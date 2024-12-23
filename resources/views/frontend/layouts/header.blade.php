<div id="backdrop"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1001;">
</div>
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar bg-dark fixed-top" style="background-color: #121212; z-index: 9999">
        <div class="container">
            <div class="row my-2">
                <div class="col text-center">
                    <a href="{{ route('home') }}" style="cursor: pointer">
                        <h6 class="text-white">Darcey.ind</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar bg-transparent fixed-top" style="margin-top: 56px;">
        <div id="searchContainer"
            style="position: absolute; display: none; z-index: 1000; background: white; width: 100%; height: 60px;">
            <form action="{{ route('product.search') }}" method="POST" id="searchForm">
                @csrf
                <input type="text" id="searchInput" name="search" placeholder="{{ __('main.search_our_products') }}"
                    class="form-control"
                    style="width: 50%; height: 60px; position: absolute; top: 0; left: 50%; transform: translateX(-50%); padding-right: 50px; border-radius: 30px; padding-left: 20px; box-sizing: border-box;"
                    autofocus />
            </form>
            <span class="search-icon"
                style="position: absolute; top: 50%; right: 27%; transform: translateY(-50%); cursor: pointer; z-index: 1001;">
                <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="search icon"
                    style="width: 24px; height: 24px;">
            </span>
            <div id="suggestions" class="suggestions mt-2"
                style="display: none; position: absolute; top: 100%; left: 25%; width: 50%; background: white; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);">
                <!-- Suggestion items will be appended here -->
            </div>
        </div>


        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="col-auto">
                <i class="fas fa-bars sidebar-toggle mr-3 mt-2"
                    style="color: #121212; font-size: 26px; cursor: pointer;"></i>
            </div>

            <!-- Dropdown -->
            <div class="ml-auto">
                <div class="dropdown" style="height: 60px; display: flex; align-items: center;">
                    <div class="dropdown-navbar">
                        <a class="text-dark dropdown-toggle d-flex align-items-center" href="#"
                            id="dropdownSettings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="mr-1 h-4" src="{{ asset('storage/flags/id.svg') }}" id="flagSvgNavbar"
                                alt="Indonesia" style="width: 24px;">
                            <span class="mr-2 font-weight-bold" id="deliver-to-navbar">Indonesia</span>
                            <div class="p-divider mx-2"
                                style="width: 1px; height: 20px; background-color: var(--p-border-color);"></div>
                            <span class="mr-2 font-weight-bold" id="currencyType">IDR</span>
                            <span class="font-weight-bold" id="currencyTypeMoney">(Rp)</span>
                            <div class="p-divider mx-2"
                                style="width: 1px; height: 20px; background-color: var(--p-border-color);"></div>
                            <img src="data:image/png;base64,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"
                                alt="Language" width="18" class="mr-2 mt-1">
                            <span class="mr-2 font-weight-bold"
                                id="selectedLang">{{ strtoupper(session('applocale')) ?? 'EN' }}</span>
                            <svg data-v-baee0c8f="" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                width="24px" height="24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M17 9.17a1 1 0 0 0-1.41 0L12 12.71L8.46 9.17a1 1 0 0 0-1.41 0a1 1 0 0 0 0 1.42l4.24 4.24a1 1 0 0 0 1.42 0L17 10.59a1 1 0 0 0 0-1.42">
                                </path>
                            </svg>
                        </a>
                        <div class="dropdown-menu p-4 shadow-lg bg-white rounded-lg" style="width: 300px;">
                            <div>
                                <!-- Header Text -->
                                <div class="mb-1" style="font-size: 15px; font-weight: bold; word-wrap: none;">
                                    {{ __('main.region_language_currency') }}</div>
                                <div class="opacity-90" style="font-size: 13px; word-wrap: none;">
                                    {{ __('main.change_settings') }}</div>

                                <!-- Form Section -->
                                <div class="mt-4">
                                    <!-- Region Select -->
                                    <div class="mb-3">
                                        <label class="form-label"
                                            style="font-size: 15px;">{{ __('main.deliver_to') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <img src="{{ asset('storage/flags/id.svg') }}" id="flagSvgDropdown"
                                                    alt="Indonesia" width="24" class="mr-2 mt-1">
                                            </div>
                                            <select class="custom-select w-100" id="deliver-to" width="100%">
                                                <option value="id">Indonesia</option>
                                                <option value="my">Malaysia</option>
                                                <option value="sg">Singapore</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Language Select -->
                                    <div class="mb-3">
                                        <label class="form-label"
                                            style="font-size: 15px;">{{ __('main.language') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <img src="data:image/png;base64,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"
                                                    alt="Language" width="24" class="mr-2 mt-1">
                                            </div>
                                            <select class="custom-select w-100" id="langSelect" width="100%">
                                                <option value="en"
                                                    {{ session('applocale') == 'en' ? 'selected' : '' }}>
                                                    English</option>
                                                <option value="id"
                                                    {{ session('applocale') == 'id' ? 'selected' : '' }}>
                                                    Bahasa Indonesia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Currency Select -->
                                    <div class="mb-3">
                                        <label class="form-label"
                                            style="font-size: 15px;">{{ __('main.currency') }}</label>
                                        <div class="input-group">
                                            <select class="custom-select w-100" id="currencySelect">
                                                <option value="IDR" selected>IDR - Indonesian Rupiah</option>
                                                <option value="USD">USD - United States Dollar</option>
                                                <option value="SGD">SGD - Singapore Dollar</option>
                                                <option value="MYR">MYR - Malaysian Ringgit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <button type="button" class="btn btn-danger btn-block"
                                        id="saveSettingBtn">{{ __('main.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Section -->
                    <div class="sinlge-bar shopping mx-3" id="cart-header">
                        <a href="{{ route('cart') }}" class="single-icon">
                            <i class="ti-bag" style="font-size: 20px"></i>
                            <span class="total-count">{{ Helper::cartCount() }}</span>
                        </a>
                        <!-- Cart Dropdown -->
                        @auth
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>{{ count(Helper::getAllProductFromCart()) }} Items</span>
                                    <a href="{{ route('cart') }}">{{ __('main.view_cart') }}</a>
                                </div>
                                <ul class="shopping-list">
                                    @foreach (Helper::getAllProductFromCart() as $data)
                                        @php
                                            $photo = explode(',', $data->product['photo']);
                                        @endphp
                                        <li>
                                            <a href="{{ route('cart-delete', $data->id) }}" class="remove"
                                                title="Remove this item"><i class="fa fa-remove"></i></a>
                                            <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                    alt="{{ $photo[0] }}"></a>
                                            <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                    target="_blank">{{ $data->product['title'] }}
                                                    ( {{ $data->size }} )
                                                </a></h4>
                                            <p class="quantity">{{ $data->quantity }} x - <span
                                                    class="amount currency_convert">${{ number_format($data->price, 2) }}</span>
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span
                                            class="total-amount currency_convert">${{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                    </div>
                                    <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
                                </div>
                            </div>
                        @endauth
                        <!--/ End Cart Dropdown -->
                    </div>

                    <div class="text-dark text-p-default mx-3 searchToggle" style="cursor: pointer">
                        <i class="fas fa-search" style="font-size: 20px"></i> <!-- Ikon search -->
                    </div>

                    <!-- Tombol untuk profil -->
                    <a href="{{ route('user.order.index') }}" class="text-dark text-p-default mx-3"
                        style="cursor: pointer">
                        <i class="fas fa-user" style="font-size: 20px"></i> <!-- Ikon profile -->
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="notification-wrapper">
        <div class="notification success-notification" style="display: none;">
            <div>
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="message">
                {{ __('main.setting_success') }}
            </div>
        </div>
        <div class="notification error-notification" style="display: none;">
            <div>
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="message">
                {{ __('main.setting_fail') }}
            </div>
        </div>
    </div>


    <!-- End Topbar -->
    <div class="middle-inner mt-5 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings = DB::table('settings')->get();
                        @endphp
                        <a href="{{ route('home') }}"><img
                                src="@foreach ($settings as $data) {{ $data->logo }} @endforeach"
                                alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="{{ __('main.search_here') }}" name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option>All Category</option>
                                @foreach (Helper::getAllCategory() as $cat)
                                    <option>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{ route('product.search') }}">
                                @csrf
                                <input name="search" placeholder="{{ __('main.search_here') }}" type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            @php
                                $total_prod = 0;
                                $total_amount = 0;
                            @endphp
                            @if (session('wishlist'))
                                @foreach (session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod += $wishlist_items['quantity'];
                                        $total_amount += $wishlist_items['amount'];
                                    @endphp
                                @endforeach
                            @endif
                            <a href="{{ route('wishlist') }}" class="single-icon"><i class="fa fa-heart-o"></i>
                                <span class="total-count">{{ Helper::wishlistCount() }}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(Helper::getAllProductFromWishlist()) }} Items</span>
                                        <a href="{{ route('wishlist') }}">View Wishlist</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                        @foreach (Helper::getAllProductFromWishlist() as $data)
                                            @php
                                                $photo = explode(',', $data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{ route('wishlist-delete', $data->id) }}" class="remove"
                                                    title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}"></a>
                                                <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                        target="_blank">{{ $data->product['title'] }}
                                                        ({{ $data->product['size'] }})
                                                    </a></h4>
                                                <p class="quantity">{{ $data->quantity }} x - <span
                                                        class="amount">${{ number_format($data->price, 2) }}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span
                                                class="total-amount">${{ number_format(Helper::totalWishlistPrice(), 2) }}</span>
                                        </div>
                                        <a href="{{ route('cart') }}" class="btn animate">{{ __('main.cart') }}</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> --}}
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('cart') }}" class="single-icon"><i class="ti-bag"></i> <span
                                    class="total-count">{{ Helper::cartCount() }}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(Helper::getAllProductFromCart()) }} Items</span>
                                        <a href="{{ route('cart') }}">{{ __('main.view_cart') }}</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                        @foreach (Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo = explode(',', $data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{ route('cart-delete', $data->id) }}" class="remove"
                                                    title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}"></a>
                                                <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                        target="_blank">{{ $data->product['title'] }}
                                                        ({{ $data->product['size'] }})
                                                    </a></h4>
                                                <p class="quantity">{{ $data->quantity }} x - <span
                                                        class="amount">${{ number_format($data->price, 2) }}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span
                                                class="total-amount">${{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                        </div>
                                        <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



@push('scripts')
    <script>
        $(document).ready(function() {
            // Define flagCountry and currencyArr outside to reuse
            const flagCountry = {
                "id": 'Indonesia',
                "my": 'Malaysia',
                "sg": 'Singapore',
            };

            const currencyArr = {
                "IDR": '(RP)',
                "USD": '($)',
                "SGD": '(S$)',
                "MYR": '(RM)',
            };

            const exchangeRates = {
                "USD": 1,
                "IDR": 15620, // Misalnya 1 USD = 15,000 IDR
                "SGD": 1.32, // Misalnya 1 USD = 1.37 SGD
                "MYR": 4.34 // Misalnya 1 USD = 4.18 MYR
            };

            const assetUrl = "{{ asset('storage/flags') }}";

            var lastVisit = localStorage.getItem('lastVisit');
            var now = new Date().getTime();

            var timeDifference = lastVisit ? now - lastVisit : Infinity;

            var delayTime = 3600000;

            if (timeDifference > delayTime) {
                $.ajax({
                    url: '/set-language',
                    method: 'POST',
                    data: {
                        language: localStorage.getItem('language') || 'en',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Bahasa diubah ke: ' + language);
                        localStorage.setItem('lastVisit', now);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal mengubah bahasa:', error);
                        showToast('error');
                    }
                });
            }


            updateDisplayFromLocalStorage();
            updateTotalPrices();

            $('#status-filterorder').on('change', function() {
                var status = $(this).val();

                $.ajax({
                    url: '{{ route('user.order.index') }}',
                    type: 'GET',
                    data: {
                        status: status
                    },
                    success: function(data) {
                        $('#orders-list').html(data);
                        updateTotalPrices();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });

            // Function to update display based on settings
            function updateDisplayFromLocalStorage() {
                const savedFlagCode = localStorage.getItem('flagCode') || 'id';
                const savedLanguage = localStorage.getItem('language') || 'en';
                const savedCurrency = localStorage.getItem('currency') || 'IDR';

                // Update display with values from localStorage
                $('#flagSvgNavbar').attr('src', `${assetUrl}/${savedFlagCode}.svg`);
                $('#flagSvgDropdown').attr('src', `${assetUrl}/${savedFlagCode}.svg`);
                $('#deliver-to-navbar').text(flagCountry[savedFlagCode]);
                $('#selectedLang').text(savedLanguage.toLowerCase());
                $('#currencyType').text(savedCurrency);
                $('#currencyTypeMoney').text(currencyArr[savedCurrency]);

                $('#deliver-to').val(savedFlagCode);
                $('#langSelect').val(savedLanguage);
                $('#currencySelect').val(savedCurrency);

                $('#deliver-to').niceSelect('update');
                $('#langSelect').niceSelect('update');
                $('#currencySelect').niceSelect('update');


                $('#flagSvgSidebar').attr('src', `${assetUrl}/${savedFlagCode}.svg`);
                $('#flagSvgDropdownSidebar').attr('src', `${assetUrl}/${savedFlagCode}.svg`);
                $('#deliver-to-navbarsidebar').text(flagCountry[savedFlagCode]);
                $('#selectedLangSidebar').text(savedLanguage.toLowerCase());
                $('#currencyTypeSidebar').text(savedCurrency);
                $('#currencyTypeMoneySidebar').text(currencyArr[savedCurrency]);

                $('#deliver-tosidebar').val(savedFlagCode);
                $('#langSelectSidebar').val(savedLanguage);
                $('#currencySelectSidebar').val(savedCurrency);

                $('#deliver-tosidebar').niceSelect('update');
                $('#langSelectSidebar').niceSelect('update');
                $('#currencySelectSidebar').niceSelect('update');
            }

            // Fungsi untuk mengonversi mata uang
            function convertCurrency(amount, fromCurrency, toCurrency) {
                if (fromCurrency === toCurrency) {
                    return amount;
                }
                let usdAmount = amount / exchangeRates[fromCurrency];
                return usdAmount * exchangeRates[toCurrency];
            }

            function updateTotalPrices() {
                const selectedCurrency = localStorage.getItem('currency') || 'USD';


                $('.currency_convert').each(function() {
                    // Check if the element is an input
                    let originalAmount;
                    if ($(this).is('input')) {
                        // Get the value from input (remove symbols like $ and commas)
                        originalAmount = parseFloat($(this).val().replace(/[$,]/g, ''));
                    } else {
                        // Get the text for non-input elements
                        originalAmount = parseFloat($(this).text().replace(/[$,]/g, ''));
                    }

                    if (isNaN(originalAmount)) {
                        originalAmount = 0; // Default to 0 if parsing fails
                    }

                    // Perform currency conversion
                    let convertedAmount = convertCurrency(originalAmount, 'USD', selectedCurrency);

                    const currencySymbol = {
                        "USD": "$",
                        "IDR": "Rp",
                        "SGD": "S$",
                        "MYR": "RM"
                    };

                    // Update the element with the converted amount
                    if ($(this).is('input')) {
                        // If it's an input, update its value without the symbol
                        $(this).val(
                            `${convertedAmount.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`
                        );
                    } else {
                        // If it's not an input, update the text content with the symbol
                        $(this).text(
                            `${currencySymbol[selectedCurrency]} ${convertedAmount.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`
                        );
                    }
                });
            }

            $(window).scroll(function() {
                if ($(this).scrollTop() > 0) {
                    $('.navbar').removeClass('bg-transparent').addClass('bg-white');
                } else {
                    $('.navbar').removeClass('bg-white').addClass('bg-transparent');
                }
            });

            // Update flag image in dropdown when changing deliver-to option
            $('#deliver-to').on('change', function() {
                let flagCode = $('#deliver-to').val();
                $('#flagSvgDropdown').attr('src', `${assetUrl}/${flagCode}.svg`);
            });

            $('#deliver-tosidebar').on('change', function() {
                let flagCode = $('#deliver-tosidebar').val();
                $('#flagSvgDropdownSidebar').attr('src', `${assetUrl}/${flagCode}.svg`);
            });

            // Save settings when the Save button is clicked
            $('#saveSettingBtn').on('click', function() {
                let flagCode = $('#deliver-to').val();
                let language = $('#langSelect').val();
                let currency = $('#currencySelect').val();

                const previousLanguage = localStorage.getItem('language') || 'en';
                const previousCurrency = localStorage.getItem('currency') || 'idr';

                localStorage.setItem('flagCode', flagCode);
                localStorage.setItem('language', language);
                localStorage.setItem('currency', currency);

                // Update display with the saved values directly from localStorage
                updateDisplayFromLocalStorage();
                updateTotalPrices();

                if (currency !== previousCurrency) {
                    location.reload();
                } else if (language !== previousLanguage) {
                    $.ajax({
                        url: '/set-language',
                        method: 'POST',
                        data: {
                            language: language,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Bahasa diubah ke: ' + language);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error('Gagal mengubah bahasa:', error);
                            showToast('error');
                        }
                    });
                } else {
                    showToast('success');
                }
            });

            $('#saveSettingBtnSidebar').on('click', function() {
                let flagCode = $('#deliver-tosidebar').val();
                let language = $('#langSelectSidebar').val();
                let currency = $('#currencySelectSidebar').val();

                const previousLanguage = localStorage.getItem('language') || 'en';


                localStorage.setItem('flagCode', flagCode);
                localStorage.setItem('language', language);
                localStorage.setItem('currency', currency);

                // Update display with the saved values directly from localStorage
                updateDisplayFromLocalStorage();
                updateTotalPrices();

                if (language !== previousLanguage) {
                    $.ajax({
                        url: '/set-language',
                        method: 'POST',
                        data: {
                            language: language,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Bahasa diubah ke: ' + language);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error('Gagal mengubah bahasa:', error);
                            showToast('error');
                        }
                    });
                } else {
                    showToast('success');
                }
            });

            function showToast(type) {
                const notification = type === 'success' ? $('.success-notification') : $('.error-notification');

                // Tampilkan notifikasi
                notification.css('display', 'flex');

                // Sembunyikan notifikasi setelah 3 detik
                setTimeout(function() {
                    notification.css('display', 'none');
                }, 3000);
            }


            // Event for closing dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                    $('.dropdown-toggle').attr('aria-expanded', 'false');
                }
            });

            // Toggle dropdown
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                $(this).next('.dropdown-menu').toggleClass('show');
            });

            // Modal for search
            $('[data-toggle="modal"][data-target="#searchModal"]').on('click', function() {
                $('#searchModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Sidebar toggle for mobile
            $('.sidebar-toggle').on('click', function() {
                $('.sidebar').toggleClass('active');
                $('.sidebar-close').toggle($('.sidebar').hasClass(
                    'active')); // Tampilkan atau sembunyikan tombol close
            });

            // Close sidebar when clicking the close icon
            $('.sidebar-close').on('click', function() {
                $('.sidebar').removeClass('active');
                $(this).hide(); // Sembunyikan tombol close saat sidebar ditutup
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.sidebar, .sidebar-toggle').length) {
                    $('.sidebar').removeClass('active');
                    $('.sidebar-close').hide(); // Sembunyikan tombol close saat sidebar ditutup
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Toggle the search container and backdrop
            $('.searchToggle').on('click', function() {
                $('#cart-header').toggle();
                $('#searchContainer').toggle();
                $('#backdrop').toggle(); // Show/hide the backdrop
                $('#searchInput').focus(); // Focus on the search input
            });

            // Hide search and backdrop when clicking outside the search area
            $('#backdrop').on('click', function() {
                $('#cart-header').toggle();
                $('#searchContainer').hide();
                $('#backdrop').hide();
            });

            var suggestions = @json(Helper::getAllProductsForSuggestions());

            // Get recent search history from localStorage
            function getSearchHistory() {
                return JSON.parse(localStorage.getItem('searchHistory')) || [];
            }

            // Save a new search term to localStorage
            function saveSearchTerm(term) {
                let history = getSearchHistory();
                if (!history.includes(term)) {
                    history.push(term);
                    localStorage.setItem('searchHistory', JSON.stringify(history));
                }
            }

            // Display recent searches when the input is empty
            function showRecentSearches() {
                var suggestionsBox = $('#suggestions');
                suggestionsBox.empty();

                var history = getSearchHistory();

                if (history.length > 0) {
                    suggestionsBox.append(`
                        <div class="suggestion-header d-flex justify-content-between" style="padding: 10px; font-weight: bold;">
                            <span>{{ __('main.recent_search') }}</span>
                            <span class="clear-history" style="cursor: pointer; color: red;">{{ __('main.delete_all') }}</span>
                        </div>
                    `);

                    history.forEach(function(term) {
                        var historyItem = $(`
                            <div class="badge bg-danger text-white d-inline-flex align-items-center m-2 rounded"
                                style="cursor: pointer; font-size: 1.1rem; padding: 3px 10px;">
                                <span class="search-term">${term}</span>
                                <span class="remove-history ml-3" style="cursor: pointer; font-size: 1.3rem;">&times;</span>
                            </div>
                        `);

                        // Navigate to the search results page when the term is clicked
                        historyItem.find('.search-term').on('click', function() {
                            $('#searchForm').submit();
                        });

                        // Remove individual history item
                        historyItem.find('.remove-history').on('click', function(e) {
                            e.stopPropagation(); // Prevent triggering the parent click
                            removeSearchTerm(term);
                            showRecentSearches();
                        });

                        suggestionsBox.append(historyItem);
                    });

                    suggestionsBox.show();
                }
            }

            // Remove a specific search term from history
            function removeSearchTerm(term) {
                let history = getSearchHistory();
                history = history.filter(item => item !== term);
                localStorage.setItem('searchHistory', JSON.stringify(history));
            }

            // Clear all search history
            $(document).on('click', '.clear-history', function() {
                localStorage.removeItem('searchHistory');
                showRecentSearches();
            });

            // Show suggestions or recent searches as the user types
            $('#searchInput').on('input', function() {
                var input = $(this).val();
                if (input.length === 0) {
                    showRecentSearches(); // Show recent searches if input is empty
                } else {
                    performSearch(input);
                }
            });

            // Perform search and show matching suggestions
            function performSearch(input) {
                var suggestionsBox = $('#suggestions');
                suggestionsBox.empty();

                var matches = suggestions.filter(function(suggestion) {
                    return suggestion.name.toLowerCase().includes(input.toLowerCase());
                });

                suggestionsBox.append(
                    '<div class="suggestion-header" style="padding: 10px; font-weight: bold;">Products</div>'
                );

                if (matches.length > 0) {
                    suggestionsBox.append(
                        '<div class="suggestion-footer" style="padding: 10px; font-style: italic;">' + matches
                        .length + ' {{ __('main.results_found') }}</div>'
                    );

                    $.each(matches, function(index, suggestion) {
                        var suggestionItem = $('<div class="suggestion-item d-flex"></div>');

                        // HTML untuk gambar dan teks
                        var suggestionContent = `
                            <div class="suggestion-image" style="flex-shrink: 0;">
                                <img src="${suggestion.photo}" alt="${suggestion.name}" style="width: 60px; height: 60px; object-fit: cover;">
                            </div>
                            <div class="suggestion-text" style="margin-left: 10px;">
                                <strong>${suggestion.name}</strong><br>
                            </div>
                        `;

                        // Apply HTML and style
                        suggestionItem.html(suggestionContent).css({
                            padding: '10px',
                            cursor: 'pointer',
                            borderBottom: '1px solid #ddd',
                            display: 'flex',
                            alignItems: 'center' // Align image and text vertically
                        });

                        // Append suggestionItem to the parent container (assuming you have a container)
                        // Handle click event to redirect to product page and save the search term
                        suggestionItem.on('click', function() {
                            $('#searchInput').val(suggestion.name);
                            saveSearchTerm(suggestion.name); // Save to search history
                            window.location.href =
                                `/product-detail/${suggestion.slug}`; // Navigate to the product page
                        });

                        suggestionsBox.append(suggestionItem);
                    });
                } else {
                    suggestionsBox.append(
                        '<div class="no-results" style="padding: 10px; color: gray;">0 {{ __('main.results_found') }}</div>'
                    );
                    suggestionsBox.append(
                        '<div class="no-results-message" style="padding: 10px; color: gray;">{{ __('main.no_results') }} “' +
                        input + '”</div>'
                    );
                }

                suggestionsBox.show();
            }

            // Handle pressing Enter to search
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    var input = $(this).val().trim();
                    if (input) {
                        saveSearchTerm(input);
                        $('#searchForm').submit();
                    }
                }
            });

            // Handle click on the search icon
            $('.search-icon').on('click', function() {
                var input = $('#searchInput').val().trim();
                if (input) {
                    saveSearchTerm(input);
                }
            });

            // Show recent searches when input is focused
            $('#searchInput').on('focus', function() {
                if ($(this).val().trim().length === 0) {
                    showRecentSearches();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.countdown').each(function() {
                var endTime = new Date($(this).data('endtime')).getTime();

                var interval = setInterval(() => {
                    var now = new Date().getTime();
                    var timeLeft = endTime - now;

                    // Menghitung waktu dalam hari, jam, menit dan detik
                    var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    // Tampilkan hasil di elemen
                    $(this).find('.days').text(String(days).padStart(2, '0'));
                    $(this).find('.hours').text(String(hours).padStart(2, '0'));
                    $(this).find('.minutes').text(String(minutes).padStart(2, '0'));
                    $(this).find('.seconds').text(String(seconds).padStart(2, '0'));

                    // Jika waktu habis, stop countdown
                    if (timeLeft < 0) {
                        clearInterval(interval);
                        $(this).find('.days').text('00');
                        $(this).find('.hours').text('00');
                        $(this).find('.minutes').text('00');
                        $(this).find('.seconds').text('00');
                    }
                }, 1000);
            });
        });
    </script>
@endpush
