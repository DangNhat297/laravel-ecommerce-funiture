@extends('layouts.client.master')

@section('title', 'Danh sách bài viết')

@section('breadcrumb', 'Danh sách bài viết')

@section('content')
<div class="blog-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="blog-wrap mb-50" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-img-date-wrap mb-25">
                        <div class="blog-img">
                            <a href="{{ route('post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}"><img src="{{ getPathImage($post->thumbnail) }}" alt=""></a>
                        </div>
                        <div class="blog-date">
                            <h5>{{ $post->created_at->format("d M") }}</h5>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h3><a href="{{ route('post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}">{{ $post->title }}</a></h3>
                        <p>{{ $post->short_desc }}</p>
                        <div class="blog-btn-2 btn-hover">
                            <a class="btn hover-border-radius theme-color" href="{{ route('post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $posts->links('vendor.pagination.custom-client') }}
    </div>
</div>
@endsection