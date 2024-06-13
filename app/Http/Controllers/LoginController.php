<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function create()
    {
        return view('auth.create');
    }
    public function store()
    {
        $attribute = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attribute)) {

            throw ValidationException::withMessages([
                'message' => 'Sorry, credential do not be match'
            ]);
        }
        return redirect('/dashboard');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
