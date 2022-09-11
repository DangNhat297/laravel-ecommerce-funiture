@extends('layouts.client.master')

@section('title', $post->title)

@section('breadcrumb', 'Chi tiết bài viết')

@section('content')
<div class="blog-details-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-wrapper">
                    <div class="blog-details-img-date-wrap mb-35" data-aos="fade-up" data-aos-delay="200">
                        <div class="blog-details-img">
                            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
                        </div>
                        <div class="blog-details-date">
                            <h5>{{ $post->created_at->format("d M") }}</h5>
                        </div>
                    </div>
                    <div class="blog-meta-2" data-aos="fade-up" data-aos-delay="200">
                        <ul>
                            <li>Tác giả: <a> {{ $post->author->fullname }}</a></li>
                        </ul>
                    </div>
                    <h1 data-aos="fade-up" data-aos-delay="200">{{ $post->title }}</h1>
                    <p data-aos="fade-up" data-aos-delay="200">{{ $post->short_desc }}</p>
                    <p data-aos="fade-up" data-aos-delay="200">
                        {{ $post->content }}
                    </p>
                    <div class="blog-author-wrap-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="blog-author-img-2">
                            <img src="https://st3.depositphotos.com/1767687/16607/v/450/depositphotos_166074422-stock-illustration-default-avatar-profile-icon-grey.jpg" alt="">
                        </div>
                        <div class="blog-author-content-2">
                            <h2>{{ $post->author->fullname }}</h2>
                            <p>Nothing is impossible !</p>
                            <div class="social-icon-style-3">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-glide-g"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-next-previous-post" data-aos="fade-up" data-aos-delay="200">
                        @if ($post->previous)
                        <div class="blog-prev-post-wrap">
                            <div class="blog-prev-post-icon">
                                <a href="{{ route('post.detail', ['id' => $post->previous->id, 'slug' => $post->previous->slug]) }}"><i class="fa fa-angle-left"></i></a>
                            </div>
                            <div class="blog-prev-post-content">
                                <h3><a href="{{ route('post.detail', ['id' => $post->previous->id, 'slug' => $post->previous->slug]) }}">{{ $post->previous->title }}</a></h3>
                                <span>{{ $post->previous->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                        @endif
                        @if ($post->next)
                        <div class="blog-next-post-wrap">
                            <div class="blog-next-post-icon">
                                <a href="{{ route('post.detail', ['id' => $post->next->id, 'slug' => $post->next->slug]) }}"> <i class="fa fa-angle-right"></i> </a>
                            </div>
                            <div class="blog-next-post-content">
                                <h3><a href="{{ route('post.detail', ['id' => $post->next->id, 'slug' => $post->next->slug]) }}">{{ $post->next->title }}</a></h3>
                                <span>{{ $post->next->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection