<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- button tambah -->
    <div class="row">
        <div class="col-md-3">
            <a href="<?= base_url('finance/tambahCustomer') ?>" class="btn btn-primary mb-3 tambahDataMenu">Tambah Customer</a>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message') ?>

            <div class="card mb-4 text-white">
                <div class="card-body">

                    <!-- table -->
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Customer</th>
                                <th scope="col">Nama Customer</th>
                                <th>PIC 1</th>
                                <th>PIC 2</th>
                                <th>PIC 3</th>
                                <th>Email 1</th>
                                <th>Email 2</th>
                                <th>Email 3</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($customer as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $m['no']; ?></td>
                                    <td><?= $m['nama']; ?></td>
                                    <td><?= $m['pic1']; ?></td>
                                    <td><?= $m['pic2']; ?></td>
                                    <td><?= $m['pic3']; ?></td>
                                    <td><?= $m['email1'] ?></td>
                                    <td><?= $m['email2'] ?></td>
                                    <td><?= $m['email3'] ?></td>
                                    <td>
                                        <a href="<?= base_url('finance/editCustomer/') . $m['id_customer'] ?>" class="badge badge-success btn-sm tampilModalUbahMenu">Edit</a>

                                        <a href="<?= base_url('finance/hapusCustomer/') . $m['id_customer'] ?>" class="badge badge-danger btn-sm" onclick="return confirm('Are you sure ?..');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- end table -->

                </div>
            </div>
        </div>
    </div>



</div>