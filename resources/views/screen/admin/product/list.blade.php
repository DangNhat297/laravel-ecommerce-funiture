@extends('layouts.admin.master')

@section('title', 'Danh sách sản phẩm')

@section('title-heading', 'Danh sách sản phẩm')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
        <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success text-center">{{ session()->get('error') }}</div>
        @endif
        <a href="{{ route('admin.product.add') }}" class="btn btn-primary mr-2 mb-3">Thêm sản phẩm</a>
        <!--begin::table-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Danh sách sản phẩm
                </h3></div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead class="datatable-head">
                            <tr class="datatable-row" style="left: 0px;">
                                <th class="datatable-cell" style="width: 15%"><span>Ảnh</span></th>
                                <th class="datatable-cell" style="flex-grow:1"><span>Tên</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Giá</span></th>
                                <th class="datatable-cell" style="width: 13%"><span>Tình trạng</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Giảm giá</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Trạng thái</span></th>
                                <th class="datatable-cell text-right" style="width: 13%"><span>Tùy chọn</span></th>
                            </tr>
                        </thead>
                        <tbody class="datatable-body">
                            @foreach ($products as $product)
                            <tr class="datatable-row" style="left: 0px;">
                                <td class="datatable-cell" style="width: 15%"><span><img src="{{ getPathImage($product->thumbnail->path) }}" style="width:90%;object-fit:cover;display:block;margin:0 auto;aspect-ratio:1/1"></span></td>
                                <td class="datatable-cell font-weight-bold" style="flex-grow:1"><span>{{ $product->name }}</span></td>
                                <td class="datatable-cell font-weight-bold" style="width: 15%"><span>{{ productPrice($product->price) }}</span></td>
                                <th class="datatable-cell" style="width: 13%"><span class="label font-weight-bold label-lg {{ $product->quantity > 0 ? 'label-success' : 'label-warning' }} label-rounded label-inline">{{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}</span></th>
                                <th class="datatable-cell" style="width: 15%"><span class="label font-weight-bold label-lg {{ $product->promotion > 0 ? 'label-success' : 'label-warning' }} label-rounded label-inline">{{ $product->promotion > 0 ? 'Đang giảm giá' : 'Không' }}</span></th>
                                <th class="datatable-cell" style="width: 15%"><span class="label font-weight-bold label-lg {{ $product->published == 1 ? 'label-success' : 'label-warning' }} label-rounded label-inline">{{ $product->published == 1 ? 'Đã xuất bản' : 'Bản nháp' }}</span></th>
                                <td class="datatable-cell text-right" style="width: 13%">
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-icon btn-success btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-danger btn-sm mr-2 delete-item"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $products->render("pagination::bootstrap-5") }}
            </div>
        </div>
        <!--end::table-->
    </div>
</div>
@endsection
