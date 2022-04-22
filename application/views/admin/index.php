
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
        
          <div id="layoutSidenav_content">
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

     