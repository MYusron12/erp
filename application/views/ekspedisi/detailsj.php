<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
   

    <div class="row">
        <div class="col-lg-9">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('ekspedisi/detailaktivitas'); ?>" method="post">
                
                
                <table class="table table-striped">
                    <tr>
                        <td>NO</td>
                        <td>KODE TOKO</td>
                        <td>NAMA TOKO</td>
                         <td>BU</td>
                         <td>COLY</td>
                         <td>SUPPLIER</td>
                         <td>DO</td>
                    </tr>
                    <?php
                   //echo '<pre>';
                  //echo print_r($detail_aktv);
                    //  echo '</pre>';
                      $no=1;
                      $total_c=0;
                      $cv=0;
                      $cv_no=0;
                      $dp361=0;
                      $dp=0;
                    foreach ($detail_aktv as $row) :
                        ?>
                        <tr> 
                            <td><?php echo $no++;?></td>
                            <td><?= $row['D_FACILITY_ALIAS_ID']; ?></td>
                            <td><?= $row['D_FACILITY_NAME']; ?></td>
                            <td><?= $row['BU']; ?></td>
                            <td><?= $row['TOTAL_COLI']; ?></td>
                            <td><?= $row['COMPANY_DESCRIPTION']; ?></td>
                            <td><?= $row['REF_FIELD_6']; ?></td>         
                        </tr>
                        
                    <?php 
                    if ($row['BU']=='CV MDS'){
                    $totalCV=$row['TOTAL_COLI'];
                    $cv+=$totalCV;
                    }elseif($row['BU']=='CV NON MDS'){
                    $totalcvno=$row['TOTAL_COLI'];
                    $cv_no+=$totalcvno;  
                    }elseif($row['BU']=='DP 361'){
                    $total361=$row['TOTAL_COLI'];
                    $dp361+=$total361;  
                    }elseif($row['BU']=='DP MDS'){
                    $totaldp=$row['TOTAL_COLI'];
                    $dp+=$totaldp; 
                    }
                    $total=$row['TOTAL_COLI'];
                    $total_c+=$total;
                    
                    endforeach; ?>
                       
                        <tr>
                            <td  colspan="4"><strong><h5>Total CV MDS</h5></strong></td>
                            <td><strong><h5><?php echo $cv;?></h5></strong></td>
                        </tr>
                        <tr>
                            <td  colspan="4"><strong><h5>Total NON CV MDS</h5></strong></td>
                            <td><strong><h5><?php echo $cv_no;?></h5></strong></td>
                        </tr>
                        <tr>
                            <td  colspan="4"><strong><h5>DP MDS</h5></strong></td>
                            <td><strong><h5><?php echo $totaldp;?></h5></strong></td>
                        </tr>
                         <tr>
                            <td  colspan="4"><strong><h5>DP MDS 361</h5></strong></td>
                            <td><strong><h5><?php echo $dp361;?></h5></strong></td>
                        </tr>
                         <tr>
                            <td  colspan="4"><strong><h5>Grand Total</h5></strong></td>
                            <td><strong><h5><?php echo $total_c;?></h5></strong></td>
                        </tr>
                </table>
                </div>
         <div class="col-lg-3">
                <table class="table table-bordered">
                    <tr>
                        <td>SJ HARI INI YANG BLM CL</td>
                        <td>No Mobil</td>
                    </tr>
                    <?php
                   // echo '<pre>';
                   // echo print_r($sj_blm_close);
                   // echo '</pre>';
                    foreach ($sj_blm_close as $row) :
                        ?>
                   <?php
                        if($sj_blm_close ==''){?>
                        <tr> 
                            <td>Semua sj sudah di closeload</td>
                        </tr>
                        <?php }else{?>
                        
                          <tr> 
                            <td><?= $row['TC_SHIPMENT_ID']; ?> belum close load</td>
                             <td><?= $row['AUTH_NBR']; ?></td>
                        </tr>
                      <?php  }?>
                    <?php endforeach; ?>
                </table>
         </div>
        </div>
        
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
            <a href="<?= base_url('ekspedisi/driver'); ?>" class="btn btn-danger float-center"><i class="fas fa-times"></i>Cancel</a>
        </div>
        </form>
    </div>

