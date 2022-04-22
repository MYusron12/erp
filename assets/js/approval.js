$(function () {

    $('#setujupr').on('click', function () {
        let id = document.getElementById('idpermintaan').value;
        let yakin = confirm('Apakah yakin Setuju ?...');
        if (yakin == true) {
            var setuju = false;
            if (!setuju) {
                setuju = true;
                $.ajax({
                    url: base_url + 'approval/getSetujuPr',
                    type: 'post',
                    data: { id: id },
                    success: function (data) {
                        document.location.href = base_url + 'approval/index';
                    }
                });
                setuju = false;
            }
        } else {
            return false;
        }
    });

    $('#tidakpr').on('click', function () {
        let id = document.getElementById('idpermintaan').value;
        let yakin = confirm('Apakah Yakin Tidak Setuju ?...');
        if (yakin == true) {
            var setuju = false;
            if (!setuju) {
                setuju = true;
                $.ajax({
                    url: base_url + 'approval/getTidakSetujuPr',
                    type: 'post',
                    data: { id: id },
                    success: function (data) {
                        document.location.href = base_url + 'approval/index';
                    }
                });
                setuju = false;
            }
        } else {
            return false;
        }
    });
    
      $('#setujuprjs').on('click', function () {
        let id = document.getElementById('idpermintaanjs').value;
        let yakin = confirm('Apakah yakin Setuju ?...');
        if (yakin == true) {
            var setuju = false;
            if (!setuju) {
                setuju = true;
                $.ajax({
                    url: base_url + 'approval/getSetujuPrjs',
                    type: 'post',
                    data: { id: id },
                    success: function (data) {
                        document.location.href = base_url + 'approval/listjs';
                    }
                });
                setuju = false;
            }
        } else {
            return false;
        }
    });

    $('#tidakprjs').on('click', function () {
        let id = document.getElementById('idpermintaanjs').value;
        let yakin = confirm('Apakah Yakin Tidak Setuju ?...');
        if (yakin == true) {
            var setuju = false;
            if (!setuju) {
                setuju = true;
                $.ajax({
                    url: base_url + 'approval/getTidakSetujuPrjs',
                    type: 'post',
                    data: { id: id },
                    success: function (data) {
                        document.location.href = base_url + 'approval/listjs';
                    }
                });
                setuju = false;
            }
        } else {
            return false;
        }
    });

});

