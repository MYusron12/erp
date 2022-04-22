
         <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
           
            <div class="row">
            <div class="col-md-5">
                 <form action="<?= base_url('finance/realizationstatus'); ?>" method="post">
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
              <th scope="col">Recieved</th>
              <th scope="col">Realization</th>
              <th scope="col">Bs No</th>
              <th scope="col">Bank Cash</th>
              <th scope="col">Name</th>
              <th scope="col">Credit</th>
              <th scope="col">Realization</th>
              <th scope="col">Balance</th>
              <th scope="col">Status</th>
             
              
            </tr>
          </thead>
          <tbody>
            
            <?php $arrDisplay = []; ?>
            <?php if (! empty($realizationstatus)) : ?>
             <?php foreach($realizationstatus as $c) : ?>
              <?php $arrDisplay[ "Dept : " . $c['nama']][]=$c; ?>
               <?php endforeach; ?>
                <?php endif; ?>

                  <?php if (! empty($arrDisplay)) : ?>
                    <?php foreach($arrDisplay as $nama => $c1) : ?>
                     <tr>
                       <td colspan="10" style="background-color: #F0F8FF;"><?=  $nama;  ?></td>         
                      </tr>

            <?php if(! empty($c1)) : ?>
            <?php $i= 1; foreach ($c1 as $c) : ?>

            	<?php if ($c['status'] >= 2) : ?>
            		<?php $status = "Complete";  ?>
            		<?php $red = "";  ?>
            	<?php else : ?>
            		<?php $status = "Incomplete"; ?>
            		<?php $red = "style='color: red;'";  ?>
            	<?php endif; ?> 

              <?php if ($c['tgl_realisasi'] == 0000-00-00) : ?>
                 <?php $tanggal = "<center>" . "-" . "</center>"; ?>
                <?php else : ?>
                  <?php $tanggal = date('d-m-Y', strtotime($c['tgl_realisasi'])); ?>
              <?php endif; ?>
            	
            <tr <?= $red; ?>>
              <th scope="row"><?= ++$start; ?></th>
              <td><?= date('d-m-Y', strtotime($c['tgl_terima'])); ?></td>
              <td><?= $tanggal; ?></td>
              <td><?= $c['no_bs']; ?></td>
              <td><?= $c['no_kas_bank']; ?></td>
              <td><?= $c['pemohon']; ?></td>
              <td><?= number_format($c['jumlah'],2,",","."); ?></td>
              <td><?= number_format($c['terpakai'],2,",","."); ?></td>
              <td><?= number_format($c['selisih'],2,",","."); ?></td>
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