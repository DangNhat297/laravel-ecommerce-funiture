<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    
    public function login()
    {
        return view('screen.admin.login');
    }

    public function processLogin(LoginRequest $request)
    {
        $remember = isset($request->remember) ? true : false;
        if(Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ], $remember)){
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }

}
