<div id="backdrop"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1001;">
</div>
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar bg-dark fixed-top" style="background-color: #121212; z-index: 9999">
        <div class="container">
            <div class="row my-2">
                <div class="col text-center">
                    <h6 class="text-white">Hecate Official Website</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar bg-transparent fixed-top" style="margin-top: 56px;">
        <div id="searchContainer"
            style="position: absolute; display: none; z-index: 1000; background: white; width: 100%; height: 60px;">
            <input type="text" id="searchInput" placeholder="Search our products..." class="form-control"
                style="width: 50%; height: 60px; position: absolute; top: 0; left: 50%; transform: translateX(-50%); padding-right: 50px; border-radius: 30px; padding-left: 20px; box-sizing: border-box;"
                autofocus />
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
            <button class="sidebar-toggle d-md-none">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Logo -->
            <div class="col-auto">
                <img src="storage/logo.webp" class="flex-0-0 object-contain"
                    style="max-width:100%; height:44px; width:auto;" alt="Logo of Hecates.official">
            </div>

            <!-- Dropdown -->
            <div class="ml-auto">
                <div class="dropdown" style="height: 60px; display: flex; align-items: center;">
                    <a class="text-dark dropdown-toggle d-flex align-items-center" href="#" id="dropdownSettings"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="mr-1 h-4" src="storage/flags/id.svg" id="flagSvgNavbar" alt="Indonesia"
                            style="width: 24px;">
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
                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="24px"
                            height="24px" viewBox="0 0 24 24">
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
                                    <label class="form-label" style="font-size: 15px;">Deliver to</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <img src="storage/flags/id.svg" id="flagSvgDropdown" alt="Indonesia"
                                                width="24" class="mr-2 mt-1">
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
                                    <label class="form-label" style="font-size: 15px;">Language</label>
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
                                    <label class="form-label" style="font-size: 15px;">Currency</label>
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

                    <div class="text-dark text-p-default mx-3" data-toggle="modal" data-target="#sortModal"
                        style="cursor: pointer">
                        <i class="fa-solid fa-arrow-up-wide-short" style="font-size: 20px"></i>
                    </div>

                    <div class="text-dark text-p-default mx-3 searchToggle" style="cursor: pointer">
                        <i class="fas fa-search" style="font-size: 20px"></i> <!-- Ikon search -->
                    </div>

                    <!-- Tombol untuk profil -->
                    <a href="/profile" class="text-dark text-p-default mx-3" style="cursor: pointer">
                        <i class="fas fa-user" style="font-size: 20px"></i> <!-- Ikon profile -->
                    </a>
                </div>

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
                                <input type="text" placeholder="Search here..." name="search">
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
                                <input name="search" placeholder="Search Products Here....." type="search">
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
                                                        target="_blank">{{ $data->product['title'] }}</a></h4>
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
                                        <a href="{{ route('cart') }}" class="btn animate">Cart</a>
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
                                        <a href="{{ route('cart') }}">View Cart</a>
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
                                                        target="_blank">{{ $data->product['title'] }}</a></h4>
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
    {{--  <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{ Request::path() == 'home' ? 'active' : '' }}"><a
                                                    href="{{ route('home') }}">Home</a></li>
                                            <li class="{{ Request::path() == 'about-us' ? 'active' : '' }}"><a
                                                    href="{{ route('about-us') }}">About Us</a></li>
                                            <li class="@if (Request::path() == 'product-grids' || Request::path() == 'product-lists') active @endif"><a
                                                    href="{{ route('product-grids') }}">Products</a><span
                                                    class="new">New</span></li>
                                            {{ Helper::getHeaderCategory() }}
                                            <li class="{{ Request::path() == 'blog' ? 'active' : '' }}"><a
                                                    href="{{ route('blog') }}">Blog</a></li>

                                            <li class="{{ Request::path() == 'contact' ? 'active' : '' }}"><a
                                                    href="{{ route('contact') }}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!--/ End Header Inner -->
</header>

<div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content container-fluid rounded" style="width: 500px; height: 400px">
            <div class="modal-body">
                <h5 class="modal-title mt-2" id="sortModalLabel">Sort Products By</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Tombol atas -->
                <div class="d-flex mb-3">
                    <button type="button" class="btn btn-outline-custom rounded">All</button>
                    <button type="button" class="btn btn-outline-custom rounded">Available</button>
                </div>

                <!-- Tombol pilihan di bawah -->
                <button type="button" class="btn btn-sort">Featured</button>
                <button type="button" class="btn btn-sort">Recent</button>
                <button type="button" class="btn btn-sort">Oldest</button>
                <button type="button" class="btn btn-sort">Most Popular</button>
                <button type="button" class="btn btn-sort">Lowest Price</button>
                <button type="button" class="btn btn-sort">Highest Price</button>
                <button type="button" class="btn btn-sort">Product Name (A-Z)</button>
            </div>
        </div>
    </div>
</div>

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
            updateDisplayFromLocalStorage();

            // Function to update display based on settings
            function updateDisplayFromLocalStorage() {
                const savedFlagCode = localStorage.getItem('flagCode') || 'id';
                const savedLanguage = localStorage.getItem('language') || 'en';
                const savedCurrency = localStorage.getItem('currency') || 'IDR';

                // Update display with values from localStorage
                $('#flagSvgNavbar').attr('src', `storage/flags/${savedFlagCode}.svg`);
                $('#flagSvgDropdown').attr('src', `storage/flags/${savedFlagCode}.svg`);
                $('#deliver-to-navbar').text(flagCountry[savedFlagCode]);
                $('#selectedLang').text(savedLanguage.toLowerCase());
                $('#currencyType').text(savedCurrency);
                $('#currencyTypeMoney').text(currencyArr[savedCurrency]);

                // Update form values to match the saved settings
                $('#deliver-to').val(savedFlagCode);
                $('#langSelect').val(savedLanguage);
                $('#currencySelect').val(savedCurrency);

                $('#deliver-to').val(savedFlagCode);
                $('#langSelect').val(savedLanguage);
                $('#currencySelect').val(savedCurrency);

                $('#deliver-to').niceSelect('update');
                $('#langSelect').niceSelect('update');
                $('#currencySelect').niceSelect('update');
            }


            // Load settings from localStorage on page load

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
                $('#flagSvgDropdown').attr('src', `storage/flags/${flagCode}.svg`);
            });

            // Save settings when the Save button is clicked
            $('#saveSettingBtn').on('click', function() {
                let flagCode = $('#deliver-to').val();
                let language = $('#langSelect').val();
                let currency = $('#currencySelect').val();

                localStorage.setItem('flagCode', flagCode);
                localStorage.setItem('language', language);
                localStorage.setItem('currency', currency);

                // Update display with the saved values directly from localStorage
                updateDisplayFromLocalStorage();

                // AJAX request to update language on the server
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
                    }
                });
            });

            // Event for closing dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                    $('.dropdown-toggle').attr('aria-expanded', 'false');
                }
            });

            // Sidebar toggle
            $('.sidebar-toggle').on('click', function() {
                $('.sidebar').toggleClass('active');
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
            // Toggle the search container and backdrop
            $('.searchToggle').on('click', function() {
                $('#searchContainer').toggle();
                $('#backdrop').toggle(); // Show/hide the backdrop
                $('#searchInput').focus(); // Focus on the search input
            });

            // Hide search and backdrop when clicking outside the search area
            $('#backdrop').on('click', function() {
                $('#searchContainer').hide();
                $('#backdrop').hide();
            });

            // Sample product suggestions for demonstration
            var suggestions = [{
                    name: "HECATE - GOSA LEATHER JACKET (SYNTH)",
                    price: "Rp 1,000,000",
                    slug: "hecate-gosa-leather-jacket-synth"
                },
                {
                    name: "HECATE - GOSA GENUINE LEATHER JACKET",
                    price: "Rp 2,599,000",
                    slug: "hecate-gosa-genuine-leather-jacket"
                },
                {
                    name: "HECATE - DISTRESSED ROGUE HOODIE FADED",
                    price: "Rp 895,000",
                    slug: "hecate-distressed-rogue-hoodie-faded"
                },
                {
                    name: "HECATE - PHRASE FLANNEL | KEMEJA UNISEX",
                    price: "Rp 500,000",
                    slug: "hecate-phrase-flannel-kemeja-unisex"
                },
                {
                    name: "HECATE - GIVEN TSHIRT | KAOS UNISEX",
                    price: "Rp 300,000",
                    slug: "hecate-given-tshirt-kaos-unisex"
                }
            ];

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
                            <span>Recent Search</span>
                            <span class="clear-history" style="cursor: pointer; color: red;">Delete All</span>
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
                            window.location.href = `/products?search=${term}`;
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
                        .length + ' Results Found</div>'
                    );

                    $.each(matches, function(index, suggestion) {
                        var suggestionItem = $('<div class="suggestion-item"></div>')
                            .html('<strong>' + suggestion.name + '</strong><br><span>' + suggestion.price +
                                '</span>')
                            .css({
                                padding: '10px',
                                cursor: 'pointer',
                                borderBottom: '1px solid #ddd'
                            });

                        // Handle click event to redirect to product page and save the search term
                        suggestionItem.on('click', function() {
                            $('#searchInput').val(suggestion.name);
                            saveSearchTerm(suggestion.name); // Save to search history
                            window.location.href =
                                `/product/${suggestion.slug}`; // Navigate to the product page
                        });

                        suggestionsBox.append(suggestionItem);
                    });
                } else {
                    suggestionsBox.append(
                        '<div class="no-results" style="padding: 10px; color: gray;">0 Results Found</div>'
                    );
                    suggestionsBox.append(
                        '<div class="no-results-message" style="padding: 10px; color: gray;">Ups, sorry no results for “' +
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
                        window.location.href = `/products?search=${input}`;
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
@endpush
