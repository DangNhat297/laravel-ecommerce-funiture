<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('screen.admin.user.list', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('screen.admin.user.create', compact('roles'));
    }

    public function store(RegisterRequest $request)
    {
        try{
            $user = new User();
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            $user->save();
            $user->assignRole($request->roles);
            return redirect()
                    ->route('admin.user.list')
                    ->with('success', 'Đăng ký thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function update(User $user, Request $request)
    {
        try{
            $user->status = $request->status;
            $user->save();
            return response()->json(['status' => true]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status' => false]);
        }
    }

    public function destroy(User $user){
        $result = $user->delete();
        if($result){
            return redirect()
                    ->back()
                    ->with('success', 'Xóa người dùng thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRole = $user->roles->pluck('name')->all();
        return view('screen.admin.user.edit', compact('user', 'roles', 'userRole'));
    }

    public function updateRoles(User $user, Request $request)
    {
        try{
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            $user->assignRole($request->roles);
            return redirect()
                        ->route('admin.user.list')
                        ->with('success', 'Cập nhật thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                        ->back()
                        ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
