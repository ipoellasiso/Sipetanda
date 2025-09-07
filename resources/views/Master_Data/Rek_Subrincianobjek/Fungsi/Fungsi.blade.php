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
    var table = $('.tabelreksubrincianobjek').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilreksubrincianobjek",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'rek', name: 'rek'},
            {data: 'rek_kel', name: 'rek_kel'},
            {data: 'rek_jen', name: 'rek_jen'},
            {data: 'rek_o', name: 'rek_o'},
            {data: 'rek_ro', name: 'rek_ro'},
            {data: 'no_rek_sro', name: 'no_rek_sro'},
            {data: 'rek_sro', name: 'rek_sro'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
     $('#createReksubrincianobjek').click(function (){
         $('#saveBtn').val("create-reksubrincianobjek");
         $('#id6').val('');
         $('#userForm').trigger("reset");
         $('#tambahreksubrincianobjek').modal('show');
         $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editReksubrincianobjek', function(e)  {
        var id_sro = $(this).data('id_sro');
        $.get("/reksubrincianobjek/edit/"+id_sro, function (data) {
            $('#saveBtn').val("edit-reksubrincianobjek");
            $('#tambahreksubrincianobjek').modal('show');
        
            $('#id6').val(data.id_sro);
            $('#id_akun').html('<option value = "'+data.id+'" selected >'+data.rek+'</option>');
            $('#id_kelompok').html('<option value = "'+data.id_kel+'" selected >'+data.rek_kel+'</option>');
            $('#id_jenis').html('<option value = "'+data.id_jen+'" selected >'+data.rek_jen+'</option>');
            $('#id_objek').html('<option value = "'+data.id_o+'" selected >'+data.rek_o+'</option>');
            $('#id_rincianobjek').html('<option value = "'+data.id_ro+'" selected >'+data.rek_ro+'</option>');
            $('#no_rek_sro').val(data.no_rek_sro);
            $('#rek_sro').val(data.rek_sro);
        })
    });

    // Import data
    $('#createimportreksubrincianobjek').click(function (){
        $('#saveBtn').val("create-import");
        $('#id6').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportreksubrincianobjek').modal('show');
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
            url: "/reksubrincianobjek/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahreksubrincianobjek').modal('hide');
                    $('#saveBtn').html('Simpan');

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
                    $('#tambahreksubrincianobjek').modal('hide');
                    $('#saveBtn').html('Simpan');

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Nomor Rekening Sudah Ada"
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
    $('body').on('click', '.deleteReksubrincianobjek', function () {

        var id_sro = $(this).data("id_sro");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_sro,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/reksubrincianobjek/destroy/"+id_sro,
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

    $('#id_akun').select2({
        placeholder: "Pilih Akun",
        dropdownParent: $('#tambahreksubrincianobjek'),
        ajax: {
            url: "{{route('akun.index')}}",
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
            dropdownParent: $('#tambahreksubrincianobjek'),
            ajax: {
                url: "{{url('rekkelompok/subrincianobjek')}}/"+id,
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
            dropdownParent: $('#tambahreksubrincianobjek'),
            ajax: {
                url: "{{url('rekjenis/subrincianobjek')}}/"+id,
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
            dropdownParent: $('#tambahreksubrincianobjek'),
            ajax: {
                url: "{{url('rekobjek/subrincianobjek')}}/"+id,
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
            dropdownParent: $('#tambahreksubrincianobjek'),
            ajax: {
                url: "{{url('rekrincianobjek/subrincianobjek')}}/"+id,
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

});

</script>