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

    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="preload" href="{{ asset('template/dist') }}/assets/fonts/tabler-icons.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/tabler-icons.min.css">

    <!-- [Favicon] icon -->
    {{-- <link rel="icon" href="{{ asset('template/dist') }}/assets/images/favicon.svg" type="image/x-icon"> --}}
    <!-- [Feather Icons] https://feathericons.com -->
    {{-- <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/feather.css"> --}}
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    {{-- <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/fontawesome.css"> --}}
    <!-- [Material Icons] https://fonts.google.com/icons -->
    {{-- <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/material.css"> --}}

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

    <style>
        /* Tambahkan ini untuk menjadi 'parent' dari loader */
        .pc-container {
            position: relative;
        }

        /* Modifikasi loader-bg */
        .loader-bg {
            position: absolute;
            /* UBAH DARI 'fixed' */
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            z-index: 999;
            /* UBAH DARI '9999' */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        /* Hidden state (biarkan sama) */
        .loader-bg.hidden {
            opacity: 0;
            visibility: hidden;
        }

        /* Animasi lingkaran berputar (biarkan sama) */
        .loader-fill {
            width: 3rem;
            height: 3rem;
            border: 4px solid #4CAF50;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        /* Efek rotasi berulang (biarkan sama) */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Teks loading tambahan (biarkan sama) */
        .loader-text {
            margin-top: 1rem;
            color: #2e7d32;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <!-- [ Sidebar Menu ] start -->
    <x-sidebar />
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <x-header />
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            {{-- <div class="loader-track"></div> --}}
            <div class="loader-fill"></div>
            <div class="loader-text">Memuat halaman SITIMBANG...</div>
        </div>
        <!-- [ Pre-loader ] End -->
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            {{-- <x-breadcrumbs /> --}}
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
        // let table = new DataTable('#table');

        // // $(document).ready(function() {
        // //     $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
        // //         $("#success-alert").slideUp(500);
        // //     });
        // // })

        // $('.myselect').select2({
        //     theme: 'bootstrap-5'
        // });
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

    <script>
        window.addEventListener('load', function() {
            const loader = document.querySelector('.loader-bg');
            loader.classList.add('hidden');
            setTimeout(() => loader.style.display = 'none', 500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && !href.startsWith('#') && !href.startsWith('javascript')) {
                        document.querySelector('.loader-bg').classList.remove('hidden');
                        document.querySelector('.loader-bg').style.display = 'flex';
                    }
                });
            });
        });
    </script>


    @stack('scripts')

    {{-- SweetAlert 2 --}}
    @include('sweetalert::alert')
    {{-- Icons Sprite SVG --}}
    @include('partials.svg-sprite')
</body>
<!-- [Body] end -->

</html>
