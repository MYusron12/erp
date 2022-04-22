
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

         <div class="row">
         	<div class="col-md-8">
         		<form action="<?= base_url('finance/kasprocess') ?>" method="post">

         		 <div class="form-group row">
	                <label for="dateposisi" class="col-sm-3 col-form-label">Date</label>
	                <div class="col-sm-6">
	                  <input type="text" class="form-control tanggal" id="dateposisi" name="dateposisi" value="<?php echo date('d-m-Y'); ?>">
	                </div>
	              </div>


	              <div class="form-group row">
				    <label for="department" class="col-sm-3 col-form-label">Department</label>
				    <div class="col-sm-6">
				      <select name="department_id" id="department_id" class="selectpicker show-tick form-control" data-live-search="true" title="Select Department" data-width="100%">
		              <option value="">Select Department</option>
		              <?php foreach ($department as $d) : ?>
                      
                      <option value="<?= $d['id_departement']; ?>"><?= $d['nama']; ?></option>

		              <?php endforeach; ?>
		               
		              </select>
				    </div>
				  </div>

				  <div class="form-group row justify-content-end">
                  	<div class="col-sm-10">
                  		<button type="submit" class="btn btn-primary">Process</button>
                  	</div>
                  </div>

                  </form>
         	</div>
         </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     