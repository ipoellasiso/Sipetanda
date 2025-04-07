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

    // $(document).ready(function(){
    //     $(document).ready(function () {
    //         var tampilawal = '1';
    //         $.ajax({
    //             url: "{{ route('realisasi.index') }}" +'/' + tampilawal +'/tampilawal',
    //             type: "GET",
    //             data: 'tampilawal=' + tampilawal,
    //             success: function (data) {
    //                 $('#tampilrealisasifix').html(data);//menampilkan data ke dalam modal
    //             }
    //         });
    //     });
    // });

});

</script>