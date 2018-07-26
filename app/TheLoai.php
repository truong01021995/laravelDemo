<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = "TheLoai";
    //lấy tất cả các loại tin của thể loại này
    public function loaitin()
    {
    	return $this->hasMany('App\LoaiTin', 'idTheLoai', 'id');//tạo các liên kết
    }

    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc', 'App\LoaiTin', 'idTheLoai', 'idLoaiTin', 'id');
    }
}
