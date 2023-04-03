<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Editar Regra Empresa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="empresas.php?pg=<?= $_GET['pg'] ?>">EMPRESAS</a></li>
        <li class="breadcrumb-item">Editar Regra Empresa</li>
      </ol>
    </nav>
  </div>

  <?php
  require_once('../../../inc/mensagens.php');

  require '../inc/editemp.php';
?>
<script>
  function aprovador() {
    var tela = document.getElementById("liberarApro").style.display;

    if (tela == "none") {
      document.getElementById("liberarApro").style.display = "block";
      document.getElementById("aproCaixa").required = true;
    } else {
      document.getElementById("liberarApro").style.display = "none";
      document.getElementById("aproCaixa").required = false;
    }
  }
  function camposObrigatorios() {
    var value = document.getElementById("sistema").value

    if (value == "A") {
      document.getElementById("empresaNbs").style.display = "none";
      document.getElementById("empnbs").value = "";
      document.getElementById("empresaApollo").style.display = "block";
      document.getElementById("revendaApollo").style.display = "block";

    } else {
      document.getElementById("empresaNbs").style.display = "block";
      document.getElementById("empresaApollo").style.display = "none";
      document.getElementById("revendaApollo").style.display = "none";
      document.getElementById("empApollo").value = " ";
      document.getElementById("revApollo").value = " ";
      document.getElementById("empApollo").required = false;
      document.getElementById("revApollo").required = false;
    }
  }

  function _cnpj(cnpj) {

cnpj = cnpj.replace(/[^\d]+/g, '');

if (cnpj == '') return false;

if (cnpj.length != 14)
    return false;


if (cnpj == "00000000000000" ||
    cnpj == "11111111111111" ||
    cnpj == "22222222222222" ||
    cnpj == "33333333333333" ||
    cnpj == "44444444444444" ||
    cnpj == "55555555555555" ||
    cnpj == "66666666666666" ||
    cnpj == "77777777777777" ||
    cnpj == "88888888888888" ||
    cnpj == "99999999999999")
    return false;


tamanho = cnpj.length - 2
numeros = cnpj.substring(0, tamanho);
digitos = cnpj.substring(tamanho);
soma = 0;
pos = tamanho - 7;
for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
        pos = 9;
}
resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
if (resultado != digitos.charAt(0)) return false;
tamanho = tamanho + 1;
numeros = cnpj.substring(0, tamanho);
soma = 0;
pos = tamanho - 7;
for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
        pos = 9;
}
resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
if (resultado != digitos.charAt(1))
    return false;

return true;

}

function validarCNPJ(el){
  if( !_cnpj(el.value) ){

    $('#verticalycentered').modal('show')

    // apaga o valor
    el.value = "";
  }
}

function onlyNumberKey(evt) { 
              
              // Only ASCII character in that range allowed 
              var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
              if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                  return false; 
              return true; 
          } 

</script>
<?php
  require_once('footer.php'); //Javascript e configurações afins
  ?>