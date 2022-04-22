<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">

            <?= $this->session->flashdata('message') ?>  
            <div class="card mb-4 text-white">
               
                <div class="card-body">
                      <span><h5><strong><a href='<?= base_url('finance/monitoringemail')?>'>Kembali</a></strong></h5></span>
                    <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No Customer</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Freight</th>
                                <th scope="col">Insurance</th>
                                <th scope="col">Vat</th>
                                <th scope="col">Total</th>
                                <th scope="col">Os</th>
                             

                            </tr>
                        </thead>
                        <tbody>

                            

                            <?php 
                           // echo '<pre>';
                           // echo print_r($d90120);
                           // echo '</pre>';
                            $no=1;
                            $t=0;
                            $i=0;
                            $vat=0;
                            $f=0;
                            $o=0;
                            foreach ($d90120 as $c) : ?> 
                            
                                    <tr>
                                        <th scope="row"><?=$no++;?></th>
                                        <td><?= $c->no_cs; ?></td>
                                        <td><?= $c->name_cs; ?></td>
                                        <td><?= number_format($c->f,2); ?></td>
                                        <td><?= number_format($c->i,2); ?></td>
                                        <td><?= number_format($c->vat,2); ?></td>
                                        <td><?= number_format($c->t,2); ?></td>
                                        <td><?= number_format($c->o,2); ?></td>
                                    </tr>

                                   
                                   
                             

                            <?php 
                            $f+=$c->f;
                            $i+=$c->i;
                            $vat+=$c->f;
                            $t+=$c->t;
                            $o+=$c->o;
                            endforeach; ?> 

                                  <tr>
                                      <td colspan="3">Total</td>
                                      <td colspan=""><?= number_format($f, 2); ?></td>
                                      <td colspan=""><?= number_format($i, 2); ?></td>
                                      <td colspan=""><?= number_format($vat, 2); ?></td>
                                      <td colspan=""><?= number_format($t, 2); ?></td>
                                      <td colspan=""><?= number_format($o, 2); ?></td>
                                        
                                    </tr>
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
