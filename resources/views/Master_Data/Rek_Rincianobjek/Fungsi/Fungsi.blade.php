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
    var table = $('.tabelrekrincianobjek').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekrincianobjek",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'rek', name: 'rek'},
            {data: 'rek_kel', name: 'rek_kel'},
            {data: 'rek_jen', name: 'rek_jen'},
            {data: 'rek_o', name: 'rek_o'},
            {data: 'no_rek_ro', name: 'no_rek_ro'},
            {data: 'rek_ro', name: 'rek_ro'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
     $('#createRekrincianobjek').click(function (){
         $('#saveBtn').val("create-rekrincianobjek");
         $('#id6').val('');
         $('#userForm').trigger("reset");
         $('#tambahrekrincianobjek').modal('show');
         $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editRekrincianobjek', function(e)  {
        var id_ro = $(this).data('id_ro');
        $.get("/rekrincianobjek/edit/"+id_ro, function (data) {
            $('#saveBtn').val("edit-rekrincianobjek");
            $('#tambahrekrincianobjek').modal('show');
        
            $('#id6').val(data.id_ro);
            $('#id_akun').html('<option value = "'+data.id+'" selected >'+data.rek+'</option>');
            $('#id_kelompok').html('<option value = "'+data.id_kel+'" selected >'+data.rek_kel+'</option>');
            $('#id_jenis').html('<option value = "'+data.id_jen+'" selected >'+data.rek_jen+'</option>');
            $('#id_objek').html('<option value = "'+data.id_o+'" selected >'+data.rek_o+'</option>');
            $('#no_rek_ro').val(data.no_rek_ro);
            $('#rek_ro').val(data.rek_ro);
        })
    });

    // Import data
    $('#createimportrekrincianobjek').click(function (){
        $('#saveBtn').val("create-import");
        $('#id6').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportrekrincianobjek').modal('show');
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
            url: "/rekrincianobjek/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahrekrincianobjek').modal('hide');
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
                    $('#tambahrekrincianobjek').modal('hide');
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
    $('body').on('click', '.deleteRekrincianobjek', function () {

        var id_ro = $(this).data("id_ro");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_ro,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/rekrincianobjek/destroy/"+id_ro,
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
        dropdownParent: $('#tambahrekrincianobjek'),
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
            dropdownParent: $('#tambahrekrincianobjek'),
            ajax: {
                url: "{{url('rekkelompok/rincianobjek')}}/"+id,
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
            dropdownParent: $('#tambahrekrincianobjek'),
            ajax: {
                url: "{{url('rekjenis/rincianobjek')}}/"+id,
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
            dropdownParent: $('#tambahrekrincianobjek'),
            ajax: {
                url: "{{url('rekobjek/rincianobjek')}}/"+id,
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

});

</script>