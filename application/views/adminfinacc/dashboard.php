
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
        
          <div id="layoutSidenav_content">
              <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?= $title; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                              <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($d0 as $row) : ?>
                                    <div class="card-body">Rp. <?= number_format($row->no,2);?><br><br><strong><h4>invoice baru</h4></strong></div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('finance/d0s');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($d060 as $row) : ?>
                                      <div class="card-body">Rp. <?= number_format($row->no,2);?><br><br><strong><h4> 0-30 hari</h4></strong></div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('finance/d060s');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($d3060 as $row) : ?>
                                      <div class="card-body">Rp. <?= number_format($row->no,2);?><br><br><strong><h4> 30-60 hari</h4></strong></div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('finance/d3060s');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($d6090 as $row) : ?>
                                      <div class="card-body">Rp. <?= number_format($row->no,2);?><br><br><strong><h4> 60-90 hari</h4></strong></div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('finance/d6090s');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($d90120 as $row) : ?>
                                    <div class="card-body">Rp. <?= number_format($row->no,2);?><br><br><strong><h4>90-120 hari</h4></strong></div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('finance/d90120s');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($d120 as $row) : ?>
                                    <div class="card-body">Rp. <?= number_format($row->no,2);?><br><br><strong><h4>120 > hari</h4></strong></div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('finance/d120s');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                             
                             
                           
                          
                        </div>
                      
                    </div>
                </main>
              
                
              
          
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     