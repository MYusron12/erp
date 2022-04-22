$(document).ready(function () {

  // const pathArray = window.location.pathname.split('/');
  // const base_url = "http://" + window.location.host + '/';

  get_data_editkk();

  function get_data_editkk() {

    var id = $('#id_transaksi').val();

    //AJAX REQUEST TO GET SELECTED BS 
    $.ajax({
      url: base_url + 'transaksi/get_data_bs',
      method: "POST",
      data: { id: id },
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        // var item=data;
        // var val1=item.replace("[","");
        // var val2=val1.replace("]","");
        // var values=val2;
        // console.log(values);
        $.each(data.split(","), function (i, e) {
          $("#nomorbs option[value='" + e + "']").prop("selected", true).trigger('change');
          $("#nomorbs").selectpicker('refresh');
        });

      }

    });

  }

  function get_data_editkas() {

    //AJAX REQUEST TO GET SELECTED BS kantor pusat
    $.ajax({
      url: base_url + 'transaksi/get_data_bs',
      method: "POST",
      data: { id: id },
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        // var item=data;
        // var val1=item.replace("[","");
        // var val2=val1.replace("]","");
        // var values=val2;
        // console.log(values);
        $.each(data.split(","), function (i, e) {
          $("#nomorbs option[value='" + e + "']").prop("selected", true).trigger('change');
          $("#nomorbs").selectpicker('refresh');
        });
      }

    });

  }


});