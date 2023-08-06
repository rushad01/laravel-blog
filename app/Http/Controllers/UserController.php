<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You logged out successfully.');
    }

    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('home-feed');
        } else {
            return view("home");
        }
    }
    public function login(Request $request)
    {
        //dd($request->all());
        $loginFormData = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt([
            'username' => $loginFormData['loginusername'],
            'password' => $loginFormData['loginpassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You logged in successfully');
        } else {
            return redirect('/')->with('failure', 'Invalid username or password');
        };
    }

    public function register(Request $request)
    {
        //dd($request->all());
        $registrationFormData = $request->validate(
            [
                'username' => ['required', 'min:3', 'max:30', Rule::unique('users', 'username')],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:8', 'confirmed']
            ]
        );
        $registrationFormData['password'] = bcrypt($registrationFormData['password']);
        $user = User::create($registrationFormData);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account');
    }

    public function profile(User $user)
    {
        $posts = $user->posts()->get();
        $postsCount = $posts->count();
        $username = $user->username;
        return view('profile-post', compact('posts', 'postsCount', 'username'));
    }
}
