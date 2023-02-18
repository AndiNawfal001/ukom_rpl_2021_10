<?php

namespace App\Http\Controllers;

use app\Models\PenggunaModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {

        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // dd($request->all());

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //dd(Auth::user()->username);
            $request->session()->regenerate();
            //ddd($request);
            flash()->addSuccess('Berhasil Login.');
            return redirect()->intended('/dashboard');
        }
        flash()->addError('Wrong username or password');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
