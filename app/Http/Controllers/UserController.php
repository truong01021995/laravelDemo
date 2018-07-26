<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function getdangnhapAdmin(){
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
        //kiểm tra  lỗi
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
            ],[
            'email.required'=>'ban chua nhap email',
            'password.required'=>'ban chua nhap mat khau'
            ]);
        //check dang nhap
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('admin/theloai/danhsach');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','dang nhap khong thanh cong');
        }
    }

    public function getdangxuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }




    public function getdanhsach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getthem(){
    	return view('admin.user.them');
    }
    public function postthem(Request $request){
    	$this->validate($request, [
    		'name'=>'required|min:3',
    		'email'=>'required|email|unique:users,email',
    		'pass'=>'required|min:3|max:32',
    		'passagain'=>'required|same:pass'
    		],[
    		'name.required'=>'ban chua nhap ho ten',
    		'name.min'=>'ten cua ban qua ngan',
    		'email.required'=>'ban chua nhap email',
    		'email.email'=>'ban chua nhap dung dinh danh email',
    		'email.unique'=>'email cua ban da ton tai',
    		'pass.required'=>'ban chua nhap pass',
    		'pass.min'=>'pass cua ban qua ngan',
    		'pass.max'=>'pass cua ban qua dai toi da 32',
    		'passagain.required'=>'ban chua nhap lai password',
    		'passagain.same'=>'pass nhap lai khong dung'
    		]);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email=$request->email;
    	//ma hoa mat khau
    	$user->password= bcrypt($request->pass);
    	$user->quyen=$request->quyen;

    	$user->save();
    	return redirect('admin/user/them')->with('thongbao', 'them thanh cong');
    }
    public function getsua($id){
    	$user = User::find($id);
    	return view('admin.user.sua', ['user'=>$user]);
    }
    public function postsua(Request $request, $id){
    	$this->validate($request, [
    		'name'=>'required|min:3',
    		],[
    		'name.required'=>'ban chua nhap ho ten',
    		'name.min'=>'ten cua ban qua ngan',
    		]);
    	$user = User::find($id);
    	$user->name=$request->name;
    	$user->quyen= $request->quyen;
    	if($request->changePass =="on"){
    		$this->validate($request, [
    		'pass'=>'required|min:3|max:32',
    		'passagain'=>'required|same:pass'
    		],[
    		'pass.required'=>'ban chua nhap pass',
    		'pass.min'=>'pass cua ban qua ngan',
    		'pass.max'=>'pass cua ban qua dai toi da 32',
    		'passagain.required'=>'ban chua nhap lai password',
    		'passagain.same'=>'pass nhap lai khong dung'
    		]);
    		$user->password= bcrypt($request->pass);
    	}

    	$user->save();
    	return redirect('admin/user/sua/'.$id)->with('thongbao','sua thanh cong');
    }
    public function getxoa($id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('thongbao','xoa thanh cong');
    }


}