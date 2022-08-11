@extends('layouts.client.master')

@section('title', 'Đăng nhập')

@section('breadcrumb', 'Đăng nhập')

@section('content')
<div class="login-register-area pt-100 pb-100">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-form-container">
                        <div class="login-register-form">
                            <form action="{{ route('auth.processLogin') }}" method="post">
                                @csrf
                                @if (session()->has('error'))
                                    <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
                                @endif
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="login-toggle-btn">
                                    <input id="remember" name="remember" type="checkbox">
                                    <label for="remember">Nhớ mật khẩu</label>
                                </div>
                                <div class="button-box btn-hover">
                                    <button type="submit">Đăng nhập</button>
                                </div>
                                <p>Bạn chưa có tài khoản? <a href="{{ route('auth.register') }}">Đăng ký tại đây</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection