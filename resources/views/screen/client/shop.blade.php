@extends('layouts.client.master')

@section('title', 'Shop')

@section('title-breadcrumb', 'Cửa hàng')

@section('content')
<div class="shop-area shop-page-responsive pt-100 pb-100">
    <div class="container">
        <form action="">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-topbar-wrapper mb-40">
                        <div class="shop-topbar-left" data-aos="fade-up" data-aos-delay="200">
                            <div class="showing-item">
                                <span>Kết quả tìm thấy {{ $products->count() }} trên tổng số {{ $products->total() }} sản phẩm</span>
                            </div>
                        </div>
                        <div class="shop-topbar-right" data-aos="fade-up" data-aos-delay="400">
                            <div class="shop-sorting-area">
                                <select name="sort" class="nice-select nice-select-style-1">
                                    <option value="default">Mới nhất</option>
                                    <option value="view" @selected(request()->query('sort') == 'view')>Lượt xem</option>
                                    <option value="azSort" @selected(request()->query('sort') == 'azSort')>Tên: A-Z</option>
                                    <option value="zaSort" @selected(request()->query('sort') == 'zaSort')>Tên: Z-A</option>
                                    <option value="hPrice" @selected(request()->query('sort') == 'hPrice')>Giá: Cao đến thấp</option>
                                    <option value="lPrice" @selected(request()->query('sort') == 'lPrice')>Giá: Thấp đến cao</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-bottom-area">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">
                                    @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="200">
                                            <div class="product-img img-zoom mb-25">
                                                <a href="{{ route('product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                                    <img src="/{{ $product->thumbnail->path }}" alt="{{ $product->name }}">
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
                                {{ $products->withQueryString()->links('vendor.pagination.custom-client') }}
                                {{-- <div class="pagination-style-1" data-aos="fade-up" data-aos-delay="200">
                                    <ul>
                                        <li><a class="active" href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a class="next" href="#"><i class=" ti-angle-double-right "></i></a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar-wrapper">
                        <div class="sidebar-widget mb-40" data-aos="fade-up" data-aos-delay="200">
                            <div class="search-wrap-2">
                                <div class="search-2-form">
                                    <input placeholder="Tìm kiếm..." name="q" value="{{ request()->query('q') ?? '' }}" type="text">
                                    <button class="button-search"><i class=" ti-search "></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget sidebar-widget-border mb-40 pb-35" data-aos="fade-up" data-aos-delay="200">
                            <div class="sidebar-widget-title mb-25">
                                <h3>Product Categories</h3>
                            </div>
                            <div class="sidebar-list-style">
                                <ul class="overflow-auto" style="max-height: 250px">
                                    <input type="hidden" name="categories" value="{{ request()->query('categories') ?? '' }}">
                                    @foreach ($categories as $cat)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input categories" type="checkbox" value="{{$cat->slug}}" id="flexCheckChecked{{$cat->id}}" {{ in_array($cat->slug, explode(",", request()->query('categories'))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckChecked{{$cat->id}}">
                                                {{ $cat->name }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                        @foreach ($attributes as $attr)
                        <div class="sidebar-widget sidebar-widget-border mb-40 pb-35" data-aos="fade-up" data-aos-delay="200">
                            <div class="sidebar-widget-title mb-25">
                                <h3>{{ $attr->name }}</h3>
                            </div>
                            <div class="sidebar-list-style">
                                <ul class="overflow-auto" style="max-height: 250px">
                                    <input type="hidden" name="{{ \Illuminate\Support\Str::slug($attr->name) }}" value="{{ request()->query(\Illuminate\Support\Str::slug($attr->name)) ?? '' }}">
                                    @foreach ($attr->values()->groupBy('value')->get() as $val)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input {{ \Illuminate\Support\Str::slug($attr->name) }}" type="checkbox" value="{{ $val->value }}" id="attr_{{$val->id}}" {{ in_array($val->value, explode(",", request()->query(\Illuminate\Support\Str::slug($attr->name)))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="attr_{{$val->id}}">
                                                {{ $val->value }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        <div class="btn-style-3 btn-hover d-flex justify-content-center">
                            <button class="btn hover-border-radius">Áp dụng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('custom-js-tag')
<script>
    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val())
        })
    return filter
    }
    $(document).ready(function(){

        $('[name="sort"]').change(function(){
            $(this).closest('form').submit()
        })

        $('.categories').click(function(){
            let data = get_filter('categories')
            $('[name="categories"]').val(decodeURIComponent(data.join(',')))
        })

        $('.kich-thuoc').click(function(){
            let data = get_filter('kich-thuoc')
            $('[name="kich-thuoc"]').val(decodeURIComponent(data.join(',')))
        })

        $('.mau-sac').click(function(){
            let data = get_filter('mau-sac')
            $('[name="mau-sac"]').val(decodeURIComponent(data.join(',')))
        })
    })
</script>
@endsection