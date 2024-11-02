@extends('frontend.layouts.master')

@section('title', 'Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <form class="form" method="POST" action="{{ route('cart.order') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>{{ __('main.make_your_checkout') }}</h2>
                            <p>{{ __('main.register_to_checkout') }}</p>
                            <!-- Form -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.first_name') }}<span>*</span></label>
                                        <input type="text" name="first_name" placeholder=""
                                            value="{{ old('first_name') }}" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.last_name') }}<span>*</span></label>
                                        <input type="text" name="last_name" placeholder="" value="{{ old('lat_name') }}">
                                        @error('last_name')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.email_address') }}<span>*</span></label>
                                        <input type="email" name="email" placeholder="" value="{{ old('email') }}">
                                        @error('email')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.phone_number') }} <span>*</span></label>
                                        <input type="number" name="phone" placeholder="" required
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.country') }}<span>*</span></label>
                                        <select id="country" class="nice-select" disabled>
                                            <option value="ID">Indonesia</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="SG">Singapore</option>
                                        </select>
                                        <!-- Hidden input to send the selected value -->
                                        <input type="hidden" name="country" id="selected_country">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.address_line') }} 1<span>*</span></label>
                                        <input type="text" name="address1" placeholder="" value="{{ old('address1') }}">
                                        @error('address1')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.address_line') }} 2</label>
                                        <input type="text" name="address2" placeholder="" value="{{ old('address2') }}">
                                        @error('address2')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.postal_code') }}</label>
                                        <input type="text" name="post_code" placeholder=""
                                            value="{{ old('post_code') }}">
                                        @error('post_code')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>{{ __('main.cart_totals') }}</h2>
                                <div class="content">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">
                                            {{ __('main.cart_subtotal') }}<span
                                                class="currency_convert">${{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                        </li>
                                        <li class="shipping">
                                            {{ __('main.shipping_cost') }}
                                            @if (count(Helper::shipping()) > 0 && Helper::cartCount() > 0)
                                                <select name="shipping" class="nice-select" id="shipping-select" required>
                                                    <option value="" disabled>Select your address</option>
                                                    @foreach (Helper::shipping() as $shipping)
                                                        <option value="{{ $shipping->id }}"
                                                            data-price="{{ $shipping->price }}">
                                                            {{ $shipping->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span>Free</span>
                                            @endif

                                        </li>

                                        @if (session('coupon'))
                                            <li class="coupon_price" data-price="{{ session('coupon')['value'] }}">
                                                {{ __('main.you_save') }}<span
                                                    class="currency_convert">{{ number_format(session('coupon')['value'], 2) }}</span>
                                            </li>
                                        @endif
                                        @php
                                            $total_amount = Helper::totalCartPrice();
                                            if (session('coupon')) {
                                                $total_amount = $total_amount - session('coupon')['value'];
                                            }
                                        @endphp
                                        @if (session('coupon'))
                                            <li class="last" id="order_total_price">
                                                Total<span
                                                    class="currency_convert">{{ number_format($total_amount, 2) }}</span>
                                            </li>
                                        @else
                                            <li class="last" id="order_total_price">
                                                Total<span
                                                    class="currency_convert">{{ number_format($total_amount, 2) }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>{{ __('main.payments') }}</h2>
                                <div class="content">
                                    <div class="checkbox">
                                        <form-group>
                                            {{-- <input name="payment_method"  type="radio" value="cod"> <label> Cash On Delivery</label><br> --}}
                                            {{-- <input name="payment_method"  type="radio" value="paypal"> <label> PayPal</label> --}}
                                            <h6>{{ __('main.account_number') }}: {{ env('NO_REKENING') }} (BCA) </h6>
                                        </form-group>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Payment Method Widget -->
                            <div class="single-widget payement">
                                <div class="content">
                                    {{--  <img src="{{ 'backend/img/payment-method.png' }}" alt="#">  --}}
                                    <img src="{{ 'backend/img/Bank_Central_Asia.svg' }}" alt="Logo BCA" width="80px">
                                </div>
                            </div>
                            <!--/ End Payment Method Widget -->
                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit"
                                            class="btn">{{ __('main.proceed_to_checkout') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Button Widget -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->

@endsection
@push('styles')
    <style>
        li.shipping {
            display: inline-flex;
            width: 100%;
            font-size: 14px;
        }

        li.shipping .input-group-icon {
            width: 100%;
            margin-left: 10px;
        }

        .input-group-icon .icon {
            position: absolute;
            left: 20px;
            top: 0;
            line-height: 40px;
            z-index: 3;
        }

        .form-select {
            height: 30px;
            width: 100%;
        }

        .form-select .nice-select {
            border: none;
            border-radius: 0px;
            height: 40px;
            background: #f6f6f6 !important;
            padding-left: 45px;
            padding-right: 40px;
            width: 100%;
        }

        .list li {
            margin-bottom: 0 !important;
        }

        .list li:hover {
            background: #F7941D !important;
            color: white !important;
        }

        .form-select .nice-select::after {
            top: 14px;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $("select.select2").select2();
            $('select.nice-select').niceSelect();

            // Ambil nilai dari localStorage
            var savedFlagCode = localStorage.getItem('flagCode') || 'ID';

            // Set nilai pada elemen select
            $('#country').val(savedFlagCode.toUpperCase()); // Trigger untuk memperbarui tampilan Select2
            $('#country').niceSelect('update');

            // Set nilai hidden input
            $('#selected_country').val($('#country').val()); // Menyimpan nilai yang sama di hidden input

            // Disable agar tidak dapat diubah
            $('#country').prop('disabled', true); // Disable untuk mencegah pengguna mengubah pilihan
        });
    </script>
    <script>
        function showMe(box) {
            var checkbox = document.getElementById('shipping').style.display;
            // alert(checkbox);
            var vis = 'none';
            if (checkbox == "none") {
                vis = 'block';
            }
            if (checkbox == "block") {
                vis = "none";
            }
            document.getElementById(box).style.display = vis;
        }
    </script>
    <script>
        $(document).ready(function() {
            const exchangeRates = {
                "USD": 1,
                "IDR": 15620, // Misalnya 1 USD = 15,000 IDR
                "SGD": 1.32, // Misalnya 1 USD = 1.37 SGD
                "MYR": 4.34 // Misalnya 1 USD = 4.18 MYR
            };

            const savedCurrency = localStorage.getItem('currency') || 'IDR';

            function convertCurrency(amount, fromCurrency, toCurrency) {
                if (fromCurrency === toCurrency) {
                    return amount;
                }
                let usdAmount = amount / exchangeRates[fromCurrency];
                return usdAmount * exchangeRates[toCurrency];
            }

            const currencySymbol = {
                "USD": "$",
                "IDR": "Rp",
                "SGD": "S$",
                "MYR": "RM"
            };

            $('#shipping-select option').each(function() {
                var price = convertCurrency($(this).data('price'), 'USD', savedCurrency);

                console.log($(this).text());
                console.log(price);

                if (price) {
                    $(this).text(
                        `${$(this).text()} - ${currencySymbol[savedCurrency]} ${price.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`
                    );
                }
            });

            $('#shipping-select').niceSelect('update');

            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;

                cost = convertCurrency(cost, 'USD', savedCurrency);
                subtotal = convertCurrency(subtotal, 'USD', savedCurrency);
                coupon = convertCurrency(coupon, 'USD', savedCurrency);

                $('#order_total_price span').text(
                    `${currencySymbol[savedCurrency]} ${(subtotal + cost - coupon).toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`
                );


            });
        });
    </script>
@endpush
