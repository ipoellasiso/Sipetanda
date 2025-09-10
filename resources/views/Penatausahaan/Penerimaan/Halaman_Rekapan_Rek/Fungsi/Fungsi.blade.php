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

    $('body').on('click', '.reset', function () {
        $('#id_rekening').val('').trigger('change');
        $('#nama_opd').val('').trigger('change');
        $('#tgl_awal').val('').trigger('change');
        $('#tgl_akhir').val('').trigger('change');
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

    $('body').on('click', '.caribaruadmin', function (e) {
        e.preventDefault();
        var id_rekening = $('#id_rekening').val();
        var nama_opd = $("#nama_opd").val();
        var tgl_awal = $("#tgl_awal").val();
        var tgl_akhir = $("#tgl_akhir").val();
        var tampilawal = '1';
        $.ajax({
            url: "{{ route('view.dataindex.index') }}" +'/' + tampilawal +'/tampil',
            type: "GET",
            data: '&tgl_awal=' + tgl_awal + '&tgl_akhir=' + tgl_akhir + '&id_rekening=' + id_rekening + '&nama_opd=' + nama_opd,
                success: function (data) {
                    $('.tampildata1').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    

    $('#id_rekening').select2({
	    placeholder: "Pilih Rekening",
    	allowClear: true,
        // dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/kamar/rekening",
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

    $('#nama_opd').select2({
	    placeholder: "Pilih Opd",
    	allowClear: true,
        // dropdownParent: $('#tambahbku'),
	    ajax: { 
            url: "/kamar/opd",
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

<script>
      // Export excel
      var tablesToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , tmplWorkbookXML = '<xml version="1.0"><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
          + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
          + '<Styles>'
          + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
          + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
          + '</Styles>' 
          + '{worksheets}</Workbook>'
        , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
        , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(tables, wsnames, wbname, appname) {
          var ctx = "";
          var workbookXML = "";
          var worksheetsXML = "";
          var rowsXML = "";

          for (var i = 0; i < tables.length; i++) {
            if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
            for (var j = 0; j < tables[i].rows.length; j++) {
              rowsXML += '<Row>'
              for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
                var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
                var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
                var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
                dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
                var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
                dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
                ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                      , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                      , data: (dataFormula)?'':dataValue
                      , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                      };
                rowsXML += format(tmplCellXML, ctx);
              }
              rowsXML += '</Row>'
            }
            ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
            worksheetsXML += format(tmplWorksheetXML, ctx);
            rowsXML = "";
          }

          ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
          workbookXML = format(tmplWorkbookXML, ctx);

    console.log(workbookXML);

          var link = document.createElement("A");
          link.href = uri + base64(workbookXML);
          link.download = wbname || 'Workbook.xls';
          link.target = '_blank';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }
      })();
</script>