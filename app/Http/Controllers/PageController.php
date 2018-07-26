<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\User;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;
class PageController extends Controller
{
	
	function __construct(){
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('theloai', $theloai);
		view()->share('slide', $slide);
	}
    function trangchu(){	
    	return view('pages.trangchu');
    }
    function lienhe(){
    	
    	return view('pages.lienhe');
    }

    function gioithieu(){
    	return view('pages.gioithieu');
    }

    function getchitietloaitin($id){

        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idloaitin', $id)->paginate(5);
        return view('pages.chitietloaitin', ['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }

    function getchitiettin($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat', 1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
        return view('pages.chitiettin', ['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    function getdangki(){
        return view('pages.dangki');
    }

    public function postdangnhapAdmin(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
            ],[
            'email.required'=>'ban chua nhap email',
            'password.required'=>'ban chua nhap mat khau'
            ]);
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('theloai/danhsach');
        }else{
            return redirect('dangnhap')->with('thongbao','dang nhap khong thanh cong');
        }
    }
}
