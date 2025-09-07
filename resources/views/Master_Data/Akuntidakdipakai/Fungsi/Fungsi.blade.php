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
        ajax: "/tampilakun",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rek', name: 'no_rek'},
            {data: 'rek', name: 'rek'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createAkun').click(function (){
        $('#saveBtn').val("create-Akun");
        $('#id').val('');
        $('#userForm').trigger("reset");
        $('#tambahakun').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    $('#createimport').click(function (){
        $('#saveBtn').val("create-import");
        $('#id').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimport').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editAkun', function()  {
        var idrek = $(this).data('id');
        $.get("/akun/edit/"+idrek, function (data) {
            $('#saveBtn').val("edit-akun");
            $('#tambahakun').modal('show');
            $('#id').val(data.id);
            $('#no_rek').val(data.no_rek);
            $('#rek').val(data.rek);
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
            url: "/akun/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm1').trigger("reset");
                    $('#tambahakun').modal('hide');
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
                    $('#userForm1').trigger("reset");
                    $('#tambahakun').modal('hide');
                    $('#saveBtn').html('Simpan');

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
    $('body').on('click', '.deleteAkun', function () {

        var id = $(this).data("id");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/akun/destroy/"+id,
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

});

</script>
