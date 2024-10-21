@extends('frontend.layouts.master')

@section('title', 'E-SHOP || PRODUCT PAGE')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Shop Grid</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Style -->
    <form action="{{ route('shop.filter') }}" method="POST">
        @csrf
        <section class="product-area shop-sidebar shop section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="shop-sidebar">
                            <!-- Single Widget -->
                            <div class="single-widget category" style="margin-bottom: -20px;">
                                <div class="searchToggle btn-sidebar" style="cursor: pointer">
                                    <i class="fas fa-search" style="font-size: 20px; color: #121212; cursor: pointer;"></i>
                                    <span class="ml-1" style="font-size: 15px; font-weight: bold;">Search</span>
                                </div>
                                <a href="{{ route('product-grids') }}" class="btn btn-sidebar"
                                    style="font-size: 14px; font-weight: bold; color: #121212">All Product</a>
                            </div>
                            <!--/ End Single Widget -->
                            <hr>
                            <!-- Shop By Price -->
                            <div class="single-widget range" style="margin-top: -20px;">
                                <h3 class="title" style="border: 0;">Price</h3>
                                <div class="price-filter" style="margin-top: -30px;">
                                    <div class="price-filter-inner">
                                        @php
                                            $max = DB::table('products')->max('price');
                                        @endphp
                                        <div id="slider-range" data-min="0" data-max="{{ $max }}"></div>
                                        <div class="product_filter mt-5">
                                            <div class="form-floating-custom mb-3 position-relative">
                                                <input type="text" class="form-control price-input" placeholder=" "
                                                    id="min_price" name="min_price" required>
                                                <label for="min_price">Minimum Price</label>
                                                <span class="currency-label">IDR</span>
                                            </div>
                                            <div class="form-floating-custom mb-3 position-relative">
                                                <input type="text" class="form-control price-input" placeholder=" "
                                                    id="max_price" name="max_price" required>
                                                <label for="max_price">Maximum Price</label>
                                                <span class="currency-label">IDR</span>
                                            </div>
                                            <button type="submit" class="btn btn-custom mt-2"
                                                style="width: 100%; border-radius: 10px;">Apply</button>
                                            <input type="hidden" name="price_range" id="price_range"
                                                value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Shop By Price -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!-- Shop Top -->
                                <div class="shop-top">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Show :</label>
                                            <select class="show" name="show" onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="9" @if (!empty($_GET['show']) && $_GET['show'] == '9') selected @endif>09
                                                </option>
                                                <option value="15" @if (!empty($_GET['show']) && $_GET['show'] == '15') selected @endif>15
                                                </option>
                                                <option value="21" @if (!empty($_GET['show']) && $_GET['show'] == '21') selected @endif>21
                                                </option>
                                                <option value="30" @if (!empty($_GET['show']) && $_GET['show'] == '30') selected @endif>30
                                                </option>
                                            </select>
                                        </div>
                                        <div class="single-shorter">
                                            <label>Sort By :</label>
                                            <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="title" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'title') selected @endif>
                                                    Name</option>
                                                <option value="price" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'price') selected @endif>
                                                    Price</option>
                                                <option value="category" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'category') selected @endif>
                                                    Category</option>
                                                <option value="brand" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'brand') selected @endif>
                                                    Brand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <ul class="view-mode">
                                        <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-large"></i></a>
                                        </li>
                                        <li><a href="{{ route('product-lists') }}"><i class="fa fa-th-list"></i></a></li>
                                    </ul>
                                </div>
                                <!--/ End Shop Top -->
                            </div>
                        </div>
                        <div class="row">
                            {{-- {{$products}} --}}
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('product-detail', $product->slug) }}">
                                                    @php
                                                        $photo = explode(',', $product->photo);
                                                    @endphp
                                                    <img class="default-img" src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}">
                                                    <img class="hover-img" src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}">
                                                    @if ($product->discount)
                                                        <span class="price-dec">{{ $product->discount }} % Off</span>
                                                    @endif
                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#{{ $product->id }}"
                                                            title="Quick View" href="#"><i
                                                                class=" ti-eye"></i><span>Quick Shop</span></a>
                                                        <a title="Wishlist"
                                                            href="{{ route('add-to-wishlist', $product->slug) }}"
                                                            class="wishlist" data-id="{{ $product->id }}"><i
                                                                class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                    </div>
                                                    <div class="product-action-2">
                                                        <a title="Add to cart"
                                                            href="{{ route('add-to-cart', $product->slug) }}">Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a
                                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                                </h3>
                                                @php
                                                    $after_discount =
                                                        $product->price - ($product->price * $product->discount) / 100;
                                                @endphp
                                                <span>${{ number_format($after_discount, 2) }}</span>
                                                <del
                                                    style="padding-left:4%;">${{ number_format($product->price, 2) }}</del>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
                            @endif



                        </div>
                        <div class="row">
                            <div class="col-md-12 justify-content-center d-flex">
                                {{ $products->appends($_GET)->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </form>

    <!--/ End Product Style 1  -->



    <!-- Modal -->
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

    @if ($products)
        @foreach ($products as $key => $product)
            <div class="modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Product Slider -->
                                    <div class="product-gallery">
                                        <div class="quickview-slider-active">
                                            @php
                                                $photo = explode(',', $product->photo);
                                                // dd($photo);
                                            @endphp
                                            @foreach ($photo as $data)
                                                <div class="single-slider">
                                                    <img src="{{ $data }}" alt="{{ $data }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{ $product->title }}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    {{-- <i class="yellow fa fa-star"></i>
                                                        <i class="yellow fa fa-star"></i>
                                                        <i class="yellow fa fa-star"></i>
                                                        <i class="yellow fa fa-star"></i>
                                                        <i class="fa fa-star"></i> --}}
                                                    @php
                                                        $rate = DB::table('product_reviews')
                                                            ->where('product_id', $product->id)
                                                            ->avg('rate');
                                                        $rate_count = DB::table('product_reviews')
                                                            ->where('product_id', $product->id)
                                                            ->count();
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($rate >= $i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{ $rate_count }} customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if ($product->stock > 0)
                                                    <span><i class="fa fa-check-circle-o"></i> {{ $product->stock }} in
                                                        stock</span>
                                                @else
                                                    <span><i class="fa fa-times-circle-o text-danger"></i>
                                                        {{ $product->stock }} out stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount =
                                                $product->price - ($product->price * $product->discount) / 100;
                                        @endphp
                                        <h3><small><del
                                                    class="text-muted">${{ number_format($product->price, 2) }}</del></small>
                                            ${{ number_format($after_discount, 2) }} </h3>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if ($product->size)
                                            <div class="size">
                                                <h4>Size</h4>
                                                <ul>
                                                    @php
                                                        $sizes = explode(',', $product->size);
                                                        // dd($sizes);
                                                    @endphp
                                                    @foreach ($sizes as $size)
                                                        <li><a href="#" class="one">{{ $size }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="size">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <h5 class="title">Size</h5>
                                                    <select>
                                                        @php
                                                            $sizes = explode(',', $product->size);
                                                            // dd($sizes);
                                                        @endphp
                                                        @foreach ($sizes as $size)
                                                            <option>{{ $size }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <div class="col-lg-6 col-12">
                                                        <h5 class="title">Color</h5>
                                                        <select>
                                                            <option selected="selected">orange</option>
                                                            <option>purple</option>
                                                            <option>black</option>
                                                            <option>pink</option>
                                                        </select>
                                                    </div> --}}
                                            </div>
                                        </div>
                                        <form action="{{ route('single-add-to-cart') }}" method="POST">
                                            @csrf
                                            <div class="quantity">
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                            disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="slug" value="{{ $product->slug }}">
                                                    <input type="text" name="quant[1]" class="input-number"
                                                        data-min="1" data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                            data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </div>
                                            <div class="add-to-cart">
                                                <button type="submit" class="btn">Add to cart</button>
                                                <a href="{{ route('add-to-wishlist', $product->slug) }}"
                                                    class="btn min"><i class="ti-heart"></i></a>
                                            </div>
                                        </form>
                                        <div class="default-social">
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- Modal end -->

@endsection
@push('styles')
    <style>
        .pagination {
            display: inline-flex;
        }

        .filter_button {
            /* height:20px; */
            text-align: center;
            background: #F7941D;
            padding: 8px 16px;
            margin-top: 10px;
            color: white;
        }

        .form-floating-custom {
            position: relative;
            margin-bottom: 15px;
        }

        .form-floating-custom .price-input {
            width: 100%;
            padding-left: 55px;
            /* Space for "IDR" label */
            padding-top: 27px;
            /* Adjust for label height */
            height: 50px;
            border-radius: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .form-floating-custom .price-input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-floating-custom label {
            position: absolute;
            top: 10px;
            /* Lowered position for label */
            left: 55px;
            /* Align with the start of the input text */
            transition: all 0.2s ease;
            /* Background to overlap the input border */
            padding: 0 5px;
            color: #6c757d;
            font-size: 14px;
            pointer-events: none;
            font-weight: bold;
        }

        /* Adjust the label when input is focused or has content */
        .form-floating-custom .price-input:focus+label,
        .form-floating-custom .price-input:not(:placeholder-shown)+label {
            top: 5px;
            /* Lowered position when floating */
            font-size: 12px;
            color: #007bff;
            padding: 0 5px;
            background: #fff;
        }

        /* "IDR" label positioning */
        .form-floating-custom .currency-label {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            /*----------------------------------------------------*/
            /*  Jquery Ui slider js
            /*----------------------------------------------------*/
            if ($("#slider-range").length > 0) {
                const max_value = parseInt($("#slider-range").data('max')) || 500;
                const min_value = parseInt($("#slider-range").data('min')) || 0;
                const currency = $("#slider-range").data('currency') || '';
                let price_range = min_value + '-' + max_value;

                if ($("#price_range").length > 0 && $("#price_range").val()) {
                    price_range = $("#price_range").val().trim();
                }

                let price = price_range.split('-').map(Number);

                $("#slider-range").slider({
                    range: true,
                    min: min_value,
                    max: max_value,
                    values: price,
                    slide: function(event, ui) {
                        // Update the amount display
                        $("#amount").val(currency + ui.values[0] + " - " + currency + ui.values[1]);

                        // Update the hidden price range input
                        $("#price_range").val(ui.values[0] + "-" + ui.values[1]);

                        // Update min_price and max_price inputs
                        $("#min_price").val(ui.values[0]);
                        $("#max_price").val(ui.values[1]);
                    }
                });

                // Set initial values for the inputs and amount display
                $("#amount").val(currency + $("#slider-range").slider("values", 0) +
                    " - " + currency + $("#slider-range").slider("values", 1));
                $("#min_price").val($("#slider-range").slider("values", 0));
                $("#max_price").val($("#slider-range").slider("values", 1));

                // Update slider when min_price or max_price changes
                $("#min_price, #max_price").on('change keyup', function() {
                    let min_price = parseInt($("#min_price").val()) || min_value;
                    let max_price = parseInt($("#max_price").val()) || max_value;

                    // Make sure min is not greater than max
                    if (min_price > max_price) {
                        min_price = max_price;
                        $("#min_price").val(min_price);
                    }

                    if (max_price < min_price) {
                        max_price = min_price;
                        $("#max_price").val(max_price);
                    }

                    // Update the slider and hidden input value
                    $("#slider-range").slider("values", [min_price, max_price]);
                    $("#price_range").val(min_price + "-" + max_price);
                    $("#amount").val(currency + min_price + " - " + currency + max_price);
                });
            }
        })
    </script>
@endpush
