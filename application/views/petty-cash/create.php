
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	<div class="col-lg">

          		<?php if ( validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                 <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

               

          		<form action="<?= base_url('pettycash/create'); ?>" method="post">

          		<div class="form-group row">
				    <label for="bsno" class="col-sm-2 col-form-label">BS No.</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="bsno" name="bsno" value="<?= $bsno; ?>" readonly>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="bankcash" class="col-sm-2 col-form-label">Bank Cash</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="bankcash" name="bankcash" value="<?= $bcno; ?>" readonly>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="department" class="col-sm-2 col-form-label">Department</label>
				    <div class="col-sm-10">
				      <select name="department_id" id="department_id" class="selectpicker show-tick form-control" data-live-search="true" title="Select Department" data-width="100%">
		              <option value="">Select Department</option>
		              <?php foreach ($department as $d) : ?>
                      <option value="<?= $d['id_departement']; ?>"><?= $d['nama']; ?></option>

		              <?php endforeach; ?>
		               
		              </select>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="applicant" class="col-sm-2 col-form-label">Applicant Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="applicant" name="applicant">
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="applicant" class="col-sm-2 col-form-label">Type Of Transaction</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="typetransaction" name="typetransaction">
				    </div>
				  </div>


				  <div class="form-group row">
				    <label for="credit" class="col-sm-2 col-form-label">Credit Total</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="credit" name="credit">
				    </div>
				  </div>


                <div class="form-group row justify-content-end">
                  	<div class="col-sm-10">
                  		<button type="submit" class="btn btn-primary">Submit</button>
                  		<a href="<?= base_url('pettycash'); ?>" class="btn btn-success">Cancel</a>
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
	
	
	var credit = document.getElementById('credit');
    credit.addEventListener('keyup', function(e)
    {
      credit.value = formatRupiah(this.value);
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