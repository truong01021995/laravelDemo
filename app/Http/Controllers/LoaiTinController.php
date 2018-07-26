<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
class LoaiTinController extends Controller
{
    public function getdanhsach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach', ['loaitin' => $loaitin]);
    }

    public function getthem(){
    	$theloai = TheLoai::all();

    	return view('admin.loaitin.them', ['theloai'=> $theloai]);
    }
    public function postthem(Request $request){
    	$this->validate($request, [
    		'ten'=>'required|min:2|max:100|unique:LoaiTin,Ten',
    		'theloai'=>'required'
    		], [
    		'ten.required'=>'ban chua nhap ten',
    		'ten.min'=>'ki tu toi thieu la 2',
    		'ten.max'=>'ki tu toi da la 100',
			'ten.unique'=>'ten loai tin da ton tai',
			'theloai.required'=>'ban chua chon ten the loai'
    		]);
    	$loaitin = new LoaiTin;

    	$loaitin->Ten = $request->ten;
    	$loaitin->TenKhongDau = changeTitle($request->ten);
    	$loaitin->idTheLoai = $request->theloai;

    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao', 'ban da them thanh cong');
    }

    public function getsua($id){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
    	return view('admin.loaitin.sua', ['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postsua(Request $request, $id){
    	$this->validate($request, [
    		'ten'=>'required|min:2|max:100|unique:LoaiTin,Ten',
    		'theloai'=>'required'
    		], [
    		'ten.required'=>'ban chua nhap ten',
    		'ten.min'=>'ki tu toi thieu la 2',
    		'ten.max'=>'ki tu toi da la 100',
			'ten.unique'=>'ten loai tin da ton tai',
			'theloai.required'=>'ban chua chon ten the loai'
    		]);

    	$loaitin = LoaiTin::find($id);
    	$loaitin->idTheLoai = $request->theloai;
    	$loaitin->Ten = $request->ten;
    	$loaitin->TenKhongDau = changeTitle($request->ten);
    	$loaitin->save();
    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'sua thanh cong');
    }

    public function getxoa($id){
    	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao', 'xoa thanh cong');
    }
}
