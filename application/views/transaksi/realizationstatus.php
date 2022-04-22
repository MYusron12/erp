
         <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
           
            <div class="row">
            <div class="col-md-5">
                 <form action="<?= base_url('transaksi/realizationstatus'); ?>" method="post">
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

              <table class="table table-hover table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">No Bs</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Pemohon</th>
              <th scope="col">Jml Pengajuan</th>
              <th scope="col">Jml Realisasi</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Status</th>
             
              
            </tr>
          </thead>
          <tbody>
            
            <?php $arrDisplay = []; ?>
            <?php if (! empty($realizationstatus)) : ?>
             <?php foreach($realizationstatus as $c) : ?>
              <?php $arrDisplay[ "Bagian : " . $c['nama_bagian']][]=$c; ?>
               <?php endforeach; ?>
                <?php endif; ?>

                  <?php if (! empty($arrDisplay)) : ?>
                    <?php foreach($arrDisplay as $nama_bagian => $c1) : ?>
                     <tr>
                       <td colspan="10" style="background-color: #F0F8FF;"><?=  $nama_bagian;  ?></td>         
                      </tr>

            <?php if(! empty($c1)) : ?>
            <?php $i= 1; foreach ($c1 as $c) : ?>

            	<?php if ($c['status'] == 0) : ?>
            		<?php $status = "Batal";  ?>
            		<?php $red = "style='color: green;'";  ?>
            	<?php elseif ($c['status'] >= 1 And $c['status'] < 3) : ?>
                  <?php $status = "Incomplete";  ?>
                  <?php $red = "style='color: red;'";  ?>
                
                <?php else : ?>
            		<?php $status = "Complete"; ?>
            		<?php $red = " ";  ?>
            	<?php endif; ?> 

              <?php if ($c['tgl_realisasi'] == 0000-00-00) : ?>
                 <?php $tanggal = "<center>" . "-" . "</center>"; ?>
                <?php else : ?>
                  <?php $tanggal = date('d-m-Y', strtotime($c['tgl_realisasi'])); ?>
              <?php endif; ?>
            	
            <tr <?= $red; ?>>
              <th scope="row"><?= ++$start; ?></th>
              <td><?= $c['no_bs']; ?></td>
              <td><?= $c['tanggal']; ?></td>
              <td><?= $c['pemohon']; ?></td>
              <td><?= number_format($c['jmlajuan'],2,",","."); ?></td>
              <td><?= number_format($c['terpakai'],2,",","."); ?></td>
               <td><?= $c['keterangan']; ?></td>
              <td><?= $status ?></td>
             
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->