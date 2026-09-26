<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taikhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:taikhoans,phone',
            'password' => 'required|min:6',
            'fullname' => 'required|string',
        ]);

        $taikhoan = Taikhoan::create([
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'address' => $request->address,
        ]);

        Auth::guard('taikhoan')->login($taikhoan);

        return redirect('/')->with('success', 'Đăng ký tài khoản thành công!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('taikhoan')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'phone' => 'Số điện thoại hoặc mật khẩu không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('taikhoan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Đã đăng xuất.');
    }
}
