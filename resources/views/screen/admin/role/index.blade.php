@extends('layouts.admin.master')

@section('title', 'Vai trò')

@section('title-heading', 'Vai trò')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
        <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success text-center">{{ session()->get('error') }}</div>
        @endif
        <div class="card card-custom mb-3">
            <div class="card-header">
                <h3 class="card-title">Thêm vai trò</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.role.processCreate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên vai trò</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Danh sách vai trò</h3>
            </div>
            <div class="card-body">
                <div class="datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead class="datatable-head">
                            <tr class="datatable-row" style="left: 0px;">
                                <th class="datatable-cell"><span>Tên vai trò.</span></th>
                            </tr>
                        </thead>
                        <tbody id="table-categories" class="datatable-body">
                            @foreach($roles as $role)
                            <tr class="datatable-row" style="left: 0px;">
                                <td class="datatable-cell"><span class="text-dark-75 font-weight-bolder d-block font-size-lg mb-2">{{ $role->name }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
