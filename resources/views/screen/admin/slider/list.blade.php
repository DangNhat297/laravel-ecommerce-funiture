@extends('layouts.admin.master')

@section('title', 'Danh sách slide')

@section('title-heading', 'Danh sách slide')

@section('content')
<form action="{{ route('admin.slider.sort') }}" method="POST" class="mt-3">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.slider.add') }}" class="btn btn-primary mr-2 mb-3">Thêm slider</a>
            @if (session()->has('success'))
                <div class="alert alert-success text-center">{{session()->get('success')}}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
            @endif
        </div>
    </div>
    <div class="row parent">
        @foreach($sliders as $slider)
        <div class="col-md-12">
            <div class="card card-custom mb-3">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label"></h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-icon btn-sm btn-success mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.slider.delete', $slider->id) }}" class="btn btn-icon btn-sm btn-danger mr-1">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ getPathImage($slider->image) }}" style="display:block;margin:0 auto;width: 100%;height:220px;object-fit:cover">
                        </div>
                        <div class="col-md-6">
                            <p>Tiêu đề: <input type="text" class="form-control" value="{{$slider->title}}" placeholder="Không có tiêu đề" disabled></p>
                            <p>Url: <input type="text" class="form-control" value="{{$slider->url}}" placeholder="Không có đường dẫn" disabled></p>
                            <input type="hidden" name="sliders[]" value="{{$slider->id}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if (count($sliders) > 0)
        <button class="btn btn-primary" type="submit">Cập nhật</button>
    @else
        <p class="font-weight-bold text-center">Không có dữ liệu</p>
    @endif
    @csrf
</form>
@endsection

@section('custom-js-tag')
<script>
    $(document).ready(function(){
        $('.parent').sortable({
            cursor: "move"
        })
        $('[data-type-btn="delete"]').click(function(e){
            let _this = $(this)
            e.preventDefault()
            Swal.fire({
                title: 'Bạn có chắc muốn xóa sản phẩm này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa ngay!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    return window.location.href = _this.attr('href')
                } 
                return false
            })
        })
    })
</script>
@endsection