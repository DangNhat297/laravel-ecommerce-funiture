@extends('layouts.client.master')

@section('title', 'Đăng ký')

@section('breadcrumb', 'Đăng ký')

@section('content')
<div class="login-register-area pt-100 pb-100">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-form-container">
                        <div class="login-register-form">
                            <form action="{{ route('auth.processRegister') }}" method="post">
                                @csrf
                                @if (session()->has('error'))
                                    <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                                @endif
                                <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" placeholder="Họ và tên">
                                @error('fullname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username">
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="button-box btn-hover">
                                    <button type="submit">Đăng ký</button>
                                </div>
                                <p>Bạn đã có tài khoản? <a href="{{ route('auth.login') }}">Đăng nhập tại đây</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection