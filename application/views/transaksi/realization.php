
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

           <div class="row">
            <div class="col-md-5">
                 <form action="<?= base_url('transaksi/realization'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Keyword.." name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                      <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                  </div>
              </form>
           </div>
          </div>

           <div class="row">
            <div class="col-lg">

              <?= form_error('payment', '<div class="alert alert-success" role="alert">', '</div>'); ?>
              <?= $this->session->flashdata('message'); ?>

            <div class="card mb-4 text-white">
                <div class="card-header py-3 bg-primary">
                  Total :  <?= $total_rows; ?>
                </div>
                <div class="card-body">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tgl Pengajuan</th>
                      <th scope="col">Tgl Terima</th>
                      <th scope="col">Aging</th>
                      <th scope="col">No Bs</th>
                      <th scope="col">Pemohon</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Aksi</th>
                      
                    </tr>
                  </thead>
                  <tbody>

                      <?php if( empty($realization)) : ?>
                        <tr>
                          <td colspan="10" style="text-align: center;">
                            <div class="alert alert-danger" role="alert">
                              Data not found!
                            </div>
                          </td>
                        </tr>
                <?php endif; ?>   

                
                    <?php $arrDisplay = []; ?>
                    <?php if (! empty($realization)) : ?>
                    <?php foreach($realization as $c) : ?>
                      <?php $arrDisplay[ "Bagian : " . $c['nama_bagian']][]=$c; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (! empty($arrDisplay)) : ?>
                      <?php foreach($arrDisplay as $nama_bagian => $c1) : ?>
                        <tr>
                              <td colspan="10" style="background-color: #F0F8FF;"><?=  $nama_bagian;  ?></td>         
                           </tr>

                    <?php if(! empty($c1)) : ?>
                    <?php $i= 1; foreach ($c1 as $c) : ?>
                    <?php $start_date = new DateTime($c['tanggal']); ?>
                   <?php $end_date = new dateTime($c['tgl_terima']); ?>
                    <?php $interval = $start_date->diff($end_date); ?>     
                    <tr>
                      <th scope="row"><?= ++$start; ?></th>
                      <td><?= date('d-m-Y', strtotime($c['tanggal'])); ?></td>
                      <td><?= date('d-m-Y', strtotime($c['tgl_terima'])); ?></td>
                      <td><?= $interval->days ?></td>
                      <td><?= $c['no_bs']; ?></td>
                      <td><?= $c['pemohon']; ?></td>
                      <td><?= $c['keterangan']; ?></td>
                       <td><?= number_format($c['jumlah'],2,",","."); ?></td>

                      <td>
                

                      <a href="" class="badge badge-primary tampilModalUbahRealization" data-toggle="modal" data-target="#newRealizationModal" data-id="<?= $c['id_transaksi_dept']; ?>">Process</a>  
            
                          </td>
                        </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
                       
                      </tbody>
                    </table>

                    <?= $this->pagination->create_links(); ?> 
              </div>
            </div>

            </div>
           </div>
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


       <!-- Modal -->
        <div class="modal fade" id="newRealizationModal" tabindex="-1" role="dialog" aria-labelledby="newRealizationModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newRealizationModalLabel">Realisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

               <form action="<?= base_url('transaksi/realization'); ?>" method="post">
                
                <input type="hidden" name="idtransaksidept" id="idtransaksidept">
                 <input type="hidden" name="lokasi" id="lokasi">


                <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">Tgl Realisasi</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control tanggal" id="realizationdate" name="realizationdate" value="<?php echo date('d-m-Y'); ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="credittotal" class="col-sm-3 col-form-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="credittotal" name="credittotal" readonly>
                </div>
              </div>


              <div class="form-group row">
                <label for="realization" class="col-sm-3 col-form-label">Jml Realisasi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="realization" name="realization">
                </div>
              </div>


              <div class="form-group row">
                <label for="balance" class="col-sm-3 col-form-label">Sisa</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="balance" name="balance" readonly>
                </div>
              </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
          </div>
        </div>  



<script>

	
	var realization = document.getElementById('realization');
   realization.addEventListener('keyup', function()
    {
      

      realization.value = formatRupiah(this.value);
      sumrealization();
      
     
   });





   

   function sumrealization()

   {
      
      var credittotal = document.getElementById('credittotal').value;
      var xcredittotal = credittotal.replace(/[^,\d]/g, '');
      var xcredittotal1 = xcredittotal.replace(',', '.');
     
      
    
      var realization = document.getElementById('realization').value;
      var xrealization = realization.replace(/[^,\d]/g, '');
      var xrealization1 = xrealization.replace(',', '.');
     
     
      var result = parseFloat(xcredittotal1) - parseFloat(xrealization1);
      // console.log(result);
      
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
  function formatRupiah(angka, prefix)
  {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa  = split[0].length % 3,
      rupiah  = split[0].substr(0, sisa),
      ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
      
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }






  
</script>
