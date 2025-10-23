<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>SITIMBANG</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('template/dist') }}/assets/images/favicon.svg" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style-preset.css">

    {{-- Data Tables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

    {{-- Jquery --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    @vite(['resources/js/app.js'])
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <x-sidebar />
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <x-header />
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <x-breadcrumbs />
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                @if (session('success'))
                    {{-- alert bootsrap --}}
                    <div class="alert alert-success container" role="alert" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <x-footer />
    </footer>

    {{-- JQUERY --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    {{-- Data Tables --}}
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#table');

        // $(document).ready(function() {
        //     $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
        //         $("#success-alert").slideUp(500);
        //     });
        // })

        $('.myselect').select2({
            theme: 'bootstrap-5'
        });

        $('#no_polisiForm').change(function() {
            var truk_id = $(this).val();
            console.log(truk_id);

            var url1 = '{{ route('getWeight', ':id') }}';
            url1 = url1.replace(':id', truk_id);

            var url2 = '{{ route('getDriver', ':id') }}';
            url2 = url2.replace(':id', truk_id);

            /* Ajax untuk get data truks (mengambil berat truk) */
            $.ajax({
                url: url1,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        console.log("reponse dari truk : ", response);
                        $('#berat_trukForm').val(response.berat_truk);
                    }
                }
            });

            /* Ajax untuk get data supirs (mengambil nama supir) */
            $.ajax({
                url: url2,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        console.log("reponse dari supir : ", response);
                        $('#nama_supirForm').empty();
                        $('#nama_supirForm').append('<option value="">Pilih Supir</option>');
                        $.each(response, function(key, supir) {
                            console.log(supir.nama);
                            $('#nama_supirForm').append('<option value="' + supir.supir_id +
                                '">' + supir.nama + '</option>');
                        });
                    }
                }
            });

        });
    </script>

    <!-- [Page Specific JS] start -->
    {{-- <script src="{{ asset('template/dist') }}/assets/js/plugins/apexcharts.min.js"></script> --}}
    {{-- <script src="{{ asset('template/dist') }}/assets/js/pages/dashboard-default.js"></script> --}}
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('template/dist') }}/assets/js/plugins/popper.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/fonts/custom-font.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/pcoded.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/feather.min.js"></script>

    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change("preset-1");
        font_change("Public-Sans");
    </script>

    {{-- SweetAlert 2 --}}
    @include('sweetalert::alert')
</body>
<!-- [Body] end -->

</html>
