<?php

namespace App\Http\Controllers\be;


use Auth;
use Hash;
use Bcrypt;
use App\Models\CarAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\UserLoginHistory;
use App\Models\Rental;

class AccountController extends Controller
{
    //
    public function index()
    {
        $data['taikhoan'] = DB::table('account')->join('role_account', 'account.role_value', '=', 'role_account.value')
            ->select('account.*', 'role_account.name as rolename')->where('account.role_value', '=', 2)
            ->get();
        // $data['taikhoan'] = CarAccount::where('role_value', '!=', 0)->get();
        return view("be/pages/accounts/index", $data);
    }
    public function viewMod()
    {
        $data['taikhoan'] = DB::table('account')->join('role_account', 'account.role_value', '=', 'role_account.value')
            ->select('account.*', 'role_account.name as rolename')->where('account.role_value', '=', 1)
            ->get();
        // $data['taikhoan'] = CarAccount::where('role_value', '!=', 0)->get();
        return view("be/pages/accounts/viewMod", $data);
    }

    // Register
    public function add(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "fullname" => "required",
                "dob" => "required|date|before_or_equal:today",
                "phone" => "required|numeric|digits_between:10,12",
                "address" => "required|string|max:255",
                "email" => "required|email | unique:account,email", // exist:account,email : bắt trùng email đã tồn tại không cho, exist: tên bảng, tên cột
                "username" => "required|string|min:6|max:15|unique:account,username",
                "pass" => "required|string|min:8|max:50|confirmed",
                "role" => "required"

            ]);
            $taikhoan = new CarAccount();
            $taikhoan->fullname = $request->fullname;
            $taikhoan->dob = $request->dob;
            $taikhoan->phone = $request->phone;
            $taikhoan->address = $request->address;
            $taikhoan->email = $request->email;
            $taikhoan->username = $request->username;
            $taikhoan->password = bcrypt($request->pass);
            $taikhoan->status = $request->status;
            $taikhoan->role_value = $request->role;
            $taikhoan->save();
            Session::flash("note", "Add  Successfully");
            return redirect()->route('be.account');

        }
        return view("be/pages/accounts/add");
    }

    public function edit(Request $request, $id = null)
    {
        $data['load'] = CarAccount::find($id);
        $data['loginhis'] = UserLoginHistory::where('account_id', '=', $id)->orderBy('login_datetime', 'desc')->get();
        if ($request->has('change_info')) {
            $this->validate($request, [
                "fullname" => "required|string|max:32",
                "dob" => "required|date|before_or_equal:today",
                "phone" => "required|numeric|digits_between:10,12",
                "address" => "required|string|max:255",
                "profile_image" => "image|mimes:jpeg,bmp,png,gif,jpg|max:50096",
                "role" => "required",
                "status" => "required"
            ]);

            $acc = CarAccount::find($id);
            $acc->fullname = $request->fullname;
            $acc->dob = $request->dob;
            $acc->phone = $request->phone;
            $acc->role_value = $request->role;
            $acc->status = $request->status;
            $acc->address = $request->address;

            if ($request->hasFile("profile_image")) {
                $img = $request->file("profile_image"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/profile_image/' . $acc->profile_image); // sau khi update hình mới xoá hình cũ
                $img->move('public/be/images/profile_image/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $acc->profile_image = $nameimg;
            } else {
                $acc->profile_image = $acc->profile_image;
            }

            $acc->save();
            Session::flash('note', 'Edit Profile Success');
            return redirect()->route("be.account", $acc->id);
        }

        //     if($request->has('change_password')) {
        //         Session::forget('error');
        //         if (!Hash::check($request->get('oldpass'), Auth::user()->password)) 
        //     {
        //         return redirect()->back()->with('error', "Current Password is Invalid");
        //     }

        //         $this->validate($request, [
        //             // 'oldpass' => 'current_password:api',
        //             "newpass" => "required|string|min:8|max:50|confirmed"
        //         ]);
        //         $acc = CarAccount::find(Auth::user()->id);
        //         $acc->password = bcrypt($request->newpass) ;
        //         $acc->save();

        // }
        return view('be/pages/accounts/edit', $data);
    }

    public function del($id)
    {
        try {
            $deluser = CarAccount::find($id)->role_value;
            $deluser = Rental::where('account_id', $id)->exists();
            
            
            if ($deluser) {      
                Session::flash('error', 'Cannot delete the account due to existing records in the rental.');
                return redirect()->back();
    
            } 
          
            if ($deluser = 1 && $deluser = 2  ) {
                // dd($deluser);
                    CarAccount::destroy($id);
                    Session::flash('note', 'Delete Success');
                    return redirect()->back();
            }else{
                    Session::flash('error', 'Cannot Delete Account ');
                    return redirect()->back();
            }
           
         
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

}
