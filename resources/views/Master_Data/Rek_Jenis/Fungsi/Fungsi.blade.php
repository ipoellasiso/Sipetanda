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
    var table = $('.tabelrekjenis').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekjenis",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id_akun', name: 'id_akun'},
            {data: 'id_kelompok', name: 'id_kelompok'},
            {data: 'no_rek', name: 'no_rek'},
            {data: 'rek', name: 'rek'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
     $('#createRekjenis').click(function (){
         $('#saveBtn').val("create-rekjenis");
         $('#id').val('');
         $('#userForm').trigger("reset");
         $('#tambahrekjenis').modal('show');
         $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editRekjenis', function(e)  {
        var id = $(this).data('id');
        $.get("/rekjenis/edit/"+id, function (data) {
            $('#saveBtn').val("edit-rekjenis");
            $('#tambahrekjenis').modal('show');
        
            $('#id6').val(data.id);
            $('#id_akun').val(data.id_akun);
            $('#id_kelompok').val(data.id_kelompok);
            $('#no_rek').val(data.no_rek);
            $('#rek').val(data.rek);
        })
    });

    // Import data
    $('#createimportrekjenis').click(function (){
        $('#saveBtn').val("create-import");
        $('#id').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportrekjenis').modal('show');
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
            url: "/rekjenis/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahrekjenis').modal('hide');
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
                    $('#tambahrekjenis').modal('hide');
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
    $('body').on('click', '.deleteRekjenis', function () {

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
                    url: "/rekjenis/destroy/"+id,
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