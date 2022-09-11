@extends('layouts.client.master')

@section('title', 'Trang chủ')

@section('content')
<div class="slider-area">
    <div class="slider-active swiper-container">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="intro-section slider-height-1 slider-content-center bg-img single-animation-wrap slider-bg-color-3" style="background-image:url({{ getPathImage($slider->image) }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 hm2-slider-animation">
                                <div class="slider-content-2 slider-animated-3">
                                    <h3 class="animated">{{ $slider->desc }}</h3>
                                    <h1 class="animated">{{ $slider->title }}</h1>
                                    @if ($slider->url)
                                    <div class="slider-btn-2 btn-hover">
                                        <a href="{{ $slider->url }}" class="btn hover-border-radius theme-color animated">
                                            Xem ngay
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="home-slider-prev2 main-slider-nav2"><i class="fa fa-angle-left"></i></div>
            <div class="home-slider-next2 main-slider-nav2"><i class="fa fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="banner-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="banner-wrap mb-30" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('shop', ['categories' => 'phong-bep']) }}"><img src="/assets/client/images/banner/banner-6.webp" alt=""></a>
                    <div class="banner-content-5">
                        {{-- <span>Up To 40% Off</span> --}}
                        <h2>Nội Thất Phòng Bếp</h2>
                        <div class="btn-style-3 btn-hover">
                            <a class="btn hover-border-radius" href="{{ route('shop', ['categories' => 'phong-bep']) }}">Xem Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="banner-wrap mb-30" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('shop', ['categories' => 'phong-ngu']) }}"><img src="/assets/client/images/banner/banner-7.webp" alt=""></a>
                    <div class="banner-content-5">
                        {{-- <span>Up To 40% Off</span> --}}
                        <h2>Nội Thất Phòng Ngủ</h2>
                        <div class="btn-style-3 btn-hover">
                            <a class="btn hover-border-radius" href="{{ route('shop', ['categories' => 'phong-ngu']) }}">Xem Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="service-area pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-img-2">
                        <img src="/assets/client/images/icon-img/car.png" alt="">
                    </div>
                    <div class="service-content-2">
                        <h3>Miễn Phí Giao Hàng</h3>
                        {{-- <p>Miễn phí giao hàng với các đơn hàng có giá trị lớn.</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-img-2">
                        <img src="/assets/client/images/icon-img/time.png" alt="">
                    </div>
                    <div class="service-content-2">
                        <h3>Hỗ Trợ 24/7</h3>
                        {{-- <p>Nhân viên hỗ trợ mọi lúc mọi nơi.</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-img-2">
                        <img src="/assets/client/images/icon-img/dollar.png" alt="">
                    </div>
                    <div class="service-content-2">
                        <h3>Chính Sách Hoàn Trả</h3>
                        {{-- <p>Hoàn Trả Với Các Đơn Hàng Bị Lỗi. </p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="800">
                    <div class="service-img-2">
                        <img src="/assets/client/images/icon-img/discount.png" alt="">
                    </div>
                    <div class="service-content-2">
                        <h3>Khuyến Mãi Khủng</h3>
                        {{-- <p>Giảm Giá Đơn Hàng Với Giá Trị Khủng.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-95">
    <div class="container">
        <div class="section-border section-border-margin-1" data-aos="fade-up" data-aos-delay="200">
            <div class="section-title-timer-wrap bg-white">
                <div class="section-title-1">
                    <h2>Sản Phẩm Giảm Giá</h2>
                </div>
                {{-- <div id="timer-1-active" class="timer-style-1">
                    <span>End In: </span>
                    <div data-countdown="{{ \Carbon\Carbon::now()->addDays(5)->format('Y/m/d') }}"></div>
                </div> --}}
            </div>
        </div>
        <div class="product-slider-active-1 swiper-container">
            <div class="swiper-wrapper">
                @foreach ($productSales as $product)
                <div class="swiper-slide">
                    <div class="product-wrap" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-img img-zoom mb-25">
                            <a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                <img src="{{ getPathImage($product->thumbnail->path) }}" alt="">
                            </a>
                            <div class="product-badge badge-top badge-right badge-pink">
                                <span>Giảm</span>
                            </div>
                            @if ($product->quantity == 0)
                                <div class="product-badge badge-top badge-left badge-pink">
                                    <span>Hết hàng</span>
                                </div>
                            @endif
                            <div class="product-action-wrap">
                                <button class="product-action-btn-1" title="Wishlist"><i class="pe-7s-like"></i></button>
                                <button class="product-action-btn-1" title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="pe-7s-look"></i>
                                </button>
                            </div>
                            @if($product->quantity > 0)
                                @if (count($product->attributes) > 0)
                                <div class="product-action-2-wrap">
                                    <a class="product-action-btn-2" href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}" title="Lựa chọn các tùy chọn"><i class="pe-7s-cart"></i> Lựa chọn</a>
                                </div>
                                @else
                                <div class="product-action-2-wrap">
                                    <button class="product-action-btn-2 add-to-cart" data-product-id="{{ $product->id }}" title="Thêm vào giỏ"><i class="pe-7s-cart"></i> Thêm vào giỏ</button>
                                </div>
                                @endif
                            @endif
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                            <div class="product-price">
                                <span class="old-price">{{ productPrice($product->price) }} </span>
                                <span class="new-price">{{ productPrice($product->promotion) }} </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="product-prev-1 product-nav-1" data-aos="fade-up" data-aos-delay="200"><i class="fa fa-angle-left"></i></div>
            <div class="product-next-1 product-nav-1" data-aos="fade-up" data-aos-delay="200"><i class="fa fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="banner-area pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="banner-wrap mb-30" data-aos="fade-up" data-aos-delay="200">
                    <a href="product-details.html"><img src="/assets/client/images/banner/banner-8.png" alt=""></a>
                    <div class="banner-content-6">
                        <h2>New Furniture </h2>
                        <h3>Up To 30% Off</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="banner-wrap mb-30" data-aos="fade-up" data-aos-delay="400">
                    <a href="product-details.html"><img src="/assets/client/images/banner/banner-9.png" alt=""></a>
                    <div class="banner-content-6">
                        <h2>Old Furniture </h2>
                        <h3>Up To 60% Off</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-95">
    @php
        $productSale = $productSales->shuffle()->first();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="home-single-product-img" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('product', ['slug' => $productSale->slug, 'id' => $productSale->id]) }}"><img src="{{ $productSale->thumbnail->path }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="home-single-product-content">
                    <h2 data-aos="fade-up" data-aos-delay="200">{{ $productSale->name }}</h2>
                    <p class="text-primary">Sản phẩm đang giảm giá</p>
                    <h3 data-aos="fade-up" data-aos-delay="400">{{ productPrice($productSale->promotion) }}</h3>
                    <h5 data-aos="fade-up" data-aos-delay="400"><s>{{ productPrice($productSale->price) }}</s></h5>
                    <p data-aos="fade-up" data-aos-delay="600">{{ $productSale->short_desc }}</p>
                    <div class="product-details-action-wrap" data-aos="fade-up" data-aos-delay="1000">
                        <div class="single-product-cart btn-hover">
                            <a href="{{ route('product', ['slug' => $productSale->slug, 'id' => $productSale->id]) }}">Xem ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-60">
    <div class="container">
        <div class="section-title-tab-wrap mb-75" data-aos="fade-up" data-aos-delay="200">
            <div class="section-title-2">
                <h2>Hot Products</h2>
            </div>
            <div class="tab-style-1 nav">
                <a class="active" href="#pro-1" data-bs-toggle="tab">Sản Phẩm Mới </a>
                <a href="#pro-2" data-bs-toggle="tab" class=""> Xem Nhiều </a>
            </div>
        </div>
        <div class="tab-content jump">
            <div id="pro-1" class="tab-pane active">
                <div class="row">
                    @foreach($newProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-img img-zoom mb-25">
                                <a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                    <img src="{{ getPathImage($product->thumbnail->path) }}" alt="">
                                </a>
                                @if ($product->promotion > 0)
                                <div class="product-badge badge-top badge-right badge-pink">
                                    <span>Giảm</span>
                                </div>
                                @endif
                                @if ($product->quantity == 0)
                                    <div class="product-badge badge-top badge-left badge-pink">
                                        <span>Hết hàng</span>
                                    </div>
                                @endif
                                <div class="product-action-wrap">
                                    <button class="product-action-btn-1" title="Wishlist"><i class="pe-7s-like"></i></button>
                                    <button class="product-action-btn-1" title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                                @if($product->quantity > 0)
                                    @if (count($product->attributes) > 0)
                                    <div class="product-action-2-wrap">
                                        <a class="product-action-btn-2" href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}" title="Lựa chọn các tùy chọn"><i class="pe-7s-cart"></i> Lựa chọn</a>
                                    </div>
                                    @else
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2 add-to-cart" data-product-id="{{ $product->id }}" title="Thêm vào giỏ"><i class="pe-7s-cart"></i> Thêm vào giỏ</button>
                                    </div>
                                    @endif
                                @endif
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                <div class="product-price">
                                    @if ($product->promotion > 0)
                                    <span class="old-price">{{ productPrice($product->price) }}</span>
                                    <span class="new-price">{{ productPrice($product->promotion) }}</span>
                                    @else
                                    <span>{{ productPrice($product->price) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="pro-2" class="tab-pane">
                <div class="row">
                    @foreach ($mostView as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-wrap mb-35">
                            <div class="product-img img-zoom mb-25">
                                <a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                    <img src="{{ getPathImage($product->thumbnail->path) }}" alt="">
                                </a>
                                @if ($product->promotion > 0)
                                <div class="product-badge badge-top badge-right badge-pink">
                                    <span>Giảm</span>
                                </div>
                                @endif
                                @if ($product->quantity == 0)
                                    <div class="product-badge badge-top badge-left badge-pink">
                                        <span>Hết hàng</span>
                                    </div>
                                @endif
                                <div class="product-action-wrap">
                                    <button class="product-action-btn-1" title="Wishlist"><i class="pe-7s-like"></i></button>
                                    <button class="product-action-btn-1" title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                                @if($product->quantity > 0)
                                    @if (count($product->attributes) > 0)
                                    <div class="product-action-2-wrap">
                                        <a class="product-action-btn-2" href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}" title="Lựa chọn các tùy chọn"><i class="pe-7s-cart"></i> Lựa chọn</a>
                                    </div>
                                    @else
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2 add-to-cart" data-product-id="{{ $product->id }}" title="Thêm vào giỏ"><i class="pe-7s-cart"></i> Thêm vào giỏ</button>
                                    </div>
                                    @endif
                                @endif
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                <div class="product-price">
                                    @if ($product->promotion > 0)
                                    <span class="old-price">{{ productPrice($product->price) }} </span>
                                    <span class="new-price">{{ productPrice($product->promotion) }} </span>
                                    @else
                                    <span>{{ productPrice($product->price) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="brand-logo-area pb-95">
    <div class="container">
        <div class="brand-logo-active swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-brand-logo" data-aos="fade-up" data-aos-delay="200">
                        <a href="#"><img src="/assets/client/images/brand-logo/brand-logo-1.png" alt=""></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-brand-logo" data-aos="fade-up" data-aos-delay="400">
                        <a href="#"><img src="/assets/client/images/brand-logo/brand-logo-2.png" alt=""></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-brand-logo" data-aos="fade-up" data-aos-delay="600">
                        <a href="#"><img src="/assets/client/images/brand-logo/brand-logo-3.png" alt=""></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-brand-logo" data-aos="fade-up" data-aos-delay="800">
                        <a href="#"><img src="/assets/client/images/brand-logo/brand-logo-4.png" alt=""></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-brand-logo" data-aos="fade-up" data-aos-delay="1000">
                        <a href="#"><img src="/assets/client/images/brand-logo/brand-logo-5.png" alt=""></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-brand-logo" data-aos="fade-up" data-aos-delay="1200">
                        <a href="#"><img src="/assets/client/images/brand-logo/brand-logo-1.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog-area pb-70">
    <div class="container">
        <div class="section-title-2 st-border-center text-center mb-75" data-aos="fade-up" data-aos-delay="200">
            <h2>Bài Viết Mới</h2>
        </div>
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="blog-wrap mb-50" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-img-date-wrap mb-25">
                        <div class="blog-img">
                            <a href="{{ route('post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}"><img src="{{ getPathImage($post->thumbnail) }}" alt=""></a>
                        </div>
                        <div class="blog-date">
                            <h5>{{ $post->created_at->format("d M") }}</h5>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h3><a href="{{ route('post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}">{{ $post->title }}</a></h3>
                        <p>{{ $post->short_desc }}</p>
                        <div class="blog-btn-2 btn-hover">
                            <a class="btn hover-border-radius theme-color" href="{{ route('post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection