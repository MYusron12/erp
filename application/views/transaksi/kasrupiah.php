<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <a href="<?= base_url('transaksi/kasrupiahtambah'); ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i>Tambah</a>
  <div class="row mt-1">
    <div class="col-md-12">

      <?= $this->session->flashdata('message') ?>

      <div class="table-responsive-md">
        <table class="table table-bordered" id="dataTable1" style="width: 100%">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Jenis Kasbank</th>
              <th scope="col">No Kas Bank</th>
              <th scope="col">Tgl Pengajuan</th>
              <th scope="col">Pemohon</th>
              <th scope="col">Total</th>
              <th scope="col">Aksi</th>
              <th scope="col">Batal</th>

            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($transHead as $row) : ?>

              <?php if ($row->type == "KK") : ?>
                <?php $jenis = "Kas Kecil"; ?>

                <?php $edit = '<a href="' . base_url('transaksi/kasrupiaheditkk/') . $row->id_transaksi . '" class="btn btn-info btn-sm editkasbank" data-id="' . $row->id_transaksi . '"; title="edit" ' . href_batalkasbank($row->id_transaksi) . '><i class="far fa-edit">Edit</i></a>' ?>

                <?php $input = '<input type="checkbox" id="batalkas" name="batalkas" class="kasrupiah-check-input"
                                            ' . check_batalkasbank($row->id_transaksi) . ' data-id="' . $row->id_transaksi . '"
                                            data-nokasbank="' . $row->cashbankno . '" data-total="' . $row->total . '">' ?>

                <?php $cetak = '<a href="' . base_url('report/cetakkasbank/') . $row->id_transaksi . '" class="btn btn-success btn-sm" target="_blank"  ' . href_batalkasbank($row->id_transaksi) . '><i class="fas fa-print"></i>Cetak</a>' ?>

              <?php elseif ($row->type == "KAS") : ?>
                <?php $jenis = "Kas"; ?>

                <?php $edit = '<a href="' . base_url('transaksi/kasrupiaheditkas/') . $row->id_transaksi . '" class="btn btn-info btn-sm editkasbank1" data-id="' . $row->id_transaksi . '"; title="edit" ' . href_batalkasbank($row->id_transaksi) . '><i class="far fa-edit">Edit</i></a>' ?>

                <?php $input = '<input type="checkbox" id="batalkaskas" name="batalkaskas" class="kasrupiahkas-check-input"
                                            ' . check_batalkasbankkas($row->id_transaksi) . ' data-id="' . $row->id_transaksi . '"
                                            data-nokasbank="' . $row->cashbankno . '" data-total="' . $row->total . '" >' ?>
                <?php $cetak = '<a href="' . base_url('report/cetakkasbank1/') . $row->id_transaksi . '" class="btn btn-success btn-sm" target="_blank"  ' . href_batalkasbank($row->id_transaksi) . '><i class="fas fa-print"></i>Cetak</a>' ?>

              <?php elseif ($row->type == "BANK") : ?>
                <?php $jenis = "Bank"; ?>
                <?php $edit = '<a href="' . base_url('transaksi/kasrupiaheditbank/') . $row->id_transaksi . '" class="btn btn-info btn-sm editkasbank2" data-id="' . $row->id_transaksi . '"; title="edit" ' . href_batalkasbank($row->id_transaksi) . '><i class="far fa-edit">Edit</i></a>' ?>

                <?php $input = '<input type="checkbox" id="batalkasbank" name="batalkasbank" class="kasrupiahbank-check-input"
                                            ' . check_batalkasbankbank($row->id_transaksi) . ' data-id="' . $row->id_transaksi . '"
                                            data-nokasbank="' . $row->cashbankno . '" data-total="' . $row->total . '" >' ?>

                <?php $cetak = '<a href="' . base_url('report/cetakkasbankbank/') . $row->id_transaksi . '" class="btn btn-success btn-sm" target="_blank"  ' . href_batalkasbank($row->id_transaksi) . '><i class="fas fa-print"></i>Cetak</a>' ?>

              <?php endif; ?>


              <?php if ($row->status == 1) : ?>
                <?php $aktif = "style='pointer-events:none; opacity:0.2; background-color:#000;'"; ?>
              <?php else : ?>
                <?php $aktif = ""; ?>
              <?php endif; ?>

              <tr>
                <td><?= $i++;  ?></td>
                <td><?= $jenis; ?></td>
                <td><?= $row->cashbankno;  ?></td>
                <td><?= date('d-m-Y', strtotime($row->tgl_pengajuan));  ?></td>
                <td><?= $row->pemohon;  ?></td>
                <td><?= number_format($row->total, 2, ",", ".");  ?></td>
                <td>

                  <?= $edit; ?>

                  <?= $cetak; ?>
                </td>

                <td><?= $input; ?></td>
              </tr>


            <?php endforeach; ?>
          </tbody>
        </table>
      </div>


    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->