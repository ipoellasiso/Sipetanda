<script type="text/javascript">
    $(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      --------------------------------------------
      --------------------------------------------*/
    var table = $('.tabelbkuopd').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilbkuopd",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rek_sro', name: 'no_rek_sro'},
            {data: 'rek_sro', name: 'rek_sro'},
            {data: 'no_kas_bpkad', name: 'no_kas_bpkad'},
            {data: 'no_buku', name: 'no_buku'},
            {data: 'tgl_transaksi', name: 'tgl_transaksi'},
            {data: 'uraian', name: 'uraian'},
            {data: 'nama_opd', name: 'nama_opd'},
            {data: 'nama_bank', name: 'nama_bank'},
            {data: 'nilai_transaksi', name: 'nilai_transaksi'},
            {data: 'action2', name: 'action2'},
            {data: 'action3', name: 'action3'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createBku').click(function (){
        $('#saveBtn').val("create-bku");
        $('#id_transaksi').val('');
        $('#userForm').trigger("reset");
        $('#tambahbku').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // tambah data no kas bpkad
    $('body').on('click', '.tambahbkuopd', function()  {
        var iduser = $(this).data('id_transaksi');
        $.get("/bkuopd5/edit/"+iduser, function (data) {
            $('#saveBtn').val("tambah-bkuopd");
            $('#tambahkasbpkad').modal('show');
            $('#id_transaksi5').val(data.id_transaksi);
            $('#no_buku5').val(data.no_buku);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

    // simpan data no kas bpkad
    $('body').on('submit', '#userFormSimpan', function(e){
        e.preventDefault();

        var id_transaksi2 = $('#id_transaksis5').val(); // ambil dari input
        $('#saveBtn').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "/bkukasbpkad/update/" + id_transaksi2,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function(response) {
                $('#saveBtn').html('Terima');

                // kalau gagal (response.success = false)
                if (response.success === false) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: response.message
                    });
                    return;
                }

                // kalau sukses
                $('#userFormSimpan').trigger("reset");
                $('#tambahkasbpkad').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.message
                });

                table.draw();
            },

            // ⬇️ letakkan di sini — dalam satu level dengan "success:"
            error: function(xhr) {
                $('#saveBtn').html('Terima');
                let msg = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: msg
                });
            }
        });
    });

    // Batal data no kas bpkad
    $('body').on('click', '.batalbkuopd', function()  {
        var iduser = $(this).data('id_transaksi');
        $.get("/bkuopd5/edit/"+iduser, function (data) {
            $('#saveBtn').val("batal-bkuopd");
            $('#batalbkukasbpkad').modal('show');
            $('#id_transaksi6').val(data.id_transaksi);
            $('#no_buku6').val(data.no_buku);
            $('#no_kas_bpkad6').val(data.no_kas_bpkad);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

    // simpan data batal  no kas bpkad
    $('body').on('submit', '#userFormBatal', function(e){
        e.preventDefault();

        var id_transaksi2 = $(this).data("id_transaksi");
        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/bkukasbpkad/updatebatal/"+id_transaksi2,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormBatal').trigger("reset");
                $('#batalbkukasbpkad').modal('hide');
                $('#saveBtn').html('Terima');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil DiSimpan"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtn').html('Terima');
            }
        });
    });

    // ubah data no kas bpkad
    $('body').on('click', '.ubahbkuopd', function()  {
        var iduser = $(this).data('id_transaksi');
        $.get("/bkuopd5/ubah/"+iduser, function (data) {
            $('#saveBtn').val("ubah-bkuopd");
            $('#ubahkasbpkad').modal('show');
            $('#id_transaksi7').val(data.id_transaksi);
            $('#no_buku7').val(data.no_buku);
            $('#no_kas_bpkad7').val(data.no_kas_bpkad);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

    // simpan data ubah no kas bpkad
    $('body').on('submit', '#userFormUbah', function(e){
        e.preventDefault();

        var id_transaksi2 = $('#id_transaksis6').val(); // ambil dari input form
        $('#saveBtn').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "/bkukasbpkad/updateubah/" + id_transaksi2,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function(response) {
                $('#saveBtn').html('Terima');

                // Jika duplikat / gagal
                if (response.success === false) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: response.message
                    });
                    return;
                }

                // Jika berhasil
                $('#userFormUbah').trigger("reset");
                $('#ubahkasbpkad').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.message
                });

                table.draw();
            },

            error: function(xhr) {
                $('#saveBtn').html('Terima');
                let msg = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: msg
                });
            }
        });
    });

    // edit data
    $('body').on('click', '.editBkuopd', function(e)  {
        var id_transaksi1 = $(this).data('id_transaksi');
        $.get("/bkuopd/edit/"+id_transaksi1, function (data) {
            $('#saveBtn').val("edit-bku");
            $('#tambahbku').modal('show');
            $('#id_transaksi').val(data.id_transaksi);
            // $('#id_bankopd').html('<option value = "'+data.id_bank+'" selected >'+data.nama_bank+'</option>');
            $('#uraian').val(data.uraian);
            $('#tgl_transaksi').val(data.tgl_transaksi);
            $('#nilai_transaksi').val(data.nilai_transaksi);
        })
    });

    $('#createimportbkuopd').click(function (){
        $('#saveBtn').val("create-import");
        $('#id').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportbku').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // simpan data
    $('body').on('submit', '#userForm', function(e){
        e.preventDefault();

        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Menunggu Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/bkuopd/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahbku').modal('hide');
                    $('#saveBtn').html('Simpan');
                    $('#id_akun').val('').trigger('change');
                    $('#id_kelompok').val('').trigger('change');
                    $('#id_jenis').val('').trigger('change');
                    $('#id_objek').val('').trigger('change');
                    $('#id_rincianobjek').val('').trigger('change');
                    $('#id_subrincianobjek').val('').trigger('change');

                    Swal.fire({
                        icon: "success",
                        title: "success",
                        text: "Data Berhasil Disimpan"
                    })

                    table.draw();
                }
                else
                {
                    $('#userForm').trigger("reset");
                    $('#tambahbku').modal('hide');
                    $('#saveBtn').html('Simpan');
                    $('#id_akun').val('').trigger('change');
                    $('#id_kelompok').val('').trigger('change');
                    $('#id_jenis').val('').trigger('change');
                    $('#id_objek').val('').trigger('change');
                    $('#id_rincianobjek').val('').trigger('change');
                    $('#id_subrincianobjek').val('').trigger('change');

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Nomor Buku/Bukti Sudah Ada"
                    })

                    table.draw();
                }
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtn').html('Simpan');
            }
        });
    });

    // hapus data
    $('body').on('click', '.deleteBkuopd', function () {

        var id_transaksi = $(this).data("id_transaksi");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_transaksi,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/bkuopd/destroy/"+id_transaksi,
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data.success
                        })
                        table.draw();
                    },
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Data Gagal Dihapus"
                })
            }
        })
    });

    $(document).ready(function() {
        $('.amount').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), ' '));
        });
    });


    $('#id_rekeningopd').select2({
	    placeholder: "Pilih Rekening",
    	allowClear: true,
        dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bkuopd/rekening",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchRek: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
                cache: true
            }
    });

    $('#id_opdopd').select2({
	    placeholder: "Pilih Opd",
    	allowClear: true,
        dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bkuopd/opd",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchOpd: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
                cache: true
            }
    });

    $('#id_bankopd').select2({
	    placeholder: "Pilih Bank",
    	allowClear: true,
        dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bkuopd/bank",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params2) {
                return {
                    searchBank: params2.term2 // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
                cache: true
            }
    });


    $('#id_akun').select2({
        placeholder: "Pilih Akun1",
        dropdownParent: $('#tambahbku'),
        ajax: {
            url: "{{route('akun1.index')}}",
            processResults: function({data}){
                return {
                    results: $.map(data, function(item){
                        return {
                            id: item.id,
                            text:item.rek
                        }
                    })
                }
            }
        }
    });

    $('#id_akun').change(function(){
        let id = $('#id_akun').val();

        $('#id_kelompok').select2({
            placeholder: "Pilih Kelompok",
            dropdownParent: $('#tambahbku'),
            ajax: {
                url: "{{url('rekkelompok/bkuopd')}}/"+id,
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id_kel,
                                text:item.rek_kel
                            }
                        })
                    }
                }
            }
        });

    });

    $('#id_kelompok').change(function(){
        let id = $('#id_kelompok').val();

        $('#id_jenis').select2({
            placeholder: "Pilih Jenis",
            dropdownParent: $('#tambahbku'),
            ajax: {
                url: "{{url('rekjenis/bkuopd')}}/"+id,
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id_jen,
                                text:item.rek_jen
                            }
                        })
                    }
                }
            }
        });

    });

    $('#id_jenis').change(function(){
        let id = $('#id_jenis').val();

        $('#id_objek').select2({
            placeholder: "Pilih Objek",
            dropdownParent: $('#tambahbku'),
            ajax: {
                url: "{{url('rekobjek/bkuopd')}}/"+id,
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id_o,
                                text:item.rek_o
                            }
                        })
                    }
                }
            }
        });

    });

    $('#id_objek').change(function(){
        let id = $('#id_objek').val();

        $('#id_rincianobjek').select2({
            placeholder: "Pilih Rincian Objek",
            dropdownParent: $('#tambahbku'),
            ajax: {
                url: "{{url('rekrincianobjek/bkuopd')}}/"+id,
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id_ro,
                                text:item.rek_ro
                            }
                        })
                    }
                }
            }
        });

    });

    $('#id_rincianobjek').change(function(){
        let id = $('#id_rincianobjek').val();

        $('#id_subrincianobjek').select2({
            placeholder: "Pilih Sub Rincian Objek",
            dropdownParent: $('#tambahbku'),
            ajax: {
                url: "{{url('reksubrincianobjek/bkuopd')}}/"+id,
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id_sro,
                                text:item.rek_sro
                            }
                        })
                    }
                }
            }
        });

    });

});

function readURL(input, id) {
    id = id || '#modal-preview';
    if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#modal-preview').removeClass('hidden');
        $('#start').hide();
    }
}

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

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
}

</script>