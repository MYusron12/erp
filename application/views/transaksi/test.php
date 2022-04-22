

<script src="jquery.js"></script>
<form method="POST"/>
<table class="table table-bordered">
<input type="hidden" class='form-control' value="BELUM LUNAS" name="Status" / >
<tr>
  <td><Strong>No_Transaksi</strong></td>
  <td><input type="text" class='form-control' name="No_transaksi" / ></ td>
  </tr>
  
  <tr>
  <td><Strong>Tanggal Transaksi</strong></td>
  <td><input type="text" class='form-control datepicker' name="Tgl" / ></td>
  </tr>
  <tr>
  <td><Strong>Tanggal Jatuh Tempo</strong></td>
  <td><input type="text" class='form-control datepicker' name="Tgl_Tempo" /></ td>
  </tr>

  <tr>
  <td><strong>Id_Salesman</strong></td>
  <td><select class='form-control' name="Id_Salesman"/>
  <option value=""/>------Pilih Salesman------</option>
    <?php 
    $data=mysql_query("select * from salesman");
    while($list=mysql_fetch_array($data)){ ?>
      <option value="<?php echo $list['Id_Salesman'];?>"/><?php echo $list['Nama_Salesman'];?></option>
    
    <?php } ?>
  </select>
  </td>
  </tr>
<input type="hidden" name="wilayah" id="wilayah"/>
  <tr>
  <td><strong>Id_Customer</strong></td>
  <td><select class='form-control' name="Id_Customer" id="Id_Customer"/>
  <option value=""/>------Pilih Customer------</option>
    
  </select>
  </td>
  </tr>
  </table>
   

  <table border="1">
        <tr id="baris">
            <td>Nama Barang</td>
            <td>Harga</td>
            <td>Qty</td>
        </tr>
        <tr>
        <td> <select name="Id_Barang[]" id="textfield2" class="form-control" />
      <option value="">--Pilih Barang--</option>
         
               
          <option value="<?php echo $d['Id_Barang'];?>"><?php echo $d['Nama_Barang'];?></option>
            
                </select> </td>
            
            <td>
                <input type="text" name="Harga[]" id="textfield2" class="form-control" /></td>
            <td>
                <input type="text" name="Qty[]" id="textfield3" class="form-control" /></td>
        </tr>
        <tr id="tambah">
            <td colspan="4"><input type="button" class="btn-large btn-success" id="tambah" name="baris" value="tambah baris"/></td>
        </tr>
        <tr>
            <td colspan="4"><input type="submit" class="btn btn-small btn-danger" name="Simpan" value="simpan"/></td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
