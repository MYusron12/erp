<!-- Begin Page Content -->
<div class="container-fluid">
  <form action="<?= base_url('transaksi/kasrupiahtambah'); ?>" method="post">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
      <div class="col-md-12">

        <?php if (validation_errors()) : ?>
          <div class="alert alert-success" role="alert">
            <?= validation_errors(); ?>
          </div>
        <?php endif; ?>

        <?= $this->session->flashdata('message') ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          <label for="typebankcash" class="col-sm-3 col-form-label">Jenis Kas Bank</label>
          <div class="form-check form-check-inline">
            <input type="radio" name="pilihan" id="inlineRadio1" value="KK" onclick="validasi_radio();">
            <label class="form-check-label" for="inlineRadio1">Kas Kecil</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="pilihan" id="inlineRadio2" value="KAS" onclick="validasi_radio();">
            <label class="form-check-label" for="inlineRadio2">Kas</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="pilihan" id="inlineRadio3" value="BANK" onclick="validasi_radio();">
            <label class="form-check-label" for="inlineRadio3">Bank</label>
          </div>
        </div>

        <div class="form-group row">
          <label for="cashbankno" class="col-sm-3 col-form-label">No KasBank</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="cashbankno" name="cashbankno" readonly>
          </div>
        </div>


        <div class="form-group row">
          <label for="Date" class="col-sm-3 col-form-label">Tanggal</label>
          <div class="col-sm-6">
            <input type="text" class="form-control tanggal" id="datepengajuan" name="datepengajuan" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">
          </div>
        </div>


        <div class="form-group row">
          <label for="aplicantname" class="col-sm-3 col-form-label">Pemohon</label>
          <div class="col-sm-6">
            <input type="text" class="form-control aplicantname" id="" name="aplicantname" autocomplete="off">
          </div>
        </div>


        <div class="form-group row">
          <label for="necessity" class="col-sm-3 col-form-label">Keperluan</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="necessity" name="necessity" autocomplete="off">
          </div>
        </div>


        <div class="form-group row">
          <label for="note" class="col-sm-3 col-form-label">Catatan</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="note" name="note" autocomplete="off">
          </div>
        </div>
      </div>


      <div class="col-md-6">
        <div class="form-group row mt-5">
          <label for="note" class="col-sm-3 col-form-label">No Bs</label>
          <div class="col-sm-6">
            <select id="nomorbs" name="nomorbs[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-width="fit" multiple>
              <option value="">No Selected</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="jmlterpakaiawal" class="col-sm-3 col-form-label">Jumlah BS Awal</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="jmlterpakaiawal" name="jmlterpakaiawal" autocomplete="off" readonly value="0">
          </div>
        </div>

        <div class="form-group row">
          <label for="jmlterpakai" class="col-sm-3 col-form-label">Jumlah Sisa BS</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="jmlterpakai" name="jmlterpakai" autocomplete="off" readonly value="0">
          </div>
        </div>



        <div class="form-group row">
          <label for="jmlterpakai" class="col-sm-3 col-form-label">Jumlah Kasbank</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="nkasbank" name="nkasbank" autocomplete="off" readonly value="0">
          </div>
        </div>



      </div>
    </div>

    <hr>
    <!-- perincian -->
    <label for="" style="font-weight: bold;">Input Perincian</label>
    <div class="form-row align-items-center mt-2">
      <div class="col-md-6">


        <div class="form-group row">
          <label for="no" class="col-sm-2 col-form-label">No.</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="no" name="no[]" readonly>
          </div>
        </div>
          <table>
              <tr><td><label for="loccmb" class="col-sm-2 col-form-label">Lokasi</label><select id="loccmb" class="selectpicker form-control" data-style="btn-success" data-live-search="true">
              <option value="">LOC</option>
              <?php foreach ($loc as $row) : ?>
                <option value="<?= $row['kode_loc'];  ?>"><?= $row['kode_loc'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
            </select></td>
            <td><label for="eccmb" class="col-sm-2 col-form-label">EC</label><select id="eccmb" class="selectpicker form-control" data-style="btn-success" data-live-search="true">
              <option value="">EC</option>
              <?php foreach ($ec as $row) : ?>
                <option value="<?= $row['account'];  ?>"><?= $row['account'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
            </select></td>
            <td><label for="nacmb" class="col-sm-2 col-form-label">NA</label><select id="nacmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
              <option value="">NA</option>
              <?php foreach ($na as $row) : ?>
                <option value="<?= $row['account'];  ?>"><?= $row['account'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
            </select></td>
            <td><label for="tbcmb" class="col-sm-2 col-form-label">TB</label><select id="tbcmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
              <option value="">TB</option>
              <?php foreach ($tb as $row) : ?>
                <option value="<?= $row['account'];  ?>"><?= $row['account'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
            </select></td>
              </tr>
          </table>
     

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
            <button type="button" class="btn btn-warning" id="add_data"><i class="fas fa-plus"></i>Insert</button>
          </div>
        </div>

      </div>
    </div>


    <!--  
         <div class="row mt-5">
         	<div class="col-md">  
          <div class="row d-flex justify-content-center">
          <div class="col-md-1">
            <input type="text" class="form-control" id="no" name="no[]" readonly>
          </div>


          <div class="col-md">

              <select  id="loccmb" class="selectpicker form-control" data-style="btn-success" data-live-search="true" required>
              <option value="">LOC</option>
              <?php foreach ($loc as $row) : ?>
              <option value="<?= $row['kode_loc'];  ?>"><?= $row['kode_loc'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
              </select> 
           </div>



           <div class="col-md">
              <select  id="eccmb" class="selectpicker form-control" data-style="btn-success" data-live-search="true" required>
              <option value="">EC</option>
              <?php foreach ($ec as $row) : ?>
              <option value="<?= $row['account'];  ?>"><?= $row['account'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
              </select> 
             
           </div>
           <div class="col-md">

              <select id="nacmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
              <option value="">NA</option>
              <?php foreach ($na as $row) : ?>
              <option value="<?= $row['account'];  ?>"><?= $row['account'] . " - " . $row['nama']; ?></option>
              <?php endforeach; ?>
              </select>
           </div>
           <div class="col-md">
             <select id="tbcmb" class="selectpicker form-control" data-live-search="true" data-style="btn-success">
                    <option value="">TB</option>
                   <?php foreach ($tb as $row) : ?>
                    <option value="<?= $row['account'];  ?>"><?= $row['account'] . " - " . $row['nama']; ?></option>
                    <?php endforeach; ?>
                    </select>
           </div>

          

           <div class="col-md">
             <input type="text" class="form-control" id="ammount" name="ammount[]" placeholder="Jumlah">
           </div>
       
         </div>

         <div class="row mt-3">
           <div class="col-md-4">
             <input type="text" class="form-control" id="keter" name="keter" placeholder="Keterangan">
           </div>
         </div> -->

    <!-- <div class="row mt-3">
           <div class="col-md-12 d-flex justify-content-center">
              <button type="button" class="btn btn-warning" id="add_data"><i class="fas fa-plus"></i>Insert</button>
           </div>
         </div>
      </div> -->



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
                <th scope="col">PPn</th>
                <th scope="col">PPh</th>
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
              <input class="form-check-input1" type="checkbox" id="ckho" name="ckho" autocomplete="off" disabled>
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
              <?php foreach ($suplier as $row) : ?>
                <option value="<?= $row['id_suplier'] ?>"><?= $row['kode_suplier'] . " - " . $row['suplier'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

    </div>

    <hr>

    <div class="row">
      <div class="col-md">

        <label for="" style="font-weight: bold;">Realisasi Pembayaran</label>
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="batchno">No Batch</label>
            <input type="text" class="form-control" id="batchno" name="batchno" readonly autocomplete="off">
          </div>

          <div class="form-group col-md-2">
            <label for="datetrans">Tanggal</label>
            <input type="text" class="form-control tanggal" id="dtpenerima" name="dtpenerima" readonly autocomplete="off">
          </div>

          <div class="form-group col-md-2">
            <label for="nobpkb">No BPK/B</label>
            <input type="text" class="form-control" id="nobpkb" name="nobpkb" readonly autocomplete="off">
          </div>

          <div class="form-group col-md-2">
            <label for="chequeno">No Giro / Check</label>
            <input type="text" class="form-control" id="chequeno" name="chequeno" readonly autocomplete="off">
          </div>

          <div class="form-group col-md-2">
            <label for="totaltrans">Jml realisasi</label>
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
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Save</button>
            <a href="<?= base_url('transaksi/kasrupiah'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
          </div>
  </form>
</div>

</div>
</div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->