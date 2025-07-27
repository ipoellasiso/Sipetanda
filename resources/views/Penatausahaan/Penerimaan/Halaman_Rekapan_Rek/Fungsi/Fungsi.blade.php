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
    // var table = $('.tabelrekapan').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "/tampilrekapanrek",
    //     columns: [
    //         {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //         {data: 'no_rekening', name: 'no_rekening'},
    //         {data: 'rekening2', name: 'rekening2'},
    //         {data: 'no_buku', name: 'no_buku'},
    //         {data: 'tgl_transaksi', name: 'tgl_transaksi'},
    //         {data: 'uraian', name: 'uraian'},
    //         {data: 'nama_opd', name: 'nama_opd'},
    //         {data: 'nama_bank', name: 'nama_bank'},
    //         {data: 'nilai_transaksi', name: 'nilai_transaksi'},
    //         {data: 'ket', name: 'ket'},
    //         // {data: 'action', name: 'action', orderable: false, searchable: false},
    //     ]
    // });

    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawal = '1';
            $.ajax({
                url: "{{ route('view.dataindex.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampildata1').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });

    $('body').on('click', '.caribaru', function (e) {
        e.preventDefault();
        var id_rekening2 = $('#id_rekening2').val();
        var id_opd = $("#id_opd").val();
        var tgl_awal = $("#tgl_awal").val();
        var tgl_akhir = $("#tgl_akhir").val();
        var tampilawal = '1';
        $.ajax({
            url: "{{ route('view.dataindex.index') }}" +'/' + tampilawal +'/tampil',
            type: "GET",
            data: '&tgl_awal=' + tgl_awal + '&tgl_akhir=' + tgl_akhir + '&id_rekening2=' + id_rekening2 + '&id_opd=' + id_opd,
                success: function (data) {
                    $('.tampildata1').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $('#id_rekening2').select2({
	    placeholder: "Pilih Rekening",
    	allowClear: true,
        // dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bku/rekening",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchRek: params.term // search term
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

    $('#id_opd').select2({
	    placeholder: "Pilih Opd",
    	allowClear: true,
        // dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bku/opd",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchOpd: params.term // search term
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