<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TipePengaduan;
use Dotenv\Parser\Value;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage(): View
    {
        return view("auth.login");
    }

    public function registerPage(): View
    {
        return view("auth.register");;
    }

    public function login(Request $request)
    {
        $credentials = $request->only("email","password");

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended(default: '/dashboard')->with(key: 'success', value:'Selamat datang kembali!');
        }

        return back()->with(key: 'error', value: 'Email atau password salah');
    }

    public function register(Request $request)
    {
        $request->validate(rules: [
            'name' => 'required|string|max:25',
            "email" => 'required|string|email|unique:users',
            "provinsi" => 'nullable|string',
            "password" => 'required|string|min:6|confirmed',
        ]);

        User::create(attributes:[
            'name'=> $request->name,
            'email'=> $request->email,
            'provinsi'=> $request->provinsi,
            'password'=> Hash::make(value: $request->password),
        ]);

        return redirect()->route(route: 'login')->with(key: 'success', value: 'Akun berhasil dibuat');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(to: '/');

    }
}
