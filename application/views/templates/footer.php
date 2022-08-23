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

<!-- sweetalert -->
<script src="<?= base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/sweetalert.js'); ?>"></script>

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

  $('#total').on("change", function(){
    var jumlah = document.getElementById('#qty');
    var harga = document.getElementById('#harga');
    var total = harga * jumlah;
  });

  // function grandtotal() {
  //   var tabel = $("#tabel tbody tr").length;
  //   var grandtotalbarang = 0;
  //   for (x = 0; x < tabel; x++) {
  //     var tr = $("#tabel tbody tr")[x];
  //     var count = $(tr).attr('id');
  //     count = count.substring(4);
  //     var total = $("#total_" + count).val();
  //     var total = total.replace(/[^,\d]/g, '');
  //     var total = total.replace(',', '.');
  //     grandtotalbarang = Number(grandtotalbarang) + Number(total);
  //   } // /for
  //   console.log(tabel);
  //   console.log(x);
  //   // grandtotalbarang = grandtotalbarang.toFixed(2);
  //   // $('#grandtotal').val(grandtotalbarang);  
  //   $('#grandtotalbarang').val(grandtotalbarang);  
  //   // console.log(grandtotalbarang);
  // }

function myfunctionHargaJasa(row = null) {
  var x = document.getElementById("harga_" + row);
  // x.value = formatRupiah(x.value);
  if (row) {
      var total = $("#harga_" + row).val();
      var total = total.replace(/[^,\d]/g, '');
      var total = total.replace(',', '.');
      var result = Number(total) * Number($('#qty_' + row).val());
      $("#total_" + row).val(result);
      grandtotal();
  } else {
      alert('no row !! please refresh the page');
  }
}
function getTotalJasa(row = null) {
    if (row) {
        var total = $("#harga_" + row).val();
        // var total = total.replace(/[^,\d]/g, '');
        // var total = total.replace(',', '.');
        var result = Number(total) * Number($('#qty_' + row).val());
        $("#total_" + row).val(result);
        grandtotal();
		//console.log(result);
    } else {
        alert('no row !! please refresh the page');
    }
}

function myfunctionHargaJasaRow() {
  var x = document.getElementById("hargarow");
  // x.value = formatRupiah(x.value);
      var total = $("#hargarow").val();
      var total = total.replace(/[^,\d]/g, '');
      var total = total.replace(',', '.');  
      var result = Number(total) * Number($('#qtyrow').val());
      $("#totalrow").val(result);
      grandtotal();
}
function getTotalJasaRow() {
        var total = $("#hargarow").val();
        var total = total.replace(/[^,\d]/g, '');
        var total = total.replace(',', '.');
        var result = Number(total) * Number($('#qtyrow').val());
        $("#totalrow").val(result);
        grandtotal();
		console.log(result);
}

function removeRow1Jasa(tr_id) {
    $("#tambahjasa tbody tr#row_" + tr_id).remove();
    grandtotal();
}

$(function(){
  $('#tambahjasa').on('click', function(){
  var ec = base_url+'purchasing/ec';
      var tabel = $('#tabel1');
      var tr = $('#tabel1 tbody tr').length;
      var row_id = tr + 1;
      var html = "";
      $.ajax({
        url: base_url + 'purchasing/coa',
        method: 'POST',
        dataType: 'json',
        success: function(data){
          console.log(ec)
          html += '<tr id="row_' + row_id + '">';
          // html += '<td></td>';
          html += '<td><textarea name="deskripsi_jasa[]" id="deskripsi_jasa_' + row_id + '" cols="15" rows="5"></textarea></td>';
          html += '<td><select name="loc[]" id="loc_' + row_id + '" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="">Pilih</option>'
          $.each(data, function (index, value) {
                html += '<option value="' + value.kode_loc + '">' + value.kode_loc + '|' + value.nama + '</option>';
            });
          '</select></td>';
          html += '<td><select name="ec[]" id="ec_'+row_id+'" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="0">Pilih</option><option value=""></option></select></td>';
          html += '<td><select name="na[]" id="na_'+row_id+'" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="0">Pilih</option></select></td>';
          html += '<td><select name="tb[]" id="tb_'+row_id+'" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="0">Pilih</option></select></td>';
          html += '<td><input type="number" class="form-control" id="ea[]" name="ea_' + row_id + '" value="0"  /></td>';
          html += '<td><select name="satuan[]" id="satuan_'+row_id+'" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="0">Pilih</option></select></td>';
          html += '<td><input type="text" class="form-control" id="qty_' + row_id + '" name="qty[]" onkeyup="getTotalJasa(' + row_id + ')"></td>';
          html += '<td><input type="text" class="form-control" id="harga_' + row_id + '" name="harga[]" onkeyup="myfunctionHargaJasa(' + row_id + ')"></td>';
          html += '<td><input type=" text" class="form-control" id="total_' + row_id + '" name="total[]" readonly></td>';html += '<td><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></td>';
          console.log(row_id);
          $('#tabel1 tbody:last-child').append(html);
          $('.selectpicker').selectpicker("refresh");
        }
      });
    });
});

  

 </script>


 </body>

 </html>