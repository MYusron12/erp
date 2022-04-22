<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-md-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">

      <div class="form-group row">
        <label for="dateposisi" class="col-sm-3 col-form-label">Tanggal</label>
        <div class="col-sm-6">
          <input type="text" class="form-control tanggal" id="dateposisi" name="dateposisi" value="<?php echo date('d-m-Y'); ?>">
        </div>
      </div>

    </div>

    <div class="col-md-5">
      <div class="form-group row">
        <label for="department" class="col-sm-2 col-form-label">Lokasi</label>
        <div class="col-sm-4">
          <select name="department_id" id="department_id" class="selectpicker show-tick form-control" data-live-search="true" title="Lokasi" data-width="100%">
            <?php foreach ($department as $d) : ?>
              <option value="<?= $d['id_departement']; ?>"><?= $d['nama']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div><button type="button" class="btn btn-primary" id="proses" style="margin-left: 10px;">Proses</button></div>

        <div><button type="button" class="btn btn-success" id="ctkposisi" style="margin-left: 10px;" disabled><i class="fas fa-print"></i>Cetak</button></div>

      </div>


    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-hover mt-5" id="data_table">
        <thead>
          <tr>
            <th scope="col" width="5%">No</th>
            <th scope="col" width="10%">Lembar</th>
            <th scope="col" width="20%">Pecahan</th>
            <th scope="col" width="20%">Total</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody id="show_data">

        </tbody>
      </table>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-7">
      <div class="form-group row">
        <label for="cashonhand" class="col-sm-5 col-form-label">CashOnHand</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="cashonhand" name="cashonhand" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="kasbonsementara" class="col-sm-5 col-form-label">Kasbon Sementera</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="kasbonsementara" name="kasbonsementara" readonly>
        </div>
      </div>



      <div class="form-group row">
        <label for="outstandingkasbank" class="col-sm-5 col-form-label">Outstanding kas bank</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="outstandingkasbank" name="outstandingkasbank" readonly>
        </div>
      </div>


      <div class="form-group row">
        <label for="selisih" class="col-sm-5 col-form-label">Selisih</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="selisih" name="selisih" readonly>
        </div>
      </div>

      <hr>

      <div class="form-group row">
        <label for="totalpettycash" class="col-sm-5 col-form-label" style="font-weight: bold;">Total Pettycash</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="totalpettycash" name="totalpettycash" style="font-weight: bold;" readonly>
        </div>
      </div>


      <div class="form-group row">
        <label for="outstandingreimburstho" class="col-sm-5 col-form-label">Out Standing Reimburstment Ho</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="outstandingreimburstho" name="outstandingreimburstho" readonly>
        </div>
      </div>
      <hr>

      <div class="form-group row">
        <label for="gtotal" class="col-sm-5 col-form-label" style="font-weight: bold;">Grand Total</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="gtotal" name="gtotal" style="font-weight: bold;" readonly>
        </div>
      </div>

      <div class="form-group row justify-content-end " style="margin-top: 50px;">
        <div class="col-sm-10">
          <button type="button" class="btn btn-primary" id="simpanposisi" disabled><i class="fas fa-save"></i>Simpan</button>
          <a href="<?= base_url('transaksi/kasharian') ?>" class="btn btn-success"><i class="fas fa-window-close"></i>Cancel</a>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

Modal
<div class="modal fade" id="editLembarModal" tabindex="-1" role="dialog" aria-labelledby="editLembarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLembarModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <input type="hidden" id="idlembar" name="idlembar">
        <input type="hidden" id="pecahan" name="pecahan">

        <div class="form-group row">
          <label for="lembar1" class="col-sm-3 col-form-label">lembar</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="lembar" name="lembar">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btn_update">Ubah</button>
      </div>
    </div>
  </div>
</div>