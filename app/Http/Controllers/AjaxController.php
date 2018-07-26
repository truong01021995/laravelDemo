<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
class AjaxController extends Controller
{
    public function getloaitin($idtheloai){
    	$loaitin = LoaiTin::where('idTheLoai', $idtheloai)->get();
    	foreach($loaitin as $lt)
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	
    }
}
