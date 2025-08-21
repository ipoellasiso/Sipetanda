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
    var table = $('.tabelbkuopd').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilbkuopd",
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
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createBku').click(function (){
        $('#saveBtn').val("create-bku");
        $('#id_transaksi').val('');
        $('#userForm').trigger("reset");
        $('#tambahbku').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editBkuopd', function(e)  {
        var id_transaksi1 = $(this).data('id_transaksi');
        $.get("/bku/edit/"+id_transaksi1, function (data) {
            $('#saveBtn').val("edit-bku");
            $('#tambahbku').modal('show');
        
            $('#id_transaksi').val(data.id_transaksi);
            $("#id_rekening").html('<option value = "'+data.id_rekening+'" selected >'+data.rekening2+'</option>');
            // $('#id_rekening').val(data.id_rekening);
            $('#id_opd').html('<option value = "'+data.id+'" selected >'+data.nama_opd+'</option>');
            $('#id_bank').html('<option value = "'+data.id_bank+'" selected >'+data.nama_bank+'</option>');
            $('#uraian').val(data.uraian);
            $('#no_buku').val(data.no_buku);
            $('#tgl_transaksi').val(data.tgl_transaksi);
            $('#nilai_transaksi').val(data.nilai_transaksi);
        })
    });

    $('#createimportbkuopd').click(function (){
        $('#saveBtn').val("create-import");
        $('#id').val('');
        $('#userForm1').trigger("reset");
        $('#tambahimportbku').modal('show');
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
            url: "/bkuopd/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahbku').modal('hide');
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
                    $('#tambahbku').modal('hide');
                    $('#saveBtn').html('Simpan');

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Nomor Buku/Bukti Sudah Ada"
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
    $('body').on('click', '.deleteBkuopd', function () {

        var id_transaksi = $(this).data("id_transaksi");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id_transaksi,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/bkuopd/destroy/"+id_transaksi,
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

    $(document).ready(function() {
        $('.amount').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), ' '));
        });
    });


    $('#id_rekeningopd').select2({
	    placeholder: "Pilih Rekening",
    	allowClear: true,
        dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bkuopd/rekening",
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

    $('#id_opdopd').select2({
	    placeholder: "Pilih Opd",
    	allowClear: true,
        dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bkuopd/opd",
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

    $('#id_bankopd').select2({
	    placeholder: "Pilih Bank",
    	allowClear: true,
        dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/bkuopd/bank",
            type: "Get",
            dataType: 'json',
            delay: 250,
            data: function (params2) {
                return {
                    searchBank: params2.term2 // search term
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