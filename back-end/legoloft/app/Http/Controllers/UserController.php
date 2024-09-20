<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidate;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login(LoginValidate $request)
    {

        $user = $this->userModel->checkAccount($request->email);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Tài khoản không tồn tại trong hệ thống!');
        }

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if ($user->status < 1) {
                return redirect()->route('login')->with('error', 'Tài khoản bạn đã bị khóa');
            }
            session()->put('user', $user);
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('login')->with('error', 'Email hoặc password của bạn đã sai!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Đăng nhập tại đây');
    }
}
