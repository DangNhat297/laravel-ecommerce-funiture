@extends('layouts.admin.master')

@section('title', 'Danh sách đánh giá')

@section('title-heading', 'Danh sách đánh giá')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::table-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Danh sách đánh giá
                </h3></div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead class="datatable-head">
                            <tr class="datatable-row" style="left: 0px;">
                                <th class="datatable-cell" style="flex-grow:1"><span>Sản phẩm</span></th>
                                <th class="datatable-cell" style="width: 13%"><span>Tổng lượt đánh giá</span></th>
                                <th class="datatable-cell" style="width: 13%"><span>Đánh giá trung bình</span></th>
                                <th class="datatable-cell text-right" style="width: 15%"><span>Chi tiết</span></th>
                            </tr>
                        </thead>
                        <tbody id="table-categories" class="datatable-body">
                            @foreach($products as $product)
                            <tr class="datatable-row" style="left: 0px;">
                                <td class="datatable-cell font-weight-bold" style="flex-grow:1"><span>{{ $product->name }}</span></td>
                                <td class="datatable-cell font-weight-bold" style="width: 13%"><span>{{ $product->reviews_count }}</span></td>
                                <td class="datatable-cell font-weight-bold" style="width: 13%"><span>{{ roundNumber($product->rating) }} <i class="fas fa-star" style="color:#fad102"></i></span></td>
                                <td class="datatable-cell text-right" style="width: 15%">
                                    <span>
                                    <a href="{{ route('admin.review.detail', $product->id) }}" class="btn btn-success btn-sm list-review-product">
                                        <i class="far fa-comments"></i> Chi tiết
                                    </a>
                                    </span>
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