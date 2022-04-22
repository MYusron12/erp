 <!-- Footer -->
 <footer class="sticky-footer bg-white">
   <div class="container my-auto">
     <div class="copyright text-center my-auto">
       <span>Copyright &copy; PT Matahari Nusantara Logistik <?= date('Y'); ?></span>
     </div>
   </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
   <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
       </div>
     </div>
   </div>
 </div>

 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>


 <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>


 <script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url('assets/'); ?>js/bootstrap-datepicker.js"></script>
 <script src="<?= base_url('assets/'); ?>js/jquery.maskMoney.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/bootstrap-select-1.13.2/dist/js/bootstrap-select.min.js"></script>

 <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> -->

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
 <script src="<?= base_url('assets/'); ?>js/myscript.js"></script>
 <script src="<?= base_url('assets/'); ?>js/transaksi.js"></script>
 <script src="<?= base_url('assets/'); ?>js/posisikas.js"></script>
 <script src="<?= base_url('assets/'); ?>js/editkasbankkk.js"></script>
 <script src="<?= base_url('assets/'); ?>js/purchasing.js"></script>
 <script src="<?= base_url('assets/'); ?>js/approval.js"></script>
 <script src="<?= base_url('assets/'); ?>js/jasa.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>



 <script type="text/javascript">
   $('.selectpicker').selectpicker();

   $('.formatliter').mask("###.##", {
     reverse: true
   });

   //  //Rupiah
   //  $('.formatrupiah').mask("###.###,000", {
   //    reverse: true
   //  });

   //  ribuan
   //  $('.money').mask("###.###.000", {
   //    reverse: true
   //  });



   $('.custom-file-input').on('change', function() {
     let fileName = $(this).val().split('\\').pop();
     $(this).next('.custom-file-label').addClass("selected").html(fileName);

   });


   $('.form-check-input').on('click', function() {
     const menuId = $(this).data('menu');
     const roleId = $(this).data('role');

     $.ajax({
       url: "<?= base_url('admin/changeaccess'); ?>",
       type: 'post',
       data: {
         menuId: menuId,
         roleId: roleId
       },
       success: function() {

         document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;

       }
     });

   });

   $(document).ready(function() {
     $('.tanggal').datepicker({
       format: "dd-mm-yyyy",
       autoclose: true,
       todayHighlight: true,
     });

     $('.tanggal2').datepicker({
       format: "yyyy-mm-dd",
       autoclose: true,
       todayHighlight: true,
     });

     $('#dataTable').DataTable();
     $('#dataTable1').DataTable();
     $('.dataTable1').DataTable();


   });



   $(document).ready(function() {
     $('#mydata').DataTable();
   });



   $('#ctkkasbank').on('click', function() {

     var tgl1 = $('#tgl1').val();
     var tgl2 = $('#tgl2').val();

     $('#startdate').val(tgl1);
     $('#enddate').val(tgl2);


   });

   $('#yakasbank').on('click', function() {
     $('#cetakKasbankModal').modal('hide');

   });



   $('#ctkreimburst').on('click', function() {

     var tgl1 = $('#tgl1').val();
     var tgl2 = $('#tgl2').val();

     $('#startdate').val(tgl1);
     $('#enddate').val(tgl2);


   });

   $('#yareimburst').on('click', function() {
     $('#cetakReimburstModal').modal('hide');

   });


   $('#ctkrealisasi').on('click', function() {

     var tgl1 = $('#tgl1').val();
     var tgl2 = $('#tgl2').val();

     $('#startdate').val(tgl1);
     $('#enddate').val(tgl2);


   });

   $('#yarealisasi').on('click', function() {
     $('#cetakRealisasiModal').modal('hide');

   });



   $('#ctkbelumprosesho').on('click', function() {

     var tgl1 = $('#tgl1').val();
     var tgl2 = $('#tgl2').val();

     $('#startdate').val(tgl1);
     $('#enddate').val(tgl2);


   });

   $('#yabelumprosesho').on('click', function() {
     $('#cetakBelumProsesHoModal').modal('hide');

   });


   $('#ctkkasbankhobelumrealisasi').on('click', function() {

     var tgl1 = $('#tgl1').val();
     var tgl2 = $('#tgl2').val();

     $('#startdate').val(tgl1);
     $('#enddate').val(tgl2);


   });

   $('#yakasbankhobelumreal').on('click', function() {
     $('#cetakKasbankhoBelumRealHoModal').modal('hide');

   });
 </script>


 </body>

 </html>