
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <div class="col-md-3">
              
              <a href="" class="btn btn-primary mb-3 tambahData1" data-toggle="modal" data-target="#newCrudbModal">Add New</a>

              </div>
              <div class="col-md-5" style="margin-left: 180px;">
                 <form action="<?= base_url('master/crudb'); ?>" method="post" name="">
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
           	<div class="col-lg-10">
              <div class="card mb-4 text-white">
                <div class="card-header py-3 bg-primary">
                  Total : <?= $total_rows; ?> Data Results
                </div>
                <div class="card-body">

           		 <?php if ( validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                 <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

                <?= $this->session->flashdata('message') ?>  
          
           	
           		<table class="table table-hover table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">No</th>
				      <th scope="col">Account No</th>
				      <th scope="col">Nama</th>
              <th scope="col">Action</th>
				      
				    </tr>
				  </thead>
				  <tbody>
             <?php if( empty($crudb)) : ?>
                <tr>
                  <td colspan="4" style="text-align: center;">
                  <div class="alert alert-danger" role="alert">
                  Data not found!
                  </div>
                  </td>
                </tr>

            <?php endif; ?> 
				  	<?php foreach ($crudb as $c) : ?>	  	
				    <tr>
				      <th scope="row"><?= ++$start; ?></th>
				      <td><?= $c['account']; ?></td>
              <td><?= $c['nama']; ?></td>
				      <td>
				      <a href="" class="badge badge-success tampilModalUbah1" data-toggle="modal" data-target="#newCrudbModal" data-id="<?= $c['id_coa_na']; ?>">Edit</a> 	
				      <a href="<?= base_url('master/deletecrudb/') . $c['id_coa_na']; ?>" class="badge badge-danger btn-sm" onclick="return confirm('Are you Sure?...');">Delete</a>
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
<div class="modal fade" id="newCrudbModal" tabindex="-1" role="dialog" aria-labelledby="newCrudbModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newCrudbModaLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?= base_url('master/crudbtambah'); ?>" method="post">
        <input type="hidden" id="id" name="id">
         <div class="form-group">
		    <input type="text" class="form-control" id="accountno" name="accountno" placeholder="Account Number">
		  </div>


      <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
      </div>

        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="kirim">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>



