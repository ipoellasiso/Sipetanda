    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="/assets/compiled/js/app.js"></script>

    <script src="/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/static/js/pages/dashboard.js"></script>


    <div class="container my-3">
        @if (@session('success'))
            <script>

                const Toast = swal.mixin({
                    toast:true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer:4500,
                    timeProgressBar: true
                })
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                })
            </script>
        @endif

        @if (@session('error'))
            <script>
                // swal.fire({
                //     icon: 'success',
                //     title: 'Wow ...',
                //     text: "{{ session('success') }}",
                //     timer: 2500
                // })

                const Toast = swal.mixin({
                    toast:true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer:4500,
                    timeProgressBar: true
                })
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                })
            </script>
        @endif

        @if (@session('question'))
            <script>
                // swal.fire({
                //     icon: 'success',
                //     title: 'Wow ...',
                //     text: "{{ session('success') }}",
                //     timer: 2500
                // })

                const Toast = swal.mixin({
                    toast:true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer:4500,
                    timeProgressBar: true
                })
                Toast.fire({
                    icon: 'question',
                    title: "{{ session('question') }}"
                })
            </script>
        @endif
    </div>
    