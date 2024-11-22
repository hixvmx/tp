<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    //
    public function viewRegisterPage()
    {
        return view('auth.register');
    }
    
    //
    public function viewLoginPage()
    {
        return view('auth.login');
    }
    
    
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    
    
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    
    
    //
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
