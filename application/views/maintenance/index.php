
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
                            
                            <div class="col-xl-3 col-md-6 text-white mb-4">
                                <div class="card bg-primary text-white mb-4">
                                    <?php  foreach ($count_service as $row) : ?>
                                      <div class="card-body"><?= $row->tot;?> Mobil wajib di Service</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('maintenance/totservice');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                     <?php  foreach ($count_wo1 as $row) : ?>
                                      <div class="card-body"><?= $row->wo;?> WO Yang perlu di check</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('maintenance/woperludicheck');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                     <?php  foreach ($count_wo2 as $row) : ?>
                                      <div class="card-body"><?= $row->wo;?> WO Yang sudah di check</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('maintenance/wosudahdicheck');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    
                                     <?php  foreach ($count_wo3 as $row) : ?>
                                      <div class="card-body"><?= $row->wo;?> Wo yang sudah selesai</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('maintenance/wosudahselesai');?>">View Details</a>
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

     