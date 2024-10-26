@extends('frontend.layouts.master')
@section('title', 'Darcey || HOME PAGE')
@section('main-content')
    <!-- Slider Area -->
    @if (count($banners) > 0)
        <section id="Gslider" class="carousel slide" data-ride="carousel"
            style="width: 100vw; height: 92vh; overflow: hidden;">
            <div class="carousel-inner" role="listbox">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="height: 92vh;">
                        <img class="d-block w-100" src="{{ $banner->photo }}" alt="Slide {{ $key + 1 }}">

                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </section>
    @endif

    <!--/ End Slider Area -->

    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('main.trending_item') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                                @php
                                    $categories = DB::table('categories')
                                        ->where('status', 'active')
                                        ->where('is_parent', 1)
                                        ->get();
                                    // dd($categories);
                                @endphp
                                @if ($categories)
                                    <button class="btn" style="background:black"data-filter="*">
                                        {{ __('main.all_product') }}
                                    </button>
                                    @foreach ($categories as $key => $cat)
                                        <button class="btn"
                                            style="background:none;color:black;"data-filter=".{{ $cat->id }}">
                                            {{ $cat->title }}
                                        </button>
                                    @endforeach
                                @endif
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content isotope-grid" id="myTabContent">
                            <!-- Start Single Tab -->
                            @if ($product_lists)
                                <div class="row justify-content-center">
                                    @foreach ($product_lists as $key => $product)
                                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-35 isotope-item {{ $product->cat_id }}">
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
                                                        @if ($product->stock <= 0)
                                                            <span class="out-of-stock">Sale out</span>
                                                        @elseif($product->condition == 'new')
                                                            <span class="new">{{ __('main.new') }}</span>
                                                        @elseif($product->condition == 'hot')
                                                            <span class="hot">Hot</span>
                                                        @else
                                                            <span class="price-dec">{{ $product->discount }}% Off</span>
                                                        @endif
                                                    </a>
                                                    <div class="button-head">
                                                        <a data-toggle="modal" data-target="#{{ $product->id }}"
                                                            title="Quick View" href="#"><button
                                                                class="btn btn-custom rounded"
                                                                style="width: 100%">{{ __('main.buy') }}</button></a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a
                                                            href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                                    </h3>
                                                    <div class="product-price">
                                                        @php
                                                            $after_discount =
                                                                $product->price -
                                                                ($product->price * $product->discount) / 100;
                                                        @endphp
                                                        <span
                                                            class="currency_convert">{{ number_format($after_discount, 2) }}</span>
                                                        <del style="padding-left:4%;"
                                                            class="currency_convert">{{ number_format($product->price, 2) }}</del>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    <section class="see-all-products mb-4">
        <div class="container-fluid p-0 position-relative"> <!-- Container tanpa padding -->
            <div class="row g-0"> <!-- Row tanpa gutter -->
                <div class="col-12">
                    <div class="section_title mb-3" style="text-align: center; font-weight: bold;">
                        <h2>PRODUCT</h2>
                    </div>
                </div>
            </div>
            <div class="row g-0"> <!-- Row tanpa gutter -->
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center text-white"
                        style="background-color: rgba(0,0,0,0.6); height: 300px;">
                        <a href="{{ route('product-grids') }}">
                            <button type="button" class="btn btn-custom rounded">
                                <span class="d-flex align-items-center gap-2">{{ __('main.see_all_products') }}</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    @if ($product_lists)
        @foreach ($product_lists as $key => $product)
            <div class="modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header ml-2">
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
                                                <a href="#"> ({{ $rate_count }} {{ __('main.cust_review') }})</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if ($product->stock > 0)
                                                    <span><i class="fa fa-check-circle-o"></i> {{ $product->stock }}
                                                        {{ __('main.in_stock') }}</span>
                                                @else
                                                    <span><i class="fa fa-times-circle-o text-danger"></i>
                                                        {{ $product->stock }} {{ __('main.out_stock') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount =
                                                $product->price - ($product->price * $product->discount) / 100;
                                        @endphp
                                        <div class="d-flex align-items-center">
                                            <h3 class="mr-2">
                                                <small>
                                                    <del
                                                        class="text-muted currency_convert">{{ number_format($product->price, 2) }}</del>
                                                </small>
                                            </h3>
                                            <h3 class="currency_convert">
                                                ${{ number_format($after_discount, 2) }}
                                            </h3>
                                        </div>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if ($product->size)
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">{{ __('main.size') }}</h5>
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
                                                </div>
                                            </div>
                                        @endif
                                        <form action="{{ route('single-add-to-cart') }}" method="POST" class="mt-4">
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
                                                <button type="submit"
                                                    class="btn">{{ __('main.add_to_cart') }}</button>
                                            </div>
                                        </form>
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
        /* Banner Sliding */
        #Gslider {
            width: 100%;
            margin-left: calc(-50vw + 50%);
        }

        #Gslider .carousel-inner {
            background: #fff;
            color: black;
            height: 92vh;
            /* Tetapkan tinggi carousel selalu 92vh */
        }

        #Gslider .carousel-inner img {
            width: 100%;
            height: 92vh;
            /* Pastikan gambar selalu memiliki tinggi 92vh */
            object-fit: cover;
            /* Potong bagian yang tidak muat secara proporsional */
            opacity: 0.8;
        }

        #Gslider .carousel-caption {
            bottom: 60%;
        }

        #Gslider .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-caption p {
            font-size: 18px;
            color: black;
            margin: 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }

        .carousel {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Untuk memastikan tidak ada scroll horizontal */
        }

        .carousel-inner {
            width: 100%;
        }

        .carousel-item {
            width: 100%;
        }

        .carousel-item img {
            width: 100%;
            height: 92vh;
            /* Pastikan gambar tetap 92vh di semua perangkat */
            object-fit: cover;
            /* Menjaga proporsi gambar agar tidak terdistorsi */
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        /*==================================================================
                                                                                                                                                                        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function() {
            $filter.on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({
                    filter: filterValue
                });
            });

        });

        // init Isotope
        $(window).on('load', function() {
            var $grid = $topeContainer.each(function() {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine: 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function() {
            $(this).on('click', function() {
                for (var i = 0; i < isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
        function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el
                .exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el
                .msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>
@endpush
