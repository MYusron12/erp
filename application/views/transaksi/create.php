<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-md-12">

      <?php if (validation_errors()) : ?>
        <div class="alert alert-success" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('transaksi/create'); ?>" method="post">

        <div class="form-group row">
          <label for="bsno" class="col-sm-2 col-form-label">No Bs.</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="bsno" name="bsno" value="<?= $bsno;?>" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label for="bankcash" class="col-sm-2 col-form-label">Kas-bank</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="bankcash" name="bankcash" readonly>
          </div>
        </div>

        <!--  <div class="form-group row">
            <label for="department" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
              <select name="lokasi" id="lokasi" class="selectpicker show-tick form-control" title="Lokasi" data-width="100%" data-live-search="true">
                <option value="">Pilih</option>
                  <?php foreach ($lokasi as $d) : ?>
                      <option value="<?= $d['id_departement']; ?>"><?= $d['kode_loc'] . "-" . $d['nama']; ?></option>
                  <?php endforeach; ?>
                   
                  </select>
            </div>
          </div> -->

        <div class="form-group row">
          <label for="department" class="col-sm-2 col-form-label">Bagian</label>
          <div class="col-sm-10">
            <select name="bagian" id="bagian" class="selectpicker show-tick form-control" title="Bagian" data-width="100%" data-live-search="true" value="<?= set_value('bagian'); ?>">
              <option value="">Pilih</option>
              <?php foreach ($bagian as $d) : ?>
                <option value="<?= $d['idbagian']; ?>"><?= $d['nama_bagian']; ?></option>
              <?php endforeach; ?>

            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="applicant" class="col-sm-2 col-form-label">Pemohon</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="applicant" name="applicant" value="<?= set_value('applicant'); ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="applicant" class="col-sm-2 col-form-label">Keterangan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="typetransaction" name="typetransaction" value="<?= set_value('typetransaction'); ?>">
          </div>
        </div>


        <div class="form-group row">
          <label for="credit" class="col-sm-2 col-form-label">Jumlah</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="credit" name="credit" value="<?= set_value('credit'); ?>">
          </div>
        </div>

    </div>
    <!--   <div class="col-md-6">

             <div class="form-group row">
            <label for="approvaldate" class="col-sm-3 col-form-label">Tgl Persetujuan</label>
            <div class="col-sm-6">
              <input type="text" class="form-control tanggal" id="approvaldate" name="approvaldate" value="<?php echo date('d-m-Y'); ?>">
            </div>
          </div>


          <div class="form-group row">
            <label for="approvedby" class="col-sm-3 col-form-label">Disetujui Oleh</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="approvedby" name="approvedby" value="<?= set_value('approvedby'); ?>">
            </div>
          </div>


       


          <div class="form-group row">
            <label for="receivedby" class="col-sm-3 col-form-label">Diterima Oleh</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="receivedby" name="receivedby" value="<?= set_value('receivedby'); ?>">
            </div>
          </div>
                  

                  <div class="form-group row">
            <label for="receivingdate" class="col-sm-3 col-form-label">Tgl Terima</label>
            <div class="col-sm-6">
              <input type="text" class="form-control tanggal" id="receivingdate" name="receivingdate" value="<?php echo date('d-m-Y'); ?>">
            </div>
          </div>
           </div> -->
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="form-group row mt-5">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Save</button>
          <a href="<?= base_url('transaksi'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
        </div>
        </form>
      </div>
    </div>
  </div>




  <!--    <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a href="<?= base_url('transaksi'); ?>" class="btn btn-success">Cancel</a>
                    </div>
                  </div>
               </form>
            </div> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
  var credit = document.getElementById('credit');
  credit.addEventListener('keyup', function(e) {
    credit.value = formatRupiah(this.value);
  });

  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>