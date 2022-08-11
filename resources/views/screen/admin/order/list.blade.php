@extends('layouts.admin.master')

@section('title', 'Danh sách đơn hàng')

@section('title-heading', 'Danh sách đơn hàng')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
        <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        <!--begin::table-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Danh sách đơn hàng
                </h3></div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead class="datatable-head">
                            <tr class="datatable-row" style="left: 0px;">
                                <th class="datatable-cell" style="width: 10%"><span>ID.</span></th>
                                <th class="datatable-cell" style="flex-grow:1"><span>Thông tin</span></th>
                                <th class="datatable-cell" style="width: 13%"><span>Ngày tạo đơn</span></th>
                                <th class="datatable-cell" style="width: 13%"><span>Tổng tiền</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Trạng thái</span></th>
                                <th class="datatable-cell text-right" style="width: 10%"><span>Hành động</span></th>
                            </tr>
                        </thead>
                        <tbody id="table-categories" class="datatable-body">
                            @foreach($orders as $order)
                            <tr class="datatable-row" style="left: 0px;" data-order-id="{{ $order->id }}">
                                <td class="datatable-cell" style="width: 10%"><span class="text-dark-75 font-weight-bolder d-block font-size-lg mb-2">#{{ base64_encode('donhang_' . $order->id) }}</span></td>
                                <td class="datatable-cell" style="flex-grow:1">
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg mb-2">{{ $order->fullname }}</span>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg mb-2">{{ $order->phone }}</span>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg mb-2">{{ $order->email }}</span>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->address }}</span>
                                </td>
                                <td class="datatable-cell" style="width: 13%"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->created_at->format("d-m-Y \l\ú\c H:i") }}</span></td>
                                <td class="datatable-cell" style="width: 13%"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ productPrice($order->orderDetails->sum(fn($q) => $q->price * $q->quantity)) }}</span></td>
                                <td class="datatable-cell" style="width: 15%">
                                    <select class="form-control order-status">
                                        <option value="0" @selected($order->status == 0)>Đã hủy</option>
                                        <option value="1" @selected($order->status == 1)>Đang xử lý</option>
                                        <option value="2" @selected($order->status == 2)>Đang vận chuyển</option>
                                        <option value="3" @selected($order->status == 3)>Thành công</option>
                                    </select>
                                </td>
                                <td class="datatable-cell text-right" style="width: 10%">
                                    <a href="{{ route('admin.order.detail', $order->id) }}" class="btn btn-icon btn-success btn-sm detail-order">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-danger btn-sm delete-item">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::table-->
    </div>
</div>
@endsection

@section('custom-js-tag')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            })
            $('.order-status').change(function(){
                let status = Number($(this).val())
                let id = $(this).closest('tr').data('order-id')
                let _url = '{{route('admin.order.update',':id')}}'
                _url = _url.replace(':id', id)
                $.ajax({
                    url: _url,
                    type: 'PUT',
                    data: {status: status},
                    dataType: 'json',
                    success: function(res){
                        if(res.status){
                            Swal.fire({
                                position: 'top-right',
                                icon: 'success',
                                title: 'Đã cập nhật đơn hàng',
                                showConfirmButton: false,
                                timer: 1300,
                                timerProgressBar: true
                            })
                        }
                    }
                })
            })
        })
    </script>
@endsection