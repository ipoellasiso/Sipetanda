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
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilanggaranopd",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rek_sro', name: 'no_rek_sro'},
            {data: 'rek_sro', name: 'rek_sro'},
            {data: 'uraian', name: 'uraian'},
            {data: 'nama_opd', name: 'nama_opd'},
            {data: 'nilai_anggaranopd', name: 'nilai_anggaranopd'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createAnggaranopd').click(function (){
        $('#saveBtn').val("create-Anggaran");
        $('#id_anggaranopd').val('');
        $('#userForm1').trigger("reset");
        $('#tambahanggaranopd').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // $('#createimport').click(function (){
    //     $('#saveBtn').val("create-import");
    //     $('#id_rekening').val('');
    //     $('#userForm1').trigger("reset");
    //     $('#tambahimport').modal('show');
    //     $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    // });

    // edit data
    $('body').on('click', '.editAnggaran', function()  {
        var idanggaran1 = $(this).data('id_anggaranopd');
        $.get("/anggaranopd/edit/"+idanggaran1, function (data) {
            $('#saveBtn').val("edit-anggaran");
            $('#tambahanggaranopd').modal('show');
            $('#id_anggaranopd1').val(data.id_anggaranopd);

            $('#id_akun').html('<option value = "'+data.id+'" selected >'+data.rek+'</option>');
            $('#id_kelompok').html('<option value = "'+data.id_kel+'" selected >'+data.rek_kel+'</option>');
            $('#id_jenis').html('<option value = "'+data.id_jen+'" selected >'+data.rek_jen+'</option>');
            $('#id_objek').html('<option value = "'+data.id_o+'" selected >'+data.rek_o+'</option>');
            $('#id_rincianobjek').html('<option value = "'+data.id_ro+'" selected >'+data.rek_ro+'</option>');
            $('#id_subrincianobjek').html('<option value = "'+data.id_sro+'" selected >'+data.rek_sro+'</option>');

            $('#uraian').val(data.uraian);
            $('#nilai_anggaranopd').val(data.nilai_anggaranopd);
        })
    });

    // simpan data
    $('body').on('submit', '#userForm1', function(e){
        e.preventDefault();

        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Tunggu Ya ..');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/anggaranopd/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm1').trigger("reset");
                    $('#tambahanggaranopd').modal('hide');
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
                    $('#userForm1').trigger("reset");
                    $('#tambahanggaranopd').modal('hide');
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
                        text: "Rekening Sudah Ada"
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
    $('body').on('click', '.deleteAnggaran', function () {

        var id_anggaranopd = $(this).data("id_anggaranopd");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_anggaranopd,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/anggaranopd/destroy/"+id_anggaranopd,
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
        $('.amount1').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), ' '));
        });
    });

    $('#id_akun').select2({
        placeholder: "Pilih Akun1",
        dropdownParent: $('#tambahanggaranopd'),
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
            dropdownParent: $('#tambahanggaranopd'),
            ajax: {
                url: "{{url('rekkelompok/anggaranopd')}}/"+id,
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
        $('#id_jenis').val('').trigger('change');

        $('#id_jenis').select2({
            placeholder: "Pilih Jenis",
            dropdownParent: $('#tambahanggaranopd'),
            ajax: {
                url: "{{url('rekjenis/anggaranopd')}}/"+id,
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
        $('#id_objek').val('').trigger('change');

        $('#id_objek').select2({
            placeholder: "Pilih Objek",
            dropdownParent: $('#tambahanggaranopd'),
            ajax: {
                url: "{{url('rekobjek/anggaranopd')}}/"+id,
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
        $('#id_rincianobjek').val('').trigger('change');

        $('#id_rincianobjek').select2({
            placeholder: "Pilih Rincian Objek",
            dropdownParent: $('#tambahanggaranopd'),
            ajax: {
                url: "{{url('rekrincianobjek/anggaranopd')}}/"+id,
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
        $('#id_subrincianobjek').val('').trigger('change');

        $('#id_subrincianobjek').select2({
            placeholder: "Pilih Sub Rincian Objek",
            dropdownParent: $('#tambahanggaranopd'),
            ajax: {
                url: "{{url('reksubrincianobjek/anggaranopd')}}/"+id,
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