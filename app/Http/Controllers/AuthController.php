<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login', [
            'title' => 'Form Login',
        ]);
    }
    public function register()
    {
        $outlets = Outlet::all();
        return view('register', [
            'title' => 'Form Register',
            'outlets' => $outlets,
        ]);
    }
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return redirect('/login')->with('error', 'Username atau Password salah');
    }
    public function postRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'id_outlet' => 'required',
        ]);
        if ($request->id_outlet == '-') {
            $validatedData['id_outlet'] = 1;
        }
        $validatedData['password'] = Hash::make($request->password);
        $check_count_user = User::count();
        if ($check_count_user == 0) {
            $validatedData['role'] = 'admin';
        } elseif ($check_count_user == 1) {
            $validatedData['role'] = 'kasir';
        } elseif ($check_count_user >= 2) {
            $validatedData['role'] = 'owner';
        } else {
            return redirect('register')->with('error', 'Unexpected count user');
        }

        User::create($validatedData);
        return redirect('login')->with('message', 'Sukses Register User');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
