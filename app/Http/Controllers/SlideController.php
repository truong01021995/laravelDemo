<?php
namespace App\Models;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
    public function getdanhsach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach', ['slide'=>$slide]);
    }
    public function getthem(){
    	return view('admin.slide.them');
    }
    public function postthem(Request $request){
    	$this->validate($request, [
    		'ten'=>'required',
    		'noidung'=>'required'
    		],[
    		'ten.required'=>'ban chua nhap ten slide',
    		'noidung.required'=>'ban chua nhap noi dung cho slide'
    		]);

    	$slide = new Slide();
    	$slide->Ten = $request->ten;
    	$slide->NoiDung= $request->noidung;
    	$slide->link = $request->link;

    	//kiem tra nguoi dung co dang hinh anh hay khong
    	if($request->hasFile('hinhanh')){
    		$file = $request->file('hinhanh');//luu file hinh anh vao bien file
    		//lay phan mo rong cua file
    		$duoi = $file->getClientOriginalExtension();
    		//lay ten hinh anh
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;

    		while(file_exists("upload/slide/".$hinh)){
    			$hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/slide", $hinh);

    		$slide->Hinh=$hinh;
    	}else{
    		$slide->Hinh= "";
    	}
    	$slide->save();

    	return redirect('admin/slide/them')->with('thongbao', 'them thanh cong');

    }
    public function getsua($id){
    	$slide = Slide::find($id);
    	return view('admin.slide.sua', ['slide'=>$slide]);
    }
    public function postsua(Request $request, $id){
	
    	$this->validate($request, [
    		'ten'=>'required',
    		'noidung'=>'required',
    		],[
    		'ten.required'=>'ban chua nhap ten slide',
    		'noidung.required'=>'ban chua nhap noi dung cho slide'
    		]);
    	$slide= Slide::find($id);
    	$slide->Ten = $request->ten;
    	$slide->NoiDung=$request->noidung;
    	$slide->link = $request->link;
    	//kiem tra nguoi dung co dang hinh anh hay khong
    	if($request->hasFile('hinhanh')){
    		$file = $request->file('hinhanh');//luu file hinh anh vao bien file
    		//lay phan mo rong cua file
    		$duoi = $file->getClientOriginalExtension();
    		//lay ten hinh anh
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;

    		while(file_exists("upload/slide/".$hinh)){
    			$hinh = str_random(4)."_".$name;
    		}
    		unlink("upload/slide/".$slide->Hinh);
    		$file->move("upload/slide", $hinh);
    		
    		$slide->Hinh=$hinh;
    	}
    	$slide->save();

    	return redirect('admin/slide/sua/'.$id)->with('thongbao', 'sua thanh cong');
    }
    public function getxoa($id){
    	$slide = Slide::find($id);
    	$slide->delete();
    	return redirect('admin/slide/danhsach')->with('thongbao', 'xoa thanh cong');
    }
}
