@extends('layouts.admin.master')

@section('title', 'Thêm người dùng')

@section('title-heading', 'Thêm người dùng')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('error'))
                <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
            @endif
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Thêm người dùng</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('admin.user.updateRoles', $user->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Họ và tên
                                <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $user->fullname }}" class="form-control" placeholder="Nhập họ và tên" name="fullname" readonly>
                            @error('fullname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <label>Email
                                <span class="text-danger">*</span></label>
                            <input type="email" value="{{ $user->email }}" class="form-control" placeholder="Nhập email" name="email" readonly>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tên đăng nhập
                                <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $user->username }}" class="form-control" placeholder="Nhập tên đăng nhập" name="username" readonly>
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Vai trò</label>
                            <select name="roles[]" class="form-control select2" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{$role->name}}" @selected(in_array($role->name, $userRole))>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn-add-category" class="btn btn-primary mr-2">Thêm</button>
                            <a href="{{ route('admin.user.list') }}" class="btn btn-success mr-2">Danh sách người dùng</a>
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
            $('.select2').select2({
                placeholder: 'Chọn vai trò:'
            })
        })
    </script> 
@endsection
