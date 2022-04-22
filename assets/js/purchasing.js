$(function () {

    //const base_url = "http://" + window.location.host + '/';

    $('#add_data_barang').on('click', function () {

        var table = $("#data_table_barang");
        var count_table_tbody_tr = $("#data_table_barang tbody tr").length;
        var row_id = count_table_tbody_tr + 1;
        var html = "";

        $.ajax({
            url: base_url + 'purchasing/get_data_barang',
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                html += '<tr id="row_' + row_id + '">';
                html += '<td><select id="barang_' + row_id + '" name="barang[]" class="form-control selectpicker" data-row-id="' + row_id + '" data-style="btn-primary" data-live-search="true" onchange="getItemBarang(' + row_id + ')">' +
                    '<option value="">Pilih</option>';
                $.each(data, function (index, value) {
                    html += '<option value="' + value.id_barang + '">' + value.kode_barang + '|' + value.nama_barang + '</option>';
                });
                '</select></td>';
                html += '<td><input type="text" class="form-control" id="satuan_' + row_id + '" name="satuan[]" readonly></td>';
                html += '<td> <input type="text" class="form-control" id="qty_' + row_id + '" name="qty[]" onkeyup="getTotal(' + row_id + ')"></td>';
                html += '<td><input type="text" class="form-control" id="harga_' + row_id + '" name="harga[]" onkeyup="myfunctionHarga(' + row_id + ')"></td>';
                html += '<td> <input type="text" class="form-control" id="total_' + row_id + '" name="total[]" readonly></td>';
                html += '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1(\'' + row_id + '\')"><i class="fas fa-times"></i></button></td></tr>';

                $('#data_table_barang tbody:last-child').append(html);
                $('.selectpicker').selectpicker("refresh");

            }
        });
    });

    $('#nomorper').on('change', function () {
        var id = $(this).val();

        $.ajax({
            url: base_url + 'purchasing/get_data_permintaan',
            type: 'post',
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                if (data) {
                    let tanggalpr = new Date(data.tanggal_minta);
                    var dd = tanggalpr.getDate();
                    var mm = tanggalpr.getMonth() + 1;
                    var yyyy = tanggalpr.getFullYear();
                    if (dd < 10) { dd = '0' + dd; }
                    if (mm < 10) { mm = '0' + mm; }
                    tanggalpr = dd + '-' + mm + '-' + yyyy;

                    let tanggalapprove = new Date(data.tanggal_approve);
                    var dd = tanggalapprove.getDate();
                    var mm = tanggalapprove.getMonth() + 1;
                    var yyyy = tanggalapprove.getFullYear();
                    if (dd < 10) { dd = '0' + dd; }
                    if (mm < 10) { mm = '0' + mm; }
                    tanggalapprove = dd + '-' + mm + '-' + yyyy;

                    $('#tglpr').val(tanggalpr);
                    $('#bagian').val(data.nama_bagian);
                    $('#namarequest').val(data.nama_request);
                    $('#keterangan').val(data.keterangan);
                    $('#cprno').val(data.cpr_no);
                    $('#verifikasikode').val(data.verifikasi_kode);
                    $('#coding').val(data.coding);
                    $('#tglaproved').val(tanggalapprove);
                    $('#totalbarang').val(formatMoney(data.grandtotal));
                    $('#totalnet').val(formatMoney(data.grandtotal));
                } else {
                    $('#tglpr').val('');
                    $('#bagian').val('');
                    $('#namarequest').val('');
                    $('#keterangan').val('');
                    $('#cprno').val('');
                    $('#verifikasikode').val('');
                    $('#coding').val('');
                    $('#tglaproved').val('');
                    $('#totalbarang').val('0');
                    $('#totalnet').val('0');
                }
            }
        });

        $.ajax({
            url: base_url + 'purchasing/get_data_permintaan_detail',
            type: 'post',
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                var table;
                table = $('#dataTable12').DataTable();
                if (data != '') {
                    var rows = table
                        .rows()
                        .remove()
                        .draw();
                    $.each(data, function (i, item) {
                        table.row.add(
                            [
                                i + 1,
                                data[i].kode_barang,
                                data[i].nama_barang,
                                data[i].nama_satuan,
                                data[i].qty,
                                formatMoney(data[i].harga),
                                formatMoney(data[i].total)
                            ]
                        );
                    });
                }
                else {
                    var rows = table
                        .rows()
                        .remove()
                        .draw();
                }
                table.draw();
            }
        });
    });

    // simpan createorder 
    $('#simpanorder').on('click', function () {
        var nopo = $('#nopo').val();
        var tglpo = $('#tglpo').val();
        var nomorper = $('#nomorper').val();
        var ppnpersen = $('#ppnpersen').val();
        var ppnrupiah = $('#ppnrupiah').val();
        var pphpersen = $('#pphpersen').val();
        var pphrupiah = $('#pphrupiah').val();
        var totalnet = $('#totalnet').val();
        var suplierorder = $('#suplierorder').val();

        let yakin = confirm('yakin Di Simpan');
        if (yakin == true) {
            if (nomorper == '') {
                alert('Anda Belum Memilih Nomor Permintaan');
                return false;
            } else if (tglpo == '') {
                alert('Anda Belum mengisi Tanggal PO');
                return false;
            } else {
                $.ajax({
                    url: base_url + 'purchasing/simpanorder',
                    type: 'post',
                    data: {
                        nopo: nopo,
                        tglpo: tglpo,
                        nomorper: nomorper,
                        ppnpersen: ppnpersen,
                        ppnrupiah: ppnrupiah,
                        pphpersen: pphpersen,
                        pphrupiah: pphrupiah,
                        totalnet: totalnet,
                        suplierorder: suplierorder
                    },
                    success: function (data) {
                        document.location.href = base_url + 'purchasing/pembelianorder';
                    }
                });
            }
        } else {
            return false
        }
    });

});

function validateForm() {
    //e.preventDefault();
    var bagian = $('#bagian').val();
    var namarequest = $('#namarequest').val();
    var coding = $('#coding').val();
    if (namarequest == '') {
        alert('Nama Request Harus Di isi!');
        return false;
    } else if (bagian == '') {
        alert('Bagian Harus Di isi!');
        return false;
    }else if (coding == '') {
        alert('Coding Harus Di isi!');
        return false;
    }
    return true;
}

function myfunctionHarga(row = null) {
    var x = document.getElementById("harga_" + row);
    x.value = formatRupiah(x.value);
    if (row) {
        var total = $("#harga_" + row).val();
        var total = total.replace(/[^,\d]/g, '');
        var total = total.replace(',', '.');
        var result = Number(total) * Number($('#qty_' + row).val());
        $("#total_" + row).val(formatMoney(result));
        grandtotal();
    } else {
        alert('no row !! please refresh the page');
    }

}

function getTotal(row = null) {
	
    if (row) {
        var total = $("#harga_" + row).val();
        var total = total.replace(/[^,\d]/g, '');
        var total = total.replace(',', '.');
        var result = Number(total) * Number($('#qty_' + row).val());
        $("#total_" + row).val(formatMoney(result));
        grandtotal();
		//console.log(result);
    } else {
        alert('no row !! please refresh the page');
    }
}

function getItemBarang(row_id) {
    var id_barang = $('#barang_' + row_id).val();
    $.ajax({
        url: base_url + 'purchasing/get_data_barang_id',
        method: "POST",
        data: { id_barang: id_barang },
        dataType: 'json',
        success: function (result) {
            $('#satuan_' + row_id).val(result.nama_satuan);
            $('#qty_' + row_id).val(1);
            $('#harga_' + row_id).val(formatMoney(result.harga));

            var total = Number(result.harga) * 1;
            $("#total_" + row_id).val(formatMoney(total));
            grandtotal();
        }
    });
    return false
}


$('#supplierid').on('change', function () {
    var id_suplier = $('#supplierid').val();
   // console.log('var');
    $.ajax({
        url: base_url + 'purchasing/get_data_supplier_id',
        method: "POST",
        data: { id_suplier: id_suplier },
        dataType: 'json',
        success: function (result) {
            $('#suppliername').val(result.suplier);
            
        }
    });
    //alert("The text has been changed.");
});




function removeRow1(tr_id) {
    $("#data_table_barang tbody tr#row_" + tr_id).remove();
    grandtotal();
}

function grandtotal() {
    var tableBarangLength = $("#data_table_barang tbody tr").length;
    var grandtotalbarang = 0;
    for (x = 0; x < tableBarangLength; x++) {
        var tr = $("#data_table_barang tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(4);
        var total = $("#total_" + count).val();
        var total = total.replace(/[^,\d]/g, '');
        var total = total.replace(',', '.');
       grandtotalbarang = Number(grandtotalbarang) + Number(total);
    } // /for
  grandtotalbarang = grandtotalbarang.toFixed(2);
   $('#grandtotalbarang').val(formatMoney(grandtotalbarang));
   
}

function ppn() {
    var totalbarang = document.getElementById('totalbarang').value;
    var totalbarang = totalbarang.replace(/[^,\d]/g, '');
    var totalbarang = totalbarang.replace(',', '.');
    var ppn = $('#ppnpersen').val();
    var pph = $('#pphpersen').val();
    var resultrupiah = 0;
    var resulttotal = 0;
    resultrupiah = Number(resultrupiah) + (Number(totalbarang) * Number(ppn / 100));
    $('#ppnrupiah').val(formatMoney(resultrupiah.toFixed(2)));

    resulttotal = Number(resulttotal) + Number(totalbarang) + (Number(resulttotal) + Number(totalbarang) * Number(ppn / 100)) - (Number(resulttotal) + Number(totalbarang) * Number(pph / 100));
    $('#totalnet').val(formatMoney(resulttotal.toFixed(2)));
}

function pph() {
    var totalbarang = document.getElementById('totalbarang').value;
    var totalbarang = totalbarang.replace(/[^,\d]/g, '');
    var totalbarang = totalbarang.replace(',', '.');
    var ppn = $('#ppnpersen').val();
    var pph = $('#pphpersen').val();
    var resultrupiah = 0;
    var resulttotal = 0;
    resultrupiah = Number(resultrupiah) + (Number(totalbarang) * Number(pph / 100));
   // console.log(formatMoney(resultrupiah.toFixed(2)));
    $('#pphrupiah').val(formatMoney(resultrupiah.toFixed(2)));

    resulttotal = Number(resulttotal) + Number(totalbarang) + (Number(resulttotal) + Number(totalbarang) * Number(ppn / 100)) - (Number(resulttotal) + Number(totalbarang) * Number(pph / 100));
     console.log(resulttotal);
    $('#totalnet').val(formatMoney(resulttotal.toFixed(2)));

}

function ppn1() {
    var totalbarang = document.getElementById('grandtotalbarangs').value;
    var totalbarang = totalbarang.replace(/[^,\d]/g, '');
    var totalbarang = totalbarang.replace(',', '.');
    var ppn = $('#ppnpersen').val();
    var pph = $('#pphpersen').val();
    var resultrupiah = 0;
    var resulttotal = 0;
    resultrupiah = Number(resultrupiah) + (Number(totalbarang) * Number(ppn / 100));
    
    $('#ppnrupiah').val(formatMoney(resultrupiah.toFixed(2)));

    resulttotal = Number(resulttotal) + Number(totalbarang) + (Number(resulttotal) + Number(totalbarang) * Number(ppn / 100)) - (Number(resulttotal) + Number(totalbarang) * Number(pph / 100));
    $('#totalnet').val(formatMoney(resulttotal.toFixed(2)));
}

function pph1() {
    var totalbarang = document.getElementById('grandtotalbarangs').value;
    var totalbarang = totalbarang.replace(/[^,\d]/g, '');
    var totalbarang = totalbarang.replace(',', '.');
    var ppn = $('#ppnpersen').val();
    var pph = $('#pphpersen').val();
    var resultrupiah = 0;
    var resulttotal = 0;
    resultrupiah = Number(resultrupiah) + (Number(totalbarang) * Number(pph / 100));
    console.log(formatMoney(resultrupiah.toFixed(2)));
    $('#pphrupiah').val(formatMoney(resultrupiah.toFixed(2)));

    resulttotal = Number(resulttotal) + Number(totalbarang) + (Number(resulttotal) + Number(totalbarang) * Number(ppn / 100)) - (Number(resulttotal) + Number(totalbarang) * Number(pph / 100));
     console.log(resulttotal);
   $('#totalnet').val(formatMoney(resulttotal.toFixed(2)));

}

function ppn2() {
    var totalbarang = document.getElementById('grandtotalbarang').value;
    var totalbarang = totalbarang.replace(/[^,\d]/g, '');
    var totalbarang = totalbarang.replace(',', '.');
    var ppn = $('#ppnpersen').val();
    var pph = $('#pphpersen').val();
    var resultrupiah = 0;
    var resulttotal = 0;
    resultrupiah = Number(resultrupiah) + (Number(totalbarang) * Number(ppn / 100));
    
    $('#ppnrupiah').val(formatMoney(resultrupiah.toFixed(2)));

    resulttotal = Number(resulttotal) + Number(totalbarang) + (Number(resulttotal) + Number(totalbarang) * Number(ppn / 100)) - (Number(resulttotal) + Number(totalbarang) * Number(pph / 100));
    $('#totalnet').val(formatMoney(resulttotal.toFixed(2)));
}

function pph2() {
    var totalbarang = document.getElementById('grandtotalbarang').value;
    var totalbarang = totalbarang.replace(/[^,\d]/g, '');
    var totalbarang = totalbarang.replace(',', '.');
    var ppn = $('#ppnpersen').val();
    var pph = $('#pphpersen').val();
    var resultrupiah = 0;
    var resulttotal = 0;
    resultrupiah = Number(resultrupiah) + (Number(totalbarang) * Number(pph / 100));
    console.log(formatMoney(resultrupiah.toFixed(2)));
    $('#pphrupiah').val(formatMoney(resultrupiah.toFixed(2)));

    resulttotal = Number(resulttotal) + Number(totalbarang) + (Number(resulttotal) + Number(totalbarang) * Number(ppn / 100)) - (Number(resulttotal) + Number(totalbarang) * Number(pph / 100));
     console.log(resulttotal);
   $('#totalnet').val(formatMoney(resulttotal.toFixed(2)));

}


function getdatapermintaan() {
    var idpembelian = document.getElementById('nopoterima').value;
    $.ajax({
        url: base_url + 'purchasing/getdataorderid',
        method: "POST",
        data: { id: idpembelian },
        dataType: 'json',
        success: function (data) {
            if (data) {
                $('#noperterima').val(data.no_permintaan);
            } else {
                $('#noperterima').val('');
            }

        }
    });

    $.ajax({
        url: base_url + 'purchasing/getdataorderdetail',
        type: 'post',
        data: { id: idpembelian },
        dataType: 'json',
        success: function (data) {
            //console.log(data);
            var table;
            table = $('#dataTable13').DataTable();
            if (data != '') {
                var rows = table
                    .rows()
                    .remove()
                    .draw();
                $.each(data, function (i, item) {
                    table.row.add(
                        [
                            i + 1,
                            data[i].kode_barang,
                            data[i].nama_barang,
                            data[i].nama_satuan,
                            data[i].qty,
                            '<input type="text" class="form-control qtyterima" name="qtyterima[]" style="width:100px;" onkeypress="return hanyaAngka(event)">',
                            '<input type="text" class="form-control keterterimadetail" name="keterterimadetail[]" style="width:100px;">'
                        ]
                    );
                });
            }
            else {
                var rows = table
                    .rows()
                    .remove()
                    .draw();
            }
            table.draw();
        }
    });
}

function simpanterimabarang() {
    var notransterima = $('#notransterima').val();
    var tglterima = document.getElementById('tglterima').value;
    var nopoterima = $('#nopoterima').val();
    var keteranganterima = $('#keteranganterima').val();
    // Get data as array, ['Jon', 'Mike']
    var qtyterima = $('input[name="qtyterima[]"]').map(function () {
        return this.value;
    }).get();

    var keterterimadetail = $('input[name="keterterimadetail[]"]').map(function () {
        return this.value;
    }).get();

    let yakin = confirm('Anda yakin Simpan ?...');
    if (yakin == true) {

        for (var i = 0; i < qtyterima.length; i++) {
            if (qtyterima[i] == '') {
                alert('Mohon Periksa inputan qty terima ada yang tidak terisi! \nMohon Periksa kembali!..');
                return false;
            }
        }
        if (tglterima == '') {
            alert('Tanggal Tidak Boleh Kosong!..');
            return false;
        } else if (nopoterima == '') {
            alert('No PO Tidak Boleh Kosong!..');
            return false;
        } else {

            $.ajax({
                url: base_url + 'purchasing/simpanpenerimaan',
                type: 'post',
                data: {
                    notransterima: notransterima,
                    tglterima: tglterima,
                    nopoterima: nopoterima,
                    keteranganterima: keteranganterima,
                    qtyterima: qtyterima,
                    keterterimadetail: keterterimadetail
                },
                //dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    document.location.href = base_url + 'purchasing/penerimaanbarang';
                }
            });
        }

    } else {
        return false;
    }
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
    try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
        console.log(e)
    }
};

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}