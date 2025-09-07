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
    var table = $('.tabelfix').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekon",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_kas_bpkad', name: 'no_kas_bpkad'},
            {data: 'no_buku', name: 'no_buku'},
            {data: 'tgl_transaksi', name: 'tgl_transaksi'},
            {data: 'uraian', name: 'uraian'},
            {data: 'nilai_transaksi', name: 'nilai_transaksi'},
        ]
    });

    var table = $('.tabelbelumfix').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekon2",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'no_kas_bpkad', name: 'no_kas_bpkad'},
            {data: 'no_buku', name: 'no_buku'},
            {data: 'tgl_transaksi', name: 'tgl_transaksi'},
            {data: 'uraian', name: 'uraian'},
            {data: 'nilai_transaksi', name: 'nilai_transaksi'},
        ]
    });

});

</script>
  