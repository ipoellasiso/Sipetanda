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
    var table = $('.tabelrekapanuser').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilrekapanrekuser",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rekening', name: 'no_rekening'},
            {data: 'rekening2', name: 'rekening2'},
            {data: 'no_buku', name: 'no_buku'},
            {data: 'tgl_transaksi', name: 'tgl_transaksi'},
            {data: 'uraian', name: 'uraian'},
            {data: 'nama_opd', name: 'nama_opd'},
            {data: 'nama_bank', name: 'nama_bank'},
            {data: 'nilai_transaksi', name: 'nilai_transaksi'},
            // {data: 'ket', name: 'ket'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});

function readURL(input, id) {
    id = id || '#modal-preview';
    if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#modal-preview').removeClass('hidden');
        $('#start').hide();
    }
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
}

</script>