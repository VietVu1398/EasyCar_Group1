<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarProduct;
use App\Models\CarCategory;
use Session;
//thư viện QR_Code
use Endroid\QrCode\QrCode;
use App\Models\Rental;
use App\Models\CarRating;

// use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProductController extends Controller
{
    //Index
    public function index()
    {
        
        $data["product"] = CarProduct::get();
        $data['allrate'] = CarRating::all();
        return view("be/pages/cars/product/index", $data);
    }

    // Add Product
    public function add(Request $request)
    {

        if ($request->isMethod("post")) {
            $this->validate($request, [
                "brand" => "required",
                "name" => "required",
                "year" => "required",
                "seat" => "required|numeric",
                "price" => "required|numeric",
                "overview" => "required",
                "color" => "required",
                "thumbnail" => "required|mimes:jpeg,png,gif,jpg,ico|max:5096",
                'images.*' => 'image|mimes:jpeg,bmp,png,gif,jpg|max:5096', // nhiều ảnh phải thêm dấu . và *

            ]);
            $Product = new CarProduct();
            $Product->brand = $request->brand;
            $Product->name = $request->name;
            $Product->year = $request->year;
            $Product->seat = $request->seat;
            $Product->overview = $request->overview;
            $Product->price = $request->price;
            $Product->color = $request->color;

            // lấy dữ liệu của image
            if ($request->hasFile("thumbnail")) {
                $img = $request->file("thumbnail"); // lay ten anh
                $nameimg = time()."_".$img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/products/thumbnail/',$nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $Product->thumbnail = $nameimg;

            }
            // nhiều hình
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time().'_at.'.$file->getClientOriginalName();
                    $file->move('public/be/images/products/images/',$name);
                    $images[] = $name;

                }
                $Product->images = json_encode($images);
            }

            // Thêm vào để tạo qr_code
            $this->generateQRCode($Product->name, $Product->thumbnail, $Product->price, $Product->brand, $Product->color);
            $Product->type_id = $request->type_id;
            $Product->created_at = now();
            $Product->updated_at = now();
            $Product->product_status = $request->product_status;
            $Product->save();
            Session::flash('note', 'Add Product Successfully');
            return redirect()->route("be.product");

        } else {
            //load category vào Product
            $data["dm"] = CarCategory::where("type_status", 1)->get(); // where lấy theo status = 1 còn hoạt động thì mới lấy vào để add
            return view("be/pages/cars/product/add", $data);
        }

    }

    //Edit 
    public function edit(Request $request, $id = null)
    {
        $data["load"] = CarProduct::find($id);
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "brand" => "required",
                "name" => "required",
                "year" => "required",
                "seat" => "required|numeric",
                "price" => "required|numeric",
                "overview" => "required",
                "color" => "required",
                // "thumbnail" => "required|mimes:jpeg,png,gif,jpg,ico|max:5096",

            ]);
            $Product = CarProduct::find($id);
            $Product->brand = $request->brand;
            $Product->name = $request->name;
            $Product->year = $request->year;
            $Product->seat = $request->seat;
            $Product->overview = $request->overview;
            $Product->price = $request->price;
            $Product->color = $request->color;
            // lấy dữ liệu của image(1 hình)
            if ($request->hasFile("thumbnail")) {
                $img = $request->file("thumbnail"); // lay ten anh
                $nameimg = time()."_".$img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/products/thumbnail/'.$data["load"]->thumbnail); // sau khi update hình mới xoá hình cũ
                $img->move('public/be/images/products/thumbnail/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $Product->thumbnail = $nameimg;

            } else {
                $Product->thumbnail = $data["load"]->thumbnail;
            }

            // nhiều hình
            if ($request->hasfile('images')) {
                if ($Product->images != "") {
                    foreach (json_decode($Product->images) as $key) {
                        @unlink('public/be/images/products/images/'.$key);
                    }
                }
                foreach ($request->file('images') as $file) {
                    $name = time().'_at.'.$file->getClientOriginalName();
                    $file->move('public/be/images/products/images/',$name);
                    $image[] = $name;

                }
                $Product->images = json_encode($image);
            }

            //chỉ cần thêm phương thức này vào hàm để cập nhật lại qr code theo các giá trị
            $this->generateQRCode($Product->name, $Product->thumbnail, $Product->price, $Product->brand, $Product->color);
            $Product->type_id = $request->type_id;
            $Product->created_at = now();
            $Product->updated_at = now();
            $Product->product_status = $request->product_status;
            $Product->save();
            Session::flash('note', 'Edit Product Success');
            return redirect()->route("be.product");

        } else {
            $data["dm"] = CarCategory::where("type_status", 1)->get();
            return view("be/pages/cars/product/edit", $data);
        }
    }

    // Delete
    public function del($id = null)
    {
        // bắt lỗi    
        try {
            $load = CarProduct::find($id);
            // truy vấn tìm car_id trong rental
            $hasRental = Rental::where('car_id', $id)->exists();
            // Kiểm tra có dữ liệu Model Rantal có sản phẩm hay không nếu có không cho xoá
            if($hasRental){
                Session::flash("error", "Cannot delete this car as it is currently in a car rental invoice.");
                return redirect()->back();
            }
            // xoá hình đơn
            @unlink('public/be/images/products/imagesPro/'.$load->thumbnail); 
            if($load->imgages!=''){
                $images = json_decode($load->images);
                // Xóa nhiều hình ảnh
                foreach ($images as $key) {
                @unlink('public/be/images/products/thumbnail/'.$key);
                }
            }
            // Xóa QR code
            $qrCodePath = public_path("be/carqrcode/product_{$load->name}.png");
            if (file_exists($qrCodePath)) {
                unlink($qrCodePath);
            }

            CarProduct::destroy($id); // xoá thông tin
            Session::flash("note", "Delete Product Success.");
            return redirect()->back(); // xoá xong về trang chủ
        } catch (\Throwable $th) {
            return redirect()->route('be.product');
        }

    }

    // Create QR_Code
    private function generateQRCode($productName, $productPrice, $imageName, $imageBrand, $imageColor)
    {
        $companyName = "EASY CAR COMPANY LIMITED"; // Tên công ty cố định

        // Tạo một thể hiện mã QR mới
        $qrCode = new QrCode("$companyName\n\n$productName\n\nThumbnail: $imageName\n\n
            Price: $productPrice VND\n\nBrand: $imageBrand\n\nColor: $imageColor");

        // Lưu mã QR dưới dạng tệp hình ảnh
        $fileName = "product_$productName.png";

        // Xóa tệp tin cũ trước khi tạo QR code mới
        $oldQRCodePath = public_path("be/carqrcode/$fileName");
        $realPath = realpath($oldQRCodePath);

        if ($realPath && file_exists($realPath)) {
            unlink($realPath);
        }


        $qrCode->writeFile(public_path("be/carqrcode/$fileName"));

    }
    // Download QR
    public function downloadQRCode($filename)
    {
        $path = public_path("be/carqrcode/$filename");

        return response()->download($path);
    }

    // Change Status
    // Change Status
    public function statusCar($id){
        $changeStatus = CarProduct::find($id);
        if ($changeStatus->	product_status == 0) {
            $changeStatus->	product_status = 1;
        } else {
            $changeStatus->	product_status = 0;
        }
        $changeStatus->save();
        return redirect()->back();
    }

}
