<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->isAdmin() ? route('admin.dashboard') : '/');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone'    => 'required|string',
            'password' => 'required|string',
        ], [
            'phone.required'    => 'Telefon raqam kiritilmadi.',
            'password.required' => 'Parol kiritilmadi.',
        ]);

        $phone = preg_replace('/\D/', '', $request->phone);

        $user = User::where('phone', $phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withInput()->with('error', 'Telefon raqam yoki parol noto\'g\'ri.');
        }

        Auth::login($user, $request->boolean('remember'));

        return redirect($user->isAdmin() ? route('admin.dashboard') : '/');
    }

    public function showRegister()
    {
        if (Auth::check()) return redirect('/');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'phone'    => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required'      => 'Ism kiritilmadi.',
            'phone.required'     => 'Telefon raqam kiritilmadi.',
            'password.required'  => 'Parol kiritilmadi.',
            'password.min'       => 'Parol kamida 6 ta belgidan iborat bo\'lishi kerak.',
            'password.confirmed' => 'Parollar mos kelmadi.',
        ]);

        $phone = preg_replace('/\D/', '', $request->phone);

        if (User::where('phone', $phone)->exists()) {
            return back()->withInput()->with('error', 'Bu telefon raqam allaqachon ro\'yxatdan o\'tgan.');
        }

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $phone,
            'password' => $request->password,
            'role'     => 'user',
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'Muvaffaqiyatli ro\'yxatdan o\'tdingiz!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
