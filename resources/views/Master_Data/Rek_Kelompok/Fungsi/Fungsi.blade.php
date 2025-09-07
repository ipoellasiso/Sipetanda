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
    var table = $('.tabelrekkelompok').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekkelompok",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'rek', name: 'rek'},
            {data: 'no_rek_kel', name: 'no_rek_kel'},
            {data: 'rek_kel', name: 'rek_kel'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
     $('#createRekkelompok').click(function (){
         $('#saveBtn').val("create-rekkelompok");
         $('#id').val('');
         $('#userForm').trigger("reset");
         $('#tambahrekkelompok').modal('show');
         $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editRekkelompok', function(e)  {
        var id_kel = $(this).data('id_kel');
        $.get("/rekkelompok/edit/"+id_kel, function (data) {
            $('#saveBtn').val("edit-rekkelompok");
            $('#tambahrekkelompok').modal('show');
        
            $('#id6').val(data.id_kel);
            $('#id_akun').html('<option value = "'+data.id+'" selected >'+data.rek+'</option>');
            $('#no_rek_kel').val(data.no_rek_kel);
            $('#rek_kel').val(data.rek_kel);
        })
    });

    // Import data
    $('#createimportrekkelompok').click(function (){
        $('#saveBtn').val("create-import");
        $('#id_kel').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportrekkelompok').modal('show');
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
            url: "/rekkelompok/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahrekkelompok').modal('hide');
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
                    $('#tambahrekkelompok').modal('hide');
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
    $('body').on('click', '.deleteRekkelompok', function () {

        var id_kel = $(this).data("id_kel");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_kel,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/rekkelompok/destroy/"+id_kel,
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

    //Get Data Akun
    $('#id_akun').select2({
	    placeholder: "Pilih Akun",
    	allowClear: true,
        dropdownParent: $('#tambahrekkelompok'),
	    ajax: { 
            url: "/rekkelompok/akun",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params2) {
                return {
                    searchAkun: params2.term2 // search term
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

});

</script>