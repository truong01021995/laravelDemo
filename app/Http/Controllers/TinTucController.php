<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;

class TinTucController extends Controller
{
    public function getdanhsach(){
    	//lay cac tin cuoi cung truoc
    	$tintuc = TinTuc::orderBy('id', 'DESC')->get();
    	return view('admin.tintuc.danhsach', ['tintuc'=>$tintuc]);
    }
    public function getthem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();

    	return view('admin.tintuc.them', ['theloai'=>$theloai, 'loaitin' =>$loaitin]);
    }
    public function postthem(Request $request){
    	$this->validate($request, [
    		'loaitin'=>'required',
    		'tieude'=>'required|min:3|unique:TinTuc,TieuDe',
    		'tomtat'=>'required',
    		'noidung'=>'required'
    		], [
    		'loaitin.required'=>'ban chua  nhap ten loai tin',
    		'tieude.required'=>'ban chua nhap tieu de',
    		'tieude.min'=>'tieu de phai it nhats 3 ki tu',
    		'tieude.unique'=>'tieu de da ton tai',
    		'tomtat.required'=>'ban chua nhap tom tat',
    		'noidung.required'=>'ban chua nhap noi dung'
    		]);

    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $request->tieude;
    	$tintuc->TieuDeKhongDau = changeTitle($request->tieude);
    	$tintuc->TomTat = $request->tomtat;
    	$tintuc->NoiDung=$request->noidung;
    	$tintuc->idLoaiTin = $request->loaitin;
    	$tintuc->SoLuotXem = 0;
    	//kiem tra nguoi dung co dang hinh anh hay khong
    	if($request->hasFile('hinhanh')){
    		$file = $request->file('hinhanh');//luu file hinh anh vao bien file
    		//lay phan mo rong cua file de co the kiem tra file dinh dang
    		$duoi = $file->getClientOriginalExtension();
    		//lay ten hinh anh1

            if($duoi =="jpg" || $duoi == "png" || $duoi =="jpeg"){

            }
            //lay ten cua file khong bao gom duoi dinh dang
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;

    		while(file_exists("upload/tintuc/".$hinh)){
    			$hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/tintuc", $hinh);

    		$tintuc->Hinh=$hinh;
    	}else{
    		$tintuc->Hinh= "";
    	}

    	$tintuc->save();
    	return redirect("admin/tintuc/them")->with('thongbao', 'ban da them thanh cong');
    }
    public function getsua($id){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);
    	return view('admin.tintuc.sua', ['tintuc'=>$tintuc, 'theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }
    public function postsua(Request $request, $id){
        $tintuc = TinTuc::find($id);
    	$this->validate($request, [
            'loaitin'=>'required',
            'tieude'=>'required|min:3|unique:TinTuc,TieuDe',
            'tomtat'=>'required',
            'noidung'=>'required'
            ], [
            'loaitin.required'=>'ban chua  nhap ten loai tin',
            'tieude.required'=>'ban chua nhap tieu de',
            'tieude.min' => 'tieu de phai it nhats 3 ki tu',
            'tieude.unique' => 'tieu de da ton tai',
            'tomtat.required' => 'ban chua nhap tom tat',
            'noidung.required' => 'ban chua nhap noi dung'
            ]);
        
        $tintuc->TieuDe = $request->tieude;
        $tintuc->TieuDeKhongDau = changeTitle($request->tieude);
        $tintuc->TomTat = $request->tomtat;
        $tintuc->NoiDung = $request->noidung;
        $tintuc->idLoaiTin = $request->loaitin;
        //kiem tra nguoi dung co dang hinh anh hay khong
        if($request->hasFile('hinhanh')){
            $file = $request->file('hinhanh');//luu file hinh anh vao bien file
            //lay phan mo rong cua file
            $duoi = $file->getClientOriginalExtension();
            //lay ten hinh anh
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;

            while(file_exists("upload/tintuc/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }


            $file->move("upload/tintuc", $hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh=$hinh;
        }

        $tintuc->save();
        return redirect("admin/tintuc/sua/".$id)->with('thongbao', 'ban da sua thanh cong');
    }
    public function getxoa($id){
    	$tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'xoa thanh cong');
    }
}
