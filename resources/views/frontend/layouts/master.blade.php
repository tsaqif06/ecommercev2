<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'en' }}">

<head>
    @include('frontend.layouts.head')
</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    @include('frontend.layouts.notification')
    <!-- Header -->
    @include('frontend.layouts.header')
    <!--/ End Header -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar bg-light">
                <!-- Sidebar -->
                <div class="sidebar fixed-left">
                    <div class="ml-4" data-toggle="modal" data-target="#searchModal">
                        <i class="fas fa-search" style="font-size: 25px; color: #121212"></i>
                    </div>
                    <div class="sidebar-menu">
                        <!-- Add other menu items here -->
                    </div>

                    <!-- Dropdown for Mobile, hidden on desktop -->
                    <div class="dropdown d-block d-md-none mt-auto p-3">
                        <a class="text-light dropdown-toggle d-flex align-items-center" href="#"
                            id="sidebarDropdownSettings" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="mr-1 h-4" src="storage/flags/id.svg" id="sidebarFlagSvgNavbar" alt="Indonesia"
                                style="width: 24px;">
                            <span class="mr-2 font-weight-bold">Indonesia</span>
                            <div class="p-divider mx-2" style="width: 1px; height: 20px; background-color: #ffffff;">
                            </div>
                            <span class="mr-2 font-weight-bold">IDR</span>
                            <span class="font-weight-bold">(Rp)</span>
                        </a>
                        <div class="dropdown-menu p-4 shadow-lg bg-white rounded-lg" style="width: 300px;">
                            <!-- Dropdown content as before, same as in the topbar dropdown -->
                            <!-- Region Select, Language Select, Currency Select, Save Button -->
                        </div>
                    </div>
                </div>

                <!-- Dropdown for Desktop, hidden on mobile -->
                <div class="ml-auto dropdown d-none d-md-block">
                    <a class="text-dark dropdown-toggle d-flex align-items-center" href="#"
                        id="desktopDropdownSettings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="mr-1 h-4" src="storage/flags/id.svg" id="flagSvgNavbar" alt="Indonesia"
                            style="width: 24px;">
                        <span class="mr-2 font-weight-bold">Indonesia</span>
                        <div class="p-divider mx-2"
                            style="width: 1px; height: 20px; background-color: var(--p-border-color);">
                        </div>
                        <span class="mr-2 font-weight-bold">IDR</span>
                        <span class="font-weight-bold">(Rp)</span>
                    </a>
                    <div class="dropdown-menu p-4 shadow-lg bg-white rounded-lg" style="width: 300px;">
                        <!-- Dropdown content as before -->
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @yield('main-content')
            </main>
        </div>
    </div>

    @include('frontend.layouts.footer')

</body>

</html>
