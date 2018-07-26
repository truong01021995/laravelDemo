<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class TheLoaiController extends Controller
{
    public function getdanhsach(){
    	//danh sach cac the loai lay duoc
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai' => $theloai]);
    }
    public function getthem(){

    	return view('admin.theloai.them');
    }

    public function postthem(Request $request){
    	//kiem tra dieu kien truyen
    	$this->validate($request,[
    			'ten'=> 'required|min:3|max:100|unique:TheLoai,Ten'
    		],[
    			'ten.required'=>'bạn chưa nhập tên thể loại',
    			'ten.min'=>'tên phải có ít nhất 3 kí tự',
    			'ten.max'=>'tên thể loại có độ dài kí tự quá lớn',
    			'ten.unique'=>'ten the loai da  ton tai'
    		]);

    	$theloai = new TheLoai;
    	$theloai->Ten = $request->ten;
    	$theloai->TenKhongDau = changeTitle($request->ten);
    	$theloai->save();

    	//quay tro lai trang them cộng thông báo
    	return redirect('admin/theloai/them')->with('thongbao', 'thêm thành công');
    }

    public function getsua($id){
    	$theloai = TheLoai::find($id);//tim kiem thong tin the loai co id maf chung ta da truyen
    	return view('admin.theloai.sua', ['theloai'=>$theloai]);
 	}
	public function postsua(Request $request, $id){
    	
    	$this->validate($request,
    	[
    		'ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
    	],
    	[
    		'ten.required'=>'ban chua nhap ten',
    		'ten.unique'=>'ten the loai da  ton tai',
    		'ten.min'=>'ten the loai phai co it nhat 3 ki tu',
    		'ten.max'=>'ten the loai qua dai'
       	]);//kiem tra dieu kien loi
        $theloai = TheLoai::find($id);
       	$theloai->Ten = $request->ten;
       	$theloai->TenKhongDau = changeTitle($request->ten);
       	$theloai->save();

       	return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'sua than cong');
    }

    public function getxoa($id){
    	$theloai = TheLoai::find($id);
    	$theloai->delete();

    	return redirect('admin/theloai/danhsach')->with('thongbao', 'xoa thanh cong');
    }
}
