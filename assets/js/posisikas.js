$(document).ready(function () {

  // const pathArray = window.location.pathname.split( '/' );
  // const base_url = "http://" + window.location.host + '/' + pathArray[1] + '/';
  // console.log(base_url);

  // const base_url = "http://" + window.location.host + '/';

  $('#proses').on('click', function () {

    var tgl = $('#dateposisi').val();
    var iddept = $('#department_id').val();
    var button = document.getElementById("simpanposisi");

    tampiluang(iddept, tgl);
    tampilrincian(iddept, tgl);
    button.disabled = false;

  });


  function tampiluang(iddept, tgl) {
    $.ajax({
      url: base_url + 'transaksi/data_uang',
      type: 'post',
      data: { id: iddept, tgl: tgl },
      async: true,
      dataType: 'json',
      success: function (data) {

        var html = '';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' +
            '<td>' + (i + 1) + '</td>' +
            '<td>' + data[i].jumlah + '</td>' +
            '<td>' + formatMoney(data[i].pecahan) + '</td>' +
            '<td>' + (formatMoney(data[i].jumlah * data[i].pecahan)) + '</td>' +
            '<td style="text-align:left;">' +
            '<a href="javascript:;" class="btn btn-success btn-sm item_edit" data="' + data[i].id_validasi + '"><i class="fas fa-edit"></i>Edit</a>' +
            '</td>' +
            '</tr>';
        }
        $('#show_data').html(html);
      }
    });

    return false;

  }

  function tampilrincian(iddept, tgl) {
    $.ajax({
      url: base_url + 'transaksi/datarincian',
      type: 'post',
      data: { id: iddept, tgl: tgl },
      dataType: 'json',
      success: function (data) {

        const selisih = document.getElementById('selisih');

        if (data.selisih < 0) {
          selisih.style.color = 'red';
          selisih.style.fontWeight = "bold";

        } else {

          selisih.style.color = '';
          selisih.style.fontWeight = "";

        }

        $('#cashonhand').val(formatMoney(data.cashonhand));
        $('#kasbonsementara').val(formatMoney(data.kasbon));
        $('#outstandingkasbank').val(formatMoney(data.outstanding));
        $('#selisih').val(formatMoney(data.selisih));
        $('#totalpettycash').val(formatMoney(data.ttlpettycash));
        $('#outstandingreimburstho').val(formatMoney(data.reimburstho));
        $('#gtotal').val(formatMoney(data.grandtotal));

      }

    });

    return false;
  }

  //GET UPDATE
  $('#show_data').on('click', '.item_edit', function () {
    var id = $(this).attr('data');

    $.ajax({
      type: "post",
      url: base_url + 'transaksi/getdatauang',
      dataType: "JSON",
      data: { id: id },
      success: function (data) {
        $.each(data, function (id_validasi, jumlah, pecahan) {
          $('#editLembarModal').modal('show');
          $('#lembar').val(Number(data.jumlah).toFixed(0));
          $('#pecahan').val(Number(data.pecahan).toFixed(0));
          $('#idlembar').val(data.id_validasi);
        });
      }
    });
    return false;
  });

  //getupdate
  $('#btn_update').on('click', function () {

    var tgl = $('#dateposisi').val();
    var iddept = $('#department_id').val();

    var jumlah = $('#lembar').val();
    var idvalidasi = $('#idlembar').val();
    var pecahan = $('#pecahan').val()

    //var ttl = Number(jumlah) * Number(pecahan); 

    $.ajax({
      type: "POST",
      url: base_url + 'transaksi/updatedatauang',
      dataType: "JSON",
      data: { jumlah: jumlah, id: idvalidasi, iddept: iddept, pecahan: pecahan },
      success: function (data) {
        $('[name="lembar"]').val("");
        $('[name="idlembar"]').val("");
        $('[name="pecahan"]').val("");
        $('#editLembarModal').modal('hide');
        tampiluang(iddept, tgl);
        tampilrincian(iddept, tgl);
      }
    });

    return false;

  });


  $('#simpanposisi').on('click', function () {
    var iddept = $('#department_id').val();

    var cashonhand = $('#cashonhand').val();
    var kasbonsementara = document.getElementById('kasbonsementara').value;
    var outstandingkasbank = document.getElementById('outstandingkasbank').value;
    var outstandingHo = document.getElementById('outstandingreimburstho').value;
    var gtotal = document.getElementById('gtotal').value;
    var tglposisi = document.getElementById('dateposisi').value;
    var selisih = document.getElementById('selisih').value;
    var totalpettycash = document.getElementById('totalpettycash').value;

    var numberString = selisih;
    numberString = numberString
      .replace(/\./g, '')  // replace all separators
      .replace(/,/, '.');  // replace comma with dot 

    var parsed = parseFloat(numberString);

    if (parsed < 0) {

      alert('Data masih Selisih, Mohon Agar Di Cek Kembali!...');

    } else {

      $.ajax({
        type: "POST",
        url: base_url + 'transaksi/simpanposisi',
        //dataType : "JSON",
        data: {
          iddept: iddept,
          tglposisi: tglposisi,
          cashonhand: cashonhand,
          kbs: kasbonsementara,
          selisih: selisih,
          outstandingho: outstandingHo,
          gtotal: gtotal,
          totalpettycash: totalpettycash,
          outstandingkasbank: outstandingkasbank
        },
        success: function () {
          var button = document.getElementById("ctkposisi");
          //document.location.href = base_url + 'transaksi/kasharian';
          alert('Posisi Kas Sudah Tersimpan!....');
          button.disabled = false;
        }
      });
      return false;
    }
  });

  $('#department_id').on('change', function () {
    var button = document.getElementById("ctkposisi");
    button.disabled = true;
  });

  $('#ctkposisi').on('click', function () {

    var id = $('#department_id').val();

    $.ajax({
      type: "POST",
      url: base_url + 'report/cetakposisi',
      //dataType : "JSON",
      data: { id: id },
      success: function () {
        window.open(base_url + 'report/cetakposisi/' + id);
      }
    });
    return false;

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

});