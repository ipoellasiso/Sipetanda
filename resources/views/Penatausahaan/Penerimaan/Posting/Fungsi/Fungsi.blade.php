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


    let table = $('.tabelposting').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/tampilposting',
            data: function(d){
            d.opd      = $('#id_opdopd').val();
            d.rekening = $('#id_rekeningopd').val();
            d.tgl_awal = $('#tanggal-awal').val();
            d.tgl_akhir= $('#tanggal-akhir').val();
            },
            error: function(xhr){
            console.error(xhr.responseText);
            Swal.fire('Error', 'Gagal memuat data tabel.', 'error');
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            {
            data: 'status4',
            name: 'tb_transaksi.status4',
            orderable:false, searchable:false,
            render: function(data, type, row){
                if (data === 'Posting') {
                return `
                    <button class="btn btn-sm btn-danger batal-posting"
                    data-id_transaksi="${row.id_transaksi}"
                    data-no_buku="${row.no_buku}">
                    Batalkan Posting
                    </button>`;
                } else {
                return `
                    <input type="checkbox" class="row-check"
                    value="${row.id_rekening}"
                    data-no_buku="${row.no_buku}"
                    data-id_transaksi="${row.id_transaksi}">`;
                }
            }
            },
            { data: 'no_rekening',     name: 'tb_rekening.no_rekening' },
            { data: 'rekening2',       name: 'tb_rekening.rekening2' },
            { data: 'no_buku',         name: 'tb_transaksi.no_buku' },
            { data: 'tgl_transaksi',   name: 'tb_transaksi.tgl_transaksi' },
            { data: 'uraian',          name: 'tb_transaksi.uraian' },
            { data: 'nama_opd',        name: 'tb_opd.nama_opd' },
            { data: 'nama_bank',       name: 'tb_bank.nama_bank' },
            { data: 'nilai_transaksi', name: 'tb_transaksi.nilai_transaksi' },
            // optional hidden, supaya row.id_transaksi dijamin ada
            { data: 'id_transaksi',    name: 'tb_transaksi.id_transaksi', visible:false, searchable:false }
        ]
        });

    $('#btn-filter').on('click', function() {
        table.ajax.reload();
    });

    $('#btn-reset').on('click', function() {
        $('#id_opdopd').val(null).trigger('change');
        $('#id_rekeningopd').val(null).trigger('change');
        $('#tanggal-awal').val('');
        $('#tanggal-akhir').val('');
        table.ajax.reload();
    });

    $(document).on('click', '.batal-posting', function(){
        let id = $(this).data('id');
        let no_buku = $(this).data('no_buku');
        let id_transaksi = $(this).data('id_transaksi');

        Swal.fire({
            title: 'Batalkan Posting?',
            text: `Apakah Anda yakin ingin membatalkan posting untuk No Buku ${no_buku}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/batalkan-posting",
                    type: "POST",
                    data: {
                        id_transaksi: id_transaksi,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res){
                        if(res.success){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message
                            });
                        }
                        $('.tabelposting').DataTable().ajax.reload();
                    },
                        error: function(xhr){
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan server!'
                        });
                    }
                });
            }
        });
    });

    // Pilih semua
    $('#select-all').on('click', function(){
        $('.row-check').prop('checked', this.checked);
    });

    $('#btn-update').on('click', function(){
        let selected = [];

        $('.row-check:checked').each(function(){
            selected.push({
                no_buku: $(this).data('no_buku'),
                id_rekening: $(this).val(),
                id_transaksi: $(this).data('id_transaksi') // <-- tambahkan ini
            });
        });

        if (selected.length === 0) {
            Swal.fire("Oops!", "Pilih minimal satu transaksi!", "warning");
            return;
        }

        Swal.fire({
            title: "Yakin Posting?",
            text: "Data akan diupdate ke BKU OPD",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Posting!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('transaksi.updateBku') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: selected
                    },
                    success: function(res) {
                        Swal.fire("Sukses!", res.message, "success").then(() => {
                            $('.tabelposting').DataTable().ajax.reload();
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            Swal.fire("Validasi Gagal!", xhr.responseJSON.message, "warning");
                        } else {
                            Swal.fire("Error!", "Terjadi kesalahan server!", "error");
                        }
                    }
                });
            }
        });
    });

     $('#id_rekeningopd').select2({
	    placeholder: "Pilih Rekening",
    	allowClear: true,
        // dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/posting/rekening",
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
        // dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/posting/opd",
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

</script>