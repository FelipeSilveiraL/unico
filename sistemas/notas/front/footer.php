<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; TI Grupo Servopa
  </div>
  <div class="credits">
    Dúvidas ou sujestões entrar em contato via <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/glpi" target="_blank">GLPI</a>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Vendor JS Files -->
<script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/chart.js/chart.min.js"></script>
<script src="../../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../../assets/vendor/quill/quill.min.js"></script>
<script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../../assets/vendor/php-email-form/validate.js"></script>
<script src="../../../assets/js/formCpf.js"></script>
<script src="../../../assets/js/mascaras.js"></script>
<script src="../../../assets/js/jquery.js"></script>
<!-- <script src="../../../assets/js/seg.js"></script> -->

<!-- Template Main JS File -->
<script src="../../../assets/js/main.js"></script>

</body>

<?php
$conn->close();
$connNOTAS->close();
?>

</html>