<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Nome da Pagina</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item">Pagina Branco</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Stacked Bar Chart</h5>

              <!-- Stacked Bar Chart -->
              <canvas id="stakedBarChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#stakedBarChart'), {
                    type: 'bar',
                    data: {
                      labels: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'],
                      datasets: [{
                          label: 'Dataset 1',
                          data: [1, 2, 3, 4, 5],
                          backgroundColor: 'rgb(255, 99, 132)',
                        },
                        {
                          label: 'Dataset 2',
                          data: [1, 2, 3, 4, 5,23],
                          backgroundColor: 'rgb(75, 192, 192)',
                        },
                        {
                          label: 'Dataset 3',
                          data: [1, 2, 3, 4, 5,23],
                          backgroundColor: 'rgb(255, 205, 86)',
                        },
                      ]
                    },
                    
                    options: {
                      responsive: true,
                      plugins: {
                        legend: {
                          position: 'top',
                        },
                        title: {
                          display: true,
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Stacked Bar Chart -->

            </div>
          </div>
        </div>

      </div>
    </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>