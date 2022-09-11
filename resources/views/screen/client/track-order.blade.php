@extends('layouts.client.master')

@section('title', 'Thông tin đơn hàng')

@section('breadcrumb', 'Thông tin đơn hàng')

@section('content')
    <div class="container pb-100 pt-100">
        <!-- Main content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Details -->
                <form action="" method="GET" class="mb-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ request()->query('id') ?? '' }}" placeholder="Nhập mã đơn hàng" name="id" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="submit">Xem thông tin</button>
                        </div>
                      </div>
                </form>
                @if (isset($order))
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <span class="me-3">{{ $order->created_at->format('m-d-Y \l\ú\c H:i') }}</span>
                                <span class="me-3">#{{ $order->id }}</span>
                                <span class="badge rounded-pill bg-info">{{ config("common.order_status.{$order->status}") }}</span>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                @foreach($order->orderDetails as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex mb-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $product->product->thumbnail->path }}" alt="{{ $product->product->name }}"
                                                    width="35" class="img-fluid">
                                            </div>
                                            <div class="flex-lg-grow-1 ms-3">
                                                <h6 class="small mb-0"><a href="#" class="text-reset">{{ $product->product->name }}</a>
                                                </h6>
                                                <span class="small">{{ $product->options }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->quantity }}</td>
                                    <td class="text-end">{{ productPrice($product->quantity*$product->price) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="2">Tổng tiền</td>
                                    <td class="text-end">{{ productPrice($order->orderDetails->sum(fn($v) => $v->price*$v->quantity)) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Payment -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="h6">Ghi chú khách hàng</h3>
                                <p>{{ $order->note }}</p>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="h6">Địa chỉ thanh toán</h3>
                                <address>
                                    <strong>{{ $order->name }}</strong><br>
                                    <p>{{ $order->address }}</p>
                                    <p>{{ $order->email }}</p>
                                    <abbr title="Phone"></abbr> {{ hiddenPhone($order->phone) }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
