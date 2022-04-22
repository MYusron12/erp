
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
  
     <div class="row mt-1">
        <div class="col-md-12">

            <?= $this->session->flashdata('message') ?>  

            <div class="panel-body">


                <a href="<?php echo base_url("excel/format_upload_ar.xlsx"); ?>" class="btn btn-primary">Download Format</a>


                <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
                <form class="form-horizontal" method="post" action="<?php echo base_url("finance/import"); ?>" enctype="multipart/form-data">
                    <!--
                    -- Buat sebuah input type file
                    -- class pull-left berfungsi agar file input berada di sebelah kiri
                    -->

                    <div class="form-group row" style="margin-top: 20px;">
                        <div class="col-sm-2">
                            <input type="file" name="file">
                        </div> 
                    </div>

                    <div class="form-group row" style="margin-top: 20px;">
                        <div class="col-sm-2">
                            <input type="submit" name="preview" value="Proses" class="btn btn-primary">
                        </div> 
                    </div>
					<ul class="list-group list-group-flush">
                        <div class="row">
                            <div class="col-lg-6">
                                <li class="list-group-item">Setelah Klik Proses, halaman akan beralih ke apps.local:8081/</li>
                                <li class="list-group-item">Kemudian login lagi dan masuk ke menu email customer.</li>
                                <li class="list-group-item">Selanjutnya klik reset email lagi</li>
                                <li class="list-group-item">Lalu klik kirim email</li>
                                <li class="list-group-item">Pastikan jumlah email yg akan dikirm sesuai</li>
                            </div>
                        </div>
                    </ul>
                    <!--
                    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
                    -->

                </form>

                <?php
                if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
                    if (isset($upload_error)) { // Jika proses upload gagal
                        echo "<div style='color: red;'>" . $upload_error . "</div>"; // Muncul pesan error upload
                        //die; // stop skrip
                        redirect("finance/form");
                    }

                    // Buat sebuah tag form untuk proses import data ke database
                    echo "<form method='post' action='" . base_url("finance/import") . "'>";

                    // Buat sebuah div untuk alert validasi kosong
                    // echo "<div style='color: red;' id='kosong'>
                    // Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                    // </div>";

                    echo "<table border='1' cellpadding='8' width='100%'>
		<tr>
			<th colspan='11'>Preview Data</th>
		</tr>
		<tr>
			<th>NO</th>
			<th>PICKUP DATE</th>
			<th>CITY</th>
			<th>VENDOR NAME</th>
			<th>STORE NAME</th>
			<th>SJ VENDOR</th>
			<th>COLLIE</th>
			<th>ATD DC</th>
			<th>ETA</th>
			<th>ATA(STORE)</th>
			<th>REMAKS</th>
		</tr>";

                    $numrow = 1;
                    $kosong = 0;
                    $no = 1;

                    // Lakukan perulangan dari data yang ada di excel
                    // $sheet adalah variabel yang dikirim dari controller
                    foreach ($sheet as $row) {
                        // Ambil data pada excel sesuai Kolom
                        $a = $row['A']; // Ambil data NIS
                        $b = $row['B']; // Ambil data nama
                        $c = $row['C']; // Ambil data jenis kelamin
                        $d = $row['D']; // Ambil data alamat
                        $e = $row['E']; // Ambil data NIS
                        $f = $row['F']; // Ambil data nama
                        $g = $row['G']; // Ambil data jenis kelamin
                        $h = $row['H']; // Ambil data alamat
                        $i = $row['I'];
                        $j = $row['J'];
                        $k = $row['K'];
                        $l = $row['L'];

                        // Cek jika semua data tidak diisi
                        //if ($a == "" && $b == "" && $c == "" && $d == "" && $e == "" && $f == "" && $g == "" && $h == "" && $i == "" && $j == "")
                        //    continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)


                            
// Cek $numrow apakah lebih dari 1
                        // Artinya karena baris pertama adalah nama-nama kolom
                        // Jadi dilewat saja, tidak usah diimport
                        if ($numrow > 1) {
                            // Validasi apakah semua data telah diisi
                            $a_td = (!empty($a)) ? "" : " style='background: #E07171;'";
                            $b_td = (!empty($b)) ? "" : " style='background: #E07171;'";
                            $c_td = (!empty($c)) ? "" : " style='background: #E07171;'";
                            $d_td = (!empty($d)) ? "" : " style='background: #E07171;'";
                            $e_td = (!empty($e)) ? "" : " style='background: #E07171;'";
                            $f_td = (!empty($f)) ? "" : " style='background: #E07171;'";
                            $g_td = (!empty($g)) ? "" : " style='background: #E07171;'";
                            $h_td = (!empty($h)) ? "" : " style='background: #E07171;'";
                            $i_td = (!empty($i)) ? "" : " style='background: #E07171;'";
                            $j_td = (!empty($j)) ? "" : " style='background: #E07171;'";
                            $k_td = (!empty($i)) ? "" : " style='background: #E07171;'";
                            $l_td = (!empty($i)) ? "" : " style='background: #E07171;'";


                            // Jika salah satu data ada yang kosong
                            if ($a == "" && $b == "" && $c == "" && $d == "" && $e == "" && $f == "" && $g == "" && $h == "" && $i == "" && $j == "") {

                                $kosong++; // Tambah 1 variabel $kosong
                            }

                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td" . $a_td . ">" . $a . "</td>";
                            echo "<td" . $b_td . ">" . $b . "</td>";
                            echo "<td" . $c_td . ">" . $c . "</td>";
                            echo "<td" . $d_td . ">" . $d . "</td>";
                            echo "<td" . $e_td . ">" . $e . "</td>";
                            echo "<td" . $f_td . ">" . $f . "</td>";
                            echo "<td" . $g_td . ">" . $g . "</td>";
                            echo "<td" . $h_td . ">" . $h . "</td>";
                            echo "<td" . $i_td . ">" . $i . "</td>";
                            echo "<td" . $j_td . ">" . $j . "</td>";
                            echo "<td" . $k_td . ">" . $k . "</td>";
                            echo "<td" . $l_td . ">" . $l . "</td>";
                            echo "</tr>";
                        }

                        $numrow++; // Tambah 1 setiap kali looping
                    }

                    echo "</table>";

                    // Cek apakah variabel kosong lebih dari 0
                    // Jika lebih dari 0, berarti ada data yang masih kosong
                    if ($kosong > 0) {
                        ?>
                        <script>
                            $(document).ready(function () {
                                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                                $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                                $("#kosong").show(); // Munculkan alert validasi kosong
                            });
                        </script>
                        <?php
                    } else { // Jika semua data sudah diisi
                        echo "<hr>";
                        // Buat sebuah tombol untuk mengimport data ke database
                        echo "<button type='submit' name='import' class='btn btn-primary'>Import</button>";
                        echo "<a href='" . base_url("finance") . "' style='margin-left: 20px;' class='btn btn-danger'>Cancel</a>";
                    }

                    echo "</form>";
                }
                ?>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

