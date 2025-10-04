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
    // var table = $('.tabelposting').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "/tampilposting",
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
    //     ]
    // });

    let table = $('.tabelposting').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/tampilposting',
            data: function(d){
            d.opd      = $('#filter-opd').val();
            d.rekening = $('#filter-rekening').val();
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
                    <span class="badge bg-success">Sudah Posting</span><br>
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

    $('#btn-filter').on('click', function(){
    table.ajax.reload();
    });

    $('#btn-reset').on('click', function(){
        $('#filter-opd').val('');
        $('#filter-rekening').val('');
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
                        id: id,
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
                            location.reload();
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

    // tambah data
    $('#createBku').click(function (){
        $('#saveBtn').val("create-bku");
        $('#id_transaksi').val('');
        $('#userForm').trigger("reset");
        $('#tambahbku').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    // edit data
    $('body').on('click', '.editBku', function(e)  {
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

    // simpan data
    $('body').on('submit', '#userForm', function(e){
        e.preventDefault();

        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Menunggu Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/bku/store",
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

    $(document).ready(function() {
        $('.amount').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), ' '));
        });
    });

});

</script>