$(function () {

    $('#add_data_jasa').on('click', function () {
        var table = $("#data_table_jasa");
        var count_table_tbody_tr = $("#data_table_jasa tbody tr").length;
        var row_id = count_table_tbody_tr + 1;
        var html = "";

        html += '<tr id="row_' + row_id + '">';
        html += '<td><input type="text" class="form-control" id="no_urut_jasa_' + row_id + '" name="no_urut_jasa[]" value="' + row_id + '"></td>';
        html += '<td><textarea class="form-control" id="deskripsi_jasa_' + row_id + '" name="deskripsi_jasa[]" rows="1"></textarea></td>';
        html += '<td><input type="text" class="form-control" id="unitjasa_' + row_id + '" name="unitjasa[]"></td>';
        html += '<td><input type="text" class="form-control rupiah dollar" id="hargajasa_' + row_id + '" name="hargajasa[]" onkeyup="matauang(' + row_id + ');"></td>';
        html += '<td><input type="text" class="form-control" id="totaljasa_' + row_id + '" name="totaljasa[]"></td>';
        html += '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRowjasa(\'' + row_id + '\')"><i class="fas fa-times"></i></button></td>';

        $('#data_table_jasa tbody:last-child').append(html);

    });

});

function removeRowjasa(tr_id) {
    $("#data_table_jasa tbody tr#row_" + tr_id).remove();
}
function matauang(row) {
    var pilih = document.getElementsByName('matauang');
    if (pilih[0].checked == true) {
        var rp = document.getElementById("hargajasa_" + row);
        rp.value = formatRupiah(rp.value, 'Rp. ');
        const test = rp.value.replace(/[^,\d]/g, '');
        console.log(test);
    } else {
        var dolar = document.getElementById("hargajasa_" + row);
        dolar.value = '$' + dolar.value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

}

function rubahmatauang() {
    var pilih = document.getElementsByName('matauang');
    if (pilih[0].checked == true) {
        document.getElementById("judulhargajasa").innerHTML = "IDR";
        document.getElementById("judultotaljasa").innerHTML = "IDR";
        $('.rupiah').val('');
        document.getElementById('kursdolar').style.display = 'none';
    } else {
        document.getElementById("judulhargajasa").innerHTML = "USD";
        document.getElementById("judultotaljasa").innerHTML = "USD";
        $('.rupiah').val('');
        document.getElementById('kursdolar').style.display = 'block';
    }
}

function formatdolar(amount, decimalCount = 2, decimal = ".", thousands = ",") {
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

function formatRupiah1(angka, prefix) {
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