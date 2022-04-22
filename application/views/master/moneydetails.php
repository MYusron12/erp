
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
           <div class="row">
           	<div class="col-lg-6">
           	
                <?= $this->session->flashdata('message'); ?>

                	<a href="" class="btn btn-primary mb-3 tambahDataMoney" data-toggle="modal" data-target="#newMoneyModal">Add New</a>
          
		           <h5>DC : <?= $dc['nama']; ?></h5>
              <h5>Plafon: <?= number_format($dc['saldo1']); ?></h5>
		          <table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Jumlah</th>
				      <th scope="col">Pecahan</th>
				      <th scope="col">Total</th>
				      <th scope="col">Action</th>
				      
				    </tr>
				  </thead>
				  <tbody>

				  		<?php $i = 1; $total=0; $red=""; foreach ($money as $m) : ?>
              <?php $total = $total + ($m['pecahan']*$m['jumlah']); ?>
              <?php if ($total > $dc['saldo1']) : ?>
              <?php $red = "style='color : red;'"; ?>
              <?php else : ?>
               <?php $red = "style='color : blue;'"; ?>
              <?php endif; ?>
				    <tr>
				       <th scope="row"><?= $i++; ?></th>
				       <td><?= number_format($m['jumlah']); ?></td>
				       <td><?= number_format($m['pecahan']); ?></td>
				       <td><?= number_format($m['pecahan']*$m['jumlah']); ?></td>
				       <td>
				       	 <a href="" class="badge badge-success tampilModalUbahMoney" data-toggle="modal" data-target="#newMoneyModal" data-id="<?= $m['id_validasi']; ?>" data-iddept="<?= $dc['id_departement']; ?>">Edit</a>

				         <a href="" class="badge badge-danger deleteMoney" data-idvalidasi="<?= $m['id_validasi']; ?>" data-iddept="<?= $dc['id_departement']; ?>">Delete</a>
				       </td>
				    </tr>      
				  </tbody>
				<?php endforeach; ?>
          <tr <?= $red; ?>>
            <td colspan="3" style="text-align: center; font-weight: bold;">Total</td>
            <td style="font-weight: bold;"><?= number_format($total); ?></td>
          </tr>
				</table>
           	</div>
           </div>
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     <!-- Modal -->
<div class="modal fade" id="newMoneyModal" tabindex="-1" role="dialog" aria-labelledby="newMoneyModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMoneyModalLabel">Tambah Pecahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       <form action="<?= base_url('master/moneydetails/') . $dc['id_departement'] ?>" method="post">
        
         <input type="hidden" class="form-control" id="iddepartment" name="iddepartment" value="<?= $dc['id_departement']; ?>">


          <input type="hidden" class="form-control" id="idvalidasi" name="idvalidasi">
          
         
         <div class="form-group">
		    <input type="text" class="form-control" id="pieces" name="pieces" placeholder="Lembaran">
		  </div>


       <div class="form-group">
        <input type="text" class="form-control" id="bills" name="bills" placeholder="Nilai Pecahan">
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>



<script>


var bills = document.getElementById('bills');
   bills.addEventListener('keyup', function()
    {
      
      bills.value = formatRupiah(this.value);
    
     
   });





	
	/* Fungsi */
  function formatRupiah(angka, prefix)
  {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa  = split[0].length % 3,
      rupiah  = split[0].substr(0, sisa),
      ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
      
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>

     

