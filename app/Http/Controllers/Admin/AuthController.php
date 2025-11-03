<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Veritabanından kullanıcıyı bul
        $user = User::where('email', $email)->first();

        // Kullanıcı var mı ve şifre doğru mu kontrol et
        if ($user && Hash::check($password, $user->password)) {
            session(['admin_logged_in' => true, 'admin_email' => $user->email, 'admin_name' => $user->name]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Bu bilgiler kayıtlarımızla eşleşmiyor.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_email', 'admin_name']);
        return redirect()->route('admin.login');
    }
}





