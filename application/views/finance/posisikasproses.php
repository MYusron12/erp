
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


          <div class="row">
          	<div class="col-md-8">
          		<h5>DC : <?= $dc['nama']; ?></h5>

          		<table class="table table-bordered table-hover mt-3">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Pieces</th>
				      <th scope="col">Bills</th>
				      <th scope="col">Total</th>
				     
				      
				    </tr>
				  </thead>
				  <tbody>
				  		<?php $i = 1; foreach ($bills as $m) : ?>
				    <tr>
				       <th scope="row"><?= $i++; ?></th>
				       <td><?= number_format($m['jumlah']); ?></td>
				       <td><?= number_format($m['pecahan'],2,",","."); ?></td>
				       <td><?= number_format($m['pecahan']*$m['jumlah'],2,",","."); ?></td>
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
                  <input type="text" class="form-control" id="kasbonsementara" name="kasbonsementara" value="<?= number_format($result['kasbonsementara'],2,",","."); ?>"readonly>
                </div>
              </div>


              <div class="form-group row">
                <label for="outstandingkasbank" class="col-sm-5 col-form-label">Outstanding kas bank</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="outstandingkasbank" name="outstandingkasbank" value="<?= number_format($result['outstanding'],2,",","."); ?>" readonly>
                </div>
              </div>


              <div class="form-group row">
                <label for="selisih" class="col-sm-5 col-form-label">Selisih</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="selisih" name="selisih" value="0" readonly>
                </div>
              </div>

              <hr>


              <div class="form-group row">
                <label for="totalpettycash" class="col-sm-5 col-form-label" style="font-weight: bold;">Total Pettycash</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="totalpettycash" name="totalpettycash" value="<?= number_format($result['totalP'],2,",","."); ?>" style="font-weight: bold;" readonly>
                </div>
              </div>


              <div class="form-group row">
                <label for="outstandingreimburstho" class="col-sm-5 col-form-label">Out Standing Reimburstment Ho</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="outstandingreimburstho" name="outstandingreimburstho" value="<?= number_format($result['THo'],2,",","."); ?>" readonly>
                </div>
              </div>
              <hr>

               <div class="form-group row">
                <label for="grandtotal" class="col-sm-5 col-form-label" style="font-weight: bold;">Grand Total</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="grandtotal" name="grandtotal" value="<?= number_format($result['GrandtP'],2,",","."); ?>" style="font-weight: bold;" readonly>
                </div>
              </div>


               <div class="form-group row justify-content-end " style="margin-top: 50px;">
                  	<div class="col-sm-10">
                  		<button type="submit" class="btn btn-primary">Save</button>
                  		<a href="<?= base_url('finance/posisikas') ?>" class="btn btn-success">Cancel</a>
                  	</div>
                  </div>


             </form>


         	</div>
         </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     