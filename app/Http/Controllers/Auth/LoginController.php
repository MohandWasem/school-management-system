<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthTrait;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;


    // protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request,$type)
    {
        $locale = Session::get('locale');

        Auth::guard($type)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::put('locale', $locale);

        return redirect('/');
    }

    public function login(Request $request)
    {
        
        if(Auth::guard($this->checkGuard($request))->attempt(['email'=>$request->email,'password'=>$request->password])){
             return $this->redirect($request);
        } else {
            return redirect()->back()->with('message',' خطأ في اسم المستخدم او كلمة المرور');
        }
    }
}
