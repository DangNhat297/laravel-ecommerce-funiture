@extends('layouts.client.master')

@section('title', 'Thanh toán')

@section('breadcrumb', 'Thanh toán')

@section('content')
<div class="checkout-main-area pb-100 pt-100">
    <div class="container">
        <div class="checkout-wrap pt-30">
            <form action="{{ route('order') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Thông Tin Thanh Toán</h3>
                            @if (session()->has('error'))
                            <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20">
                                        <label>Họ và tên <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="fullname" value="{{ auth()->user()->fullname ?? old('fullname') }}" placeholder="Nhập họ và tên*">
                                        @error('fullname')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20">
                                        <label>Số điện thoại <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại*">
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Email <abbr class="required" title="required">*</abbr></label>
                                        <input type="email" name="email" value="{{ auth()->user()->email ?? old('email') }}" placeholder="Nhập email*">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-select select-style mb-20">
                                        <label>Tỉnh / Thành <abbr class="required" title="required">*</abbr></label>
                                        <select class="select-two-active province">
                                        </select>
                                        <input type="hidden" name="address[province]">
                                        @error('address.province')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-select select-style mb-20">
                                        <label>Quận / Huyện <abbr class="required" title="required">*</abbr></label>
                                        <select class="select-two-active district">
                                            <option value="">Chọn quận huyện</option>
                                        </select>
                                        <input type="hidden" name="address[district]">
                                        @error('address.district')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-select select-style mb-20">
                                        <label>Phường / Xã <abbr class="required" title="required">*</abbr></label>
                                        <select class="select-two-active ward">
                                            <option value="">Chọn xã phường</option>
                                        </select>
                                        <input type="hidden" name="address[ward]">
                                        @error('address.ward')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Địa chỉ chi tiết</label>
                                        <input type="text" name="address[more]" value="{{ old('address.more') }}" placeholder="Số nhà / Đường / Thôn">
                                    </div>
                                </div>
                            </div>
                            <div class="additional-info-wrap">
                                <label>Order notes</label>
                                <textarea name="note" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." name="message">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3>Thông Tin Sản Phẩm</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li>Sản phẩm <span>Tạm tính</span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>Tổng <span></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="payment-method">
                                    <div class="pay-top sin-payment sin-payment-3">
                                        <input id="payment-method-4" class="input-radio" type="radio" value="cheque" checked name="payment_method">
                                        <label for="payment-method-4">Thanh toán khi nhận hàng <img alt="" src="assets/images/icon-img/payment.png"></label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>Đơn hàng sẽ được thanh toán khi khách hàng nhận được hàng.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Place-order btn-hover">
                                <button type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-js-tag')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'token': '7d39926f-24bd-11ec-b268-d64e67bb39ee'
                }
            })

            // get province
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
                dataType: 'json',
                success: function(res){
                    if(res.code == 200){
                        let options = '<option>Chọn tỉnh thành</option>'
                        let data = res.data.map(value => {
                            return `<option value="${value.ProvinceID}">${value.ProvinceName}</option>`
                        })
                        $('.province').html(options + data.join(''))
                    }
                }
            })

            // get district
            $('.province').on('change', function(){
                let provinceID = $(this).val()
                let text = $(this).find(':selected').text()
                $('[name="address[province]"]').val(text)
                $.ajax({
                    url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                    dataType: 'json',
                    data: {'province_id' : provinceID},
                    success: function(res){
                        console.log(res)
                        if(res.code == 200){
                            let options = '<option>Chọn quận huyện</option>'
                            let data = res.data.map(value => {
                                return `<option value="${value.DistrictID}">${value.DistrictName}</option>`
                            })
                            $('.district').html(options + data.join(''))
                            $('.ward').html('<option>Chọn xã phường</option>')
                        }
                    }
                })
            })

            // get ward
            $('.district').on('change', function(){
                let districtID = $(this).val()
                let text = $(this).find(':selected').text()
                $('[name="address[district]"]').val(text)
                $.ajax({
                    url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                    dataType: 'json',
                    data: {'district_id' : districtID},
                    success: function(res){
                        console.log(res)
                        if(res.code == 200){
                            let options = '<option>Chọn xã phường</option>'
                            let data = res.data.map(value => {
                                return `<option value="${value.WardCode}">${value.WardName}</option>`
                            })
                            $('.ward').html(options + data.join(''))
                        }
                    }
                })
            })

            $('.ward').on('change', function(){
                let text = $(this).find(':selected').text()
                $('[name="address[ward]"]').val(text)
            })

            // get product
            $.ajax({
                url: '{{ route('cart') }}',
                dataType: 'json',
                success: function(res){
                    console.log(res)
                    let products = res.data.map(value => {
                        return `<li>${value.product.name} ${value.options ? '(' + value.options + ')': ''} (Số lượng: ${value.quantity}) <span>${value.subtotal} </span></li>`
                    })
                    $('.your-order-middle ul').html(products.join(''))
                    $('.order-total span').text(res.total)
                }
            })

        })
    </script>
@endsection