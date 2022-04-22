
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="" method="post">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



        <div class="row">
          <div class="col-md-12"> 

            <?php if ( validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                 <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

        <?php if (substr($transaksi['trans']['cashbankno'],0,9) == "Pettycash"): ?>
           <div class="form-group row">
             <label for="typebankcash" class="col-sm-3 col-form-label">Type of Bank Cash</label>
            <div class="form-check form-check-inline">
                <input  type="radio" name="pilihan" id="inlineRadio1" value="Pettycash" onclick="validasi_radio();" checked>
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

            <?php elseif(substr($transaksi['trans']['cashbankno'],0,4) == "Cash") : ?>

             <div class="form-group row">
             <label for="typebankcash" class="col-sm-3 col-form-label">Type of Bank Cash</label>
            <div class="form-check form-check-inline">
                <input  type="radio" name="pilihan" id="inlineRadio1" value="Pettycash" onclick="validasi_radio();">
                <label class="form-check-label" for="inlineRadio1">Petty Cash</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="pilihan" id="inlineRadio2" value="Cash" onclick="validasi_radio();" checked>
                <label class="form-check-label" for="inlineRadio2">Cash</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="pilihan" id="inlineRadio3" value="Bank" onclick="validasi_radio();">
                <label class="form-check-label" for="inlineRadio3">Bank</label>
              </div>
            </div>

            <?php else : ?>
              
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
                <input type="radio" name="pilihan" id="inlineRadio3" value="Bank" onclick="validasi_radio();" checked>
                <label class="form-check-label" for="inlineRadio3">Bank</label>
              </div>
            </div>

             <?php endif ?>

 
            <div class="form-group row">
                <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $transaksi['trans']['id_transaksi']; ?>">
                <label for="cashbankno" class="col-sm-3 col-form-label">No Cash / Bank</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="cashbankno" name="cashbankno" value ="<?= $transaksi['trans']['cashbankno']; ?>" readonly>
                </div>
              </div>


          <div class="form-group row">
            <label for="Date" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-6">
              <input type="text" class="form-control tanggal" id="datepengajuan" name="datepengajuan" value ="<?= date('d-m-Y', strtotime($transaksi['trans']['tgl_pengajuan'])); ?>" autocomplete="off">
            </div>
          </div>


          <div class="form-group row">
            <label for="aplicantname" class="col-sm-3 col-form-label">Aplicant Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="aplicantname" name="aplicantname" value="<?= $transaksi['trans']['pemohon'] ?>" autocomplete="off">
            </div>
          </div>


          <div class="form-group row">
            <label for="necessity" class="col-sm-3 col-form-label">Necessity</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="necessity" name="necessity" value="<?= $transaksi['trans']['keperluan'] ?>" autocomplete="off">
            </div>
          </div>


           <div class="form-group row">
            <label for="note" class="col-sm-3 col-form-label">Note</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="note" name="note" value="<?= $transaksi['trans']['catatan'] ?>" autocomplete="off">
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
              <select  id="eccmb" class="selectpicker form-control" data-style="btn-success">
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
                          <?php $x = 1; ?>
                          <?php foreach ($transaksi['items'] as $key => $val) : ?>
                          <tr id="row_<?= $x; ?>">
                            <td><input type="text" class="form-control" value="<?= $x; ?>" style="font-size: 13px; width: 50px;" id="no_<?= $x;  ?>" name="noinput[]" readonly></td>
                            <td><input type="text" class="form-control" value="<?= $val['loc']; ?>" style="font-size: 13px; width: 70px;" id="ec_<?= $x; ?>" name="locinput[]" readonly></td>
                            <td><input type="text" class="form-control" value="<?= $val['id_coa_ec']; ?>" style="font-size: 13px; width: 70px;" id="ec_<?= $x; ?>" name="ecinput[]" readonly></td>
                            <td><input type="text" class="form-control" value="<?= $val['id_coa_na']; ?>" style="font-size: 13px; width: 70px;" id="na_<?= $x; ?>" name="nainput[]" readonly></td>
                            <td><input type="text" class="form-control" value="<?= $val['id_coa_tb']; ?>" style="font-size: 13px; width: 70px;" id="tb_<?= $x; ?>" name="tbinput[]" readonly></td>
                            <td>
                              <input type="hidden" id="id_trans_dept_<?= $x; ?>" name="id_trans_dept[]" value="<?= $val['id_transaksi_dept']; ?>"></input><input type="text" class="form-control" id="bsnoinput_<?= $x;  ?>" name="bsnoinput[]" value="<?= $val['no_bs']; ?>" style="font-size: 13px; width: 70px;" readonly>
                              <input type="hidden" id="tglkasboninput_<?= $x; ?>" name="tglkasboninput[]" value="<?= $val['tanggal_kas_bon']; ?>">
                              <input type="hidden" id="tglpenerimainput_<?= $x; ?>" name="tglpenerimainput[]" value="<?= $val['tgl_penerima']; ?>">
                              <input type="hidden" id="tglpengajuaninput_<?= $x; ?>" name="tglpengajuaninput[]" value="<?= $val['tgl_penajuan']; ?>">
                            </td>
                            <td>
                              <input type="text" class="form-control" value="<?= number_format($val['nominal'],2,",","."); ?>" style="font-size: 13px; width: 140px;" id="ammount1_<?= $x;  ?>" name="ammount1input[]" readonly>
                            </td>
                            <td>
                              <input type="text" class="form-control" value="<?= $val['keterangan']; ?>" style="font-size: 13px;" id="keter_<?= $x;  ?>" name="keterinput[]" readonly>
                            </td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm hapusstatus" title="Removed" data-uri="<?= $uri; ?>" data-bs="<?= $val['no_bs']; ?>" onclick="removeRow('<?php echo $x; ?>')"><i class="fas fa-window-close"></i></button>
                            </td>
                          </tr>
                          <?php $x++; ?>
                        <?php endforeach; ?>
                        </tbody>                   
                      </table>

         	         </div>

                  </div>
             </div>

           <hr>


     <?php if ($transaksi['trans']['status'] == 1 ) : ?>

       
           <div class="row mt-1">
             <div class="col-md-3">
                <div class="form-group row">
                <div class="col-sm-10 mt-1">
                  <div class="form-check">
                    <input class="form-check-input1" type="checkbox" id="ckho" name="ckho" autocomplete="off" checked>
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
                  <input type="text" class="form-control tanggal" id="dateho" name="dateho" value ="<?= date('d-m-Y', strtotime($transaksi['trans']['dateho'])); ?>" autocomplete="off">
                </div>
             </div>
           </div>
             
            
               
            
             <div class="col-md-4">
                <div class="form-group row">
                <label for="suplier" class="col-sm-2 col-form-label">Suplier</label>
                <div class="col-sm-6">
                 <select id="suplier" name="suplier" class="selectpicker form-control" data-live-search="true" data-style="btn-primary">
                    <option value="">Suplier</option>
                   <?php foreach($suplier as $row) : ?>
                    <?php if ($row['id_suplier'] == $transaksi['trans']['id_suplier']) : ?>
                    <option value="<?= $row['id_suplier'] ?>" selected><?= $row['kode_suplier']. " - " .$row['suplier'] ?></option>
                    <?php else : ?>
                      <option value="<?= $row['id_suplier'] ?>"><?= $row['kode_suplier']. " - " .$row['suplier'] ?></option>
                  <?php endif; ?>
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
                  <input type="text" class="form-control" id="batchno" name="batchno" value="<?= $transaksi['trans']['no_batch']; ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-2">
                  <label for="datetrans">Date</label>
                  <input type="text" class="form-control tanggal" id="dtpenerima" name="dtpenerima" value ="<?= date('d-m-Y', strtotime($transaksi['trans']['tgl_penerima'])); ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-2">
                  <label for="nobpkb">BPK/B No</label>
                  <input type="text" class="form-control" id="nobpkb" name="nobpkb" value ="<?= $transaksi['trans']['no_bpk']; ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-2">
                  <label for="chequeno">Cheque No</label>
                  <input type="text" class="form-control" id="chequeno" name="chequeno" value ="<?= $transaksi['trans']['no_giro']; ?>" autocomplete="off">
                </div>

                  <div class="form-group col-md-2">
                  <label for="totaltrans">Total</label>
                  <input type="text" class="form-control" id="totaltrans" name="totaltrans" value ="<?= number_format($transaksi['trans']['total'],2,",","."); ?>" style="font-weight: bold;" readonly autocomplete="off">
                </div>
              </div>
              
            </div>
            </div>

            <?php else : ?>


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
                 <select id="suplier" name="suplier" class="selectpicker form-control" data-live-search="true" data-style="btn-primary">
                    <option value="">Suplier</option>
                   <?php foreach($suplier as $row) : ?>
                    <?php if ($row['id_suplier'] == $transaksi['trans']['id_suplier']) : ?>
                    <option value="<?= $row['id_suplier'] ?>" selected><?= $row['kode_suplier']. " - " .$row['suplier'] ?></option>
                    <?php else : ?>
                      <option value="<?= $row['id_suplier'] ?>"><?= $row['kode_suplier']. " - " .$row['suplier'] ?></option>
                  <?php endif; ?>
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
                  <input type="text" class="form-control" id="totaltrans" name="totaltrans" value ="<?= number_format($transaksi['trans']['total'],2,",","."); ?>" style="font-weight: bold;" readonly autocomplete="off">
                </div>
              </div>
              
            </div>
            </div>
           
          <?php endif; ?>
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





