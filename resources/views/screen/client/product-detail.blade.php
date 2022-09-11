@extends('layouts.client.master')

@section('title', $product->name)

@section('breadcrumb', 'Chi tiết sản phẩm')

@section('content')
<div class="product-details-area pb-100 pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-details-img-wrap product-details-vertical-wrap" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-small-img-wrap">
                        <div class="swiper-container product-details-small-img-slider-1 pd-small-img-style">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $image)
                                <div class="swiper-slide">
                                    <div class="product-details-small-img">
                                        <img src="{{ getPathImage($image->path) }}" alt="{{ $product->name }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pd-prev pd-nav-style"> <i class="ti-angle-up"></i></div>
                        <div class="pd-next pd-nav-style"> <i class="ti-angle-down"></i></div>
                    </div>
                    <div class="swiper-container product-details-big-img-slider-1 pd-big-img-style">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                            <div class="swiper-slide">
                                <div class="easyzoom-style">
                                    <div class="easyzoom easyzoom--overlay">
                                        <a href="{{ getPathImage($image->path) }}">
                                            <img src="{{ getPathImage($image->path) }}" alt="">
                                        </a>
                                    </div>
                                    <a class="easyzoom-pop-up img-popup" href="{{ getPathImage($image->path) }}">
                                        <i class="pe-7s-search"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-details-content" data-aos="fade-up" data-aos-delay="400">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-details-price">
                        @if ($product->promotion > 0)
                        <span class="old-price">{{ productPrice($product->price) }} </span>
                        <span class="new-price">{{ productPrice($product->promotion) }}</span>
                        @else
                            <span>{{ productPrice($product->price) }}</span>
                        @endif
                    </div>
                    <p>Tình trạng: {!! $product->quantity > 0 ? '<span class="text-success">Còn hàng ('.$product->quantity.')</span>' : '<span class="text-danger">Hết hàng</span>' !!}</p>
                    <div class="product-details-review">
                        <div class="rateit" data-rateit-value="{{ $product->rating }}" data-rateit-resetable="false"
                            data-rateit-ispreset="true" data-rateit-mode="font" style="font-size:30px" data-rateit-readonly="true"></div>
                        <span>( {{ count($product->reviews) }} Đánh giá )</span>
                    </div>
                    @if ($product->hasAttr())
                        @foreach ($product->showAttributes() as $attr => $value)
                        <div class="product-color product-color-active product-details-color">
                            <span>{{ $attr }} :</span>
                            <select data-name-attribute="{{ $attr }}" name="attr_{{$value['id']}}" id="" class="form-control">
                                @foreach ($value['value'] as $v)
                                    <option value="{{$v}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    @endif
                    <div class="product-details-action-wrap">
                        @if($product->quantity > 0)
                        <div class="product-quality">
                            <input class="cart-plus-minus-box input-text qty text" data-max="{{ $product->quantity }}" id="quantity" name="qtybutton" value="1">
                        </div>
                        <div class="single-product-cart btn-hover">
                            <input type="hidden" value="{{ $product->id }}" id="idProduct">
                            <button id="addToCart">Thêm vào giỏ</button>
                        </div>
                        <div class="single-product-wishlist">
                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                        </div>
                        @else
                        @endif
                    </div>
                    <span class="noti text-danger out-of-stock"></span>
                    <div class="product-details-meta">
                        <ul>
                            <li><span class="title">Danh mục:</span>
                                <ul>
                                    @foreach ($product->categories as $key => $cat)
                                        @if ($key == count($product->categories)-1)
                                        <li><a href="#"> {{ $cat->name }}</a></li>
                                        @else 
                                        <li><a href="#">{{ $cat->name }}</a> , </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="social-icon-style-4">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-area pb-85">
    <div class="container">
        <div class="description-review-topbar nav" data-aos="fade-up" data-aos-delay="200">
            <a class="active" data-bs-toggle="tab" href="#des-details1"> Mô Tả </a>
            <a data-bs-toggle="tab" href="#des-details3" class=""> Đánh Giá </a>
        </div>
        <div class="tab-content">
            <div id="des-details1" class="tab-pane active">
                <div class="product-description-content text-center">
                    <p data-aos="fade-up" data-aos-delay="400">
                        {!! $product->content !!}
                    </p>
                </div>
            </div>
            <div id="des-details3" class="tab-pane">
                <div class="review-wrapper">
                    <h3>{{ count($product->reviews) }} Đánh giá cho {{ $product->name }}</h3>
                    @foreach ($product->reviews as $reviewer)
                        <div class="single-review">
                            <div class="review-img">
                                <img src="/assets/client/images/product-details/review-1.png" alt="">
                            </div>
                            <div class="review-content">
                                <div class="rateit" data-rateit-value="{{ $reviewer->rating }}" data-rateit-resetable="false"
                                    data-rateit-ispreset="true" style="font-size:20px" data-rateit-readonly="true"></div>
                                <h5><span>{{ $reviewer->name }}</span> - {{ $reviewer->created_at->format('d/m/Y \l\ú\c H:i') }}
                                </h5>
                                <p>{{ $reviewer->message }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="ratting-form-wrapper">
                    @if (session()->has('success'))
                        <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                    @endif
                    <h3>Thêm đánh giá</h3>
                    <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu <span>*</span></p>
                    <div class="ratting-form">
                        <form method="POST" action="{{ route('product.review', ['slug' => $product->slug, 'id' => $product->id]) }}">
                            @csrf 
                            <div class="your-rating-wrap">
                                {{-- <span>Đánh giá của bạn: </span> --}}
                                <input type="range" min="0" max="5" name="rating" value="5" step="1" id="rating">
                                <div class="rateit" data-rateit-resetable="false" data-rateit-ispreset="true" style="font-size: 35px;"
                                    data-rateit-backingfld="#rating"></div>
                            </div>
                            <div class="row">
                                
                                @if (!auth()->check())
                                    <div class="col-lg-6 col-md-6">
                                        <div class="rating-form-style mb-15">
                                            <label>Họ tên <span>*</span></label>
                                            <input type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="rating-form-style mb-15">
                                            <label>Email <span>*</span></label>
                                            <input type="email" name="email">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="rating-form-style mb-15">
                                        <label>Nội dung <span>*</span></label>
                                        <textarea name="message"></textarea>
                                    </div>
                                    @error('message')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-submit">
                                        <input type="submit" value="Gửi đánh giá">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="related-product-area pb-95">
    <div class="container">
        <div class="section-title-2 st-border-center text-center mb-75" data-aos="fade-up" data-aos-delay="200">
            <h2>Sản Phẩm Liên Quan</h2>
        </div>
        <div class="related-product-active swiper-container">
            <div class="swiper-wrapper">
                @foreach ($relatedProducts as $product)
                <div class="swiper-slide">
                    <div class="product-wrap" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-img img-zoom mb-25">
                            <a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                <img src="{{ getPathImage($product->thumbnail->path) }}" alt="">
                            </a>
                            @if ($product->promotion > 0)
                            <div class="product-badge badge-top badge-right badge-pink">
                                <span>Giảm giá</span>
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
@endsection

@section('custom-js-tag')
<script>
    $(document).ready(function(){
        $('#addToCart').click(function(e){

            let id = $('#idProduct').val()

            let quantity = Number($('#quantity').val())

            let max = Number($('#quantity').data('max'))

            if(quantity > max){
                $('.noti.out-of-stock').text('Số lượng đặt vượt quá giới hạn')
                return
            } else {
                $('.noti.out-of-stock').text('')
            }

            let options = []

            $('[name^=attr_]').each(function() {
                var string = $(this).data('name-attribute') + ': ' + $(this).val();
                options.push(string);
            })
            
            let _url = '{{route('cart.add',':id')}}'
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    quantity: quantity,
                    options: options.join('/')
                },
                success: function(response, textStatus, jqXHR) {
                    if (jqXHR.status == 201) {
                        if(response.status){
                            Swal.fire({
                                position: 'top-right',
                                icon: 'success',
                                title: 'Đã thêm vào giỏ hàng',
                                showConfirmButton: false,
                                timer: 1300,
                                timerProgressBar: true
                            })
                            miniCart()
                        }
                    }

                },
                error: function(jqXHR) {
                    console.log(jqXHR.responseText)
                }
            })
        
        })
    })
</script>
@endsection