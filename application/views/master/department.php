
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="row">
          	<div class="col-md-3">
          		 <a href="" class="btn btn-primary btn-sm mb-3 tambahDataDept" data-toggle="modal" data-target="#newDeptModal"><i class="fas fa-plus"></i>Tambah</a>
          	</div>
          </div>
          <div class="row">
          	<div class="col-md-12">
          		<?php if (validation_errors() ) : ?>
	                <div class="alert alert-success" role="alert">
	                 <?= validation_errors(); ?>
	                </div>
	               <?php endif; ?>

	           <?= $this->session->flashdata('message') ?>
          	<div class="table-responsive">
          		<table class="table table-bordered table-hover" cellspacing="0" id="dataTable">
				  <thead>
				    <tr>
				      <th scope="col" width="5%">No</th>
				      <th scope="col" width="20%">Kode Bagian</th>
				      <th scope="col" width="25%">Nama Bagian</th>
				      <th scope="col" width="25%">Kepala Bagian</th>
				      <th scope="col">Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				   <?php $i = 1; foreach ($bagian as $row) : ?>
				   	<tr>
				   		<td><?= $i++; ?></td>
				   		<td><?= $row->kode_bagian; ?></td>
				   		<td><?= $row->nama_bagian; ?></td>
				   		<td><?= $row->kepala_bagian; ?></td>
				   		<td>
				   			<a href="" class="btn btn-success btn-sm tampilModalDepartmentUbah" data-toggle="modal" data-target="#newDeptModal" data-id="<?= $row->idbagian; ?>"><i class="far fa-edit">Edit</i></a>
				   			<a href="<?= base_url('master/hapusdepartment/') .$row->idbagian; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Kamu Yakin?..');"><i class="fas fa-trash">Hapus</i></a>
				   		</td>
				   	</tr>
                    

				   	<?php endforeach; ?>
				  </tbody>
				</table>
          	</div>
          </div>
        
         </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <!-- Modal -->
<div class="modal fade" id="newDeptModal" tabindex="-1" role="dialog" aria-labelledby="newDeptModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newDeptModalLabel">Tambah Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	 <form action="<?= base_url('master/department'); ?>" method="post">

         <input type="hidden" id="idbagian" name="idbagian">
         <div class="form-group">
		    <input type="text" class="form-control" id="kodebagian" name="kodebagian" placeholder="Kode Bagian">
		  </div>

		  <div class="form-group">
		    <input type="text" class="form-control" id="namabagian" name="namabagian" placeholder="Nama Bagian">
		  </div>

		  <div class="form-group">
		    <input type="text" class="form-control" id="kepalabagian" name="kepalabagian" placeholder="Kepala Bagian">
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
