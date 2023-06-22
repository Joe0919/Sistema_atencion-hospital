<footer class="main-footer">

<strong>Copyright &copy; 2022 <a href="http://localhost/SistemaAtencion/"> Hospital Antonio Caldas Domínguez</a>.</strong>
Todos los derechos reservados.
<div class="float-right d-none d-sm-inline-block">
  <b>Version</b> 1.0
</div>
</footer>
</div>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>


<script src="/SistemaAtencion/public/assets/plugins/jquery/jquery.min.js"></script>
<!-- <script src="/SistemaAtencion/public/assets/plugins/bootstrap/js/bootstrap.js"></script> -->
<script src="/SistemaAtencion/public/assets/dist/js/adminlte.js"></script>
<script src="/SistemaAtencion/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/SistemaAtencion/public/assets/js/main.js"></script> 
<!-- DataTables  & Plugins -->
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
<script src="/SistemaAtencion/public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/SistemaAtencion/public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/SistemaAtencion/public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- <script src="/SistemaAtencion/public/assets/plugins/jquery-ui/jquery-ui.min.js"></script> -->
<script src="/SistemaAtencion/public/assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/SistemaAtencion/public/assets/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>

<script>
  // $(function () {
  // $.datepicker.setDefaults($.datepicker.regional["es"]);
  // $('#datepicker').datepicker(
  //     { minDate: 0 }  
  //   );
  
  // $('#datepicker1').datepicker(
  //     { maxDate: 0 }  
  //   );
  // });
  // $.fn.datepicker.defaults.format = "mm/dd/yyyy";
  $('.datehg').datepicker({
    format: "dd/mm/yyyy",
    startDate: "<?php echo date("d/m/Y");?>",
    autoclose: true
  });
  $('.datehg1').datepicker({
    format: "dd/mm/yyyy",
    endDate: "<?php echo date("d/m/Y");?>",
    autoclose: true
  });

  $('.dateC').datepicker({
    format: "dd/mm/yyyy",
    startDate: "<?php echo date("d/m/Y");?>",
    autoclose: true
  });

</script>

</body>

</html>