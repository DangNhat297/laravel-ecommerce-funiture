@extends('layouts.admin.master')

@section('title', 'Quản lý thuộc tính sản phẩm')

@section('title-heading', 'Thuộc tính sản phẩm')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('success'))
            <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-error text-center">{{ session()->get('error') }}</div>
            @endif
        </div>
        <div class="col-md-6">
            <form action="{{ isset($currentAttr) ? route('admin.attribute.update', $currentAttr->id) : route('admin.attribute.processCreate') }}" method="POST">
            @if (isset($currentAttr))
                @method('PUT')
            @endif
            <div class="card card-custom">
                @csrf
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                        @if (isset($currentAttr))
                            <i class="far fa-edit text-primary"></i> Sửa thuộc tính
                        @else
                            <i class="fas fa-plus text-primary"></i> Thêm mới
                        @endif

                        </h3>
                    </div>
                    @if (isset($currentAttr))
                    <div class="card-toolbar">
                        <a href="{{ route('admin.attribute.list') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> Quay lại</a>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Tên</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" value="{{ isset($currentAttr) ? $currentAttr->name : old('name') }}" class="form-control" name="name" placeholder="Tên thuộc tính">
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-sm btn-secondary">Làm lại</button>
                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label"><i class="fas fa-th-list text-primary"></i> Danh sách thuộc tính</h3>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <!--begin: Datatable-->
                    <div class="datatable datatable-default datatable-bordered datatable-loaded">
                        <table class="table table-head-custom table-head-bg table-hover table-bordered table-vertical-center">
                            <thead class="datatable-head">
                                <tr class="datatable-row" style="left: 0px;">
                                    <th class="datatable-cell" style="flex-grow:1"><span>Tên</span></th>
                                    <th class="datatable-cell" style="width: 30%"><span>Tình trạng</span></th>
                                    <th class="datatable-cell text-right" style="width: 30%"><span>Tùy chọn</span></th>
                                </tr>
                            </thead>
                            <tbody class="datatable-body">
                                @foreach ($attributes as $attr)
                                <tr class="datatable-row @if(isset($currentAttr) && $currentAttr->id == $attr->id) bg-primary @endif" style="left: 0px;">
                                    <td class="datatable-cell font-weight-bold" style="flex-grow:1"><span>{{ $attr->name }}</span></td>
                                    <td class="datatable-cell font-weight-bold" style="width: 30%"><span>{{ $attr->type }}</span></td>
                                    <td class="datatable-cell text-right" style="width: 30%">
                                        <a href="{{ route('admin.attribute.edit', $attr->id) }}" class="btn btn-icon btn-success btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.attribute.delete', $attr->id) }}" method="POST" class="d-inline">
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
            </div>
        </div>
    </div>
@endsection