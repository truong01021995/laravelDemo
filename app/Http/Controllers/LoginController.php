<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
        function getdangnhap(){
    	return view('login');
    }

    function postdangnhap(Request $request){
    	$this->validate($request,[
    		'email'=>'required',
    		'password'=>'required'
    		],[
    		'email.required'=>'bạn chưa nhập tài khoản',
    		'password.required'=>'bạn chưa nhập mật khẩu'
    		]);

    	if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
    		return redirect('trangchu');
    	}else{
    		return redirect('dangnhap')->with('thongbao','tài khoản hoặc mật khẩu không đúng');
    	}
    }

    function getdangxuat(){
    	Auth::logout();
    	return redirect('trangchu');
    }
}
