<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-5">
            <form action="<?= base_url('finance/adminfinacc'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Keyword.." name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">

            <?= $this->session->flashdata('message') ?>  
            <div class="card mb-4 text-white">
                <div class="card-header py-3 bg-primary">
                    Total : <?= $total_rows; ?> Data Results
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No Customer</th>
                                <th scope="col">Nama Customer</th>
                               <!-- <th scope="col">Hub</th>-->
                                <th scope="col">TOP</th>
                                <th scope="col">pic1</th>
                                <th scope="col">pic2</th>
                                <th scope="col">email1</th>
                                <th scope="col">email2</th>
                                <th scope="col">Status</th>
                                <th scope="col">Batal</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php if (empty($pettycash)) : ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;">
                                        <div class="alert alert-danger" role="alert">
                                            Data not found!
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>   


                            <?php 
                            //echo '<pre>';
                            //echo print_r($pettycash);
                            //echo '</pre>';
                            
                            foreach ($pettycash as $c) : ?> 
                                   
                                <?php if ($c['flag'] == 1) : ?>
                                    <?php $status = 'Email Terkirim'; ?>
                                <?php elseif ($c['flag'] == 0) : ?>
                                    <?php $status = 'Belum Terkirm'; ?>
                                     <?php endif; ?>
                                    <tr>
                                        <th scope="row"><?= ++$start; ?></th>
                                        <td><?= $c['no']; ?></td>
                                        <td><?= $c['nama']; ?></td>
                                      <!--  <td><?= $c['hub']; ?></td>-->
                                        <td><?= $c['top']; ?></td>
                                        <td><?= $c['pic1']; ?></td>
                                        <td><?= $c['pic2']; ?></td>
                                        <td><?= $c['email1']; ?></td>
                                        <td><?= $c['email2']; ?></td>
                                        <td><?= $status; ?></td>

                                        <td>
                                            <a href="<?= base_url('finance/emailcustbyid/') . $c['id_customer']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-retweet"></i>Email</a>
                                            <a href="<?= base_url('finance/editcust/') . $c['id_customer']; ?>" class="btn btn-info btn-sm editbs"><i class="far fa-edit"></i>Edit</a>
                                             <a href="<?= base_url('finance/resetflagbyid/') . $c['id_customer']; ?>" class="btn btn-success btn-sm"><i class="fas fa-retweet" ></i>Reset</a>

                                        </td>

                                        <td>
                                            <input type="checkbox" id="batal" name="batal" class="bssementara-check-input" <?= check_batalbssementara($c['id_customer']); ?> data-id="<?= $c['id_customer'] ?>" data-nobs="">
                                        </td>

                                    </tr>



                             

                            <?php endforeach; ?> 


                        </tbody>
                    </table>
                    <?= $this->pagination->create_links(); ?> 
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
