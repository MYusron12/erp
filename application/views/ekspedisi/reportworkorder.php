<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Report By PDF</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Report By Excel</a>
        </li>
    </ul>


    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <form class="form-inline"  action="<?= base_url('report/cetaklaporanwo') ?>" method="POST" target="_blank">
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

                            <input class="btn btn-primary mb-2" type="submit" name="submit" value="Cetak">

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <form class="form-inline"  action="<?= base_url('report/reportwoexcel') ?>" method="POST" target="_blank">
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

                            <input class="btn btn-primary mb-2" type="submit" name="submit" value="Cetak">

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>