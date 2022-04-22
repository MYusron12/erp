 <!-- tanggal persetujuan -->
 <?php if ($bssementara['tgl_setuju'] == 0000 - 00 - 00) : ?>
   <?php $tglsetuju = ""; ?>
 <?php else : ?>
   <?php $tglsetuju = date('d-m-Y', strtotime($bssementara['tgl_setuju'])); ?>
 <?php endif; ?>

 <!-- tanggal terima -->

 <?php if ($bssementara['tgl_terima'] == 0000 - 00 - 00) : ?>
   <?php $tglterima = ""; ?>
 <?php else : ?>
   <?php $tglterima = date('d-m-Y', strtotime($bssementara['tgl_terima'])); ?>
 <?php endif; ?>

 <?php if ($bssementara['status'] >= 3) : ?>
   <?php $disabledbutton = "disabled"; ?>
   <?php $nonaktiftext = "readonly"; ?>
 <?php else : ?>
   <?php $nonaktiftext = ""; ?>
   <?php $disabledbutton = ""; ?>
 <?php endif; ?>



 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

   <div class="row">
     <div class="col-md-6">

       <?php if (validation_errors()) : ?>
         <div class="alert alert-success" role="alert">
           <?= validation_errors(); ?>
         </div>
       <?php endif; ?>

       <form action="<?= base_url('transaksi/editbssementara/') . $bssementara['id_transaksi_dept']; ?>" method="post">

         <input type="hidden" id="idbssementara" name="idbssementara" value="<?= $bssementara['id_transaksi_dept']; ?>">
         <div class="form-group row">
           <label for="bsno" class="col-sm-2 col-form-label">No Bs.</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="bsno" name="bsno" value="<?= $bssementara['no_bs']; ?>" readonly>
           </div>
         </div>

         <div class="form-group row">
           <label for="bankcash" class="col-sm-2 col-form-label">Kas-bank</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="bankcash" name="bankcash" value="<?= $bssementara['no_kas_bank']; ?>" readonly>
           </div>
         </div>

         <!--  <div class="form-group row">
            <label for="department" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
              <select name="lokasi" id="lokasi" class="selectpicker show-tick form-control" title="Lokasi" data-width="100%" data-live-search="true">
                <option value="">Pilih</option>
                  <?php foreach ($lokasi as $d) : ?>
                    <?php if ($d['id_departement'] == $bssementara['id_dept']) : ?>
                      <option value="<?= $d['id_departement']; ?>" selected><?= $d['kode_loc'] . "-" . $d['nama']; ?></option>
                    <?php else : ?>
                      <option value="<?= $d['id_departement']; ?>"><?= $d['kode_loc'] . "-" . $d['nama']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>   
                  </select>
            </div>
          </div> -->

         <div class="form-group row">
           <label for="department" class="col-sm-2 col-form-label">Bagian</label>
           <div class="col-sm-10">
             <select name="bagian" id="bagian" class="selectpicker show-tick form-control" title="Bagian" data-width="100%" data-live-search="true" <?= $disabledbutton ?>>
               <option value="">Pilih</option>
               <?php foreach ($bagian as $d) : ?>
                 <?php if ($d['idbagian'] == $bssementara['idbagian']) : ?>
                   <option value="<?= $d['idbagian']; ?>" selected><?= $d['nama_bagian']; ?></option>
                 <?php else : ?>
                   <option value="<?= $d['idbagian']; ?>"><?= $d['nama_bagian']; ?></option>
                 <?php endif; ?>
               <?php endforeach; ?>
             </select>
           </div>
         </div>

         <div class="form-group row">
           <label for="applicant" class="col-sm-2 col-form-label">Pemohon</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="applicant" name="applicant" value="<?= $bssementara['pemohon']; ?>" readonly>
           </div>
         </div>

         <div class="form-group row">
           <label for="applicant" class="col-sm-2 col-form-label">Keterangan</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="typetransaction" name="typetransaction" value="<?= $bssementara['keterangan']; ?>" readonly>
           </div>
         </div>


         <div class="form-group row">
           <label for="credit" class="col-sm-2 col-form-label">Jumlah</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="credit" name="credit" value="<?= number_format($bssementara['jmlajuan'], 2, ",", "."); ?>" readonly>
           </div>
         </div>

     </div>
     <div class="col-md-6">

       <div class="form-group row">
         <label for="approvaldate" class="col-sm-3 col-form-label">Tgl Persetujuan</label>
         <div class="col-sm-6">
           <input type="text" class="form-control tanggal" id="approvaldate" name="approvaldate" value="<?= $tglsetuju; ?>" autocomplete="off" <?= $nonaktiftext ?>>
         </div>
       </div>


       <div class="form-group row">
         <label for="approvedby" class="col-sm-3 col-form-label">Disetujui Oleh</label>
         <div class="col-sm-6">
           <input type="text" class="form-control" id="approvedby" name="approvedby" value="<?= $bssementara['disetujui']; ?>" <?= $nonaktiftext ?>>
         </div>
       </div>



       <div class="form-group row">
         <label for="receivedby" class="col-sm-3 col-form-label">Diterima Oleh</label>
         <div class="col-sm-6">
           <input type="text" class="form-control" id="receivedby" name="receivedby" value="<?= $bssementara['penerima'];  ?>" <?= $nonaktiftext ?>>
         </div>
       </div>


       <div class="form-group row">
         <label for="receivingdate" class="col-sm-3 col-form-label">Tgl Terima</label>
         <div class="col-sm-6">
           <input type="text" class="form-control tanggal" id="receivingdate" name="receivingdate" value="<?= $tglterima;  ?>" autocomplete="off" <?= $nonaktiftext ?>>
         </div>
       </div>
     </div>
   </div>


   <hr>

   <div class="row">
     <div class="col-md-6">
       <p style="font-size: 18px; font-weight: bold;">Realisasi</p>

       <div class="form-group row">
         <label for="realizationdate" class="col-sm-4 col-form-label">Tgl Realisasi</label>
         <div class="col-sm-5">
           <input type="text" class="form-control tanggal" id="realizationdate" value="<?= date('d-m-Y') ?>" name="realizationdate" autocomplete="off" <?= $nonaktiftext ?>>
         </div>
       </div>

       <div class="form-group row">
         <label for="credittotal" class="col-sm-4 col-form-label">Jumlah Awal</label>
         <div class="col-sm-5">
           <input type="text" class="form-control" id="credittotal" name="credittotal" value="<?= number_format($bssementara['jmlajuan'], 2, ",", "."); ?>" readonly>
         </div>
       </div>


       <div class="form-group row">
         <label for="realization" class="col-sm-4 col-form-label">Jml Realisasi</label>
         <div class="col-sm-5">
           <input type="text" class="form-control" id="realization" name="realization" value="<?= $bssementara['terpakai']; ?>" <?= $nonaktiftext ?>>
         </div>
       </div>


       <div class="form-group row">
         <label for="balance" class="col-sm-4 col-form-label">Sisa Lebih/Kurang</label>
         <div class="col-sm-5">
           <input type="text" class="form-control" id="balance" name="balance" value="<?= number_format($bssementara['selisih'], 2, ",", "."); ?>" readonly>
         </div>
       </div>

     </div>
   </div>


   <div class="row">
     <div class="col-md-12">
       <div class="form-group row mt-5">
         <div class="col-sm-10">
           <button type="submit" class="btn btn-primary" <?= $disabledbutton ?>><i class="far fa-save"></i>Save</button>
           <a href="<?= base_url('transaksi/kaskecil'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
         </div>
         </form>
       </div>
     </div>
   </div>





   <!--    <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a href="<?= base_url('transaksi'); ?>" class="btn btn-success">Cancel</a>
                    </div>
                  </div>
               </form>
            </div> -->

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
 <script>
   var realization = document.getElementById('realization');
   realization.addEventListener('keyup', function() {

     realization.valu=this.value;
     sumrealization();
   });

   function sumrealization() {
     var credittotal = document.getElementById('credittotal').value;
     var xcredittotal = credittotal.replace(/[^,\d]/g, '');
     var xcredittotal1 = xcredittotal.replace(',', '.');

     var realization = document.getElementById('realization').value;
     var xrealization = realization.replace(/[^,\d]/g, '');
     var xrealization1 = xrealization.replace(',', '.');

     var result = parseFloat(xcredittotal1) - parseFloat(xrealization1);

     if (!isNaN(result)) {
       document.getElementById('balance').value = formatMoney(result);
     }
   }

   function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
     try {
       decimalCount = Math.abs(decimalCount);
       decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

       const negativeSign = amount < 0 ? "-" : "";

       let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
       let j = (i.length > 3) ? i.length % 3 : 0;

       return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
     } catch (e) {
       console.log(e)
     }

   };

   /* Fungsi */
   function formatRupiah(angka, prefix) {
     var number_string = angka.replace(/[^,\d]/g, '').toString(),
       split = number_string.split(','),
       sisa = split[0].length % 3,
       rupiah = split[0].substr(0, sisa),
       ribuan = split[0].substr(sisa).match(/\d{3}/gi);

     if (ribuan) {
       separator = sisa ? '.' : '';
       rupiah += separator + ribuan.join('.');
     }

     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
   }
 </script>