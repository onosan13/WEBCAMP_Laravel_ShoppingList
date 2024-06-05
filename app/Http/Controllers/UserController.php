<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterPostRequest;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('/user/index');
    }

    public function register(RegisterPostRequest $request){
        $data = $request->validated();
        //dd($data);
        if($data['password'] === $data['password_c']){
            unset($data['password_c']);
        }
        else{
            $request->session()->flash('user.index.password', true);
            return redirect('/user/register');
        }
        try{
            $data['password'] = Hash::make($data['password']);
            $r = UserModel::create($data);
        }catch(\Throwable $e){
            echo $e->getMessage();
            exit;
        }
        $request->session()->flash('user.index.success', true);
        return redirect('/');
    }
}
