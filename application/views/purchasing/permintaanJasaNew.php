<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/tambahPermintaanJasaNew') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Tambah Permintaan Jasa</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tgl Permintaan Jas</th>
                                    <th scope="col">No. Permintaan Jasa</th>
                                    <th scope="col">User Request</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>no</td>
                                <td>tgl</td>
                                <td>no</td>
                                <td>user</td>
                                <td>total</td>
                                <td>status</td>
                                <td>act</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->