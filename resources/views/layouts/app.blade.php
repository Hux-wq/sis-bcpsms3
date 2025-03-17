<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Student Information System')}}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

         <!-- Favicons -->
        <link href="https://elc-public-images.s3.ap-southeast-1.amazonaws.com/bcp-olp-logo-mini2.png" rel="icon">
        <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Bootstrap CSS File -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

         <!-- Fontawesome File -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Template Main CSS File -->
        <link href="/css/style.css" rel="stylesheet">

        <!-- Include SweetAlert2 CSS and JS in your layout file -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <link rel="stylesheet" href="/resources/css/app.css">
        <!-- Scripts -->
        <link rel="stylesheet" href="/resources/js/app.js">

    </head>
    <body class="font-sans antialiased">

            {{-- @include('layouts.navigation') --}}
            @include('layouts.header')
            @include('layouts.side-nav')
            

            <!-- Page Content -->
            <main id="main" class="main">

                @if (isset($header))
                <header class="p-3">
                    <div class="">
                        {{ $header }}
                    </div>
                </header>

                @endif

                {{ $slot }}

                

            </main>
        

        <!-- Vendor JS Files -->
        <script src="/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/vendor/chart.js/chart.umd.js"></script>
        <script src="/vendor/echarts/echarts.min.js"></script>
        <script src="/vendor/quill/quill.js"></script>
        <script src="/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="/vendor/tinymce/tinymce.min.js"></script>
        <script src="/vendor/php-email-form/validate.js"></script>

        <!-- Bootstrap JS File -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <!-- Template Main JS File -->
        <script src="/js/main.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>
