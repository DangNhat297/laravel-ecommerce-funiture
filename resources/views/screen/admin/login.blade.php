@extends('layouts.admin.auth')

@section('title', 'Đăng nhập')

@section('content')
	<!--begin::Login Sign in form-->
	<div class="login-signin">
		<div class="mb-20">
			<h3 class="opacity-40 font-weight-normal">Đăng Nhập Quản Trị</h3>
		</div>
		@if (session()->has('error'))
			<div class="alert alert-danger">{{ session()->get('error') }}</div>
		@endif
		@if (session()->has('success'))
			<div class="alert alert-success">{{ session()->get('success') }}</div>
		@endif
		<form class="form" method="POST" action="{{ route('admin.auth.processLogin') }}" id="kt_login_signin_form">
			@csrf
			<div class="form-group">
				<input value="{{ old('email') }}" wire:model="email" class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
				@error('email')
				<p class="text-danger">{{ $message }}</p>	
				@enderror
			</div>
			<div class="form-group">
				<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Mật khẩu" name="password" />
				@error('password')
				<p class="text-danger">{{ $message }}</p>	
				@enderror
			</div>
			<div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
				<div class="checkbox-inline">
					<label class="checkbox checkbox-outline checkbox-white text-white m-0">
					<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
					<span></span>Nhớ mật khẩu</label>
				</div>
			</div>
			<div class="form-group text-center mt-10">
				<button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Đăng nhập</button>
			</div>
		</form>
	</div>
	<!--end::Login Sign in form-->
@endsection