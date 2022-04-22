
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
              
         <div class="row mt-1">
          <div class="col-md-12">

             <?php if ( validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                 <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

            <?= $this->session->flashdata('message') ?> 

             <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fas fa-plus"></i>Tambah</a> 

         		<div class="table-responsive-md">
                   <table class="table table-bordered" id="dataTable1" style="width: 100%">
                        <thead>
                          <tr>
                            <th scope="col" width="10px;">No</th>
                            <th scope="col" width="100px;">No ikhtisar</th>
                            <th scope="col" width="100px;">Tanggal</th>
                            <th scope="col" width="200px;">Jumlah kas Bank</th>
                            <th scope="col">Aksi</th>
                            <th scope="col">Batal</th>                                                                                 
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach ($rst as $row) : ?>
                          <tr>
                          	<td><?= $i++; ?></td>
                            <td><?= $row['no_ikhtisar']; ?></td>
                            <td><?= $row['tgl_ikhtisar']; ?></td>
                            <td><?= $row['jmlkasbank']; ?></td>
                            <td>
                              <a href="<?= base_url('report/ikhtisar/') .$row['id_ikhtisar']; ?>" class="btn btn-success btn-sm" title="Cetak" target="_blank" <?= href_batalikhtisar($row['id_ikhtisar']); ?>><i class="fas fa-print"></i>Cetak</a>

                              <a href="" class="btn btn-info btn-sm viewIkhtisar" title="View" data-toggle="modal" data-target=".bd-example1-modal-xl" data-id="<?= $row['id_ikhtisar']; ?>"><i class="far fa-eye"></i>View</a>
                            </td>
                            <td>
                               <input type="checkbox" id="batal" name="batal" class="ikhtisar-check-input" <?= check_batalikhtisar($row['id_ikhtisar']); ?> data-id="<?= $row['id_ikhtisar']; ?>" data-ikhtisar="<?= $row['no_ikhtisar']; ?>">
                            </td>
                          </tr>

                        <?php endforeach; ?>
                        </tbody>
                      </table>
         	         </div>
         

         	</div>
         </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Ikhtisar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow:scroll;height:500px;">
        <form action="" method="post">
        <div class="card">
        <div class="card-body">
<!-- 
        <div class="form-group row">
         <label for="noikhtisar" class="col-sm-2 col-form-label">No Ikhtisar</label>
           <div class="col-sm-2">
             <input type="text" class="form-control" id="noikhtisar" name="noikhtisar" value="<?= $noikhtisar; ?>" readonly>
           </div>
         </div>

         <div class="form-group row">
         <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
              <div class="col-sm-5">
              <select  id="lokasi" name="lokasi" class="selectpicker form-control" data-style="btn-success" data-live-search="true" data-width="40%">
                <option value="">Lokasi</option>
                <?php foreach($loc as $row) : ?>
                <option value="<?= $row['kode_loc'];  ?>"><?= $row['kode_loc']." - ".$row['nama']; ?></option>
                <?php endforeach; ?>
              </select> 
              </div>
         </div>

         <div class="form-row">
          <label for="tglikhtisar" class="col-sm-2 col-form-label">Tgl Ikhtisar</label>
            <div class="col-3">
              <input type="text" class="form-control tanggal" id="tglikhtisar" name="tglikhtisar" value="<?= date('d-m-Y');  ?>" style="width: 50%;">
            </div>
            <label for="tglproses" class="col-sm-2 col-form-label" style="margin-left: 150px;">Tgl Proses HO</label>
            <div class="col-3">
              <input type="text" class="form-control tanggal" id="tglproses" name="tglproses" value="<?= date('d-m-Y');  ?>" style="width: 50%;">
            </div>
         </div> -->

        <div class="container-fluid">
           <div class="row">
             <div class="col-md-4">
               <div class="form-group row">
               <label for="noikhtisar" class="col-sm-4 col-form-label">No Ikhtisar</label>
                 <div class="col-sm-6">
                   <input type="text" class="form-control" id="noikhtisar" name="noikhtisar" value="<?= $noikhtisar; ?>" readonly>
                 </div>
               </div>
             </div>
           </div>

           <!-- <div class="row">
             <div class="col-md-4">
               <div class="form-group row">
               <label for="lokasi" class="col-sm-4 col-form-label">Lokasi</label>
                 <div class="col-sm-6">
                    <select  id="lokasi" name="lokasi" class="selectpicker form-control" data-style="btn-success" data-live-search="true" required>
                    <option value="">Lokasi</option>
                    <?php foreach($loc as $row) : ?>
                    <option value="<?= $row['id_departement'];  ?>"><?= $row['kode_loc']." - ".$row['nama']; ?></option>
                    <?php endforeach; ?>
                  </select> 
                 </div>
               </div>
             </div>
           </div> -->

          
         <div class="row">
          <div class="col-md-4">
          <div class="form-group row">
           <label for="tglikhtisar" class="col-sm-4 col-form-label">Tgl Ikhtisar</label>
             <div class="col-sm-6">
               <input type="text" class="form-control tanggal" id="tglikhtisar" name="tglikhtisar" value="<?= date('d-m-Y');  ?>">
             </div>
           </div>
         </div>
          <div class="col-md-4">
          <div class="form-group row">
           <label for="tglproses" class="col-sm-4 col-form-label">Tgl Proses Ho</label>
             <div class="col-sm-6">
               <input type="text" class="form-control tanggal" id="tglproses" name="tglproses" value="<?= date('d-m-Y');  ?>">
             </div>
           </div>
          </div>
        </div>
      </div>
         <hr class="mt-3">

         <div class="row mt-5">
           <div class="col-md-12">
             <table class="table table-bordered table-condensed" id="dataTable">
              <thead>
                <tr>
                  <th style="text-align:center;width:20px;">No</th>
                  <th style="width: 120px;">No KasBank</th>
                  <th style="width: 120px;">Pemohon</th>
                  <th style="width: 120px;">Tanggal</th>
                  <th style="width: 120px;">Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($kasbank as $row) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><input type="checkbox" id="pilih" name="pilih[]" value="<?= $row->id_transaksi ?>"> <?= $row->cashbankno ?></td>
                   <td><?= $row->pemohon; ?></td>
                  <td><?= date('d-m-Y', strtotime($row->tgl_pengajuan)); ?></td>
                  <td><?= number_format($row->total,2,",","."); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
           </div>
         </div>
        </div>
      </div>
                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i>Tutup</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>



<!-- Modal -->
<div class="modal fade bd-example1-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="example1ModalScrollableTitle">View Ikhtisar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow:scroll;height:500px;">
        <form action="" method="post">

         <div class="container-fluid">
           <div class="row">
             <div class="col-md-4">
               <div class="form-group row">
               <label for="noikhtisar" class="col-sm-4 col-form-label">No Ikhtisar</label>
                 <div class="col-sm-6">
                   <input type="text" class="form-control" id="noikhtisarview" name="noikhtisarview" readonly>
                 </div>
               </div>
             </div>
           </div>


         <!--  <div class="row">
             <div class="col-md-4">
               <div class="form-group row">
               <label for="lokasi" class="col-sm-4 col-form-label">Lokasi</label>
                 <div class="col-sm-6">
                    <select class="form-control selectpicker" id="lokasi1" name="lokasi1" data-live-search="true" data-style="btn-primary" disabled>
                    <option value="">Lokasi1</option>
                    <?php foreach($loc as $row) : ?>
                    <option value="<?= $row['id_departement'];  ?>"><?= $row['kode_loc'] ." - ". $row['nama']; ?></option>
                    <?php endforeach; ?>
                  </select> 
                 </div>
               </div>
             </div>
           </div> -->

          
         <div class="row">
          <div class="col-md-4">
          <div class="form-group row">
           <label for="tglikhtisarview" class="col-sm-4 col-form-label">Tgl Ikhtisar</label>
             <div class="col-sm-6">
               <input type="text" class="form-control" id="tglikhtisarview" name="tglikhtisarview" readonly>
             </div>
           </div>
         </div>
          <div class="col-md-4">
          <div class="form-group row">
           <label for="tglprosesview" class="col-sm-4 col-form-label">Tgl Proses Ho</label>
             <div class="col-sm-6">
               <input type="text" class="form-control" id="tglprosesview" name="tglprosesview" readonly>
             </div>
           </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div id="reload">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Kasbank</th>
                  <th>Tanggal</th>
                  <th>Pemohon</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody id="show_ikhtisar">
                
              </tbody>
            </table>
            </div>
        </div>
      </div>
       
                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i>Tutup</button>
      </div>
    </div>
    </form>
  </div>
</div>

















