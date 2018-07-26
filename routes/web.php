<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});
/*Route::get('thu', function(){
		$theloai = TheLoai::find(1);
		foreach ($theloai -> loaitin as $loaitin) {
			echo $loaitin ->Ten . "<br/>";
		}
	});*/

Route::get('admin/dangnhap', 'UserController@getdangnhapAdmin');
Route::post('admin/dangnhap', 'UserController@postdangnhapAdmin');

Route::get('admin/logout', 'UserController@getdangxuatAdmin');

Route::group(['prefix' => 'admin', 'middleware'=>'adminlogin'], function(){
	Route::get('trangchu', function(){
		return view('admin.layout.index');
	});
	Route::group(['prefix' => 'theloai'], function(){
		Route::get('danhsach', 'TheLoaiController@getdanhsach');
		
		Route::get('sua/{id}', 'TheLoaiController@getsua');
		Route::post('sua/{id}', 'TheLoaiController@postsua');

		Route::get('them', 'TheLoaiController@getthem');
		Route::post('them', 'TheLoaiController@postthem');

		Route::get('xoa/{id}', 'TheLoaiController@getxoa');
	});

	Route::group(['prefix' => 'loaitin'], function(){
		Route::get('danhsach', 'LoaiTinController@getdanhsach');
		
		Route::get('sua/{id}', 'LoaiTinController@getsua');
		Route::post('sua/{id}', 'LoaiTinController@postsua');

		Route::get('them', 'LoaiTinController@getthem');
		Route::post('them', 'LoaiTinController@postthem');

		Route::get('xoa/{id}', 'LoaiTinController@getxoa');
	});

	Route::group(['prefix' => 'tintuc'], function(){
		Route::get('danhsach', 'TinTucController@getdanhsach');

		Route::get('sua/{id}', 'TinTucController@getsua');
		Route::post('sua/{id}', 'TinTucController@postsua');

		Route::get('them', 'TinTucController@getthem');
		Route::post('them', 'TinTucController@postthem');

		Route::get('xoa/{id}', 'TinTucController@getxoa');
	});


	Route::group(['prefix' => 'comment'], function(){
		Route::get('xoa/{id}/{idtintuc}', 'CommentController@getxoa');
	});


	Route::group(['prefix' => 'slide'], function(){
		Route::get('danhsach', 'SlideController@getdanhsach');
		
		Route::get('sua/{id}', 'SlideController@getsua');
		Route::post('sua/{id}', 'SlideController@postsua');

		Route::get('them', 'SlideController@getthem');
		Route::post('them', 'SlideController@postthem');

		Route::get('xoa/{id}','SlideController@getxoa');
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('danhsach', 'UserController@getdanhsach');

		Route::get('sua/{id}', 'UserController@getsua');
		Route::post('sua/{id}', "UserController@postsua");

		Route::get('them', 'UserController@getthem');
		Route::post('them', 'UserController@postthem');

		Route::get('xoa/{id}', 'UserController@getxoa');
	});

	Route::group(['prefix' => 'comment'], function(){
		Route::get('danhsach', 'TheLoaiController@getdanhsach');
		Route::get('sua', 'TheLoaiController@getsua');
		Route::get('them', 'TheLoaiController@getthem');
	});

	Route::group(['prefix' => 'ajax'], function(){
		Route::get('loaitin/{idtheloai}', 'AjaxController@getloaitin');
	});
});



Route::get('trangchu', 'PageController@trangchu');
Route::get('lienhe', 'PageController@lienhe');
Route::get('gioithieu', 'PageController@gioithieu');

Route::get('dangnhap','LoginController@getdangnhap');
Route::post('dangnhap', 'LoginController@postdangnhap');
Route::get('dangxuat', 'LoginController@getdangxuat');

Route::get('chitietloaitin/{id}', 'PageController@getchitietloaitin');
Route::get('chitiettin/{id}', 'PageController@getchitiettin');

Route::post('comment/{id}', 'CommentController@postcomment');

Route::get('dangki', 'PageController@getdangki');
Route::get('dangki', 'PageController@postdangki');