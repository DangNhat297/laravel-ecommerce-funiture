@extends('layouts.admin.master')

@section('title', 'Thêm danh mục bài viết')

@section('title-heading', 'Thêm danh mục bài viết')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm danh mục bài viết</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.post-category.processCreate') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên danh mục
                            <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Nhập tên danh mục">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn
                            <span class="text-danger">*</span></label>
                        <input value="{{ old('slug') }}" type="text" name="slug" class="form-control" placeholder="Slug">
                        @error('slug')
                            <p class="text-danger">{{$message}}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" accept=".png, .jpg, .jpeg, .jfif" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @error('image')
                            <p class="text-danger">{{$message}}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Danh mục cha
                        <span class="text-danger">*</span></label>
                        <select class="form-control" name="parent_id" data-value="{{ old('parent_id') }}">
                            <option value="0">Danh mục cha</option>
                            {!! selectCategories($categories) !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hiển thị</label>
                        <div class="radio-inline">
                            <label class="radio radio-rounded">
                            <input type="radio" value="1" checked="checked" name="status">
                            <span></span>Hiển thị</label>
                            <label class="radio radio-rounded">
                            <input type="radio" value="0" name="status">
                            <span></span>Không hiển thị</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="btn-add-category" class="btn btn-primary mr-2">Thêm</button>
                        <a href="{{ route('admin.post-category.list') }}" class="btn btn-success mr-2">Danh sách danh mục bài viết</a>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection

@section('custom-js-tag')
<script>
    $(document).ready(function(){
        $('[name="name"]').blur(function(){
            let title = $(this).val()
            $('[name="slug"]').val(ChangeToSlug(title))
        })

        $('[name="parent_id"]').val($('[name="parent_id"]').data('value') || 0).change()
    })
</script>
@endsection