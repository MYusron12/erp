<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
          <div class="row">
            
            <div class="col-md-3">
              <a href="<?= base_url('transaksi/create'); ?>" class="btn btn-primary mb-3">Create</a>
              </div>
              <div class="col-md-5" style="margin-left: 365px;">
                 <form action="<?= base_url('transaksi'); ?>" method="post">
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

            <?= $this->session->flashdata('message') ?>  
          
             <div class="card mb-4 text-white">
                <div class="card-header py-3 bg-primary">
                  Total : <?= $total_rows; ?> Data Results
                </div>
                <div class="card-body">
           <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
           <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">No BS</th>
            <th scope="col">Pemohon</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah Pengajuan</th>
            <th scope="col">Aksi</th>
            
            </tr>
          </thead>
             <tbody> 

              <?php if( empty($pettycash)) : ?>
                        <tr>
                          <td colspan="9" style="text-align: center;">
                            <div class="alert alert-danger" role="alert">
                              Data not found!
                            </div>
                          </td>
                        </tr>
                <?php endif; ?>   

            <?php $arrDisplay = []; ?>
            <?php if (!empty($pettycash)) : ?>
              <?php foreach ($pettycash as $c) : ?>
                <?php $arrDisplay[ "Bagian : " . $c['nama_bagian']][]=$c; ?>
              <?php endforeach; ?>
             <!--  <?=  '<pre>';print_r($arrDisplay);echo '</pre>'; ?>  -->
            <?php endif; ?>

                     
         <?php if (! empty($arrDisplay)) : ?>
            <?php foreach ($arrDisplay as $nama_bagian => $c1) : ?> 
               <tr>
                <td colspan="9" style="background-color: #F0F8FF;"><?=  $nama_bagian;  ?></td>         
              </tr>


              <?php if (! empty($c1)) : ?>
                <?php foreach ($c1 as $c) : ?>
                  <tr>

                    <th scope="row"><?= ++$start; ?></th>
                    <td><?= date('d-m-Y', strtotime($c['tanggal'])); ?></td>
                    <td><?= $c['no_bs']; ?></td>
                    <td><?= $c['pemohon']; ?></td>
                    <td><?= $c['keterangan']; ?></td>
                    <td><?= number_format($c['jmlajuan'],2,",","."); ?></td>
                    <td>
                    
                    <a href="<?= base_url('transaksi/editbssementara/') .$c['id_transaksi_dept']; ?>" class="btn btn-info btn-sm editbs"<?= href_batalbssementara($c['id_transaksi_dept']); ?>><i class="far fa-edit"></i>Edit</a>

                    <a href="<?= base_url('report/printcashbon/') .$c['id_transaksi_dept']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-print" ></i>Print</a>

                    <a href="<?= base_url('transaksi/bssementarabatal/'). $c['id_transaksi_dept']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?...');"><i class="fas fa-times"></i>Batal</a>

                    </td>

                   <td>
                      <input type="checkbox" id="batal" name="batal" class="bssementara-check-input" <?= check_batalbssementara($c['id_transaksi_dept']); ?> data-id="<?= $c['id_transaksi_dept'] ?>" data-nobs="<?= $c['no_bs']; ?>">
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


     

