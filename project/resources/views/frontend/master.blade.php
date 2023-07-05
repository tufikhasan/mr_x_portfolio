<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Towfik Hasan">
    <title>{{ $seo->title }}</title>
    <meta name="keywords" content="{{ $seo->keywords }}">
    <meta name="description" content="{{ $seo->description }}" />
    <meta property="og:site_name" content="{{ $seo->ogSiteName }}">
    <meta property="og:url" content="{{ $seo->ogUrl }}">
    <meta property="og:title" content="{{ $seo->ogTitle }}">
    <meta property="og:description" content="{{ $seo->ogDescription }}">
    <meta property="og:image"
        content="{{ !empty($seo->ogImage) ? url('upload/seo/' . $seo->ogImage) : url('upload/no_image.jpg') }}">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/favicon.ico') }}" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        @include('frontend.components.header')
        @yield('content')
    </main>
    @include('frontend.components.footer')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
    <script src="{{ asset('frontend/js/axios.min.js') }}"></script>
    @yield('script')
</body>

</html>
