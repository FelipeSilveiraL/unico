<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Cadastro Fornecedor</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="seminovos.php?pg=<?= $_GET['pg'] ?>">Seminovos</a></li>
        <li class="breadcrumb-item">Cadastro Fornecedor</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="card">
      <div class="row">
        <div class="card-body">
          
        <h5 class="card-title">Cadastro fornecedor</h5>
                  <form class="row g-3">
                    <div class="col-md-9"><br>
                      <input type="text" class="form-control" id = "razao" placeholder="RAZÃO SOCIAL">
                    </div>
                    <div class="col-md-3"><br>
                      <input type="text" class="form-control" name='cpfcnpj' onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()'  placeholder="CNPJ" >
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" placeholder="CIDADE">
                    </div>
                    <div class="col-1">
                      <select class="form-control"  placeholder="UF" name="estado" type="text" id="estado" required >
                       <?php 
                       $resultadoEstado = $conn->query($queryEstados);

                       while ($estados = $resultadoEstado->fetch_assoc()) {
                        
                         echo '<option value="' . $estados['sigla'] . '">' . $estados['sigla'] . ' - ' . $estados['nome'] . '</option>
                           ';
                       }
                       
                       ?>
                      </select>

                    </div>
                    <div class="col-md-5">
                      <input type="email" class="form-control" placeholder="EMAIL">
                    </div>
                    <div class="col-md-3 mt-3">
                      <input type="text" class="form-control" placeholder="LOGIN SMARTSHARE">
                    </div>
                    <div class="form-floating mb-3 col-md-4"  >
                      <select class="form-select" id="utiliza" name="utiliza" required="" onchange="smartshare()">
                        <option value="">-----------------</option>
                        <option value="S">SIM</option>
                        <option value="N">NÃO</option>
                      </select>
                      <label for="utiliza">UTILIZA SMARTSHARE</label>
                    </div>
                    <div class="form-floating mb-3 col-md-4"  id="ativo" style="display: none;">
                      <select class="form-select" name="ativo" id="estaAtivo" required="" >
                        <option value="">-----------------</option>
                        <option value="S">SIM</option>
                        <option value="N">NÃO</option>
                      </select>
                      <label for="estaAtivo">ATIVO</label>
                    </div>
                    <div class="form-floating mb-3 col-md-4" id="responsavel" style="display: none;">
                      <select class="form-select" name="responsavel" id="responsavelS" required="">
                        <option value="">-----------------</option>
                        <option value="S">SIM</option>
                        <option value="N">NÃO</option>
                      </select>
                      <label for="responsavelS">NOME RESPONSÁVEL</label>
                    </div>
                    <div class="text-center">
                      <button type="button" class="btn btn-danger"><a href ="departamentos.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                      <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                  </form>

                </div>
        </div>
      </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->
<script>
 function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}
 
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
 
function cpfCnpj(v){
 
    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")
 
    if (v.length <= 12) { //CPF
 
        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{2})(\d)/,"$1.$2")
 
        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
 
    } else { //CNPJ
 
        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")
 
        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
 
        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
 
        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
 
    }
 
    return v
}

function smartshare() {
                    var tela = document.getElementById("utiliza").value;

                    switch(tela){
                      case '':
                        document.getElementById("responsavel").style.display = "none";
                        document.getElementById("responsavelS").required = false;
                        document.getElementById("ativo").style.display = "none";
                        document.getElementById("estaAtivo").required = false;
                        break;
                      case 'S':
                        document.getElementById("responsavel").style.display = "block";
                        document.getElementById("responsavelS").required = true;
                        document.getElementById("ativo").style.display = "block";
                        document.getElementById("estaAtivo").required = true;
                      break;
                      default:
                        document.getElementById("responsavel").style.display = "none";
                        document.getElementById("responsavelS").required = false;
                        document.getElementById("ativo").style.display = "none";
                        document.getElementById("estaAtivo").required = false;
                      break;
                    }
                }
</script>

<?php
require_once('footer.php'); //Javascript e configurações afins
?>