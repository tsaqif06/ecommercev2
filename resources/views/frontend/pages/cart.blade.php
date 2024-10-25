@extends('frontend.layouts.master')
@section('title', 'Cart Page')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ 'home' }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column: Cart Items -->
                <div class="col-lg-8 col-md-12 col-12">
                    <h4 class="my-cart-title">{{ __('main.my_cart') }} ({{ Helper::cartCount() }})</h4>
                    @if (!Helper::getAllProductFromCart()->isEmpty())
                        <div class="select-delete-all">
                            <a href="{{ route('cart.clear') }}" class="delete-all"
                                style="color: red; font-weight: bold;">{{ __('main.delete_all') }}</a>
                        </div>
                    @endif
                    <!-- Shopping Summary -->
                    <div class="cart-item-list">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            @if (!Helper::getAllProductFromCart()->isEmpty())
                                @foreach (Helper::getAllProductFromCart() as $key => $cart)
                                    <div class="cart-item">
                                        <div class="cart-item-body d-flex">
                                            <!-- Gambar Produk di Kiri -->
                                            <img src="{{ explode(',', $cart->product['photo'])[0] }}"
                                                alt="{{ $cart->product['title'] }}" class="product-image">

                                            <div class="product-info ml-3"> <!-- Tambahkan margin left -->
                                                <!-- Badge Low Stock di Atas -->
                                                @if ($cart->product['stock'] <= 3)
                                                    <span class="badge badge-danger mb-1">{{ __('main.low_stock') }}</span>
                                                @endif

                                                <!-- Judul Produk -->
                                                <h5 class="product-name">{{ $cart->product['title'] }}</h5>
                                                <!-- Harga Produk -->
                                                <h6 class="product-price currency_convert">
                                                    {{ number_format($cart['price'], 0) }}</h6>
                                            </div>
                                        </div>

                                        <!-- Kuantitas dan Tombol Hapus di Bawah -->
                                        <div class="qty d-flex justify-content-between align-items-center mt-3">
                                            <!-- Tambahkan margin top -->
                                            <div class="input-group" style="width: 150px; border: 0;">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-number" data-type="minus"
                                                        data-field="quant[{{ $key }}]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="quant[{{ $key }}]"
                                                    class="input-number" data-min="1" data-max="100"
                                                    value="{{ $cart->quantity }}">
                                                <input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-number" data-type="plus"
                                                        data-field="quant[{{ $key }}]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <a href="{{ route('cart-delete', $cart->id) }}" class="delete-item">
                                                <i class="ti-trash remove-icon" style="font-size: 20px;"></i>
                                            </a>
                                        </div>

                                        <!-- Peringatan Stok Rendah di Bawah -->
                                        @if ($cart->product['stock'] <= 3)
                                            <div class="low-stock-alert mt-2" style="border-radius: 5px; padding: 20px;">
                                                <!-- Tambahkan margin top -->
                                                <h6 style="text-align: left; font-weight: bold;">{{ __('main.only') }}
                                                    {{ $cart->product['stock'] }} {{ __('main.stock_left') }}</h6>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach

                                <div class="cart-actions">
                                    <button class="btn btn-outline-custom rounded"
                                        type="submit">{{ __('main.update_cart') }}</button>
                                </div>
                            @else
                                <h6>{{ __('main.your_cart_empty') }} <a href="{{ route('product-grids') }}"
                                        style="color:red;">{{ __('main.continue_shop') }}</a></h6>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Right Column: Checkout Summary -->
                <div class="col-lg-4 col-md-12 col-12 mt-lg-5">
                    <div class="checkout-summary right">
                        <h5>{{ __('main.checkout_summary') }}</h5>
                        <ul>
                            <li class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">
                                {{ __('main.cart_subtotal') }}<span class="currency_convert">
                                    {{ number_format(Helper::totalCartPrice(), 2) }}</span>
                            </li>
                            @if (session()->has('coupon'))
                                <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">
                                    {{ __('main.you_save') }}<span class="currency_convert">
                                        {{ number_format(Session::get('coupon')['value'], 2) }}</span>
                                </li>
                            @endif
                            @php
                                $total_amount = Helper::totalCartPrice();
                                if (session()->has('coupon')) {
                                    $total_amount = $total_amount - Session::get('coupon')['value'];
                                }
                            @endphp
                            <hr>
                            <li class="last" id="order_total_price">
                                {{ __('main.you_pay') }}<span
                                    class="currency_convert">{{ number_format($total_amount, 2) }}</span>
                            </li>
                        </ul>
                        <a href="{{ route('checkout') }}"
                            class="btn btn-custom rounded order-now-btn">{{ __('main.order_now') }}</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="title" style="margin: 0 0 5px 5px">
                        <h6>{{ __('main.coupon_redeem') }}</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="left">
                        <div class="coupon">
                            <form action="{{ route('coupon-store') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <!-- Gunakan kelas CSS untuk lebar tetap -->
                                    <input type="text" name="code" class="form-control fixed-width-input"
                                        placeholder="{{ __('main.enter_your_coupon') }}" aria-label="Coupon Code"
                                        style="border-radius: 15px 0 0 15px; padding-left: 15px;">

                                    <!-- Tombol Apply di sebelah kanan -->
                                    <div class="input-group-append">
                                        <button class="btn btn-custom" type="submit"
                                            style="border-radius: 0 15px 15px 0">{{ __('main.apply') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--/ End Shopping Cart -->

    <div class="product-area most-popular related-product section mt-5" style="margin-top: 100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('main.you_might_like') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach ($products as $product)
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('product-detail', $product->slug) }}">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        <img class="default-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                        <img class="hover-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                        <span class="price-dec">{{ $product->discount }} % Off</span>
                                    </a>
                                    <div class="button-head">
                                        <a href="{{ route('product-detail', $product->slug) }}"
                                            title="Quick View"><button class="btn btn-custom rounded"
                                                style="width: 100%">{{ __('main.buy') }}</button></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                    </h3>
                                    @php
                                        $after_discount =
                                            $product->price - ($product->discount * $product->price) / 100;
                                    @endphp
                                    <div class="product-price">
                                        <span class="old currency_convert">${{ number_format($product->price, 2) }}</span>
                                        <span class="currency_convert">${{ number_format($after_discount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


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

        <style>.shopping-cart {
            padding: 40px 0;
        }

        .my-cart-title {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .select-delete-all {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .discount-info {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .cart-item {
            background: white;
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 15px;
        }

        .cart-item-header {
            {{--  display: flex;
            align-items: center;
            justify-content: space-between;  --}}
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
            padding: 3px 7px;
            border-radius: 4px;
            font-size: 12px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-weight: bold;
        }

        .product-description {
            font-size: 12px;
            color: #777;
        }

        .product-price {
            font-weight: bold;
            color: #333;
        }

        .product-quantity {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        .btn-number {
            border: 1px solid #ccc;
            width: 30px;
            height: 30px;
            text-align: center;
        }

        .delete-item {
            color: #dc3545;
        }

        .low-stock-alert {
            background-color: #f8d7da;
            padding: 10px;
            color: #dc3545;
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }

        .checkout-summary {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #eee;
        }

        .checkout-summary h5 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .checkout-summary ul {
            list-style: none;
            padding: 0;
        }

        .checkout-summary ul li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .order-now-btn {
            display: block;
            width: 100%;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            color: white !important;
            margin-top: 25px !important;
        }

        .fixed-width-input {
            width: 150px !important;
            /* Pastikan lebar input adalah 150px */
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("select.select2").select2();
        });
        $('select.nice-select').niceSelect();
    </script>
    <script>
        $(document).ready(function() {
            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
            });

        });
    </script>
@endpush
