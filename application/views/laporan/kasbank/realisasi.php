
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	<form class="form-inline"  action="<?= base_url('laporan/realisasipembkasbank'); ?>" method="post">
			  <div class="form-group mb-2">
			    <label for="tanggal" class="col-sm-12 col-form-label">Dari</label>
			  </div>
			  <div class="form-group mx-sm-4 mb-2">
			    <input type="text" class="form-control tanggal2" id="tgl1" name="tgl1" value="<?= set_value('tgl1'); ?>" autocomplete="off">
			  </div>

			  <div class="form-group mb-2">
			    <label for="tanggal" class="col-sm-12 col-form-label">s/d</label>
			  </div>
			  <div class="form-group mx-sm-4 mb-2">
			    <input type="text" class="form-control tanggal2" id="tgl2" name="tgl2" value="<?= set_value('tgl2'); ?>" autocomplete="off">
			  </div>

			    <input class="btn btn-primary mb-2" type="submit" name="submit" value="Filter">
			</form>
          </div>

          <a href="#" class="btn btn-primary btn-sm mt-3" id="ctkrealisasi" name="ctkrealisasi" data-toggle="modal" data-target="#cetakRealisasiModal">Cetak</a>


          <div class="row">
          	<div class="col-md-12">
          		<table class="table mt-3" style="width: 100%" id="table-data">
				  <thead>
				    <tr>
				      <th scope="col">No</th>
				      <th scope="col">No KB</th>
				      <th scope="col">Jenis KB</th>
				      <th scope="col">Tgl KB</th>
              <th scope="col">Tgl Proses</th>
              <th scope="col">Tgl Realisasi</th>
              <th scope="col">Aging</th>
				      <th scope="col">Keterangan</th>
				      <th scope="col">Jumlah</th>
				    </tr>
				  </thead>
				  <tbody>
                    <?php $i=1; $total = 0; foreach ($kasbank as $row) : ?>
                     	<?php if (substr($row['cashbankno'],0,2) == "KK") : ?>
                     		<?php $jenis = "Kas Kecil"; ?>
                     	<?php elseif(substr($row['cashbankno'],0,3) == "KAS") : ?>
                            <?php $jenis = "Kas"; ?>
                        <?php else : ?>
                            <?php $jenis = "Bank"; ?>
                     	<?php endif; ?>

                     

		             
              <?php $start_date = new DateTime($row['tgl_proses']); ?>
					  	<?php $end_date = new DateTime($row['tgl_penerima']); ?>
					  	<?php $interval = $start_date->diff($end_date); ?>

		          
                     <tr>
                     	<td><?= $i++; ?></td>
                     	<td><?= $row['cashbankno']; ?></td>
                     	<td><?= $jenis; ?></td>
                     	<td><?= date('d-m-Y', strtotime($row['tgl_pengajuan'])); ?></td>
                      <td><?= date('d-m-Y', strtotime($row['tgl_proses'])); ?></td>
                      <td><?= date('d-m-Y', strtotime($row['tgl_penerima'])); ?></td>
                     	<td><?= $interval->days ?></td>
                     	<td><?= $row['keperluan']; ?></td>
                     	<td><?= number_format($row['total'],2,",","."); ?></td>
                     </tr>

                     <?php $total = $total + ($row['total']); ?>

                     <tr>
                     	<td colspan="8" style="text-align: center; font-weight: bold;">TOTAL</td>
                     	<td style="font-weight: bold;"><?= number_format($total,2,",","."); ?></td>
                     </tr>

                   <?php endforeach; ?>
				  </tbody>
				</table>
          	</div>
          </div>
          
        
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

  <!-- Modal -->
<div class="modal fade" id="cetakRealisasiModal" tabindex="-1" role="dialog" aria-labelledby="cetakRealisasiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cetakRealisasitModalLabel">Cetak Realisasi Kasbank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('report/realisasi') ?>" method="post" target="_blank">
      	<input type="hidden" id="startdate" name="startdate">
      	<input type="hidden" id="enddate" name="enddate">
        <p>Apakah Anda ingin Cetak ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary" id="yarealisasi">Ya</button>
      </div>
    </div>
    </form>
  </div>
</div>