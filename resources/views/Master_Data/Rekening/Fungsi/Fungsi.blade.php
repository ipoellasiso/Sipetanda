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
        ajax: "/tampilrekening",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rekening', name: 'no_rekening'},
            {data: 'rekening2', name: 'rekening2'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createRekening').click(function (){
        $('#saveBtn').val("create-Rekening");
        $('#id_rekening').val('');
        $('#userForm').trigger("reset");
        $('#tambahrekening').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    $('#createimport').click(function (){
        $('#saveBtn').val("create-import");
        $('#id_rekening').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimport').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editRekening', function()  {
        var idrek = $(this).data('id_rekening');
        $.get("/rekening/edit/"+idrek, function (data) {
            $('#saveBtn').val("edit-rekening");
            $('#tambahrekening').modal('show');
            $('#id_rekening').val(data.id_rekening);
            $('#ket4').val(data.ket4);
            $('#ket1').val(data.ket1);
            $('#ket2').val(data.ket2);
            $('#ket3').val(data.ket3);
            $('#no_rekening').val(data.no_rekening);
            $('#rekening').val(data.rekening);
            $('#rekening2').val(data.rekening2);
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
            url: "/rekening/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm1').trigger("reset");
                    $('#tambahrekening').modal('hide');
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
                    $('#tambahrekening').modal('hide');
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
    $('body').on('click', '.deleteRek', function () {

        var id_rekening = $(this).data("id_rekening");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_rekening,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/rek/destroy/"+id_rekening,
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

<script>
    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        );
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting your data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>   