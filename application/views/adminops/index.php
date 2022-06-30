<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
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
                            
                            <div class="col-xl-2 col-md-6 text-white mb-4">
                                <div class="card bg-danger text-white mb-4">
                                    <?php  foreach ($count_service as $row) : ?>
                                      <div class="card-body"><?= $row->tot;?> Mobil wajib di Service</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totservice');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                     <?php  foreach ($count_stnk as $row) : ?>
                                      <div class="card-body"><?= $row->tot_stnk;?> Mobil wajib di STNK</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totstnk');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                     <?php  foreach ($count_bpkb as $row) : ?>
                                      <div class="card-body"><?= $row->tot_bpkb;?> Mobil wajib di BPKB</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totbpkb');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($count_kir as $row) : ?>
                                      <div class="card-body"><?= $row->tot_kir;?> Mobil wajib di KIR</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totkir');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                          
                             <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($count_sipabks as $row) : ?>
                                      <div class="card-body"><?= $row->count_sipabks;?> Mobil wajib di SIPA BKS</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totbks');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($count_ibmbks as $row) : ?>
                                      <div class="card-body"><?= $row->count_ibmbks;?> Mobil wajib di IBM Bks</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totimbbks');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($count_sipabgr as $row) : ?>
                                      <div class="card-body"><?= $row->count_sipabgr;?> Mobil wajib di SIPA Bogor</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totspbgr');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($count_ibmclg as $row) : ?>
                                      <div class="card-body"><?= $row->count_ibmclg;?> Mobil wajib di IBM Cilegon</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totibmclg');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    
                                     <?php  foreach ($count_lintas as $row) : ?>
                                      <div class="card-body"><?= $row->count_lintas;?> Mobil wajib di ijin lintas</div>
                                       <?php endforeach;?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('adminops/totizin');?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
              <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Urut Mobil</th>
                                                 <th>No Polisi</th>
                                                <th>Perpanjang Pajak</th>
                                                <th>Perpanjang BPKP</th>
                                                 <th>Perpanjang KIR</th>
                                                 <th>KM Service</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>No Urut Mobil</th>
                                                <th>No Polisi</th>
                                                <th>Perpanjang Pajak</th>
                                                <th>Perpanjang BPKP</th>
                                                <th>Perpanjang KIR</th>
                                                <th>KM Service</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php  
                                            $i = 1;
                                            
                                           foreach ($truck as $row) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->no_urut; ?></td>
                                                <td><?= $row->no_polisi; ?></td>
                                                <?php if($row->byr_pajak < 30):?>
                                         
                                              <td><span class="badge bg-danger text-white mb-4"><?= $row->byr_pajak; ?> Hari Lagi</span></td>
                                                <?php else :?>
                                              <td><span class="badge rounded-pill bg-warning text-white mb-4"><?= $row->byr_pajak; ?> Hari Lagi</span></td>
                                                 <?php endif;?>
                                              <?php if($row->byr_pajak < 30):?>
                                         
                                              <td><span class="badge bg-danger text-white mb-4"><?= $row->byr_kaleng; ?> Hari Lagi</span></td>
                                                <?php else :?>
                                              <td><span class="badge rounded-pill bg-warning text-white mb-4"><?= $row->byr_kaleng; ?> Hari Lagi</span></td>
                                                 <?php endif;?>
                                              <?php if($row->byr_kir < 30):?>
                                         
                                              <td><span class="badge bg-danger text-white mb-4"><?= $row->byr_kir; ?> Hari Lagi</span></td>
                                                <?php else :?>
                                              <td><span class="badge rounded-pill bg-warning text-white mb-4"><?= $row->byr_kir; ?> Hari Lagi</span></td>
                                                 <?php endif;?>
                                               <?php if($row->km < 500):?>
                                         
                                              <td><span class="badge bg-danger text-white mb-4"><?= $row->km; ?> KM lagi wajib serivce</span></td>
                                                <?php else :?>
                                              <td><span class="badge rounded-pill bg-warning text-white mb-4"><?= $row->km; ?> KM lagi wajib serivce</span></td>
                                                 <?php endif;?>
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

     