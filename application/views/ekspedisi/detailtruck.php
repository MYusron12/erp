<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Detail Driver</h5>
                <div class="card-body">
                    <div class="row">
                  
                        <table class="table table-bordered">
                            <tr>
                                <td>No Urut</td>
                            <td><strong><?= $header->no_urut;?></strong></td>
                            </tr>
                             <tr>
                                <td>Kendaraan</td>
                                <td><strong><?= $header->no_polisi;?></strong></td>
                            </tr>
                            
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No Urtu</th>
                                    <th>No Polisi</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Request</th>
                                    <th>Part yg di ganti</th>
                                    <th>tgl req</th>
                                    <th>tgl cek</th>
                                    <th>pic</th>
                                    <th>hasil Cek</th>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php $i = 1;
                                   foreach ($details as $detail) : ?>
                                <tr>
                                    <td><?= $detail->no_urut;?></td>
                                    <td><?= $detail->no_polisi;?></td>
                                    <td><?= $detail->categori;?></td>
                                    <td><?= $detail->deskripsi_supir;?></td>
                                    <td><?= $detail->deskripsi_komponen;?></td>
                                    <td><?= $detail->deskripsi_peminta;?></td>
                                    <td><?= $detail->tgl_order;?></td>
                                    <td><?= $detail->tanggal_cek;?></td>
                                    <td><?= $detail->pic_cek;?></td>
                                    <td><?= $detail->deskripsi_perkerja ;?></td>
                                </tr>
                                 <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <a href="<?= base_url('ekspedisi/truck'); ?>" class="btn btn-primary btn-sm mt-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->