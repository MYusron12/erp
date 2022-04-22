
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <a href="<?= base_url('finance/transaksiproses'); ?>" class="btn btn-primary btn-sm">Add Transaction</a>
         <div class="row mt-1">
         	<div class="col-md-12">

             <?= $this->session->flashdata('message') ?>  

         		<div class="table-responsive-md">
                   <table class="table table-bordered" id="data_table">
                        <thead>
                          <tr>

                            <th scope="col">Cash/Bank No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Necessity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                             <th scope="col">Action</th>
                                                      
                            
                          </tr>
                        </thead>
                        <tbody>
                         <?php $i= 1; foreach ($transHead as $row) : ?>
                          <?php if ($row['status'] == 1) : ?>
                            <?php $status ="Reimbursment HO" ?>
                           <?php else : ?>
                            <?php $status = "?????"; ?>
                           <?php endif; ?>
                           <tr>
                             <td><?= $row['cashbankno'];  ?></td>
                             <td><?= date('d-m-Y', strtotime($row['tgl_pengajuan']));  ?></td>
                             <td><?= $row['keperluan'];  ?></td>
                             <td><?= number_format($row['total'],2,",",".");  ?></td>
                             <td><?= $status;  ?></td>
                             <td>
                                <a href="<?= base_url('finance/updatetrans/') .$row['id_transaksi']; ?>" class="badge badge-success">Edit</a>  
                                <a href="<?= base_url('finance/hapus/') .$row['id_transaksi']; ?>" class="badge badge-danger" onclick="return confirm('Are you Sure?...');">Delete</a>
                                 </td>
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

     