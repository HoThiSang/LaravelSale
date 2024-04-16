<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Hashing\Hasher;
use App\Models\Cart;
use App\Models\User;

class UserController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function index()
    {
    }

    public function login()
    {
        return view('pages/login');
    }

    public function getSignUp()
    {

        return view('pages/sign-up');
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => $request->_token,
            'created_at' => now()
        ];

        $userSigned =  $this->users->createNewUser($userData);
        return redirect()->route('login')->with('success', 'Sign up successfullly');
    }

    public function postLogin(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự'
        ]);

        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'thongbao' => 'Đăng nhập không thành công']);
        }
    }
}
