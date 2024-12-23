@extends('frontend.layouts.master')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
    <meta name="description" content="{{ $product_detail->summary }}">
    <meta property="og:url" content="{{ route('product-detail', $product_detail->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $product_detail->title }}">
    <meta property="og:image" content="{{ $product_detail->photo }}">
    <meta property="og:description" content="{{ $product_detail->description }}">
@endsection
@section('title', 'Darcey || PRODUCT DETAIL')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Shop Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shop Single -->
    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">
                                    <ul class="slides">
                                        @php
                                            $photo = explode(',', $product_detail->photo);
                                            // dd($photo);
                                        @endphp
                                        @foreach ($photo as $data)
                                            <li data-thumb="{{ $data }}" rel="adjustX:10, adjustY:">
                                                <img src="{{ $data }}" alt="{{ $data }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                @if ($product_detail->flash_sale_start <= now() && $product_detail->flash_sale_end >= now())
                                    <div class="countdown-element mb-4">
                                        <span class="countdown-text">Flash Sale Ends In: </span>
                                        <div class="countdown" data-endtime="{{ $product_detail->flash_sale_end }}">
                                            <span class="days">00</span>{{ __('main.d') }} : <span
                                                class="hours">00</span>{{ __('main.h') }} :
                                            <span class="minutes">00</span>m : <span
                                                class="seconds">00</span>{{ __('main.s') }}
                                        </div>
                                    </div>
                                @endif
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{ $product_detail->title }}</h4>
                                    <div class="rating-main">
                                        <ul class="rating">
                                            @php
                                                $rate = ceil($product_detail->getReview->avg('rate'));
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <li><i class="fa fa-star"></i></li>
                                                @else
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <a href="#"
                                            class="total-review">({{ $product_detail['getReview']->count() }})
                                            {{ __('main.review') }}</a>
                                    </div>
                                    @php
                                        $after_discount =
                                            $product_detail->price -
                                            ($product_detail->price * $product_detail->discount) / 100;

                                        if (
                                            $product_detail->flash_sale_start <= now() &&
                                            $product_detail->flash_sale_end >= now()
                                        ) {
                                            $discount_flash = $product_detail->flash_sale_discount;
                                        }

                                        $after_discount_flash =
                                            $after_discount - ($after_discount * ($discount_flash ?? 0)) / 100;
                                    @endphp
                                    <div class="price-container d-flex align-items-center mt-2">
                                        <span
                                            class="discount currency_convert">${{ number_format($after_discount_flash, 2) }}</span>
                                        <del
                                            class="original-price currency_convert ml-2">${{ number_format($product_detail->price, 2) }}</del>
                                    </div>
                                    <p class="description" style="margin-top: -40px;">{!! $product_detail->summary !!}</p>
                                </div>
                                <!--/ End Description -->
                                <!-- Product Buy -->
                                @php
                                    $variants = $product_detail->variants;
                                    $sizes = $variants->pluck('size')->join(', ');
                                    $totalStock = $variants->sum('quantity');
                                @endphp
                                <form action="{{ route('single-add-to-cart') }}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="size">
                                        {{--  <h5 class="title">{{ __('main.size') }}</h5>  --}}
                                        <select class="size-select" name="size"
                                            data-product-id="{{ $product_detail->id }}">
                                            @foreach ($variants as $variant)
                                                <option value="{{ $variant->size }}">
                                                    {{ $variant->size }}, Stock : {{ $variant->quantity }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="product-buy mt-2">
                                        <div class="quantity">
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                                <input type="text" name="quant[1]" class="input-number" data-min="1"
                                                    data-max="1000" value="1">
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
                                            <button type="submit" class="btn">{{ __('main.add_to_cart') }}</button>
                                        </div>
                                </form>

                                <p class="cat">{{ __('main.category') }} :<a
                                        href="{{ route('product-cat', $product_detail->cat_info['slug']) }}">{{ $product_detail->cat_info['title'] }}</a>
                                </p>
                                @if ($product_detail->sub_cat_info)
                                    <p class="cat mt-1">Sub {{ __('main.category') }} :<a
                                            href="{{ route('product-sub-cat', [$product_detail->cat_info['slug'], $product_detail->sub_cat_info['slug']]) }}">{{ $product_detail->sub_cat_info['title'] }}</a>
                                    </p>
                                @endif
                                <p class="availability">{{ __('main.stock') }} : @if ($product_detail->stock > 0)
                                        <span class="badge badge-success">{{ $product_detail->stock }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $product_detail->stock }}</span>
                                    @endif
                                </p>
                            </div>
                            <!--/ End Product Buy -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">
                            <div class="nav-main">
                                <!-- Tab Nav -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                            href="#description" role="tab">{{ __('main.description') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews"
                                            role="tab">{{ __('main.review') }}</a></li>
                                </ul>
                                <!--/ End Tab Nav -->
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <!-- Description Tab -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="single-des">
                                                    <p>{!! $product_detail->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Description Tab -->
                                <!-- Reviews Tab -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="tab-single review-panel">
                                        <div class="row">
                                            <div class="col-12">

                                                <!-- Review -->
                                                <div class="comment-review">
                                                    <div class="add-review">
                                                        <h5>{{ __('main.add_review') }}</h5>
                                                        <p>{{ __('main.your_email_will_not') }}</p>
                                                    </div>
                                                    <h4>{{ __('main.your_rating') }} <span class="text-danger">*</span>
                                                    </h4>
                                                    <div class="review-inner">
                                                        <!-- Form -->
                                                        @auth
                                                            <form class="form" method="post"
                                                                action="{{ route('review.store', $product_detail->slug) }}">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-12">
                                                                        <div class="rating_box">
                                                                            <div class="star-rating">
                                                                                <div class="star-rating__wrap">
                                                                                    <input class="star-rating__input"
                                                                                        id="star-rating-5" type="radio"
                                                                                        name="rate" value="5">
                                                                                    <label
                                                                                        class="star-rating__ico fa fa-star-o"
                                                                                        for="star-rating-5"
                                                                                        title="5 out of 5 stars"></label>
                                                                                    <input class="star-rating__input"
                                                                                        id="star-rating-4" type="radio"
                                                                                        name="rate" value="4">
                                                                                    <label
                                                                                        class="star-rating__ico fa fa-star-o"
                                                                                        for="star-rating-4"
                                                                                        title="4 out of 5 stars"></label>
                                                                                    <input class="star-rating__input"
                                                                                        id="star-rating-3" type="radio"
                                                                                        name="rate" value="3">
                                                                                    <label
                                                                                        class="star-rating__ico fa fa-star-o"
                                                                                        for="star-rating-3"
                                                                                        title="3 out of 5 stars"></label>
                                                                                    <input class="star-rating__input"
                                                                                        id="star-rating-2" type="radio"
                                                                                        name="rate" value="2">
                                                                                    <label
                                                                                        class="star-rating__ico fa fa-star-o"
                                                                                        for="star-rating-2"
                                                                                        title="2 out of 5 stars"></label>
                                                                                    <input class="star-rating__input"
                                                                                        id="star-rating-1" type="radio"
                                                                                        name="rate" value="1">
                                                                                    <label
                                                                                        class="star-rating__ico fa fa-star-o"
                                                                                        for="star-rating-1"
                                                                                        title="1 out of 5 stars"></label>
                                                                                    @error('rate')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-12">
                                                                        <div class="form-group">
                                                                            <label>{{ __('main.write_review') }}</label>
                                                                            <textarea name="review" rows="6" placeholder=""></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-12">
                                                                        <div class="form-group button5">
                                                                            <button type="submit"
                                                                                class="btn">{{ __('main.submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @else
                                                            <p class="text-center p-5">
                                                                {{ __('main.you_need_to') }} <a
                                                                    href="{{ route('login.form') }}"
                                                                    style="color:rgb(54, 54, 204)">Login</a>
                                                                {{ __('main.or') }} <a style="color:blue"
                                                                    href="{{ route('register.form') }}">Register</a>

                                                            </p>
                                                            <!--/ End Form -->
                                                        @endauth
                                                    </div>
                                                </div>

                                                <div class="ratting-main">
                                                    <div class="avg-ratting">
                                                        {{-- @php
																			$rate=0;
																			foreach($product_detail->rate as $key=>$rate){
																				$rate +=$rate
																			}
																		@endphp --}}
                                                        <h4>{{ ceil($product_detail->getReview->avg('rate')) }}
                                                            <span>(Overall)</span>
                                                        </h4>
                                                        <span>{{ __('main.based_on') }}
                                                            {{ $product_detail->getReview->count() }}
                                                            {{ __('main.comments') }}</span>
                                                    </div>
                                                    @foreach ($product_detail['getReview'] as $data)
                                                        <!-- Single Rating -->
                                                        <div class="single-rating">
                                                            <div class="rating-author">
                                                                @if ($data->user_info['photo'])
                                                                    <img src="{{ $data->user_info['photo'] }}"
                                                                        alt="{{ $data->user_info['photo'] }}">
                                                                @else
                                                                    <img src="{{ asset('backend/img/avatar.png') }}"
                                                                        alt="Profile.jpg">
                                                                @endif
                                                            </div>
                                                            <div class="rating-des">
                                                                <h6>{{ $data->user_info['name'] }}</h6>
                                                                <div class="ratings">

                                                                    <ul class="rating">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($data->rate >= $i)
                                                                                <li><i class="fa fa-star"></i></li>
                                                                            @else
                                                                                <li><i class="fa fa-star-o"></i></li>
                                                                            @endif
                                                                        @endfor
                                                                    </ul>
                                                                    <div class="rate-count">
                                                                        (<span>{{ $data->rate }}</span>)</div>
                                                                </div>
                                                                <p>{{ $data->review }}</p>
                                                            </div>
                                                        </div>
                                                        <!--/ End Single Rating -->
                                                    @endforeach
                                                </div>

                                                <!--/ End Review -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Reviews Tab -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--/ End Shop Single -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('main.related_products') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- {{$product_detail->rel_prods}} --}}
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach ($product_detail->rel_prods as $data)
                            @if ($data->id !== $product_detail->id)
                                <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('product-detail', $data->slug) }}">
                                            @php
                                                $photo = explode(',', $data->photo);
                                            @endphp
                                            <img class="default-img" src="{{ $photo[0] }}"
                                                alt="{{ $photo[0] }}">
                                            <img class="hover-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                            {{--  <span class="price-dec">{{ $data->discount }} % Off</span>  --}}
                                            @if ($data->discount)
                                                @php
                                                    if (
                                                        $data->flash_sale_start <= now() &&
                                                        $data->flash_sale_end >= now()
                                                    ) {
                                                        $discount = $data->discount + $data->flash_sale_discount;
                                                    } else {
                                                        $discount = $data->discount;
                                                    }
                                                @endphp
                                                <span class="price-dec">{{ $discount }} % Off</span>
                                            @endif

                                            @if ($data->flash_sale_start <= now() && $data->flash_sale_end >= now())
                                                <div class="countdown-banner">
                                                    <span class="countdown-text">Flash Sale Ends In: </span>
                                                    <div class="countdown" data-endtime="{{ $data->flash_sale_end }}">
                                                        <span class="days">00</span>{{ __('main.d') }} : <span
                                                            class="hours">00</span>{{ __('main.h') }} :
                                                        <span class="minutes">00</span>m : <span
                                                            class="seconds">00</span>{{ __('main.s') }}
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- <span class="out-of-stock">Hot</span> --}}
                                        </a>
                                        <div class="button-head">
                                            <a href="{{ route('product-detail', $data->slug) }}"
                                                title="Quick View"><button class="btn btn-custom rounded"
                                                    style="width: 100%">{{ __('main.buy') }}</button></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('product-detail', $data->slug) }}">{{ $data->title }}</a>
                                        </h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount = $data->price - ($data->price * $data->discount) / 100;

                                                $discount_flash_2 = 0;
                                                if (
                                                    $data->flash_sale_start <= now() &&
                                                    $data->flash_sale_end >= now()
                                                ) {
                                                    $discount_flash_2 = $data->flash_sale_discount;
                                                }

                                                $after_discount_flash =
                                                    $after_discount -
                                                    ($after_discount * ($discount_flash_2 ?? 0)) / 100;
                                            @endphp
                                            <span
                                                class="old currency_convert">${{ number_format($data->price, 2) }}</span>
                                            <span
                                                class="currency_convert">${{ number_format($after_discount_flash, 2) }}</span>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Single Product -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

@endsection
@push('styles')
    <style>
        /* Rating */
        .rating_box {
            display: inline-flex;
        }

        .star-rating {
            font-size: 0;
            padding-left: 10px;
            padding-right: 10px;
        }

        .star-rating__wrap {
            display: inline-block;
            font-size: 1rem;
        }

        .star-rating__wrap:after {
            content: "";
            display: table;
            clear: both;
        }

        .star-rating__ico {
            float: right;
            padding-left: 2px;
            cursor: pointer;
            color: #F7941D;
            font-size: 16px;
            margin-top: 5px;
        }

        .star-rating__ico:last-child {
            padding-left: 0;
        }

        .star-rating__input {
            display: none;
        }

        .star-rating__ico:hover:before,
        .star-rating__ico:hover~.star-rating__ico:before,
        .star-rating__input:checked~.star-rating__ico:before {
            content: "\F005";
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
@endpush
