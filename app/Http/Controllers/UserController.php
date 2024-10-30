<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // GET for login
    public function login() {
        if(Auth::check())
            return back();
        return view('Users/login');
    }
    // GET for register
    public function register()
    {
        if(Auth::check())
            return back();
        return view('Users/register');
    }
    // POST for login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/main');
        }

        return view('Users/login')->withErrors([
            'autherror' => 'The provided credentials do not match our records.'
        ]);
    }
    // POST for register
    public function registerUser(Request $request) {

        $data = $request->validate([    'name' => ['required', 'string', 'max:255'],
                                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                                'password' => ['required', 'confirmed']]);

        $addUser = new User();
        $addUser->name= $data['name'];
        $addUser->email = $data['email'];
        $addUser->password = $data['password'];
        $addUser->save();

        return redirect('/main');
    }
    // GET for logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back();
    }
}
