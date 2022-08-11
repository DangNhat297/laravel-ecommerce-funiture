@extends('layouts.admin.master')

@section('title', 'Thêm slider')

@section('title-heading', 'Thêm slider')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm slider</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.processCreate') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu đề
                            <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control" placeholder="Nhập tiêu đề">
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn
                            <span class="text-danger">*</span></label>
                        <input value="{{ old('url') }}" type="text" name="url" class="form-control" placeholder="Đường dẫn">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="desc" rows="5" class="form-control" placeholder="Mô tả slider"></textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Target</label>
                        <div class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                <input type="radio" value="_blank" name="target" checked>
                                <span></span>_blank</label>
                                <label class="radio">
                                <input type="radio" value="self" name="target">
                                <span></span>self</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ảnh slide</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" accept=".png, .jpg, .jpeg, .jfif, .webp" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @error('image')
                            <p class="text-danger">{{$message}}</p>    
                        @enderror
                        <div class="preview-image new"></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="btn-add-category" class="btn btn-primary mr-2">Thêm</button>
                        <a href="{{ route('admin.slider.list') }}" class="btn btn-success mr-2">Danh sách slider</a>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection