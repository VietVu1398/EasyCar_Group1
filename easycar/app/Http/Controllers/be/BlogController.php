<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogWeb;
use Session;


class BlogController extends Controller
{
    //
    public function index()
    {
        $data['blogs'] = BlogWeb::get();
        return view('be/pages/blogs/blogweb/index', $data);
    }

    public function addnew(Request $request)
    {

        if ($request->isMethod("post")) {
            $this->validate($request, [
                "title" => "required",
                "content" => "required",
                'images.*' => 'image|mimes:jpeg,bmp,png,gif,jpg|max:5096', // nhiều ảnh phải thêm dấu . và *

            ]);
            $Blog = new BlogWeb();
            $Blog->title = $request->title;
            $Blog->content = $request->content;

            // nhiều hình
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time().'_at.'.$file->getClientOriginalName();
                    $file->move('public/be/blogimages/',$name);
                    $image[] = $name;

                }
                $Blog->images = json_encode($image);
            }


            $Blog->status = $request->status;
            $Blog->save();
            Session::flash('note', 'Add Blog Success');
            return redirect()->route("be.blogWeb");

        } else {
            return view("be/pages/blogs/blogweb/add");
        }

    }

    public function edit(Request $request, $id = null)
    {
        $data["load"] = BlogWeb::find($id);
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "title" => "required",
                "content" => "required",
            ]);
            $Blog = BlogWeb::find($id);
            $Blog->title = $request->title;
            $Blog->content = $request->content;

            // nhiều hình
            if ($request->hasfile('images')) {
                if ($Blog->images != "") {
                    foreach (json_decode($Blog->images) as $key) {
                        @unlink('public/be/blogimages/'.$key);
                    }
                }
                foreach ($request->file('images') as $file) {
                    $name = time().'_at.'.$file->getClientOriginalName();
                    $file->move('public/be/blogimages/',$name);
                    $image[] = $name;

                }
                $Blog->images = json_encode($image);
            }
            $Blog->status = $request->status;
            $Blog->save();
            Session::flash('note', 'Edit Blog Success');
            return redirect()->route("be.blogWeb");

        } else {
            return view("be/pages/blogs/blogweb/edit", $data);
        }
    }

    public function statusBlog($id)
    {
        $changeStatus = BlogWeb::find($id);
        if ($changeStatus->status == 0) {
            $changeStatus->status = 1;
        } else {
            $changeStatus->status = 0;
        }
        $changeStatus->save();
        return redirect()->back();
    }

    public function del($id = null)
    {
        try {
            //findOrFail là một phương thức trong laravel để tìm một bản ghi trong cơ sở dữ liệu
            $blog = BlogWeb::findOrFail($id);

            // Kiểm tra xem có các comment liên quan không
            if ($blog->comments()->exists()) {
                // Blog có các comment liên quan, phải xoá comment trước
                Session::flash("error", "The blog cannot be deleted because it has related comments");
            } else {
                // Không có comment liên quan, tiến hành xóa
                // xoá nhiều ảnh
                @unlink('public/be/blogimages/'.$blog->image);
                if($blog->images != "") {
                    $images = json_decode($blog->images);
                        // Xóa hình ảnh
                    foreach ($images as $key) {
                        @unlink('public/be/blogimages/'.$key);
                    }
                    $blog->delete();
                    Session::flash("note", "Delete Blog Success");
                }
               
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            Session::flash("error", "Error deleting blog");
        }
    
        return redirect()->route('be.blogWeb');
    }

    // public function del_statusComment($id = null)
    // {
    //     // bắt lỗi    
    //     try {
    //         $blogs = BlogWeb::find($id);
    //         $blogs->delete(); // xoá thông tin
    //         Session::flash("note", "Delete Blog Success");
    //         return redirect()->route('be.blogWeb'); // xoá xong về trang chủ
    //     } catch (\Throwable $th) {
    //         return redirect()->route('be.blogWeb');
    //     }

    // }

}

