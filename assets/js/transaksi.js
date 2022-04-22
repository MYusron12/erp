//const base_url = "http://" + window.location.host + '/';
// transaksi
$(function () {
  //const pathArray = window.location.pathname.split('/');
  // const tes = window.location.origin+window.location.pathname;
  // console.log(tes);

  set_number();
  $('#add_data').on('click', function () {

    var no = $('#no').val();
    var loc = $('#loccmb').val();
    var ec = $('#eccmb').val();
    var na = $('#nacmb').val();
    var tb = $('#tbcmb').val();
    var ammount = $('#ammount').val();
    var keter = $('#keter').val();
    var ppn = $('#ppn').val();
    var pph = $('#pph').val();
    var html = '';

    var table = $("#data_table");
    var count_table_tbody_tr = $("#data_table tbody tr").length;
    var row_id = count_table_tbody_tr + 1;
    // console.log(row_id);

    if (ec != "" && na != "" && tb != "") {

      html += '<tr id="row_' + row_id + '">';
      html += '<td><input type="text" class="form-control" value="' + no + '" style="font-size: 13px; width: 50px;" id="no_' + row_id + '" name="noinput[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + loc + '"style="font-size: 13px; width: 70px;" id="loc_' + row_id + '" name="locinput[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + ec + '" style="font-size: 13px; width: 70px;" id="ec_' + row_id + '" name="ecinput[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + na + '" style="font-size: 13px; width: 70px;" id="na_' + row_id + '" name="nainput[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + tb + '" style="font-size: 13px; width: 70px;" id="tb_' + row_id + '" name="tbinput[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + ammount + '" style="font-size: 13px; width: 140px;" id="ammount1_' + row_id + '" name="ammount1input[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + keter + '" style="font-size: 13px;" id="keter_' + row_id + '" name="keterinput[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + ppn + '" style="font-size: 13px;" id="ppn_' + row_id + '" name="ppn[]" readonly></td>';
      html += '<td><input type="text" class="form-control" value="' + pph + '" style="font-size: 13px;" id="pph_' + row_id + '" name="pph[]" readonly></td>';
      html += '<td><button type="button" class="btn btn-danger btn-sm" title="Removed" onclick="removeRow(\'' + row_id + '\')"><i class="fas fa-window-close"></i></button></td></tr>';

      $('#data_table tbody:last-child').append(html);
      sumtrans();
      //clear input data
      $('#no').val('');
      $('#loccmb').val('').selectpicker('refresh');
      $('#eccmb').val('').selectpicker('refresh');
      $('#nacmb').val('').selectpicker('refresh');
      $('#tbcmb').val('').selectpicker('refresh');
      $('#ammount').val('');
      $('#keter').val('');
      $('#ppn').val('');
      $('#pph').val('');
      //$('#nomorbs option').empty();
      //$('#nomorbs').selectpicker("refresh");
      //maggil nomor
      set_number();
    } else {
      alert('You Have to choose the select option completely!');
    }
  });

  $('#ckho').on('click', function () {

    var ckho = document.getElementById("ckho");
    var dateho = document.getElementById("dateho");

    var batchno = document.getElementById("batchno");
    var dtpenerima = document.getElementById("dtpenerima");
    var nobpkb = document.getElementById("nobpkb");
    var chequeno = document.getElementById("chequeno");

    if (ckho.checked == true) {
      dateho.readOnly = false;
      batchno.readOnly = false;
      dtpenerima.readOnly = false;
      nobpkb.readOnly = false;
      chequeno.readOnly = false;
    } else {
      dateho.readOnly = true;
      batchno.readOnly = true;
      dtpenerima.readOnly = true;
      nobpkb.readOnly = true;
      chequeno.readOnly = true;
    }
  });

  $("#nomorbs").on("change", function () {
    var str = '';
    var val = document.getElementById('nomorbs');
    for (i = 0; i < val.length; i++) {
      if (val[i].selected) {
        str += val[i].value + ',';
      }
    }

    var str = str.slice(0, str.length - 1);
    console.log(str);
    $.ajax({
      url: base_url + 'transaksi/getBsValueId',
      type: 'post',
      data: 'id=' + str,
      dataType: 'json',
      success: function (data) {
        let array = [];
        var jmlsisabs = 0;
        var jmlterpakaiawal = 0;
        var jmlkasbank = 0;
        for (var i = 0; i < data.length; i++) {

          var terpakaiawal = data[i].terpakai;
          var sisabs = data[i].terpakai - data[i].nkasbank;
          var nkasbank = data[i].nkasbank;

          jmlsisabs = Number(jmlsisabs) + Number(sisabs);
          jmlterpakaiawal = Number(jmlterpakaiawal) + Number(terpakaiawal);
          jmlkasbank = Number(jmlkasbank) + Number(nkasbank);
          //console.log(jmlsisabs.toFixed(0));
          var b = data[i];
          array.push(b);
        }
        var str1 = '';
        var str2 = '';
        for (i = 0; i < array.length; i++) {
          str1 += array[i].pemohon + ', ';
          str2 += array[i].no_bs + ': ' + array[i].keterangan + ', ';
        }
        var str1 = str1.slice(0, str1.length - 2);
        var str2 = str2.slice(0, str2.length - 2);

        $('#aplicantname').focusout(str1);
        $('#necessity').focusout(str2);
        $('#note').focusout(str2);
        $('#jmlterpakaiawal').focusout(formatMoney(jmlterpakaiawal));
        $('#jmlterpakai').focusout(formatMoney(jmlsisabs.toFixed(0)));
        $('#nkasbank').focusout(formatMoney(jmlkasbank.toFixed(0)));
      },

      error: function (data) {
        // alert('error!...');
        $('#jmlterpakai').focusout(formatMoney(0));
        $('#jmlterpakaiawal').focusout(formatMoney(0));
        $('#nkasbank').focusout(formatMoney(0));
        $('#aplicantname').focusout("");
        $('#necessity').focusout("");
        $('#note').focusout("");
      }
    });
  });

  $("#nomorbs").on("change", function () {
    var str = '';
    var val = document.getElementById('nomorbs');
    for (i = 0; i < val.length; i++) {
      if (val[i].selected) {
        str += val[i].value + ',';
      }
    }
    var str = str.slice(0, str.length - 1);
    $.ajax({
      url: base_url + 'transaksi/getBsValuePusatId',
      type: 'post',
      data: 'id=' + str,
      dataType: 'json',
      success: function (data) {
        let array = [];
        var jmlsisabs = 0;
        var jmlterpakaiawal = 0;
        var jmlkasbank = 0;
        for (var i = 0; i < data.length; i++) {
          var terpakaiawal = data[i].jumlah;
          var sisabs = data[i].jumlah - data[i].nkasbank;
          var nkasbank = data[i].nkasbank;
          jmlsisabs = Number(jmlsisabs) + Number(sisabs);
          jmlterpakaiawal = Number(jmlterpakaiawal) + Number(terpakaiawal);
          jmlkasbank = Number(jmlkasbank) + Number(nkasbank);
          var b = data[i];
          array.push(b);
        }
        var str1 = '';
        var str2 = '';
        for (i = 0; i < array.length; i++) {
          str1 += array[i].pemohon + ', ';
          str2 += array[i].nobs + ': ' + array[i].keperluan + ', ';
        }
        var str1 = str1.slice(0, str1.length - 2);
        var str2 = str2.slice(0, str2.length - 2);
        $('#aplicantname').focusout(str1);
        $('#necessity').focusout(str2);
        $('#note').focusout(str2);
        $('#jmlterpakaiawal').focusout(formatMoney(jmlterpakaiawal));
        $('#jmlterpakai').focusout(formatMoney(jmlsisabs.toFixed(0)));
        $('#nkasbank').focusout(formatMoney(jmlkasbank.toFixed(0)));
      },

      error: function (data) {
        // alert('error!...');
        $('#jmlterpakai').focusout(formatMoney(0));
        $('#jmlterpakaiawal').focusout(formatMoney(0));
        $('#nkasbank').focusout(formatMoney(0));
        $('#aplicantname').focusout("");
        $('#necessity').focusout("");
        $('#note').focusout("");
      }
    });
  });

}); //   function

var set_number = function () {
  var table_len = $('#data_table tbody tr').length + 1;
  $('#no').val(table_len);
}

function removeRow(tr_id) {
  $("#data_table tbody tr#row_" + tr_id).remove();
  set_number();
  sumtrans();
}

function sumtrans() {
  // hitung total
  var jmltabel = $("#data_table tbody tr").length;
  var totalSubAmount = 0;
  for (var i = 0; i < jmltabel; i++) {
    var tr = $("#data_table tbody tr")[i];
    var count = $(tr).attr('id');
    count = count.substring(4);

    var jumlah = $("#ammount1_" + count).val();
    var xjumlah = jumlah.replace(/[^,\d]/g, '');
    var xjumlah1 = xjumlah.replace(',', '.');
    var ppn = $("#ppn_" + count).val();
    var pph = $("#pph_" + count).val();
    totalSubAmount = Number(totalSubAmount) + Number(xjumlah1) + (Number(totalSubAmount) + Number(xjumlah1) * Number(ppn / 100)) - (Number(totalSubAmount) + Number(xjumlah1) * Number(pph / 100));
  }
  totalSubAmount = totalSubAmount.toFixed(2);
  $('#totaltrans').val(formatMoney(totalSubAmount));
}


// $('#id_dept_transcmb').on('change', function() {
//     var id=$(this).val();
//             $.ajax({
//                 url: base_url + 'transaksi/getBsValueById',
//                 type: 'post',
//                 data: {
//                     id: id
//                 },
//                 dataType: 'json',
//                 success: function(data) { 

//                 var strtglkasbon = data.tgl_setuju;
//                 var resultkasbon = strtglkasbon.substr(0, 10);

//                 var strtglterima = data.tgl_terima;
//                 var resultterima = strtglterima.substr(0, 10);

//                 var strtglpengajuan = data.tanggal;
//                 var resultpengajuan = strtglpengajuan.substr(0, 10);

//                 $('#ammount').val(formatMoney(data.terpakai));
//                 $('#bsno').val(data.no_bs);
//                 $('#tglkasbon').val(resultkasbon);
//                 $('#tglpenerima').val(resultterima);
//                 $('#tglpengajuan').val(resultpengajuan);


//                 }
//             });

//         });

var ammount = document.getElementById('ammount');
ammount.addEventListener('keyup', function () {
  ammount.value = formatRupiah(this.value);
});


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

function validasi_radio() {
  var pilihan1 = document.getElementsByName('pilihan');
  if (pilihan1[0].checked == true) {
    var ckho = document.getElementById("ckho");
    ckho.disabled = true;
    $('#ckho').prop('checked', false);
    var id = pilihan1[0].value;
    //$('input:checked').attr("value");
    //alert('Anda Memilih Radio '+ a);
    $('#suplier').prop('disabled', true);
    $('#suplier').selectpicker('refresh');
    getGenerateNumber(id);
    dataBonSementara();
    inputbersih();
  } else if (pilihan1[1].checked == true) {
    var ckho = document.getElementById("ckho");
    ckho.disabled = false;
    $('#ckho').prop('checked', false);
    var id = pilihan1[1].value;
    $('#suplier').prop('disabled', true);
    $('#suplier').selectpicker('refresh');
    getGenerateNumber(id);
    dataBonSementaraPusat();
    inputbersih();
  } else if (pilihan1[2].checked == true) {
    var ckho = document.getElementById("ckho");
    ckho.disabled = false;
    $('#ckho').prop('checked', false);
    var id = pilihan1[2].value;
    $('#suplier').prop('disabled', false);
    $('#suplier').selectpicker('refresh');
    getGenerateNumber(id);
    $('#nomorbs option').empty();
    $('#nomorbs').selectpicker("refresh");
    inputbersih();
  }
}

function inputbersih() {
  $('#jmlterpakai').val(formatMoney(0));
  $('#jmlterpakaiawal').val(formatMoney(0));
  $('#nkasbank').val(formatMoney(0));
  $('#aplicantname').val("");
  $('#necessity').val("");
  $('#note').val("");
}

function getGenerateNumber(id) {
  $.ajax({
    url: base_url + 'transaksi/getDataNumber',
    type: 'post',
    data: {
      id: id
    },
    dataType: 'json',
    success: function (data) {
      $('#cashbankno').val(data);

    }
  });
}

function dataBonSementara() {
  $('#jmlterpakai').val('0');
  $('#nomorbs option').empty();
  $('#nomorbs').selectpicker("refresh");
  $('#nomorbs').selectpicker();

  $.ajax({
    url: base_url + 'transaksi/getDataBs',
    method: "POST",
    async: true,
    dataType: 'json',
    success: function (data) {
      var html = '';
      var i;

      for (i = 0; i < data.length; i++) {
        html += '<option value=' + data[i].id_transaksi_dept + '>' + data[i].no_bs + '-' + data[i].pemohon + '</option>';
      }
      if (data == 0) {
      } else {
        $("#nomorbs").html(html).selectpicker('refresh');
      }
    }
  });
}


function dataBonSementaraPusat() {
  $('#jmlterpakai').val('0');
  $('#nomorbs option').empty();
  $('#nomorbs').selectpicker("refresh");

  $.ajax({
    url: base_url + 'transaksi/getdatabspusat',
    method: "POST",
    async: true,
    dataType: 'json',
    success: function (data) {

      var html = '';
      var i;
      for (i = 0; i < data.length; i++) {
        html += '<option value=' + data[i].idbskantorpusat + '>' + data[i].nobs + '-' + data[i].pemohon + '</option>';
      }
      if (data == 0) {
        alert('No bs tidak ada.');
      } else {

        $("#nomorbs").html(html).selectpicker('refresh');
      }
    }
  });
}








// function get_data_edit(){

//   var id = $('#id_transaksi').val();

//   // window.onload = function() {

//   // var aarr = window.location.href.split('/');
//   // //get last value
//   // var id = aarr[aarr.length -1];

//   // //console.log(aarr);
//    console.log(id);

//    //AJAX REQUEST TO GET SELECTED BS SEMENTARA
//                 $.ajax({
//                     url: base_url + 'transaksi/get_data_bs',
//                     method: "POST",
//                     data :{id:id},
//                     dataType: 'json',
//                     success : function(data){
//                       //console.log(data);
//                         // var item=data;
//                         // var val1=item.replace("[","");
//                         // var val2=val1.replace("]","");
//                         // var values=val2;
//                         // console.log(values);
//                         $.each(data.split(","), function(i,e){
//                         $("#nomorbs option[value='" + e + "']").prop("selected", true).trigger('change');
//                         $("#nomorbs").selectpicker('refresh');

//                        });


//                     }

//   });

//    // }





// // });