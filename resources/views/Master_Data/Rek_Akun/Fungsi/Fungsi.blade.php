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
    var table = $('.tabelrekakun').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekakun",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rek', name: 'no_rek'},
            {data: 'rek', name: 'rek'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
     $('#createRekakun').click(function (){
         $('#saveBtn').val("create-rekakun");
         $('#id').val('');
         $('#userForm').trigger("reset");
         $('#tambahrekakun').modal('show');
         $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editRekakun', function(e)  {
        var id1 = $(this).data('id');
        $.get("/rekakun/edit/"+id1, function (data) {
            $('#saveBtn').val("edit-rekakun");
            $('#tambahrekakun').modal('show');
        
            $('#id5').val(data.id);
            $('#no_rek').val(data.no_rek);
            $('#rek').val(data.rek);
        })
    });

    $('#createimportrekakun').click(function (){
        $('#saveBtn').val("create-import");
        $('#id').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportrekakun').modal('show');
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
            url: "/rekakun/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahrekakun').modal('hide');
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
                    $('#tambahrekakun').modal('hide');
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
    $('body').on('click', '.deleteRekakun', function () {

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
                    url: "/rekakun/destroy/"+id,
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