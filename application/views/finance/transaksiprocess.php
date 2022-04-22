
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="<?= base_url('finance/transaksiproses'); ?>" method="post" name="trans">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



        <div class="row">
          <div class="col-md-12"> 

            <?php if ( validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                 <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

           <div class="form-group row">
             <label for="typebankcash" class="col-sm-3 col-form-label">Type of Bank Cash</label>
            <div class="form-check form-check-inline">
                <input  type="radio" name="pilihan" id="inlineRadio1" value="Pettycash" onclick="validasi_radio();">
                <label class="form-check-label" for="inlineRadio1">Petty Cash</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="pilihan" id="inlineRadio2" value="Cash" onclick="validasi_radio();">
                <label class="form-check-label" for="inlineRadio2">Cash</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="pilihan" id="inlineRadio3" value="Bank" onclick="validasi_radio();">
                <label class="form-check-label" for="inlineRadio3">Bank</label>
              </div>
            </div>

 
            <div class="form-group row">
                <label for="cashbankno" class="col-sm-3 col-form-label">No Cash / Bank</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="cashbankno" name="cashbankno"readonly>
                </div>
              </div>


          <div class="form-group row">
            <label for="Date" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-6">
              <input type="text" class="form-control tanggal" id="datepengajuan" name="datepengajuan" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">
            </div>
          </div>


          <div class="form-group row">
            <label for="aplicantname" class="col-sm-3 col-form-label">Aplicant Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="aplicantname" name="aplicantname" autocomplete="off">
            </div>
          </div>


          <div class="form-group row">
            <label for="necessity" class="col-sm-3 col-form-label">Necessity</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="necessity" name="necessity" autocomplete="off">
            </div>
          </div>


           <div class="form-group row">
            <label for="note" class="col-sm-3 col-form-label">Note</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="note" name="note" autocomplete="off">
            </div>
          </div>
          </div>
        </div>
            
         <hr>
         <div class="row mt-5">
         	<div class="col-md">  
          <div class="row d-flex justify-content-center">
          <div class="col-md-1">
            <input type="text" class="form-control" id="no" name="no[]" readonly>
          </div>


          <div class="col-md">

              <select  id="loccmb" class="selectpicker form-control" data-style="btn-success" required>
              <option value="" style="font-size: 10px;">LOC</option>
              <?php foreach($loc as $row) : ?>
              <option value="<?= $row['kode_loc'];  ?>"><?= $row['kode_loc']." - ".$row['nama']; ?></option>
              <?php endforeach; ?>
              </select> 
           </div>



           <div class="col-md">
              <select  id="eccmb" class="selectpicker form-control" data-style="btn-success" required>
              <option value="" style="font-size: 10px;">EC</option>
              <?php foreach($ec as $row) : ?>
              <option value="<?= $row['id_coa_ec'];  ?>"><?= $row['id_coa_ec']." - ".$row['nama']; ?></option>
              <?php endforeach; ?>
              </select> 
             
           </div>
           <div class="col-md">

              <select id="nacmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
              <option value="">NA</option>
              <?php foreach($na as $row) : ?>
              <option value="<?= $row['id_coa_na'];  ?>"><?= $row['id_coa_na']." - ".$row['nama']; ?></option>
              <?php endforeach; ?>
              </select>
           </div>
           <div class="col-md">
             <select id="tbcmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
                    <option value="">TB</option>
                   <?php foreach($tb as $row) : ?>
                    <option value="<?= $row['id_coa_tb'];  ?>"><?= $row['id_coa_tb']." - ".$row['nama']; ?></option>
                    <?php endforeach; ?>
                    </select>
           </div>

           <div class="col-md">
             <select id="id_dept_transcmb" class="selectpicker form-control" data-live-search="true"  data-style="btn-primary">
                    <option value="">BSNO</option>
                    <?php foreach ($bsno as $row) : ?>
                    <option value="<?= $row['id_transaksi_dept']; ?>"><?= $row['no_bs']. " - ". $row['pemohon']; ?></option>
                    <?php endforeach; ?> 
                    </select> 
           </div>

             <input type="hidden" id="bsno" name="bsno"></input>
             <input type="hidden" id="tglkasbon" name="tglkasbon"></input>
             <input type="hidden" id="tglpenerima" name="tglpenerima"></input>
             <input type="hidden" id="tglpengajuan" name="tglpengajuan"></input>

           <div class="col-md">
             <input type="text" class="form-control" id="ammount" name="ammount[]" disabled>
           </div>
       
         </div>

         <div class="row mt-3">
           <div class="col-md-4">
             <input type="text" class="form-control" id="keter" name="keter" placeholder="Description...">
           </div>
         </div>

         <div class="row mt-3">
           <div class="col-md-12">
              <input type="button" class="btn btn-primary" id="add_data" value="Insert Table">
           </div>
         </div>
  </div>
</div>
         <hr>

        
         <div class="row mt-2">
         	<div class="col-md-12">
            <div class="table-responsive-md">
                   <table class="table table-bordered" id="data_table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">LOC</th>
                            <th scope="col">EC</th>
                            <th scope="col">NA</th>
                            <th scope="col">TB</th>
                            <th scope="col">BsNo</th>
                             <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Remove</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>

         	         </div>

                  </div>
             </div>

           <hr>

           <div class="row mt-1">
             <div class="col-md-3">
                <div class="form-group row">
                <div class="col-sm-10 mt-1">
                  <div class="form-check">
                    <input class="form-check-input1" type="checkbox" id="ckho" name="ckho" autocomplete="off">
                    <label class="form-check-label" for="ckho">
                      Reimburstment HO
                    </label>
                  </div>
                </div>
              </div>
             </div>
             
             <div class="col-md-3">
               <div class="form-group row">
                <label for="dateho" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control tanggal" id="dateho" name="dateho" readonly autocomplete="off">
                </div>
             </div>
           </div>

             <div class="col-md-4">

                <div class="form-group row">
                <label for="suplier" class="col-sm-2 col-form-label">Suplier</label>
                <div class="col-sm-6">
                 <select id="suplier" name="suplier" class="selectpicker form-control" data-live-search="true" data-style="btn-primary" disabled>
                    <option value="">Suplier</option>
                   <?php foreach($suplier as $row) : ?>
                    <option value="<?= $row['id_suplier'] ?>"><?= $row['kode_suplier']. " - " .$row['suplier'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
              </div>
           </div> 

      </div>

      <hr>

            <div class="row">
              <div class="col-md">

                <label for="" style="font-weight: bold;">Payment Realization</label>
                <div class="form-row">
                  <div class="form-group col-md-2">
                  <label for="batchno">Batch No</label>
                  <input type="text" class="form-control" id="batchno" name="batchno" readonly autocomplete="off">
                </div>

                <div class="form-group col-md-2">
                  <label for="datetrans">Date</label>
                  <input type="text" class="form-control tanggal" id="dtpenerima" name="dtpenerima" readonly autocomplete="off">
                </div>

                <div class="form-group col-md-2">
                  <label for="nobpkb">BPK/B No</label>
                  <input type="text" class="form-control" id="nobpkb" name="nobpkb" readonly autocomplete="off">
                </div>

                <div class="form-group col-md-2">
                  <label for="chequeno">Cheque No</label>
                  <input type="text" class="form-control" id="chequeno" name="chequeno" readonly autocomplete="off">
                </div>

                  <div class="form-group col-md-2">
                  <label for="totaltrans">Total</label>
                  <input type="text" class="form-control" id="totaltrans" name="totaltrans" value="0" style="font-weight: bold;" readonly autocomplete="off">
                </div>
              </div>
              
            </div>
            </div>
           <hr>
         
               <div class="row">
                <div class="col-md-12">
               <div class="form-group row mt-5">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <a href="<?= base_url('finance/managetransaction') ?>" class="btn btn-success">Cancel</a>
                    </div>
                     </form>
                  </div>
               
                </div>
              </div>
         


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->





