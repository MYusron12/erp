 <div class="container-fluid">

          <!-- Page Heading -->
        
          <div id="layoutSidenav_content">
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"><h3><?= $title;?></h3></i>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Urut Mobil</th>
                                                 <th>No Polisi</th>
                                                 <th>Hari</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>No Urut Mobil</th>
                                                <th>No Polisi</th>
                                                <th>KM Service</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php  
                                            $i = 1;
                                            
                                           foreach ($izin_lintas as $row) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->no_urut; ?></td>
                                                <td><?= $row->no_polisi; ?></td>
                                                <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->izin_lintas;?></span> Mendekati Hari Bayar</td> 
                                              <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
          </div>
 </div>