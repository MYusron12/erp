
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

           <div class="row">
            <div class="col-md-5">
                 <form action="<?= base_url('finance'); ?>" method="post">
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
           
                      <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Bs No</th>
                            <th scope="col">Bank Cash</th>
                            <th scope="col">Department</th>
                            <th scope="col">App Name</th>
                            <th scope="col">Type Of Transaction</th>
                            <th scope="col">Credit Total</th>
                            <th scope="col">Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>

                         <?php $arrDisplay = []; ?>
                          <?php if (!empty($pettycash)) : ?>
                            <?php foreach ($pettycash as $c) : ?>
                              <?php $arrDisplay[ "Dept : " . $c['nama']][]=$c; ?>
                            <?php endforeach; ?>
                           <!--  <?=  '<pre>';print_r($arrDisplay);echo '</pre>'; ?>  -->
                          <?php endif; ?>

                                   
                        <?php if (! empty($arrDisplay)) : ?>
                          <?php foreach ($arrDisplay as $nama => $c1) : ?> 
                             <tr>
                              <td colspan="9" style="background-color: #F0F8FF;"><?=  $nama;  ?></td>         
                            </tr>


                            <?php if (! empty($c1)) : ?>
                              <?php foreach ($c1 as $c) : ?>    
                          <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= date('d-m-Y', strtotime($c['tanggal'])); ?></td>
                            <td><?= $c['no_bs']; ?></td>
                            <td><?= $c['no_kas_bank']; ?></td>
                            <td><?= $c['nama']; ?></td>
                            <td><?= $c['pemohon']; ?></td>
                            <td><?= $c['jenis_transaksi']; ?></td>
                             <td><?= number_format($c['jumlah_awal'],2,",","."); ?></td>

                            <td>
                            <a href="<?= base_url('finance/pettycashprocess/') . $c['id_transaksi_dept']; ?>" class="badge badge-primary">Process</a>  
                  
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


     

