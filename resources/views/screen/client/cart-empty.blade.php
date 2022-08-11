@extends('layouts.client.master')

@section('title', 'Giỏ hàng trống')

@section('breadcrumb', 'Giỏ hàng trống')

@section('content')
    <div class="cart-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body cart">
                            <div class="col-sm-12 empty-cart-cls text-center">
                                <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130"
                                    class="img-fluid mb-4 mr-3">
                                <h3><strong>Giỏ hàng của bạn đang trống</strong></h3>
                                <a href="{{ route('home') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Quay lại trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
