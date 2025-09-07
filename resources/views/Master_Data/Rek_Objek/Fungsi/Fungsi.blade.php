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
    var table = $('.tabelrekobjek').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekobjek",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'rek', name: 'rek'},
            {data: 'rek_kel', name: 'rek_kel'},
            {data: 'rek_jen', name: 'rek_jen'},
            {data: 'no_rek_o', name: 'no_rek_o'},
            {data: 'rek_o', name: 'rek_o'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
     $('#createRekobjek').click(function (){
         $('#saveBtn').val("create-rekobjek");
         $('#id6').val('');
         $('#userForm').trigger("reset");
         $('#tambahrekobjek').modal('show');
         $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editRekobjek', function(e)  {
        var id_o = $(this).data('id_o');
        $.get("/rekobjek/edit/"+id_o, function (data) {
            $('#saveBtn').val("edit-rekobjek");
            $('#tambahrekobjek').modal('show');
        
            $('#id6').val(data.id_o);
            $('#id_akun').html('<option value = "'+data.id+'" selected >'+data.rek+'</option>');
            $('#id_kelompok').html('<option value = "'+data.id_kel+'" selected >'+data.rek_kel+'</option>');
            $('#id_jenis').html('<option value = "'+data.id_jen+'" selected >'+data.rek_jen+'</option>');
            // $('#id_kelompok').val(data.id_kelompok);
            $('#no_rek_o').val(data.no_rek_o);
            $('#rek_o').val(data.rek_o);
        })
    });

    // Import data
    $('#createimportrekobjek').click(function (){
        $('#saveBtn').val("create-import");
        $('#id6').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportrekobjek').modal('show');
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
            url: "/rekobjek/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahrekobjek').modal('hide');
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
                    $('#tambahrekobjek').modal('hide');
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
    $('body').on('click', '.deleteRekobjek', function () {

        var id_o = $(this).data("id_o");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_o,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/rekobjek/destroy/"+id_o,
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
        dropdownParent: $('#tambahrekobjek'),
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
            dropdownParent: $('#tambahrekobjek'),
            ajax: {
                url: "{{url('rekkelompok/objek')}}/"+id,
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
            dropdownParent: $('#tambahrekobjek'),
            ajax: {
                url: "{{url('rekjenis/objek')}}/"+id,
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

    //  //Get Data Akun
    // $('#id_akun').select2({
	//     placeholder: "Pilih Akun",
    // 	allowClear: true,
    //     dropdownParent: $('#tambahrekobjek'),
	//     ajax: { 
    //         url: "/rekakun/objek",
    //         type: "Get",
    //         dataType: 'json',
    //         delay: 250,
    //         data: function (params2) {
    //             return {
    //                 searchAkun: params2.term2 // search term
    //             };
    //         },
    //         processResults: function (response) {
    //             return {
    //                 results: response
    //             };
    //         },
    //             cache: true
    //         }
    // });

    //  //Get Data Kelompok
    // $('#id_kelompok').select2({
	//     placeholder: "Pilih Kelompok",
    // 	allowClear: true,
    //     dropdownParent: $('#tambahrekobjek'),
	//     ajax: { 
    //         url: "/rekkelompok/objek",
    //         type: "Get",
    //         dataType: 'json',
    //         delay: 250,
    //         data: function (params2) {
    //             return {
    //                 searchKel: params2.term2 // search term
    //             };
    //         },
    //         processResults: function (response) {
    //             return {
    //                 results: response
    //             };
    //         },
    //             cache: true
    //         }
    // });

});

</script>