@extends('layouts.admin.master')

@section('title', 'Sửa bài viết')

@section('title-heading', 'Sửa bài viết')

@section('content')
<form id="add-product" method="POST" action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Sửa bài viết</h3>
                </div>
                <!--begin::Form-->
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu đề
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $post->title }}" name="title" placeholder="Nhập tiêu đề bài viết">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $post->slug }}" name="slug" placeholder="Nhập đường dẫn">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả ngắn
                            <span class="text-danger">*</span></label>
                            <textarea name="short_desc" rows="4" class="form-control" placeholder="Nhập mô tả ngắn">{{ $post->short_desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung
                            <span class="text-danger">*</span></label>
                        <textarea name="content">{{ $post->content }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Hiển thị</label>
                        <div class="radio-inline">
                            <label class="radio radio-rounded">
                            <input type="radio" value="1" name="published" @checked($post->published == 1)>
                            <span></span>Hiển thị</label>
                            <label class="radio radio-rounded">
                            <input type="radio" value="0" name="published" @checked($post->published == 0)>
                            <span></span>Không hiển thị</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                    <a href="{{ route('admin.post.list') }}"><button type="button" class="btn btn-success mr-2">Danh sách bài viết</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="fas fa-birthday-cake text-primary"></i>
                        </span>
                        <h3 class="card-label">Danh mục</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div data-scroll="true" data-height="auto" class="scroll ps ps--active-y" style="max-height: 200px; overflow: hidden;">
                        <div class="checkbox-list">
                            {{ checkboxCategories($categories) }}
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: -50px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 50px; height: 200px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 22px; height: 89px;"></div>
                        </div>
                    </div>
                    @error('categories')
                            <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="far fa-image text-primary"></i>
                        </span>
                        <h3 class="card-label">Ảnh đại diện</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-file">
                        <input type="file" id="preview-image" name="thumbnail" accept=".png, .jpg, .jpeg, .jfif" class="custom-file-input">
                        <label class="custom-file-label" style="overflow:hidden" for="customFile">Choose file</label>
                    </div>
                    <div class="form-group preview-image" style="margin-top: 10px;"></div>
                    <div class="form-group preview-image2" style="margin-top: 10px;">
                        <img src='{{ getPathImage($post->thumbnail) }}' style='display:block;margin:10px auto;width: auto;height: 150px;object-fit:cover;border:1px solid #3699ff;border-radius:5px;'>
                    </div>
                    @error('thumbnail')
                            <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('custom-js-tag')
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace( 'content' )

        $('[name="title"]').blur(function(){
            $('[name="slug"]').val(ChangeToSlug($('[name="title"]').val()))
        })

        let categoriesSelected = []
        @foreach($post->categories->toArray() as $item)
        categoriesSelected.push({{$item['id']}})
        @endforeach
        console.log(categoriesSelected)
        $('[name="categories[]"]').each((index, element) => {
            if($.inArray(Number($(element).val()), categoriesSelected) >= 0){
                $(element).prop('checked', true)
                console.log($(element).val())
            }
        })

        $("#preview-image").on('change', function(){
            $this = $(this)
            if(this.files[0] && this.files[0].size != 0){
                $('.preview-image2').hide()
            } else {
                $('.preview-image2').show()
            }
        })

    })
</script>
@endsection