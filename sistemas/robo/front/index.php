<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados

require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Horários Robô</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Horários Robô</a></li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <br>
            <!-- Table Variants -->
            
            <table class="table-bordered" style="display: fixed;width:auto;" >
              <thead>
                <tr>
                  
                  <th  scope="col" class="capitalize">Hora</th>
                  <th colspan="2" scope="col" class="capitalize">00:00</th>
                  <th colspan="2" scope="col" class="capitalize">01:00</th>
                  <th colspan="2" scope="col" class="capitalize">02:00</th>
                  <th colspan="2" scope="col" class="capitalize">03:00</th>
                  <th colspan="2" scope="col" class="capitalize">04:00</th>
                  <th colspan="2" scope="col" class="capitalize">05:00</th>
                  <th colspan="2" scope="col" class="capitalize">06:00</th>
                  <th colspan="2" scope="col" class="capitalize">07:00</th>
                  <th colspan="2" scope="col" class="capitalize">08:00</th>
                  <th colspan="2" scope="col" class="capitalize">09:00</th>
                  <th colspan="2" scope="col" class="capitalize">10:00</th>
                  <th colspan="2" scope="col" class="capitalize">11:00</th>
                  <th colspan="2" scope="col" class="capitalize">12:00</th>
                  <th colspan="2" scope="col" class="capitalize">13:00</th>
                  <th colspan="2" scope="col" class="capitalize">14:00</th>
                  <th colspan="2" scope="col" class="capitalize">15:00</th>
                  <th colspan="2" scope="col" class="capitalize">16:00</th>
                  <th colspan="2" scope="col" class="capitalize">17:00</th>
                  <th colspan="2" scope="col" class="capitalize">18:00</th>
                  <th colspan="2" scope="col" class="capitalize">19:00</th>
                  <th colspan="2" scope="col" class="capitalize">20:00</th>
                  <th colspan="2" scope="col" class="capitalize">21:00</th>
                  <th colspan="2" scope="col" class="capitalize">22:00</th>
                  <th colspan="2" scope="col" class="capitalize">23:00</th>
                  <th  scope="col" class="capitalize">Hora</th>
                </tr>
              </thead>
              <tbody>
               
                <?php 
                $diasdasemana = array (1 => "Seg",2 => "Ter",3 => "Qua",4 => "Qui",5 => "Sex",6 => "Sáb",0 => "Dom");
                $hoje = getdate();
                $diadasemana = $hoje["wday"];
                $nomediadasemana = $diasdasemana[$diadasemana];
                echo "$nomediadasemana";

                $total = 32;

                for($i=1; $i < $total;){
                  echo '<tr>
                  <th>'.$i.'</th>
                  <td bgcolor="purple"></td>
                  <td></td>
                  <td ></td>
                  <td bgcolor="#b87333"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td bgcolor="#5a96d2"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td bgcolor="green"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <th>'.$i.'</th>
                  
                </tr>';
                $i++;
                }
                
                
                ?>
              </tbody>
            </table><br>
            <!-- End Table Variants -->
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>