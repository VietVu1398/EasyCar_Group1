<?php

namespace App\Http\Controllers\be;

use App\Models\BannerADS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;

class BannerController extends Controller
{
    public function index()
    {
        $all_banne = BannerADS::orderBy('id', 'desc')->get();
        return view('be.pages.banner.banner')->with(compact('all_banne'));
    }
    public function addbanner(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "banner_name" => "required|string",
                "images" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "content" => "required|string|max:255",
                "status" => "required"
            ]);
            $ban = new BannerADS();
            $ban->banner_name = $request->banner_name;
            $ban->content = $request->content;
            if ($request->hasFile("images")) {
                $img = $request->file("images"); // give me your name
                $nameimg = time()."_".$img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/banners/', $nameimg); // move iamge: save image in public/file/image folder
                // assign the image name of the image to the image column
                $ban->images = $nameimg;
            }
            $ban->status = $request->status;
            $ban->save();
            Session::flash("note", "Edited Successfully");
            return redirect()->route("be.banner");
        } else {
            return view("be/pages/banner/addBanner");
        }
    }
    public function editbanner(Request $request, $id)
    {
        $data["load"] = BannerADS::find($id);
        if ($request->isMethod("post")) {

            // edit data
            $this->validate($request, [
                "banner_name" => "required|string",
                "images" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "content" => "required|string|max:255",
                "status" => "required"
            ]);
            $ban = BannerADS::find($id);
            $ban->banner_name = $request->banner_name;
            $ban->content = $request->content;
            // Get image data
            if ($request->hasFile("images")) {
                $img = $request->file("images"); // give me your name
                $nameimg = time()."_".$img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/banners/'.$data["load"]->images); // After updating the new image, delete the old image
                $img->move('public/be/images/banners/',$nameimg); // move iamge: save image in public/file/image folder
                // assign the image name of the image to the image column
                $ban->images = $nameimg;
            } else {
                $ban->images = $data["load"]->images;
            }
            $ban->status = $request->status;
            $ban->save();   
            Session::flash("note", "Edited Successfully");
            return redirect()->route("be.banner");
        } else {
            return view("be/pages/banner/editBanner", $data);
        }
    }
    public function del($id){
        try {
            $load = BannerADS::find($id);
            @unlink('public/be/images/banners/'.$load->images); // xoá hình
            BannerADS::destroy($id); // xoá thông tin
            Session::flash("note", "Delete Product Success");
            return redirect()->route('be.banner'); // xoá xong về trang chủ
        } catch (\Throwable $th) {
            return redirect()->route('be.banner');
        }
    }
}
