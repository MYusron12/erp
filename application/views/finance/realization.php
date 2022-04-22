
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

           <div class="row">
            <div class="col-md-5">
                 <form action="<?= base_url('finance/realization'); ?>" method="post">
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
                      <th scope="col">Received Date</th>
                      <th scope="col">Bs No</th>
                      <th scope="col">Bank Cash</th>
                      <th scope="col">App Name</th>
                      <th scope="col">Type Of Transaction</th>
                      <th scope="col">Credit Total</th>
                      <th scope="col">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>

                      <?php if( empty($realization)) : ?>
                        <tr>
                          <td colspan="9" style="text-align: center;">
                            <div class="alert alert-danger" role="alert">
                              Data not found!
                            </div>
                          </td>
                        </tr>
                <?php endif; ?>   

                
                    <?php $arrDisplay = []; ?>
                    <?php if (! empty($realization)) : ?>
                    <?php foreach($realization as $c) : ?>
                      <?php $arrDisplay[ "Dept : " . $c['nama']][]=$c; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (! empty($arrDisplay)) : ?>
                      <?php foreach($arrDisplay as $nama => $c1) : ?>
                        <tr>
                              <td colspan="9" style="background-color: #F0F8FF;"><?=  $nama;  ?></td>         
                           </tr>

                    <?php if(! empty($c1)) : ?>
                    <?php $i= 1; foreach ($c1 as $c) : ?>     
                    <tr>
                      <th scope="row"><?= ++$start; ?></th>
                      <td><?= date('d-m-Y', strtotime($c['tgl_terima'])); ?></td>
                      <td><?= $c['no_bs']; ?></td>
                      <td><?= $c['no_kas_bank']; ?></td>
                      <td><?= $c['pemohon']; ?></td>
                      <td><?= $c['jenis_transaksi']; ?></td>
                       <td><?= number_format($c['jumlah_awal'],2,",","."); ?></td>

                      <td>
                      	<a href="" class="badge badge-success">Print</a>

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
                <h5 class="modal-title" id="newRealizationModalLabel">Realization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

               <form action="<?= base_url('finance/realization'); ?>" method="post">
                
                <input type="hidden" name="idtransaksidept" id="idtransaksidept">
                 <input type="hidden" name="iddepartment" id="iddepartment">


                <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control tanggal" id="realizationdate" name="realizationdate" value="<?php echo date('d-m-Y'); ?>">
                </div>
              </div>

                 <div class="form-group row">
                <label for="credittotal" class="col-sm-3 col-form-label">Credit Total</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="credittotal" name="credittotal" readonly>
                </div>
              </div>


              <div class="form-group row">
                <label for="note" class="col-sm-3 col-form-label">Note</label>
                <div class="col-sm-5">
                 <textarea class="form-control" id="note" name="note" rows="3"></textarea></td>
                </div>
              </div>


              <div class="form-group row">
                <label for="realization" class="col-sm-3 col-form-label">Realization</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="realization" name="realization">
                </div>
              </div>


              <div class="form-group row">
                <label for="balance" class="col-sm-3 col-form-label">Balance</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="balance" name="balance" value="0" readonly>
                </div>
              </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
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
      console.log(result);
      
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
