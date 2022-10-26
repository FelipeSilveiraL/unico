<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impressão etiqueta</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 200px 200px;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            justify-items: stretch;
            align-items: stretch;
            font-size: small;
        }

        .div23 {
            page-break-before: always;
            page-break-inside: avoid;
        }

        .div24 {
            page-break-before: always;
            page-break-inside: avoid;
        }
        .div48 {
            page-break-before: always;
            page-break-inside: avoid;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();
        require_once('../config/query.php');

        // ------------------ ETIQUETA LASER -------------
        $dropTableEstoque = "DROP TABLE IF EXISTS sisrev_etiqueta_estoque ";

        $sucess = $conn->query($dropTableEstoque);

        $createTableEst = "CREATE TABLE `sisrev_etiqueta_estoque`(
            `id` INT NOT NULL AUTO_INCREMENT,
            `LOCACAO_ZONA` VARCHAR(80) NULL,
            `LOCACAO_RUA` VARCHAR(80) NULL,
            `LOCACAO_ESTANTE` VARCHAR(80) NULL,
            `LOCACAO_PRATELEIRA` VARCHAR(80) NULL,
            `ITEM_ESTOQUE` VARCHAR(80) NULL,
            `LOCACAO_NUMERO` VARCHAR(80) NULL,
            `EMPRESA` VARCHAR(80) NULL,
            `REVENDA` VARCHAR(80) NULL,
            PRIMARY KEY (`id`))";
        
        $execCreate = $conn->query($createTableEst);

        $url = "http://".$_SESSION['servidorOracle']."/unico_api/sisrev/api_estoque.php";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $resultado = json_decode(curl_exec($ch));


        foreach ($resultado->itensEndereco AS $etiqLaser) {
            
        
            $insertEstoque = "INSERT INTO sisrev_etiqueta_estoque(LOCACAO_ZONA,LOCACAO_RUA,LOCACAO_ESTANTE,LOCACAO_PRATELEIRA,ITEM_ESTOQUE,LOCACAO_NUMERO,EMPRESA,REVENDA)
            VALUES ('" . $etiqLaser->LOCACAO_ZONA ."',
                    '" . $etiqLaser->LOCACAO_RUA . "',
                    '" . $etiqLaser->LOCACAO_ESTANTE . "' ,
                    '" . $etiqLaser->LOCACAO_PRATELEIRA ."',
                    '" . $etiqLaser->ITEM_ESTOQUE ."',
                    '" . $etiqLaser->LOCACAO_NUMERO ."',
                    '" . $etiqLaser->EMPRESA ."',
                    '" . $etiqLaser->REVENDA ."')";

            if (!$execQuery = $conn->query($insertEstoque)) {
                echo "Error: " . $insertEstoque . "<br>" . $conn->error;
            }
        }

        $produto = $_GET['produto'];
        $produto = substr($produto, 3,6);
        $empresa = $_GET['empresa'];
        $revenda = $_GET['revenda'];

        $buscaCarga .= " WHERE produto LIKE '%" . $produto . "%' ";
        $sucesso = $conn->query($buscaCarga);

        while($row = $sucesso->fetch_assoc()){

            $qtde = $row['qtde'];

            $i = 1;

            while( $i <= $qtde){
                
                echo "
                
                <div class='div".$i."'>
                ".$row['produto']."<br>
                &emsp;&emsp;NF ".$row['numero_nota']."<br>
                &emsp;&emsp;".$row['caixa']."<br>";
                
                $endereco = "SELECT * FROM sisrev_etiqueta_estoque WHERE REVENDA = '".$revenda."'";
                $deuCerto = $conn->query($endereco);

                while($enderecoMostra = $deuCerto->fetch_assoc()){
                    echo '&emsp;'.$enderecoMostra['LOCACAO_ZONA'].'0'.$enderecoMostra['LOCACAO_RUA'].'&ensp;0'.$enderecoMostra['LOCACAO_ESTANTE'].'&ensp;'.$enderecoMostra['LOCACAO_PRATELEIRA'].'0'.$enderecoMostra['LOCACAO_NUMERO'].'';
                    echo '<br>';
                }
                echo "</div>";

            $i++;    
            }
        }
            
        curl_close($ch);
        $conn->close();
        ?>
        </div>
  </body>
</html>




<script>
window.onload = function () { window.print(); window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint(); } 
</script>