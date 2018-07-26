<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getxoa($id, $idtintuc){
    	$comment = Comment::find($id);

    	$comment->delete();
    	return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao', 'xoa comment thanh cong');
    }
    function postcomment($id, Request $request){
    	$idtintuc = $id;
    	$comment = new Comment;
    	$comment->idTinTuc = $idtintuc;

    	$comment->idUser = Auth::User()->id;
    	$comment->NoiDung = $request->noidung;


    	$comment->save();

    	return redirect('chitiettin/'.$id)->with('thongbao', 'Viết bình luận thành công');
    }
}
