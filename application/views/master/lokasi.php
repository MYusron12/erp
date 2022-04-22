
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <div class="col-md-3">
              <a href="" class="btn btn-primary mb-3 tambahDataLokasi" data-toggle="modal" data-target="#newLokasiModal">Add Lokasi</a>
              </div>
              <div class="col-md-5" style="margin-left: 360px;">
                 <form action="<?= base_url('master/lokasi'); ?>" method="post">
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
           	<div class="col-lg-12">

           		 <?php if ( validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                 <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

                <?= $this->session->flashdata('message') ?>  
          
           		

              <div class="card mb-4 text-white">
                <div class="card-header py-3 bg-primary">
                  Total : <?= $total_rows; ?> Data Results
                </div>
                <div class="card-body">  
                 		<table class="table table-hover table-bordered" width="100%" cellspacing="0">
      				  <thead>
      				    <tr>
      				      <th scope="col">#</th>
      				      <th scope="col">Account</th>
      				      <th scope="col">Name</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Realization</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Action</th>
      				      
      				    </tr>
      				  </thead>
      				  <tbody>
      				  	<?php foreach ($lokasi as $c) : ?>	  	
      				    <tr>
      				      <th scope="row"><?= ++$start; ?></th>
      				      <td><?= $c['kode_loc']; ?></td>
                    <td><?= $c['nama']; ?></td>
                    <td><?= number_format($c['pinjem'],2,",","."); ?></td>
                    <td><?= number_format($c['realisasi'],2,",","."); ?></td>
                    <td><?= number_format($c['saldo'],2,",","."); ?></td>

      				      <td>
      				      <a href="<?= base_url('master/moneydetails/') . $c['id_departement']; ?>" class="badge badge-warning">Money</a>

                    <a href="" class="badge badge-success tampilModalUbahLokasi" data-toggle="modal" data-target="#newLokasiModal" data-id="<?= $c['id_departement']; ?>">Edit</a> 	

      				      <a href="<?= base_url('master/deletelokasi/') . $c['id_departement']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure ?..');">Delete</a>
      				      </td>
      				    </tr>
      				<?php endforeach; ?>
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

     

<!-- Modal -->
<div class="modal fade" id="newLokasiModal" tabindex="-1" role="dialog" aria-labelledby="newLokasiModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newLokasiModaLabel">Add Lokasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?= base_url('master/lokasitambah') ?>" method="post">
        
        <input type="hidden" id="id" name="id">

         <div class="form-group">
		    <input type="text" class="form-control" id="accountno" name="accountno" placeholder="Account No">
		  </div>


       <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
      </div>

      <div class="form-group">
         <label for="formGroupExampleInput">Credit</label>
        <input type="text" class="form-control" id="credit" name="credit" value="0" placeholder="Credit" readonly>
      </div>

       <div class="form-group">
        <label for="formGroupExampleInput">Realization</label>
        <input type="text" class="form-control" id="realization" name="realization" value="0" placeholder="Realization" readonly>
      </div>

        <div class="form-group">
        <label for="formGroupExampleInput">Balance</label>
        <input type="text" class="form-control" id="balance" name="balance" value="0" placeholder="Balance" readonly>
      </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>