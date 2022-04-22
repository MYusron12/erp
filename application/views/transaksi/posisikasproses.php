
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


          <div class="row">
          	<div class="col-md-8">
          		<h5>Lokasi : <?= $dc['nama']; ?></h5>

          		<table class="table table-bordered table-hover mt-3">
  				  <thead>
  				    <tr>
  				      <th scope="col">No</th>
  				      <th scope="col">Lembar</th>
  				      <th scope="col">Pecahan</th>
  				      <th scope="col">Total</th>
                <th scope="col">Aksi</th>
  				    </tr>
  				  </thead>
				  <tbody>
				  		<?php $i = 1; foreach ($bills as $m) : ?>
				    <tr>
				       <th scope="row"><?= $i++; ?></th>
				       <td><?= number_format($m['jumlah']); ?></td>
				       <td><?= number_format($m['pecahan'],2,",","."); ?></td>
				       <td><?= number_format($m['pecahan']*$m['jumlah'],2,",","."); ?></td>
               <td>
                 <a href="" class="btn btn-primary btn-sm ubahLembar" data-toggle="modal" data-target="#editLembarModal" data-id="<?= $m['id_validasi']; ?>" data-jml="<?= $m['jumlah']; ?>"><i class="fas fa-edit"></i>Edit</a>
               </td>
				    </tr>
			         
				  </tbody>
				<?php endforeach; ?>
				</table>
          		
          	</div>
          </div>

         <div class="row" style="">
         	<div class="col-md-8">

         		
                <form action="" method="post">
         		<div class="form-group row">
                <label for="cashonhand" class="col-sm-5 col-form-label">CashOnHand</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="cashonhand" name="cashonhand" value="<?= number_format($result['cashonhand'],2,",","."); ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="kasbonsementara" class="col-sm-5 col-form-label">Kasbon Sementera</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="kasbonsementara" name="kasbonsementara" value="<?= number_format($result['kasbon'],2,",","."); ?>"readonly>
                </div>
              </div>

               

              <div class="form-group row">
                <label for="outstandingkasbank" class="col-sm-5 col-form-label">Outstanding kas bank</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="outstandingkasbank" name="outstandingkasbank" value="<?= number_format($result['outstanding'],2,",","."); ?>"readonly>
                </div>
              </div>

              <?php if ($result['selisih'] < 0) : ?>
                <div class="form-group row">
                <label for="selisih" class="col-sm-5 col-form-label">Selisih</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="selisih" name="selisih" value="<?= number_format($result['selisih'],2,",","."); ?>" readonly style="color: red;">
                </div>
              </div>
                <?php else : ?>
                  <div class="form-group row">
                <label for="selisih" class="col-sm-5 col-form-label">Selisih</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="selisih" name="selisih" value="<?= number_format($result['selisih'],2,",","."); ?>" readonly>
                </div>
              </div>
                <?php endif; ?>

              

              <hr>


              <div class="form-group row">
                <label for="totalpettycash" class="col-sm-5 col-form-label" style="font-weight: bold;">Total Pettycash</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="totalpettycash" name="totalpettycash" value="<?= number_format($result['ttlpettycash'],2,",","."); ?>" style="font-weight: bold;" readonly>
                </div>
              </div>


              <div class="form-group row">
                <label for="outstandingreimburstho" class="col-sm-5 col-form-label">Out Standing Reimburstment Ho</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="outstandingreimburstho" name="outstandingreimburstho" value="<?= number_format($result['remHo'],2,",","."); ?>" readonly>
                </div>
              </div>
              <hr>

               <div class="form-group row">
                <label for="gtotal" class="col-sm-5 col-form-label" style="font-weight: bold;">Grand Total</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="gtotal" name="gtotal" value="<?= number_format($result['grandtotal'],2,",","."); ?>" style="font-weight: bold;" readonly>
                </div>
              </div>


               <div class="form-group row justify-content-end " style="margin-top: 50px;">
                  	<div class="col-sm-10">
                  		<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                  		<a href="<?= base_url('transaksi/kasharian') ?>" class="btn btn-success"><i class="fas fa-window-close"></i>Cancel</a>
                  	</div>
                  </div>


             </form>


         	</div>
         </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="editLembarModal" tabindex="-1" role="dialog" aria-labelledby="editLembarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLembarModalLabel">Edit Uang Perincian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('transaksi/ubahpecahan'); ?>" method="post">
  
       <input type="hidden" id="idlembar" name="idlembar">
        <div class="form-group row">
          <label for="lembar" class="col-sm-2 col-form-label">lembar</label>
          <div class="col-sm-5">
            <input type="lembar" class="form-control" id="lembar" name="lembar">
          </div>
         </div>
       </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </div>
    </div>
  </form>
  </div>
</div>