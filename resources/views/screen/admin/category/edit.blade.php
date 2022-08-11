@extends('layouts.admin.master')

@section('title', 'Sửa danh mục sản phẩm')

@section('title-heading', 'Sửa danh mục sản phẩm')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Sửa danh mục sản phẩm</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên danh mục
                            <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control" placeholder="Nhập tên danh mục">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn
                            <span class="text-danger">*</span></label>
                        <input value="{{ $category->slug }}" type="text" name="slug" class="form-control" placeholder="Slug">
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
                        <div class="preview-image new"></div>
                        <div class="preview-image old">
                            <img src='{{ getPathImage($category->image) }}' style='display:block;margin:10px auto 0;width: auto;height: 150px;object-fit:cover;border:1px solid #3699ff;border-radius:5px;'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Danh mục cha
                        <span class="text-danger">*</span></label>
                        <select class="form-control" name="parent_id" data-value="{{ $category->parent_id }}">
                            <option value="0">Danh mục cha</option>
                            {!! selectCategories($categories) !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hiển thị</label>
                        <div class="radio-inline">
                            <label class="radio radio-rounded">
                            <input type="radio" value="1" name="status" @checked($category->status == 1)>
                            <span></span>Hiển thị</label>
                            <label class="radio radio-rounded">
                            <input type="radio" value="0" name="status" @checked($category->status == 0)>
                            <span></span>Không hiển thị</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="btn-add-category" class="btn btn-primary mr-2">Cập nhật</button>
                        <a href="{{ route('admin.category.list') }}" class="btn btn-success mr-2">Danh sách danh mục</a>
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