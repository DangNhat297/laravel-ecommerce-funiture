@extends('layouts.client.master')

@section('title', 'Liên hệ')

@section('breadcrumb', 'Liên hệ')

@section('content')

<div class="map mt-5 pt-120" data-aos="fade-up" data-aos-delay="200">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558813955!2d105.74459841424536!3d21.03813279283566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1660530332573!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="contact-form-area pt-90 pb-100">
    <div class="container">
        <div class="section-title-4 text-center mb-55" data-aos="fade-up" data-aos-delay="200">
            <h2>Hỏi chúng tôi bất cứ điều gì ở đây</h2>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        <div class="contact-form-wrap" data-aos="fade-up" data-aos-delay="200">
            <form class="contact-form-style" action="{{ route('contact.send') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <input name="name" value="{{ old('name') }}" type="text" placeholder="Họ và tên*">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input name="email" value="{{ old('email') }}" type="email" placeholder="Email*">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input name="subject" value="{{ old('subject') }}" type="text" placeholder="Tiêu đề*">
                        @error('subject')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        {{-- <input name="phone" type="text" placeholder="Phone*"> --}}
                    </div>
                    <div class="col-lg-8">
                        <textarea name="message" placeholder="Nội dung">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 contact-us-btn btn-hover">
                        <button class="submit" type="submit">Gửi liên hệ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection