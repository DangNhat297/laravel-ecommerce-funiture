@extends('layouts.admin.master')

@section('title', 'Chi tiết đơn hàng #' .$order->id)

@section('title-heading', 'Chi tiết đơn hàng #'.$order->id)

@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::table-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Chi tiết đơn hàng #{{ $order->id }}</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('admin.order.list') }}" class="btn btn-sm btn-secondary mr-1">
                        <i class="fas fa-backward"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">NGÀY ĐẶT HÀNG</span>
                                <span class="opacity-70">{{ $order->created_at->format("d-m-Y \l\ú\c H:i") }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">MÃ ĐƠN HÀNG.</span>
                                <span class="opacity-70">#{{ $order->id }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder">ĐỊA CHỈ NHẬN HÀNG.</span>
                                <span class="opacity-70">{{ $order->fullname }}
                                <br>{{ $order->phone }}
                                <br>{{ $order->email }}
                                <br>{{ $order->address }}
                                <br>{{ $order->note }}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">SẢN PHẨM</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Số lượng</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Giá</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody id="product-detail">
                                    @foreach ($order->orderDetails as $item)
                                    <tr class="font-weight-boldest">
                                        <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                            <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                <div class="symbol-label" style="background-image: url({{ asset($item->product->thumbnail->path) }})"></div>
                                            </div> {{ $item->product->name }}
                                        </td>
                                        <td class="text-right pt-7 align-middle">{{ $item->quantity }}</td>
                                        <td class="text-right pt-7 align-middle">{{ productPrice($item->price) }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ productPrice($item->price*$item->quantity) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">TRẠNG THÁI</th>
                                        <th class="font-weight-bold text-muted text-uppercase text-right">TỔNG THANH TOÁN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{ config("common.order_status.{$order->status}") }}</td>
                                        <td class="text-primary font-size-h3 font-weight-boldest text-right">{{ productPrice($order->orderDetails->sum(fn($v) => $v->price*$v->quantity)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::table-->
    </div>
</div>
@endsection
