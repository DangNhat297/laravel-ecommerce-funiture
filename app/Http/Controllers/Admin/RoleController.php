<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::all();
        return view('screen.admin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:roles,name'
        ], [
            'required'  => ':attribute không được để trống',
            'unique'    => 'Tên vai trò đã tồn tại'
        ], [
            'name'  => 'Tên vai trò'
        ]);
        try{
            Role::create([
                'name'  => $request->name
            ]);
            return redirect()
                    ->back()
                    ->with('success', 'Thêm vai trò thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
