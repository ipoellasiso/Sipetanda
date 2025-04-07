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
    var table = $('.tabelanggaran').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilanggaran",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rekening', name: 'no_rekening'},
            {data: 'rekening2', name: 'rekening2'},
            {data: 'nama_opd', name: 'nama_opd'},
            {data: 'nilai', name: 'nilai'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createimportanggaran').click(function (){
        $('#saveBtn').val("create-import");
        $('#id').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportanggaran').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

});

</script>