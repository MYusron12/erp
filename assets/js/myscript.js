const base_url = "http://" + window.location.host + '/';
$(function () {
    // base_url
    // const pathArray = window.location.pathname.split( '/' );
    // const base_url = "http://" + window.location.host + '/' + pathArray[1] + '/';
    $('.selectpicker').selectpicker();

    $('.tambahData').on('click', function () {
        $('#newCrudaModaLabel').html('Add New');
        $('.modal-footer button[type=submit]').html('Add');
        $('#accountno').val('');
        $('#name').val('');
        $('#id').val('');




    });

    $('.tampilModalUbah').on('click', function () {
        $('#newCrudaModaLabel').html('Edit');
        $('.modal-footer button[type=submit]').html('Edit Crud A');
        $('.modal-body form').attr('action', base_url + 'master/getchangingcruda');

        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'master/getchangedcruda',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#accountno').val(data.account);
                $('#name').val(data.nama);
                $('#id').val(data.id_coa_ec);

            }

        });


    });




    $('.tambahData1').on('click', function () {
        $('#newCrudbModaLabel').html('Add New');
        $('.modal-footer button[type=submit]').html('Add');
        $('#accountno').val('');
        $('#name').val('');
        $('#id').val('');

    });

    $('.tampilModalUbah1').on('click', function () {
        $('#newCrudbModaLabel').html('Edit Crud B');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'master/getchangingcrudb');

        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'master/getchangedcrudb',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#accountno').val(data.account);
                $('#name').val(data.nama);
                $('#id').val(data.id_coa_na);

            }

        });




    });


    $('.tambahData2').on('click', function () {
        $('#newCrudcModaLabel').html('Add New');
        $('.modal-footer button[type=submit]').html('Add');
        $('#accountno').val('');
        $('#name').val('');
        $('#id').val('');




    });



    $('.tampilModalUbah2').on('click', function () {
        $('#newCrudcModaLabel').html('Edit Crud B');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'master/getchangingcrudc');

        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'master/getchangedcrudc',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#accountno').val(data.account);
                $('#name').val(data.nama);
                $('#id').val(data.id_coa_tb);

            }

        });




    });


    $('.tambahDataLokasi').on('click', function () {
        $('#newLokasiModaLabel').html('Add Lokasi');
        $('.modal-footer button[type=submit]').html('Add');
        $('#accountno').val('');
        $('#name').val('');
        $('#credit').val('');
        $('#realization').val('');
        $('#balance').val('');
        $('#id').val('');

    });



    $('.tampilModalUbahLokasi').on('click', function () {
        $('#newLokasiModaLabel').html('Edit Lokasi');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'master/getchanginglokasi');

        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'master/getchangedlokasi',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#accountno').val(data.kode_loc);
                $('#name').val(data.nama);
                $('#credit').val(formatMoney(data.pinjem));
                $('#realization').val(formatMoney(data.realisasi));
                $('#balance').val(formatMoney(data.saldo));
                $('#id').val(data.id_departement);

            }

        });

    });


    $('.tambahDataDept').on('click', function () {
        $('#newDeptModalLabel').html('Tambah Department');
        $('.modal-footer button[type=submit]').html('Add');
        $('#kodebagian').val('');
        $('#namabagian').val('');
        $('#kepalabagian').val('');
        $('#idbagian').val('');

    });





    $('.tampilModalDepartmentUbah').on('click', function () {
        $('#newDeptModalLabel').html('Ubah Department');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('.modal-body form').attr('action', base_url + 'master/ubahdepartment');

        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'master/getubahdepartment',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#kodebagian').val(data.kode_bagian);
                $('#namabagian').val(data.nama_bagian);
                $('#kepalabagian').val(data.kepala_bagian);
                $('#idbagian').val(data.idbagian);
            }

        });

    });







    $('.tampilModalUbahRealization').on('click', function () {

        $('#newRealizationModalLabel').html('Realisasi');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('.modal-body form').attr('action', base_url + 'transaksi/realization');

        const id = $(this).data('id');


        $.ajax({
            url: base_url + 'transaksi/getchangedRealization',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#credittotal').val(formatMoney(data.jumlah));
                $('#idtransaksidept').val(data.id_transaksi_dept);
                $('#lokasi').val(data.id_dept);

            }

        });

    });


    $('.tambahDataMoney').on('click', function () {
        $('#newMoneyModalLabel').html('Tambah Pecahan');
        $('.modal-footer button[type=submit]').html('Add');
        $('#pieces').val('');
        $('#bills').val('');
        $('#idvalidasi').val('');
        $('#iddept').val('');

    });



    $('.tampilModalUbahMoney').on('click', function () {

        $('#newMoneyModalLabel').html('Edit Pecahan');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('.modal-body form').attr('action', base_url + 'master/getchangingmoney');

        const id = $(this).data('id');


        $.ajax({
            url: base_url + 'master/getchangedmoney',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                var a = parseFloat(data.jumlah);
                $('#pieces').val(a.toFixed(0));
                $('#bills').val(formatMoney(data.pecahan));
                $('#idvalidasi').val(data.id_validasi);

            }



        });

    });


    $('.deleteMoney').on('click', function () {


        var jawab = confirm("Are you Sure ?...");

        if (jawab === true) {


            var hapus = false;

            if (!hapus) {
                hapus = true;

                const idvalidasi = $(this).data('idvalidasi');
                const iddept = $(this).data('iddept');

                $.ajax({
                    url: base_url + 'master/deletemoneybills',
                    type: 'post',
                    data: {

                        idvalidasi: idvalidasi,
                        iddept: iddept
                    },

                    success: function () {

                        document.location.href = base_url + 'master/moneydetails/' + iddept;

                    }

                });

                hapus = false;
            }

        } else {

            return false;

        }


    });



    $('.tambahDataSuplier').on('click', function () {
        $('#newSuplierModaLabel').html('Tambah Suplier');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#suplier').val('');
        $('#bank').val('');
        $('#account').val('');
        $('#city').val('');
        $('#branch').val('');
        $('#idsuplier').val('');
    });

    $('.tampilModalSuplierUbah').on('click', function () {
        $('#newSuplierModaLabel').html('Edit');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'master/getchangingsuplier');

        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'master/getchangedsuplier',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                var approve = data.approve;
                if (approve == 1) {
                    $('#is_approved').prop('checked', true);
                } else {
                    $('#is_approved').prop('checked', false);
                }
                $('#suplier').val(data.suplier);
                $('#bank').val(data.bank);
                $('#account').val(data.rekening);
                $('#city').val(data.kota);
                $('#branch').val(data.cabang);
                $('#idsuplier').val(data.id_suplier);
            }
        });
    });

    $('.tambahDatatipeMobil').on('click', function () {
        $('#tambahTipeMobilModaLabel').html('Tambah Tipe Mobil');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#tipemobil').val('');
        $('#idtipemobil').val('');

    });

    $('.tampilUbahTipeMobil').on('click', function () {
        $('#tambahTipeMobilModaLabel').html('Edit Tipe Mobil');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'ekspedisi/ubahtipemobil');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'ekspedisi/getubahtipemobilbyId',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#tipemobil').val(data.tipemobil);
                $('#idtipemobil').val(data.idtipemobil);
            }

        });

    });

    $('.tambahDatajenisMobil').on('click', function () {
        $('#tambahJenisMobilModaLabel').html('Tambah Tipe Mobil');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#jenismobil').val('');
        $('#idjenismobil').val('');

    });

    $('.tampilUbahJenisMobil').on('click', function () {
        $('#tambahJenisMobilModaLabel').html('Edit Jenis Mobil');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'ekspedisi/ubahjenismobil');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'ekspedisi/getubahjenismobilbyId',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#jenismobil').val(data.jenismobil);
                $('#idjenismobil').val(data.idjenismobil);
            }

        });
    });

    $('.tambahDataMobil').on('click', function () {
        $('#tambahMobilModaLabel').html('Tambah Mobil');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#merekmobil').val('');
        $('#tipemobil').val('').selectpicker('refresh');
        $('#jenismobil').val('').selectpicker('refresh');
        $('#tglpembelian').val('');
        $('#tglpenggunaan').val('');
        $('#idmobil').val('');
    });

    $('.tampilUbahMobil').on('click', function () {
        $('#tambahMobilModaLabel').html('Edit Mobil');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'ekspedisi/ubahmobil');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'ekspedisi/getubahmobilbyId',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                var tglbeli = new Date(data.tglbeli);
                var dd = tglbeli.getDate();
                var mm = tglbeli.getMonth() + 1;
                var yyyy = tglbeli.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                tglbeli = dd + '-' + mm + '-' + yyyy;

                var tglpakai = new Date(data.tglpakai);
                var dd = tglpakai.getDate();
                var mm = tglpakai.getMonth() + 1;
                var yyyy = tglpakai.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                tglpakai = dd + '-' + mm + '-' + yyyy;

                $('#merekmobil').val(data.merek);
                $('#tipemobil').val(data.idtype).selectpicker('refresh');
                $('#jenismobil').val(data.idjenis).selectpicker('refresh');
                $('#tglpembelian').val(tglbeli);
                $('#tglpenggunaan').val(tglpakai);
                $('#idmobil').val(data.idmobil);
            }
        });
    });

    

     $('.tambahDataTruck').on('click', function () {
        $('#newTruckModaLabel').html('Tambah Truck');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#nourut').val('');
        $('#nopolisi').val('');
        $('#mobil').val('').selectpicker('refresh');
        $('#bbmperliter').val('');
        $('#bbmakumulasi').val('');
        $('#toleran').val('');
        $('#km_service').val('');
        $('#tgl_stnk').val('');
        $('#tgl_bpkb').val('');
        $('#tgl_kir').val('');
        $('#tgl_sipa_bek').val('');
        $('#tgl_sipa_bog').val('');
        $('#tgl_ibm_bek').val('');
        $('#tgl_ibm_cil').val('');
        $('#tgl_izin_lintas').val('');
        $('#driver').val('').selectpicker('refresh');
        $('#helper').val('').selectpicker('refresh');
    });

    $('.ubahTampilTruck').on('click', function () {
        $('#newTruckModaLabel').html('Edit Truck');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', base_url + 'ekspedisi/ubahtruck');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'ekspedisi/getubahtruckById',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#nourut').val(data.no_urut);
                $('#nopolisi').val(data.no_polisi);
                $('#mobil').val(data.idmobil).selectpicker('refresh');
                $('#bbmperliter').val(data.bbm_perliter);
                $('#bbmakumulasi').val(data.bbm_akumulasi);
                $('#toleran').val(data.toleran);
                $('#km_service').val(data.km_service);
                $('#tgl_stnk').val(data.tgl_stnk);
                $('#tgl_bpkb').val(data.tgl_bpkb);
                $('#tgl_kir').val(data.tgl_kir);
                $('#tgl_sipa_bek').val(data.sipa_bekasi);
                $('#tgl_sipa_bog').val(data.sipa_bogor);
                $('#tgl_ibm_bek').val(data.ibm_bekasi);
                $('#tgl_ibm_cil').val(data.ibm_cilegon);
                $('#tgl_izin_lintas').val(data.izin_lintas);
                $('#driver').val(data.driver_id).selectpicker('refresh');
                $('#helper').val(data.helper_id).selectpicker('refresh');
                $('#idtruck').val(data.id_truck);
            }
        });
    });





    // $('.prosesRealisasi').on('click', function() {

    //    const id = $(this).data('id');

    //     $.ajax({
    //        url: base_url + 'transaksi/getTampildataKantorPusat',
    //        data:{id : id},
    //        method: 'POST',
    //        dataType: 'json',
    //        success: function(data) {

    //         //merubah nilai format tanggal
    //         var today = new Date(data.tanggal);
    //         var dd = today.getDate();
    //         var mm = today.getMonth()+1; 
    //         var yyyy = today.getFullYear();
    //         if(dd<10) {dd='0'+dd;} 
    //         if(mm<10){mm='0'+mm;} 

    //         today = dd+'-'+mm+'-'+yyyy;


    //         $('#nobskp').val(data.nobs);
    //         $('#nokasbankkp').val(data.nokasbank);
    //         $('#tglkp').val(today);
    //         $('#idbskantorpusat').val(data.idbskantorpusat);
    //         $('#jumlahrealisasi').val(formatMoney(data.jumlah));



    //        }

    //      });




    // });


    //  $('.ubahLembar').on('click', function() {

    //    var id = $(this).data('id');
    //    var jml = $(this).data('jml');
    //    var n = Number(jml).toFixed(0);
    //    console.log(n);

    //     $('#idlembar').val(id);
    //     $('#lembar').val(n);

    // });



    $('.viewIkhtisar').on('click', function () {

        var id = $(this).data('id');
        $('.selectpicker').selectpicker();

        $.ajax({
            url: base_url + 'transaksi/getValueIkhtisarId',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                //merubah nilai format tanggal
                var tglikhtisar = new Date(data.tgl_ikhtisar);
                var dd = tglikhtisar.getDate();
                var mm = tglikhtisar.getMonth() + 1;
                var yyyy = tglikhtisar.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }

                tglikhtisar = dd + '-' + mm + '-' + yyyy;

                //merubah nilai format tanggal
                var tglproses = new Date(data.tgl_proses_ho);
                var dd = tglproses.getDate();
                var mm = tglproses.getMonth() + 1;
                var yyyy = tglproses.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }

                tglproses = dd + '-' + mm + '-' + yyyy;

                var lok = 904;

                $('#noikhtisarview').val(data.no_ikhtisar);
                $('#tglikhtisarview').val(tglikhtisar);
                $('#tglprosesview').val(tglproses);
                $('#lokasi1').val(data.id_lokasi).selectpicker('refresh');

            }


        });

        getTampilIkhtisar(id);

    });

    function getTampilIkhtisar(id) {

        $.ajax({
            url: base_url + 'transaksi/getTampilIkhtisarId',
            type: 'post',
            data: {id: id},
            async: true,
            dataType: 'json',
            success: function (data) {
                //console.log(data);

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td><input type="checkbox" checked disabled>' + data[i].cashbankno + '</td>' +
                            '<td>' + data[i].tgl_pengajuan + '</td>' +
                            '<td>' + data[i].pemohon + '</td>' +
                            '<td>' + (formatMoney(data[i].total)) + '</td>' +
                            '</tr>';
                }
                $('#show_ikhtisar').html(html);

            }

        });

        return false;

    }


    $('.ikhtisar-check-input').on('click', function () {
        var id = $(this).data('id');
        var noikhtisar = $(this).data('ikhtisar');

        var jawab = confirm("Anda yakin Batal ?...");

        if (jawab === true) {

            var hapus = false;

            if (!hapus) {
                hapus = true;

                $.ajax({
                    url: base_url + 'transaksi/getbatalikhtisar',
                    type: 'post',
                    data: {id: id, noikhtisar: noikhtisar},
                    success: function (data) {
                        document.location.href = base_url + 'transaksi/ikhtisar';
                    }
                });
                hapus = false;
            }
        } else {

            return false;

        }

    });



    $('.kasrupiah-check-input').on('click', function () {

        var id = $(this).data('id');
        var nokasbank = $(this).data('nokasbank');
        var total = $(this).data('total');

        var jawab = confirm("Anda yakin Batal ?...");

        if (jawab === true) {

            var hapus = false;

            if (!hapus) {
                hapus = true;

                $.ajax({
                    url: base_url + 'transaksi/getbatalkasbank',
                    type: 'post',
                    data: {id: id, nokasbank: nokasbank, total: total},
                    success: function (data) {
                        document.location.href = base_url + 'transaksi/kasrupiah';

                    }

                });

                hapus = false;

            }

        } else {

            return false;

        }

    });


    $('.kasrupiahkas-check-input').on('click', function () {
        var id = $(this).data('id');
        var nokasbank = $(this).data('nokasbank');
        var total = $(this).data('total');

        var jawab = confirm("Anda yakin Batal ?...");

        if (jawab === true) {
            var hapus = false;
            if (!hapus) {
                hapus = true;

                $.ajax({
                    url: base_url + 'transaksi/getbatalkasbankkas',
                    type: 'post',
                    data: {id: id, nokasbank: nokasbank, total: total},
                    success: function (data) {
                        document.location.href = base_url + 'transaksi/kasrupiah';

                    }

                });
                hapus = false;
            }
        } else {
            return false;
        }
    });

    $('.kasrupiahbank-check-input').on('click', function () {

        var id = $(this).data('id');
        var nokasbank = $(this).data('nokasbank');
        var total = $(this).data('total');

        var jawab = confirm("Anda yakin Batal ?...");

        if (jawab === true) {


            var hapus = false;

            if (!hapus) {
                hapus = true;

                $.ajax({
                    url: base_url + 'transaksi/getbatalkasbankbank',
                    type: 'post',
                    data: {id: id, nokasbank: nokasbank, total: total},
                    success: function (data) {
                        document.location.href = base_url + 'transaksi/kasrupiah';


                    }

                });

                hapus = false;

            }

        } else {

            return false;

        }

    });




    $('.editbspusat').on('click', function () {
        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'transaksi/getbspusatid',
            data: {id: id},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                //merubah nilai format tanggal
                var tanggal = new Date(data.tanggal);
                var dd = tanggal.getDate();
                var mm = tanggal.getMonth() + 1;
                var yyyy = tanggal.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }

                tanggal = dd + '-' + mm + '-' + yyyy;

                var tglrealisasi = new Date(data.tglperkiraanrealisasi);
                var dd = tglrealisasi.getDate();
                var mm = tglrealisasi.getMonth() + 1;
                var yyyy = tglrealisasi.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                tglrealisasi = dd + '-' + mm + '-' + yyyy;

                $('#nobsedit').val(data.nobs);
                $('#nokasbankedit').val(data.nokasbank);
                $('#tgledit').val(tanggal);
                $('#pemohonedit').val(data.pemohon);
                $('#jumlahedit').val(formatMoney(data.jumlah));
                $('#keperluanedit').val(data.keperluan);
                $('#bagianedit').val(data.idbagian).selectpicker('refresh');
                $('#kodelokasiedit').val(data.id_department).selectpicker('refresh');
                $('#kodeecedit').val(data.ec).selectpicker('refresh');
                $('#kodenaedit').val(data.na).selectpicker('refresh');
                $('#kodebisnisedit').val(data.idbisnis).selectpicker('refresh');
                $('#tglrealisasiedit').val(tglrealisasi);
                $('#catatanedit').val(data.catatan);
                $('#idbspusatedit').val(data.idbskantorpusat);
            }

        });

    });


    $('.bskantorpusat-check-input').on('click', function () {

        var id = $(this).data('id');
        var nobs = $(this).data('nobspusat');

        var jawab = confirm("Anda yakin Batal ?...");

        if (jawab === true) {

            var hapus = false;

            if (!hapus) {
                hapus = true;

                $.ajax({
                    url: base_url + 'transaksi/getbatalbssementara',
                    type: 'post',
                    data: {id: id, nobs: nobs},
                    success: function (data) {
                        document.location.href = base_url + 'transaksi/index';

                    }

                });

                hapus = false;

            }

        } else {

            return false;

        }

    });



    $('.bssementara-check-input').on('click', function () {
        const id = $(this).data('id');
        const nobs = $(this).data('nobs');

        var jawab = confirm("Anda Yakin Batal" + ' ' + nobs + ' ?....');

        if (jawab === true) {
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.ajax({
                    url: base_url + 'transaksi/getbatalbssementara',
                    type: 'post',
                    data: {id: id, nobs: nobs},
                    success: function (data) {
                        document.location.href = base_url + 'transaksi/kaskecil';
                    }
                });
                hapus = false;
            }
        } else {
            return false;
        }
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
    }
    ;

    function formatMoney3(amount, decimalCount = 3, decimal = ",", thousands = ".") {
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
    }
    ;

    $('#kendaraan').on('change', function () {
        const id = document.getElementById('kendaraan').value;
        $.ajax({
            url: base_url + 'ekspedisi/datakendaraanById',
            type: 'post',
            data: 'id=' + id,
            dataType: 'json',
            success: function (data) {
                $('#driver1').val(data.driver1);
                $('#driver2').val(data.driver2);
                $('#iddriver1').val(data.iddriver1);
                $('#iddriver2').val(data.iddriver2);
            }
        });
    });

    $('.tambahDataBbm').on('click', function () {
        $('#newBbmModalLabel').html('Tambah BBM');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#tanggalbbm').val('');
        $('#kmawal').val('');
        $('#kmakhir').val('');
        $('#jarak').val('');
        $('#kendaraan').val('').selectpicker('refresh');
        $('#iddriver1').val('');
        $('#iddriver2').val('');
        $('#driver1').val('');
        $('#driver2').val('');
        $('#jmlliter').val(formatMoney3(''));
        $('#hargabbm').val('');
        $('#totalbbm').val('');
        $('#idtransaksibbm').val();

    });

    $('.ubahTampilBbm').on('click', function () {
        $('#newBbmModalLabel').html('Edit BBM');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('.modal-body form').attr('action', base_url + 'ekspedisi/ubahBBM');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'ekspedisi/getdataUbahBbmbyId',
            type: 'post',
            data: 'id=' + id,
            dataType: 'json',
            success: function (data) {
                console.log(data)
                var tglbbm = new Date(data.tanggal);
                var dd = tglbbm.getDate();
                var mm = tglbbm.getMonth() + 1;
                var yyyy = tglbbm.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                tglbbm = dd + '-' + mm + '-' + yyyy;
                $('#tanggalbbm').val(tglbbm);
                $('#kmawal').val(data.km_awal);
                $('#kmakhir').val(data.km_akhir);
                $('#jarak').val(data.jarak);
                $('#kendaraan').val(data.id_kendaraan).selectpicker('refresh');
                $('#iddriver1').val(data.id_driver);
                $('#iddriver2').val(data.id_helper);
                $('#driver1').val(data.driver1);
                $('#driver2').val(data.driver2);
                $('#jmlliter').val(formatMoney3(data.jml_liter));
                $('#hargabbm').val(formatMoney(data.bbmharga));
                $('#totalbbm').val(formatMoney(data.ttlbbm));
                $('#idtransaksibbm').val(data.id_transaksi_bbm);
            }
        });
    });

    $('#tambahDataSatuan').on('click', function () {
        $('#newSatuanModalLabel').html('Tambah Satuan');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#idsatuan').val('');
        $('#satuan').val('');
    });

    $('.ubahSatuan').on('click', function () {
        $('#newSatuanModalLabel').html('Edit Satuan');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('.modal-body form').attr('action', base_url + 'purchasing/ubahSatuan');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'purchasing/getdataUbahSatuanId',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                $('#satuan').val(data.nama_satuan);
                $('#keterangan').val(data.keterangan);
                $('#idsatuan').val(data.id_satuan);
            }
        });
    });

    $('.tambahDataKategori').on('click', function () {
        $('#newKategoriModalLabel').html('Tambah Kategori');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#kategori').val('');
        $('#idkategori').val('');
    });

    $('.ubahKategori').on('click', function () {
        $('#newKategoriModalLabel').html('Edit Kategori');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('.modal-body form').attr('action', base_url + 'purchasing/ubahKategori');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'purchasing/getdataUbahKategoriById',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                $('#kategori').val(data.nama_categori);
                $('#idkategori').val(data.id_categori);
            }

        });

    });

    $('.tambahDataBarang').on('click', function () {
        $('#newBarangModalLabel').html('Tambah Barang');
        $('.modal-footer button[type=submit]').html('Simpan');
    });

    $('.ubahBarang').on('click', function () {
        $('#newBarangModalLabel').html('Edit Barang');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('.modal-body form').attr('action', base_url + 'purchasing/ubahBarang');
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'purchasing/getdataUbahBarangById',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#kodebarang').val(data.kode_barang);
                $('#namabarang').val(data.nama_barang);
                $('#satuan').val(data.id_satuan);
                $('#kategori').val(data.id_categori);
                $('#idbarang').val(data.id_barang);
            }
        });
    });

});



