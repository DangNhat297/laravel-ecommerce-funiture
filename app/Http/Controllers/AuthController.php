<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('screen.client.login');
    }

    public function processLogin(LoginRequest $request){
        $remember = isset($request->remember) ? true : false;

        $user = User::where('email', $request->email)->first();
        if(!password_verify($request->password, $user->password)){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
        } elseif ($user->status == 0){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Tài khoản chưa được kích hoạt');
        } else {
            Auth::attempt([
                'email'     => $request->email,
                'password'  => $request->password
            ], $remember);
            return redirect()->route('home');
        }
    }

    public function register()
    {
        return view('screen.client.register');
    }

    public function processRegister(RegisterRequest $request)
    {
        try{
            $user = new User();
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            $user->save();
            return redirect()
                    ->route('auth.login')
                    ->with('success', 'Đăng ký thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

}
