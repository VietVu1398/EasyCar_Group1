<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentBlog;
use App\Models\CarAccount;
use Session;

class CommentBlogController extends Controller
{
    //
    public function index()
    {
        $data['commentBlog'] = CommentBlog::get();
        $data['users'] = CarAccount::get();
        return view('be/pages/blogs/blogcomment/index', $data);
    }

    public function status_CommentBlog($id)
    {
        $change_comment_blog = CommentBlog::find($id);
        if ($change_comment_blog->status == 0) {
            $change_comment_blog->status = 1;
        } else {
            $change_comment_blog->status = 0;
        }
        $change_comment_blog->save();
        return redirect()->back();
    }

    public function del_statusComment($id = null){
        // bắt lỗi    
        try {
            $change_comment_blog = CommentBlog::find($id);
            $change_comment_blog->delete(); // xoá thông tin
            Session::flash("note", "Delete Blog Success");
            return redirect()->back(); // xoá xong về trang chủ
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

}
