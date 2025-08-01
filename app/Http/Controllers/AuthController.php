<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // /register -> post
        $validate = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|email|unique:users|max:255',
            'type' => 'required|in:Student,Employee',
            'password' => 'required|string|min:8|max:15|confirmed',
            'picture' => 'nullable|file|mimes:png,jpg,jpeg|max:10240',
        ]);
        $path = null;
        if ($request->hasFile('picture')) {
            $path = Storage::disk('public')->put('user_image', $request->picture);
        }
        $validate['img_path'] = $path;
        $validate['uuid'] = Str::uuid();
        $user = User::create($validate);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/dashboard')->with(['success' => 'User Registered Successfully']);
    }
    public function login(Request $request)
    {
        // /login->post
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with(['success' => 'User Logged In Successfully']);
        } else {
            throw ValidationException::withMessages(['creidential' => 'Credential not verified']);
        }
    }

    public function logout(Request $request){
        // /logout -> get
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with(['success'=>'Logged out successfully']);
    }
}
