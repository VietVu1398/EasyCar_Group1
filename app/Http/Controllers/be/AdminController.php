<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Session;
use Hash;
use Bcrypt;

use App\Models\CarAccount;
use App\Models\CarProduct;
use App\Models\Rental;
use App\Models\BillDetail;


class AdminController extends Controller
{
    //
    public function index() {
        $oneMonthAgo = Carbon::now()->subMonth();
        $data['order'] = Rental::where('created_at', '>=', $oneMonthAgo)->count();
        $data['bill'] = BillDetail::where('created_at', '>=', $oneMonthAgo)->get();
        $data['user'] = CarAccount::where('created_at', '>=', $oneMonthAgo)->count();
        $data['car'] = CarProduct::where('created_at', '>=', $oneMonthAgo)->count();
        // echo $data['bill_in_month']->sum('paid');
        return view('be/pages/main',$data);
    }
    public function profile(Request $request) {
        
        if($request->has('change_info')) {
            $this->validate($request, [
                "fullname" => "required|string|max:32",
                "dob" => "required|date|before_or_equal:today",
                "phone" => "required|numeric|digits_between:10,12",
                "address" => "required|string|max:255",
                "profile_image" => "image|mimes:jpeg,bmp,png,gif,jpg|max:50096"
            ]);
            $acc = CarAccount::find(Auth::user()->id);
            $acc->fullname = $request->fullname;
            $acc->dob = $request->dob;
            $acc->phone = $request->phone;
            $acc->address = $request->address;
            if ($request->hasFile("profile_image")) {
                $img = $request->file("profile_image"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/profile_image/' . Auth::user()->profile_image); // sau khi update hình mới xoá hình cũ
                $img->move('public/be/images/profile_image/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $acc->profile_image = $nameimg;

            } else {
                $acc->profile_image = Auth::user()->profile_image;
            }
            $acc->save();
            Session::flash('note', 'Edit Profile Success');
            return redirect()->route("be.admin.profile");
        }
        if($request->has('change_password')) {
            Session::forget('error');
            if (!Hash::check($request->get('oldpass'), Auth::user()->password)) 
        {
            return redirect()->back()->with('error', "Current Password is Invalid");
        }

            $this->validate($request, [
                // 'oldpass' => 'current_password:api',
                "newpass" => "required|string|min:8|max:50|confirmed"
            ]);
            $acc = CarAccount::find(Auth::user()->id);
            $acc->password = bcrypt($request->newpass) ;
            $acc->save();
        
    }

        return view('be/pages/admin/profile');
    }
}
