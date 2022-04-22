
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <form class="form-inline"  action="<?= base_url('laporan/realisasibs'); ?>" method="post">
        <div class="form-group mb-2">
          <label for="tanggal" class="col-sm-12 col-form-label">Tanggal</label>
        </div>
        <div class="form-group mx-sm-4 mb-2">
          <input type="text" class="form-control tanggal2" id="tanggal" name="tanggal" value="<?= set_value('tanggal') ?>"autocomplete="off">
        </div>
          <input class="btn btn-primary" type="submit" name="submit" value="filter">
      </form>
          </div>

          <a href="<?= base_url('report/cetakrealisasi/') .$tgl; ?>" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
          
          <div class="row">
            <div class="col-md-12">
              <table class="table mt-3" style="width: 100%; font-size: 13px;">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">BS</th>
              <th scope="col">KasBank</th>
              <th scope="col">TglBS</th>
              <th scope="col">Tgl Terima</th>
              <th scope="col">Tgl Realisasi</th>
              <th scope="col">Aging</th>
              <th scope="col">Pemohon</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Pengajuan</th>
              <th scope="col">Terpakai</th>
              <th scope="col">Sisa</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($osbs as $row) : ?>
            <?php $start_date = new DateTime($row['tanggal']); ?>
            <?php $end_date = new dateTime(date('Y-m-d')); ?>
            <?php $interval = $start_date->diff($end_date); ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $row['no_bs']; ?></td>
              <td><?= $row['no_kas_bank']; ?></td>
              <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
              <td><?= date('d-m-Y', strtotime($row['tgl_terima'])) ?></td>
              <td><?= date('d-m-Y', strtotime($row['tgl_terima'])) ?></td>
              <td><?= $interval->days ?></td>
              <td><?= $row['pemohon']; ?></td>
              <td><?= $row['keterangan']; ?></td>
              <td><?= number_format($row['jumlah_awal'],2,",","."); ?></td>
              <td><?= number_format($row['terpakai'],2,",","."); ?></td>
              <td><?= number_format($row['selisih'],2,",","."); ?></td>
            </tr>
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

     