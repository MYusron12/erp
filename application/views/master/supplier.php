<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message') ?>

            <a href="" class="btn btn-primary mb-3 tambahDataSuplier" data-toggle="modal" data-target="#newSuplierModal"><i class="fas fa-plus"></i>Tambah</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Supplier Code</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Account</th>
                            <th scope="col">City</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Approved</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($supplier as $row) : ?>
                            <?php if ($row['approve'] == 1) : ?>
                                <?php $approved = "Approved"; ?>

                            <?php else : ?>
                                <?php $approved = "No Approved"; ?>
                            <?php endif; ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['kode_suplier']; ?></td>
                                <td><?= $row['suplier']; ?></td>
                                <td><?= $row['bank']; ?></td>
                                <td><?= $row['rekening']; ?></td>
                                <td><?= $row['kota']; ?></td>
                                <td><?= $row['cabang']; ?></td>
                                <td><?= $approved; ?></td>
                                <td>
                                    <a href="" class="badge badge-success btn-sm tampilModalSuplierUbah" data-toggle="modal" data-target="#newSuplierModal" data-id="<?= $row['id_suplier']; ?>">Edit</a>

                                    <a href="<?= base_url('master/hapussuplier/') . $row['id_suplier'] ?>" class="badge badge-danger btn-sm" onclick="return confirm('Are you sure ?..');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newSuplierModal" tabindex="-1" role="dialog" aria-labelledby="newSuplierModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSuplierModaLabel">Add Supplier New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('master/supplier'); ?>" method="post">

                    <input type="hidden" id="idsuplier" name="idsuplier">

                    <div class="form-group">
                        <input type="text" class="form-control" id="supliercode" name="supliercode" value="<?= $kodesuplier; ?>" readonly>
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" id="suplier" name="suplier" placeholder="Suplier..">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank..">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="account" name="account" placeholder="Account..">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City..">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch..">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" value="1" name="is_approved" id="is_approved" checked>
                            <label class="form-check-label" for="is_active">
                                Approved ?..
                            </label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>