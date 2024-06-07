<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminPostRequest;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(AdminPostRequest $request){
        $data = $request->validated();
        if(!Auth::guard('admin')->attempt($data)){
            return back()
                ->withInput()
                ->withErrors(['auth'=>'ログインIDかパスワードに誤りがあります。',]);
        }
        $request->session()->regenerate();
        return redirect()->intended('/admin/top');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        return redirect(route('admin.index'));
    }
}
