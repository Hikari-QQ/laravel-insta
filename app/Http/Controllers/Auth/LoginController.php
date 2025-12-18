<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * 認証成功後の処理をカスタマイズ
     */
    protected function authenticated(Request $request, $user)
    {
        // 直接トップページに行かずに、アニメーション画面を表示するルートへ飛ばす
        return redirect('/welcome');
    }

    /**
     * アニメーション画面を表示するメソッド
     */
    public function showWelcome()
    {
        return view('auth.welcome_animation');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'showWelcome']);
        $this->middleware('auth')->only('logout');
    }
}
