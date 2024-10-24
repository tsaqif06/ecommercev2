<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?: 'en' }}">

<head>
    @include('frontend.layouts.head')
</head>

<body class="js" style="overflow-x: hidden; padding: 0;">

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

    <div class="container-fluid p-0">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar bg-light">
                <div class="sidebar-content">
                    <div class="sidebar-header d-flex justify-content-between align-items-center">
                        <div class="ml-1 searchToggle">
                            <i class="fas fa-search" style="font-size: 25px; color: #121212; cursor: pointer;"></i>
                        </div>
                        <!-- Tombol Close -->
                        <i class="fas fa-times sidebar-close"
                            style="color: #121212; font-size: 26px; cursor: pointer;"></i>
                    </div>
                    <div class="ml-1 sidebar-menu">
                        <a href="{{ route('product-grids') }}" class="btn btn-sidebar"
                            style="font-size: 14px; font-weight: bold; color: #121212">Product</a>
                    </div>

                    <div class="dropdown dropdown-sidebar ml-4"
                        style="position: absolute; bottom: 20px; width: 80%; display: flex; align-items: center;">
                        <a class="text-dark d-flex align-items-center" data-toggle="modal" data-target="#settingModal"
                            href="#" id="dropdownSettings" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="mr-1 h-4" src="storage/flags/id.svg" id="flagSvgSidebar" alt="Indonesia"
                                style="width: 24px;">
                            <span class="mr-2 font-weight-bold" id="deliver-to-navbarsidebar">Indonesia</span>
                            <div class="p-divider mx-2"
                                style="width: 1px; height: 2    0px; background-color: var(--p-border-color);"></div>
                            <span class="mr-2 font-weight-bold" id="currencyTypeSidebar">IDR</span>
                            <span class="font-weight-bold" id="currencyTypeMoneySidebar">(Rp)</span>
                            <div class="p-divider mx-2"
                                style="width: 1px; height: 20px; background-color: var(--p-border-color);"></div>
                            <img src="data:image/png;base64,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"
                                alt="Language" width="18" class="mr-2 mt-1">
                            <span class="mr-2 font-weight-bold"
                                id="selectedLangSidebar">{{ strtoupper(session('applocale')) ?? 'EN' }}</span>
                            <svg data-v-baee0c8f="" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                width="24px" height="24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M17 9.17a1 1 0 0 0-1.41 0L12 12.71L8.46 9.17a1 1 0 0 0-1.41 0a1 1 0 0 0 0 1.42l4.24 4.24a1 1 0 0 0 1.42 0L17 10.59a1 1 0 0 0 0-1.42">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="settingModalLabel"
                aria-hidden="true" style="z-index: 9999;">
                <div class="modal-dialog">
                    <div class="modal-content container-fluid rounded" style="width: 500px; height: 480px">
                        <div class="modal-body mt-3">
                            <!-- Form Section -->
                            <div>
                                <div class="mb-1" style="font-size: 15px; font-weight: bold; word-wrap: none;">
                                    {{ __('main.region_language_currency') }}</div>
                                <div class="opacity-90" style="font-size: 13px; word-wrap: none;">
                                    {{ __('main.change_settings') }}</div>
                                <!-- Region Select -->
                                <div class="mb-3">
                                    <label class="form-label" style="font-size: 15px;">{{ __('main.deliver_to') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <img src="storage/flags/id.svg" id="flagSvgDropdownSidebar" alt="Indonesia"
                                                width="24" class="mr-2 mt-1">
                                        </div>
                                        <select class="custom-select w-100" id="deliver-tosidebar" width="100%">
                                            <option value="id">Indonesia</option>
                                            <option value="my">Malaysia</option>
                                            <option value="sg">Singapore</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Language Select -->
                                <div class="mb-3">
                                    <label class="form-label" style="font-size: 15px;">{{ __('main.language') }}</label>
                                    <div class="input-group d-flex align-items-center">
                                        <img src="data:image/png;base64,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"
                                            alt="Language" width="24" class="mr-2">
                                        <select class="custom-select w-100" id="langSelectSidebar">
                                            <option value="en"
                                                {{ session('applocale') == 'en' ? 'selected' : '' }}>
                                                English</option>
                                            <option value="id"
                                                {{ session('applocale') == 'id' ? 'selected' : '' }}>Bahasa Indonesia
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <!-- Currency Select -->
                            <div class="mb-3">
                                <label class="form-label" style="font-size: 15px;">{{ __('main.currency') }}</label>
                                <div class="input-group">
                                    <select class="custom-select w-100" id="currencySelectSidebar">
                                        <option value="IDR" selected>IDR - Indonesian Rupiah</option>
                                        <option value="USD">USD - United States Dollar</option>
                                        <option value="SGD">SGD - Singapore Dollar</option>
                                        <option value="MYR">MYR - Malaysian Ringgit</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <button type="button" class="btn btn-danger btn-block"
                                id="saveSettingBtnSidebar">{{ __('main.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <main class="col-12 offset-md-2 col-md-9 col-lg-10 px-md-4">
            @yield('main-content')
        </main>
    </div>

    @include('frontend.layouts.footer')

</body>

</html>
