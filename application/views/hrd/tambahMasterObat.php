
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

         <div class="row">
         	<div class="col-lg-6">
             <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
         		<form action="<?= base_url('hrd/tambahMasterObat'); ?>" method="post">
<?php foreach($getallobat as $row) ?>
<?php $total = $row->total; ?>
                    <div class="form-group">
					    <label for="kode_obat">Kode Obat</label>
					    <input type="text" class="form-control" id="kode_obat" name="kode_obat" required value="hrmdcn00<?= $total; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" autofocus required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
         		</form>
         	</div>
         </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     