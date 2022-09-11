@extends('layouts.client.master')

@section('title', 'Tài khoản của tôi')

@section('breadcrumb', 'Tài khoản của tôi')

@section('content')
<!-- my account wrapper start -->
<div class="my-account-wrapper pb-100 pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-bs-toggle="tab">Tài khoản</a>
                                <a href="#orders" data-bs-toggle="tab">Đơn hàng</a>
                                <a href="#account-info" data-bs-toggle="tab">Thông tin tài khoản</a>
                                <a href="{{ route('logout') }}">Đăng xuất</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Tổng quan tài khoản</h3>
                                        <div class="welcome">
                                            <p>Xin chào, <strong>{{ auth()->user()->fullname }}</strong> (Nếu không phải là <strong>{{ auth()->user()->fullname }} !</strong><a href="{{ route('logout') }}" class="logout"> Đăng xuất</a>)</p>
                                        </div>

                                        <p class="mb-0">Từ trang tổng quan tài khoản của bạn. bạn có thể dễ dàng kiểm tra và xem các đơn đặt hàng gần đây, quản lý địa chỉ giao hàng và thanh toán cũng như chỉnh sửa mật khẩu và chi tiết tài khoản của mình.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>ID.</th>
                                                        <th>Ngày tạo</th>
                                                        <th>Trạng thái</th>
                                                        <th>Tổng tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orders as $order)
                                                    <tr>
                                                        <td>#{{ $order->id }}</td>
                                                        <td>{{ $order->created_at->format("d-m-Y \l\ú\c H:i") }}</td>
                                                        <td>{{ config("common.order_status.{$order->status}") }}</td>
                                                        <td>{{ productPrice($order->orderDetails->sum(fn($q) => $q->quantity*$q->price)) }}</td>
                                                        @if ($order->status == 1)
                                                            <td><a href="{{ route('profile.cancel-order', $order->id) }}" class="check-btn sqr-btn cancel-order">Hủy đơn</a></td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first-name" class="required">First Name</label>
                                                            <input type="text" id="first-name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">Last Name</label>
                                                            <input type="text" id="last-name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="display-name" class="required">Display Name</label>
                                                    <input type="text" id="display-name" />
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email Addres</label>
                                                    <input type="email" id="email" />
                                                </div>
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <div class="single-input-item">
                                                        <label for="current-pwd" class="required">Current Password</label>
                                                        <input type="password" id="current-pwd" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">New Password</label>
                                                                <input type="password" id="new-pwd" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                <input type="password" id="confirm-pwd" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item btn-hover">
                                                    <button class="check-btn sqr-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js-tag')
<script>
    $(document).ready(function(){
        $('.cancel-order').click(function(e){
            e.preventDefault()
            let _this = $(this)
            Swal.fire({
                title: 'Bạn có chắc muốn hủy đơn hàng này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hủy ngay',
                cancelButtonText: 'Không'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(_this).attr('href')
            }
            })
        })
    })
</script>
@endsection