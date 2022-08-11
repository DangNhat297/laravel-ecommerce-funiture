@extends('layouts.admin.master')

@section('title', 'Danh sách người dùng')

@section('title-heading', 'Danh sách người dùng')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
        <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success text-center">{{ session()->get('error') }}</div>
        @endif
        <a href="{{ route('admin.user.add') }}" class="btn btn-primary mr-2 mb-3">Thêm người dùng</a>
        <!--begin::table-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Danh sách người dùng
                </h3></div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                @if (count($users) > 0)
                <div class="datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead class="datatable-head">
                            <tr class="datatable-row" style="left: 0px;">
                                <th class="datatable-cell" style="flex-grow:1"><span>Email</span></th>
                                <th class="datatable-cell" style="width: 35%"><span>Tên người dùng</span></th>
                                <th class="datatable-cell" style="width: 20%"><span>Trạng thái</span></th>
                                <th class="datatable-cell" style="width: 20%"><span>Vai trò</span></th>
                                <th class="datatable-cell text-right" style="width: 15%"><span>Hành động</span></th>
                            </tr>
                        </thead>
                        <tbody id="table-categories" class="datatable-body">
                            @foreach($users as $user)
                            <tr class="datatable-row" style="left: 0px;" data-user-id="{{ $user->id }}">
                                <td class="datatable-cell font-weight-bolder" style="flex-grow:1"><span>{{ $user->email }}</span></td>
                                <td class="datatable-cell font-weight-bolder" style="width: 35%"><span>{{ $user->fullname }}</span></td>
                                <td class="datatable-cell font-weight-bolder" style="width: 20%"><span>
                                    <select class="form-control user-status">
                                        <option value="0" @selected($user->status == 0)>Không kích hoạt</option>
                                        <option value="1" @selected($user->status == 1)>Kích hoạt</option>
                                    </select>
                                </td>
                                <td class="datatable-cell font-weight-bolder" style="width: 20%"><span>
                                    @if(!empty($user->getRoleNames()))
                                        <label>{{ $user->getRoleNames() }}</label>
                                    @else 
                                    Mặc định
                                    @endif
                                </td>
                                <td class="datatable-cell text-right" style="width: 15%">
                                    <span>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-icon btn-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    <form method="POST" action="{{ route('admin.user.delete', $user->id) }}" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-icon delete-item"><i class="fas fa-trash"></i></button>
                                    </form>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else  
                <div class="alert alert-warning text-center">Chưa có người dùng nào !</div>
                @endif
            </div>
        </div>
        <!--end::table-->
    </div>
</div>
@endsection

@section('custom-js-tag')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            })
            $('.user-status').change(function(){
                let status = Number($(this).val())
                let id = $(this).closest('tr').data('user-id')
                let _url = '{{route('admin.user.update', ':id')}}'
                _url = _url.replace(':id', id)
                $.ajax({
                    url: _url,
                    type: 'PATCH',
                    dataType: 'json',
                    data: {status: status},
                    success: function(res){
                        if(res.status){
                            Swal.fire({
                                position: 'top-right',
                                icon: 'success',
                                title: 'Đã cập nhật người dùng',
                                showConfirmButton: false,
                                timer: 1300,
                                timerProgressBar: true
                            })
                        }
                    }
                })
            })
        })
    </script>
@endsection