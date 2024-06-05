<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * ログインページを表示
     */
    public function index(){
        return view('/index');
    }

    /**
     * ログイン機能
     */
    public function login(LoginPostRequest $request){
        $datum = $request->validated();
        if(!Auth::attempt($datum)){
            return back()
                ->withInput()
                ->withErrors(['auth' => 'emailかパスワードに誤りがあります',]);
        }
        $request->session()->regenerate();
        return redirect()->intended('/shopping_list/list');
    }

    /**
     * ログアウト機能
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        return redirect(route('front.index'));
    }
}
