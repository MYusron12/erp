
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
           
           <div class="row">
           	<div class="col-lg-6">

           		<div class="form-group row">
				    <label for="bsno" class="col-sm-3 col-form-label">BS No.</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="bsno" name="bsno" value="<?= $pettycash['no_bs']; ?>" readonly>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="bankcash" class="col-sm-3 col-form-label">Bank Cash</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="bankcash" name="bankcash" value="<?= $pettycash['no_kas_bank']; ?>" readonly>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="department" class="col-sm-3 col-form-label">Department</label>
				    <div class="col-sm-6">
				      <select name="department_id" id="department_id" class="selectpicker show-tick form-control" data-live-search="true" title="Select Department" data-width="100%" disabled>
		     
		             <?php foreach ($department as $d) : ?>
		             	<?php if ($d['id_departement'] == $pettycash['id_department']) : ?>
                			<option value="<?= $d['id_departement']; ?>" selected><?= $d['nama']; ?></option>
                			<?php else : ?>
                              <option value="<?= $d['id_departement']; ?>"><?= $d['nama']; ?></option>
                		<?php endif; ?>
            		<?php endforeach; ?>
		               
		              </select>
				    </div>
				  </div>
                   
           	</div>

               <div class="col-lg-6">

              
               	  <div class="form-group row">
				    <label for="applicant" class="col-sm-4 col-form-label">Applicant Name</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="applicant" name="applicant" value="<?= $pettycash['pemohon']; ?>" readonly>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="applicant" class="col-sm-4 col-form-label">Type Of Transaction</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="typetransaction" name="typetransaction" value="<?= $pettycash['jenis_transaksi']; ?>" readonly>
				    </div>
				  </div>


				  <div class="form-group row">
				    <label for="credit" class="col-sm-4 col-form-label">Credit Total</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="credit" name="credit" value="<?= number_format($pettycash['jumlah_awal'],2,",","."); ?>" readonly>
				    </div>
				  </div>

               </div>
           
           </div>

           <hr>

           <div class="row">
           	<div class="col-lg-7">

           			<?php if ( validation_errors() ) : ?>
		                <div class="alert alert-success" role="alert">
		                 <?= validation_errors(); ?>
		                </div>
		             <?php endif; ?>

           		<form action="<?= base_url('finance/pettycashprocess/') . $pettycash['id_transaksi_dept']; ?>" method="post">

                <input type="hidden" id="id_transaksi_dept" name="id_transaksi_dept" value="<?= $pettycash['id_transaksi_dept']; ?>">

                 <input type="hidden" id="iddepartment" name="iddepartment" value="<?= $pettycash['id_department']; ?>">

           		<div class="form-group row">
				    <label for="approvaldate" class="col-sm-3 col-form-label">Approval Date</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control tanggal" id="approvaldate" name="approvaldate" value="<?php echo date('d-m-Y'); ?>">
				    </div>
				  </div>


				  <div class="form-group row">
				    <label for="approvedby" class="col-sm-3 col-form-label">Approved By</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="approvedby" name="approvedby">
				    </div>
				  </div>


				   <div class="form-group row">
				    <label for="ammount" class="col-sm-3 col-form-label">Ammount</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="ammount" name="ammount">
				    </div>
				  </div>


				  <div class="form-group row">
				    <label for="receivedby" class="col-sm-3 col-form-label">Received By</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="receivedby" name="receivedby">
				    </div>
				  </div>
                  

                  <div class="form-group row">
				    <label for="receivingdate" class="col-sm-3 col-form-label">Receiving Date</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control tanggal" id="receivingdate" name="receivingdate" value="<?php echo date('d-m-Y'); ?>">
				    </div>
				  </div>

				  <div class="form-group row justify-content-end mt-5">
                  	<div class="col-sm-10">
                  		<button type="submit" class="btn btn-primary">Submit</button>
                  		<a href="<?= base_url('finance'); ?>" class="btn btn-success">Batal</a>
                  	</div>
                  </div>

               </form>
                  
           		
           	</div>
           </div>
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

  
  <script>
	
	
	var ammount = document.getElementById('ammount');
    ammount.addEventListener('keyup', function(e)
    {
      ammount.value = formatRupiah(this.value);
   });

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