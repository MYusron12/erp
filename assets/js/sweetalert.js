const flashData = $(".flash-data").data("flashdata");

if (flashData) {
  Swal({
    title: "Data",
    text: "Berhasil " + flashData,
    type: "success",
  });
}

// tombol hapus
$(".tombol-hapus").on("click", function (e) {
  e.preventDefault();
  // console.log("ok");
  const href = $(this).attr("href");
  Swal({
    title: "Apakah yakin",
    text: "Data akan dihapus",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus data!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

const flashDataDetail = $(".flash-data-detail").data("flashdata");
// const base_url = "http://" + window.location.host + '/';
// const url = base_url + 'purchasing/simpanJasaAll';
// console.log("url");
if (flashDataDetail) {
  // Swal({
  //   title: "Data",
  //   text: "Telah Berhasil " + flashDataDetail,
  //   type: "success",
  // });
  // console.log(url);

  Swal.fire({
      title: 'Data Berhasil Disimpan',
      icon: 'info',
      showCloseButton: true,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText:'<i class="fa fa-thumbs-up"></i>',
      confirmButtonAriaLabel: 'Thumbs up, great!',
      html:
        'Silahkan melanjutkan'
      // cancelButtonAriaLabel: 'Thumbs down'
    })
}
