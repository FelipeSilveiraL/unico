
        <?php
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

        $url = "http://10.100.1.215/unico_api/sisrev/estoque.json";
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

            for($i = 1; $i <= $qtde; $i++){
                
                
                echo "".$row['produto']."<br>
                &emsp;&emsp;NF ".$row['numero_nota']."<br>
                &emsp;&emsp;".$row['caixa']."<br>";
                
                $endereco = "SELECT * FROM sisrev_etiqueta_estoque WHERE REVENDA = '".$revenda."'";
                $deuCerto = $conn->query($endereco);

                while($enderecoMostra = $deuCerto->fetch_assoc()){
                    echo '&emsp;'.$enderecoMostra['LOCACAO_ZONA'].'0'.$enderecoMostra['LOCACAO_RUA'].'&ensp;0'.$enderecoMostra['LOCACAO_ESTANTE'].'&ensp;'.$enderecoMostra['LOCACAO_PRATELEIRA'].'0'.$enderecoMostra['LOCACAO_NUMERO'].'';
                    echo '<br><br>';
                }

                        
                
            }
        }
            
        curl_close($ch);

        $conn->close();


        ?>
  




<!-- <script>
window.onload = function () { window.print(); window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint(); } 
</script> -->