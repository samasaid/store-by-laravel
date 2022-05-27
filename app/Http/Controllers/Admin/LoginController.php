<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    // public function test(){
    //     // 1-validation
    //     // 2-try
    //           code..
    //         & catch
    //           code..
    // }
    public function index(){
        return view('admin.auth.login');
    }
    public function login(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
           // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('admin.dashboard');
        }
       // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->route('admin.login.form')->with(['error' => 'هناك خطا بالبيانات']);
    }
    public function logout(){
       $guard = $this->getGuard();
       $guard->logout();
       return redirect()->route('admin.login.form');
    }
    private function getGuard(){
        return auth('admin');
    }
}
