<!-- Meta Tag -->
@yield('meta')
<!-- Title Tag  -->
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="images/favicon.png">
<!-- Web Font -->
<link
    href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">

<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
<!-- Fancybox -->
<link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
<!-- Themify Icons -->
<link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/niceselect.css') }}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/flex-slider.min.css') }}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{ asset('frontend/css/owl-carousel.css') }}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}">
<!-- Jquery Ui -->
<link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="{{ asset('frontend/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
{{--  <script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons'
    async='async'></script>  --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
<style>
    body {
        font-family: "Julius Sans One", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    html,
    body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }


    .dropdown-toggle::after {
        display: none !important;
    }

    /* Multilevel dropdown */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: 0px;
        margin-left: 0px;
    }

    .show {
        transition: opacity 0.3s ease-in, transform 0.3s ease-in;
    }

    .bg-dark {
        background-color: #121212;
        !important
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 400px;
        background-color: #fff;
        color: #121212;
        transition: transform 0.3s ease-in-out;
        transform: translateX(-100%);
        padding-top: 20px;
        z-index: 9999;
        /* Sembunyikan sidebar */
    }

    .sidebar.active {
        transform: translateX(0);
        /* Tampilkan sidebar saat aktif */
    }

    @media (min-width: 768px) {
        .sidebar {
            transform: translateX(0);
            padding-top: 120px;
            z-index: 1000;
            width: 260px;
            /* Tampilkan sidebar di desktop */
        }

        .sidebar-toggle {
            display: none;
            /* Sembunyikan hamburger di desktop */
        }
    }

    .sidebar-close {
        display: none;
    }

    .dropdown-sidebar {
        display: none !important;
    }

    .dropdown-navbar {
        display: flex !important;
    }

    @media (max-width: 768px) {
        .sidebar-close {
            display: block;
        }

        .dropdown-sidebar {
            display: flex !important;
        }

        .dropdown-navbar {
            display: none !important;
        }
    }

    .sidebar-item {
        margin-bottom: 1rem;
    }

    .sidebar-item a {
        color: #121212;
        text-decoration: none;
        display: block;
        padding: 0.5rem;
        border-radius: 5px;
    }

    .sidebar-item a:hover {
        background-color: #495057;
    }

    .sidebar.hidden {
        transform: translateX(-100%);
    }

    .sidebar .search-section {
        border-bottom: 1px solid #444;
    }

    .sidebar .search-section input {
        background-color: #fff;
        border: none;
        color: #121212;
    }

    .dropdown-menu {
        transition: transform 0.3s ease-in-out;
    }

    .dropdown-menu.show {
        display: block;
        transform: translateY(0);
    }

    .dropdown-divider {
        height: 1px;
        background-color: #495057;
        margin: 1rem 0;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
    }

    .d-flex.flex-column {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .d-flex.flex-grow-1 {
        display: flex;
        flex-grow: 1;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Custom styles for buttons */
    .btn-outline-custom {
        background-color: #fff;
        color: red;
        border-color: red;
        margin-right: 5px;
        /* Spasi antara tombol */
    }

    .btn-outline-custom:hover {
        background-color: red;
        color: white;
    }

    .btn-custom {
        background-color: red;
        color: #fff;
        cursor: pointer;
        border: 0;
        /* Spasi antara tombol */
    }

    .btn-custom:hover {
        background-color: red;
        color: #fff;
    }

    .btn-sort {
        width: 100%;
        border-radius: 1rem;
        text-align: left;
        background-color: white;
        color: black;
        border: 0;
        font-size: 12px;
        padding-left: 8px;
    }

    .btn-sidebar {
        width: 100%;
        border-radius: 1rem;
        text-align: left;
        background-color: white;
        color: black;
        border: 0;
        font-size: 12px;
        padding: 8px 12px 5px 12px;
        margin-top: 12px;
    }

    .btn-sort:hover,
    .btn-sidebar:hover {
        background-color: #d4c0c0;
    }

    .active-sort {
        background-color: #e7f3fe;
        /* Warna latar belakang untuk tombol aktif */
        color: black;
        /* Warna teks untuk tombol aktif */
        border-color: #007bff;
        /* Border untuk tombol aktif */
    }

    .rounded {
        border-radius: 1rem !important;
        /* Menetapkan border radius untuk kelas rounded */
    }

    .suggestion-item {
        padding: 8px;
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #f0f0f0;
        /* Highlight on hover */
    }

    .dropdown-sidebar {
        border: 1px solid red;
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 14px;
        cursor: pointer;
    }

    .dropdown-sidebar:hover {
        background-color: red;
        color: white !important;
    }

    .dropdown-sidebar:hover a {
        color: white !important;
        /* Menjamin warna putih saat hover */
    }

    .notification {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        border-radius: 8px;
        position: fixed;
        bottom: 0px;
        right: 20px;
        z-index: 9999;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        font-size: 18px;
        font-weight: bold;
        color: #fff;
    }

    .success-notification {
        background-color: #28a745;
    }

    .error-notification {
        background-color: #dc3545;
    }

    .notification .icon {
        font-size: 24px;
        /* Ukuran ikon lebih besar */
    }

    .notification .message {
        flex-grow: 1;
    }

    .payment-icons img {
        height: 30px;
        width: auto;
        max-width: 30px;
        background-color: #fff;
        {{--  padding: 5px;  --}} border-radius: 5px;
        object-fit: contain;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-left: 6px;
    }

    .single-icon {
        position: relative;
        display: inline-block;
    }

    .single-icon span {
        position: absolute;
        top: -8px;
        right: -10px;
        background: #ffc107;
        color: #000;
        padding: 2px 6px;
        border-radius: 50%;
        font-size: 10px;
        font-weight: bold;
    }

    @media (min-width: 992px) {
        .footer-info {
            margin-left: -120px;
        }

        .footer-row {
            margin-top: -80px;
        }

        .first-row-footer {
            margin-top: 30px;
        }
    }
</style>
@stack('styles')
