
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
          </div>
        </div>


         <?php if($transaksi['trans']['status'] >= 3) :  ?>
            <?php $aktif = "style='pointer-events:none; opacity:0.2; background-color:#000;'"; ?>
            <?php $nonaktif = "readonly"; ?>
            <?php else : ?>
              <?php $aktif = ""; ?>
              <?php $nonaktif = ""; ?>
          <?php endif; ?> 

        <div class="row">
          <div class="col-md-6"> 
           <div class="form-group row">
             <label for="typebankcash" class="col-sm-3 col-form-label">Jenis Kas Bank</label>
            <div class="form-check form-check-inline">
                <input  type="radio" name="pilihan" id="inlineRadio1" value="KK" onclick="validasi_radio();" checked disabled>
                <label class="form-check-label" for="inlineRadio1">Kas Kecil</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="pilihan" id="inlineRadio2" value="KAS" onclick="validasi_radio();" disabled>
                <label class="form-check-label" for="inlineRadio2">Kas</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="pilihan" id="inlineRadio3" value="BANK" onclick="validasi_radio();" disabled>
                <label class="form-check-label" for="inlineRadio3">Bank</label>
              </div>
            </div>
 
            
            <div class="form-group row">
                <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $transaksi['trans']['id_transaksi']; ?>">
                <label for="cashbankno" class="col-sm-3 col-form-label">No Cash / Bank</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="cashbankno" name="cashbankno" value ="<?= $transaksi['trans']['cashbankno']; ?>" readonly>
                </div>
              </div>


          <div class="form-group row">
            <label for="Date" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-6">
              <input type="text" class="form-control tanggal" id="datepengajuan" name="datepengajuan" value ="<?= date('d-m-Y', strtotime($transaksi['trans']['tgl_pengajuan'])); ?>" autocomplete="off" readonly>
            </div>
          </div>


          <div class="form-group row">
            <label for="aplicantname" class="col-sm-3 col-form-label">Pemohon</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="aplicantname" name="aplicantname" value="<?= $transaksi['trans']['pemohon'] ?>" autocomplete="off" readonly>
            </div>
          </div>


          <div class="form-group row">
            <label for="necessity" class="col-sm-3 col-form-label">Keperluan</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="necessity" name="necessity" value="<?= $transaksi['trans']['keperluan'] ?>" autocomplete="off">
            </div>
          </div>


           <div class="form-group row">
            <label for="note" class="col-sm-3 col-form-label">Catatan</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="note" name="note" value="<?= $transaksi['trans']['catatan'] ?>" autocomplete="off">
            </div>
          </div>
          </div>

             <div class="col-md-6">
           <div class="form-group row mt-5">
            <label for="note" class="col-sm-3 col-form-label">No Bs</label>
            <div class="col-sm-6">
              <select  id="nomorbs" name="nomorbs[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-width="fit" multiple disabled>
                <option value="">Pilih</option>
               <?php foreach ($bsno as $row) : ?>
                
                <option value="<?= $row['id_transaksi_dept']; ?>"><?= $row['no_bs']."-". $row['pemohon']; ?></option>
                
                <?php endforeach; ?> 
              </select> 
            </div>
          </div>

           <div class="form-group row">
            <label for="jmlterpakaiawal" class="col-sm-3 col-form-label">Jumlah BS Awal</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="jmlterpakaiawal" name="jmlterpakaiawal" autocomplete="off" value="<?= number_format($total->terpakai); ?>" readonly >
            </div>
          </div>

           <div class="form-group row">
            <label for="jmlterpakai" class="col-sm-3 col-form-label">Jumlah Sisa BS</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="jmlterpakai" name="jmlterpakai" autocomplete="off" readonly value="<?= number_format($total->sisabs); ?>">
            </div>
          </div>

           

          <div class="form-group row">
            <label for="jmlterpakai" class="col-sm-3 col-form-label">Jumlah Kasbank</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="nkasbank" name="nkasbank" autocomplete="off" readonly value="<?= number_format($total->nkasbank); ?>">
            </div>
          </div>

             </div>

        </div>
            
         <hr>


           <!-- perincian -->
         <label for="" style="font-weight: bold;">Input Perincian</label>
         <div class="row mt-2">
           <div class="col-md-6">
            
             
             <div class="form-group row">
              <label for="no" class="col-sm-2 col-form-label">No.</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="no" name="no[]" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="loccmb" class="col-sm-2 col-form-label">Lokasi</label>
              <div class="col-sm-5">
              <select  id="loccmb" class="selectpicker form-control" data-style="btn-success" data-live-search="true">
                <option value="">LOC</option>
                <?php foreach($loc as $row) : ?>
                <option value="<?= $row['kode_loc'];  ?>"><?= $row['kode_loc']." - ".$row['nama']; ?></option>
                <?php endforeach; ?>
              </select> 
              </div>
            </div>

            <div class="form-group row">
              <label for="eccmb" class="col-sm-2 col-form-label">EC</label>
              <div class="col-sm-5">
                 <select  id="eccmb" class="selectpicker form-control" data-style="btn-success" data-live-search="true">
                  <option value="">EC</option>
                  <?php foreach($ec as $row) : ?>
                  <option value="<?= $row['account'];  ?>"><?= $row['account']." - ".$row['nama']; ?></option>
                  <?php endforeach; ?>
                  </select> 
              </div>
            </div>


             <div class="form-group row">
              <label for="nacmb" class="col-sm-2 col-form-label">NA</label>
              <div class="col-sm-5">
                <select id="nacmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
                  <option value="">NA</option>
                  <?php foreach($na as $row) : ?>
                  <option value="<?= $row['account'];  ?>"><?= $row['account']." - ".$row['nama']; ?></option>
                  <?php endforeach; ?>
                  </select>
              </div>
            </div>


             <div class="form-group row">
              <label for="tbcmb" class="col-sm-2 col-form-label">TB</label>
              <div class="col-sm-5">
                <select id="tbcmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
                    <option value="">TB</option>
                   <?php foreach($tb as $row) : ?>
                    <option value="<?= $row['account'];  ?>"><?= $row['account']." - ".$row['nama']; ?></option>
                    <?php endforeach; ?>
                    </select>
                 </div>
                </div>
            
           </div>
           </div>
           
        <div class="form-row align-items-center mt-2">
               <div class="col-auto my-1">
                
                <div class="form-group row">
                <label for="jumlah" class="col-sm-3 col-form-label col-form-label-sm">Jumlah</label>
                <div class="col-sm">
                   <input type="text" class="form-control" id="ammount" name="ammount[]">
                </div>
              </div>

                 <!--  <input type="text" class="form-control" id="ammount" name="ammount[]" placeholder="Jumlah"> -->
              </div>

              <div class="col-auto my-1">
                
                <div class="form-group row">
                <label for="keterangan" class="col-sm-3 col-form-label col-form-label-sm">Keterangan</label>
                <div class="col-sm">
                 <input type="text" class="form-control" id="keter" name="keter">
                </div>
              </div>

                 <!--  <input type="text" class="form-control" id="ammount" name="ammount[]" placeholder="Jumlah"> -->
              </div>



               <div class="col-auto my-1">

                <div class="form-group row">
                <label for="PPn" class="col-sm-3 col-form-label col-form-label-sm">PPn</label>
                <div class="col-sm">
                   <select name="ppn" id="ppn" class="form-control">
                     <option value="">Pilih</option>
                     <?php foreach ($ppn as $val) : ?>
                          <option value="<?= $val['nppn']; ?>"><?= $val['persen']; ?></option>
                     <?php endforeach; ?>
                   </select>
                </div>
              </div>
                   
              </div>
                 
              <div class="col-auto my-1">
                    <div class="form-group row">
                    <label for="PPh" class="col-sm-3 col-form-label col-form-label-sm">PPh</label>
                    <div class="col-sm">
                        <select name="pph" id="pph" class="form-control">
                          <option value="">Pilih</option>
                          <?php foreach ($pph as $val) : ?>
                          <option value="<?= $val['npph']; ?>"><?= $val['persen']; ?></option>
                     <?php endforeach; ?>
                       </select>
                    </div>
                  </div>
                </div>



                 <div class="col-auto my-1">

                   <div class="form-group row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-warning" id="add_data" <?= $nonaktif; ?>><i class="fas fa-plus"></i>Insert</button>
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
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Ppn</th>
                            <th scope="col">Pph</th>
                            <th scope="col">Hapus</th>
                          </tr>
                        </thead>
                        <tbody>
                       <?php $x = 1; ?>
                          <?php foreach ($transaksi['items'] as $key => $val) : ?>
                          
                          <tr id="row_<?php echo $x; ?>">
                            <td><input type="text" class="form-control" value="<?= $x; ?>" style="font-size: 13px; width: 50px;" id="no_<?= $x;  ?>" name="noinput[]" readonly></td>

                            <td><input type="text" class="form-control" value="<?= $val['loc']; ?>" style="font-size: 13px; width: 70px;" id="loc_<?= $x; ?>" name="locinput[]" readonly></td>

                            <td><input type="text" class="form-control" value="<?= $val['coa_ec_account']; ?>" style="font-size: 13px; width: 70px;" id="ec_<?= $x; ?>" name="ecinput[]" readonly></td>
                            <td><input type="text" class="form-control" value="<?= $val['coa_na_account']; ?>" style="font-size: 13px; width: 70px;" id="na_<?= $x; ?>" name="nainput[]" readonly></td>
                            <td><input type="text" class="form-control" value="<?= $val['coa_tb_account']; ?>" style="font-size: 13px; width: 70px;" id="tb_<?= $x; ?>" name="tbinput[]" readonly></td>
                            <td>
                              <input type="text" class="form-control" value="<?= number_format($val['nominal'],2,",","."); ?>" style="font-size: 13px; width: 140px;" id="ammount1_<?= $x;  ?>" name="ammount1input[]" readonly>
                            </td>
                            <td>
                              <input type="text" class="form-control" value="<?= $val['keterangan']; ?>" style="font-size: 13px;" id="keter_<?= $x;  ?>" name="keterinput[]" readonly>
                            </td>
                            <td>
                              <input type="text" class="form-control" value="<?= $val['ppn']; ?>" style="font-size: 13px;" id="ppn_<?= $x;  ?>" name="ppn[]" readonly>
                            </td>
                            <td>
                             <input type="text" class="form-control" value="<?= $val['pph']; ?>" style="font-size: 13px;" id="pph_<?= $x;  ?>" name="pph[]" readonly>
                            </td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm hapusstatus" title="Removed" onclick="removeRow('<?php echo $x; ?>')"><i class="fas fa-window-close"></i></button>
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

           
       <?php if ($transaksi['trans']['status'] >= 3) : ?>


          <div class="row mt-1">
             <div class="col-md-3">
                <div class="form-group row">
                <div class="col-sm-10 mt-1">
                  <div class="form-check">
                    <input class="form-check-input1" type="checkbox" id="ckho" name="ckho" autocomplete="off" checked disabled>
                    <label class="form-check-label" for="ckho">
                      Reimburstment HO
                    </label>
                  </div>
                </div>
              </div>
             </div>


             
             <div class="col-md-3">
               <div class="form-group row">
                <label for="dateho" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control tanggal" id="dateho" name="dateho" autocomplete="off" value="<?= date('d-m-Y', strtotime($transaksi['trans']['tgl_proses'])); ?>" readonly>
                </div>
             </div>
           </div>

        
             <div class="col-md-4">

                <div class="form-group row">
                <label for="suplier" class="col-sm-2 col-form-label">Suplier</label>
                <div class="col-sm-6">
                 <select id="suplier" name="suplier" class="selectpicker form-control" data-live-search="true" data-style="btn-primary" readonly>
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
                  <input type="text" class="form-control" id="batchno" name="batchno" autocomplete="off" value="<?= $transaksi['trans']['no_batch'] ?>" readonly>
                </div>

                <div class="form-group col-md-2">
                  <label for="datetrans">Date</label>
                  <input type="text" class="form-control tanggal" id="dtpenerima" name="dtpenerima" autocomplete="off" value="<?= date('d-m-Y', strtotime($transaksi['trans']['tgl_penerima'])); ?>" readonly>
                </div>


                <div class="form-group col-md-2">
                  <label for="nobpkb">BPK/B No</label>
                  <input type="text" class="form-control" id="nobpkb" name="nobpkb" autocomplete="off" value="<?= $transaksi['trans']['no_bpk']; ?>" readonly>
                </div>

                <div class="form-group col-md-2">
                  <label for="chequeno">No Giro</label>
                  <input type="text" class="form-control" id="chequeno" name="chequeno" autocomplete="off" value="<?= $transaksi['trans']['no_giro']; ?>" readonly>
                </div>

                  <div class="form-group col-md-2">
                  <label for="totaltrans">Total</label>
                  <input type="text" class="form-control" id="totaltrans" name="totaltrans" value ="<?= number_format($transaksi['trans']['total'],2,",","."); ?>" style="font-weight: bold;" readonly autocomplete="off">
                </div>
              </div>
              
            </div>
            </div>

             <hr> 

             <div class="row">
              <div class="col-md-12">
               <div class="form-group row mt-5">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary" disabled><i class="far fa-save"></i>Save</button>
                      <a href="<?= base_url('transaksi/kasrupiah') ?>" class="btn btn-success"><i class="fas fa-times"></i>Cancel</a>
                    </div>
                     </form>
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
                <label for="dateho" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control tanggal" id="dateho" name="dateho" autocomplete="off" readonly>
                </div>
             </div>
           </div>

          

             <div class="col-md-4">

                <div class="form-group row">
                <label for="suplier" class="col-sm-2 col-form-label">Suplier</label>
                <div class="col-sm-6">
                 <select id="suplier" name="suplier" class="selectpicker form-control" data-live-search="true" data-style="btn-primary" readonly>
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
                  <input type="text" class="form-control" id="batchno" name="batchno" autocomplete="off" readonly>
                </div>

                <div class="form-group col-md-2">
                  <label for="datetrans">Date</label>
                  <input type="text" class="form-control tanggal" id="dtpenerima" name="dtpenerima" autocomplete="off" readonly>
                </div>

                <div class="form-group col-md-2">
                  <label for="nobpkb">BPK/B No</label>
                  <input type="text" class="form-control" id="nobpkb" name="nobpkb" autocomplete="off" readonly>
                </div>

                <div class="form-group col-md-2">
                  <label for="chequeno">No Giro</label>
                  <input type="text" class="form-control" id="chequeno" name="chequeno" autocomplete="off" readonly>
                </div>

                  <div class="form-group col-md-2">
                  <label for="totaltrans">Total</label>
                  <input type="text" class="form-control" id="totaltrans" name="totaltrans" value ="<?= number_format($transaksi['trans']['total'],2,",","."); ?>" style="font-weight: bold;" readonly autocomplete="off">
                </div>
              </div>
              
            </div>
            </div>

             <hr> 

             <div class="row">
              <div class="col-md-12">
               <div class="form-group row mt-5">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Save</button>
                      <a href="<?= base_url('transaksi/kasrupiah') ?>" class="btn btn-success"><i class="fas fa-times"></i>Cancel</a>
                    </div>
                     </form>
                  </div>  
                </div>
              </div>

       <?php endif; ?>

          

        <!--     <?php if (substr($transaksi['trans']['cashbankno'],0,2) == "KK" && $transaksi['trans']['status'] >= 3): ?>
          -->
             

          <!--    <?php elseif (substr($transaksi['trans']['cashbankno'],0,3) == "KAS") : ?>

              <div class="row">
                <div class="col-md-12">
               <div class="form-group row mt-5">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Save</button>
                      <a href="<?= base_url('transaksi/kasrupiah') ?>" class="btn btn-success"><i class="fas fa-times"></i>Cancel</a>
                    </div>
                     </form>
                  </div>  
                </div>
              </div>


              <?php else : ?>

               <div class="row">
                <div class="col-md-12">
               <div class="form-group row mt-5">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Save</button>
                      <a href="<?= base_url('transaksi/kasrupiah') ?>" class="btn btn-success"><i class="fas fa-times"></i>Cancel</a>
                    </div>
                     </form>
                  </div>  
                </div>
              </div>
         
           <?php endif; ?> -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->





