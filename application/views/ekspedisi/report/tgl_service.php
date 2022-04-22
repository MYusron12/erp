
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <form class="form-inline"  action="<?= base_url('report/truckdetail'); ?>" method="post">
            <div class="form-group mb-2">
                <label for="tanggal" class="col-sm-12 col-form-label">Dari</label>
            </div>
            <div class="form-group mx-sm-4 mb-2">
                <input type="text" class="form-control tanggal2" id="tgl1" name="tgl1" value="<?= set_value('tgl1'); ?>" autocomplete="off">
            </div>

            <div class="form-group mb-2">
                <label for="tanggal" class="col-sm-12 col-form-label">s/d</label>
            </div>
            <div class="form-group mx-sm-4 mb-2">
                <input type="text" class="form-control tanggal2" id="tgl2" name="tgl2" value="<?= set_value('tgl2'); ?>" autocomplete="off">
            </div>

            <input class="btn btn-primary mb-2" type="submit" name="submit" value="Filter">
        </form>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
