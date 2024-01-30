<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarAccount;
use Auth;
use Bcrypt;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendemail;
use DB;
use App\Models\UserLoginHistory;
use Carbon\Carbon;


class CarAccountController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                "email" => "required|email|exists:account,email",
                "password" => "required|alpha_num",
            ]);
            $email = $request->email;
            $pass = $request->password;
            if (Auth::attempt(['email' => $email, 'password' => $pass])) {
                if (Auth::user()->status == 1) {
                    $loginhis = new UserLoginHistory();
                    $loginhis->account_id = Auth::user()->id;
                    $loginhis->login_datetime = Carbon::now();
                    $loginhis->save();
                    return redirect()->route("fe.home");
                } else {
                    Auth::logout();
                    Session::flash("note", "Tài khoản này đã bị cấm!");
                    return redirect()->route("fe.login");
                }
            } else {
                Session::flash("note", "Đăng nhập không thành công!");
                return redirect()->route("fe.login");
            }
        }

        return view("fe.pages.login");
    }


    public function logout()
    {
        $loginhis = UserLoginHistory::where('account_id', '=', Auth::user()->id)->orderBy('login_datetime', 'desc')->first();
        $loginhis->logout_datetime = Carbon::now();
        $loginhis->save();
        Auth::logout();

        return redirect()->route('fe.home');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                "fullname" => "required|string|max:32",
                "dob" => "required|date|before_or_equal:today",
                "phone" => "required|numeric|digits_between:10,12",
                "address" => "required|string|max:255",
                "email" => "required|email|unique:account,email",
                "username" => "required|string|min:6|max:15|unique:account,username",
                "pass" => "required|string|min:8|max:50|confirmed",
                "profile_image" => "image|mimes:jpeg,bmp,png,gif,jpg|max:50096"
            ]);
            $acc = new CarAccount();
            $acc->fullname = $request->fullname;
            $acc->dob = $request->dob;
            $acc->phone = $request->phone;
            $acc->address = $request->address;
            $acc->email = $request->email;
            $acc->username = $request->username;
            $acc->password = bcrypt($request->pass);
            $acc->role_value = 2;
            $acc->status = 1;
            if ($request->hasFile("profile_image")) {
                $img = $request->file("profile_image"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/profile_image/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $acc->profile_image = $nameimg;
            } else {
                $acc->profile_image = "default-profile-image.jpg";
            }
            $acc->save();
            return redirect()->route('fe.login');
        }
        return view('fe.pages.register');
    }
    public function forgetpass(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                "email" => "required|email|exists:account,email",
            ]);
            $email = $request->email;
            //load user
            $user = CarAccount::where('status', 1)->where('email', $email)->first();
            $passmoi = Str::random(8);
            $this->guimail($email, $passmoi);
            DB::table('account')->where('id', $user->id)->update(array('password' => bcrypt($passmoi)));
            Session::flash("note", "Mật khẩu mới đã được gửi tới email của bạn");
            return redirect()->route("fe.login");
        }
        return view("fe/pages/forget");
    }
    public function guimail($mail = null, $password = null)
    {
        $data = [
            'frommail' => 'vietvu1398@gmail.com',
            'fromname' => 'GD. Cty ABC',
            'title' => 'Khôi phục mật khẩu',
            'message' => 'Yêu cầu khôi phục mật khẩu của bạn tại web.com đã được chấp nhận. Mật khẩu mới của bạn là: ' . $password,

        ];
        Mail::to($mail)->send(new Sendemail($data));
    }


    //Rental History:
    public function bookinghistory() {
        if(Auth::check()) {
            $data['list_booking'] = DB::table('rental')->join('bill_detail','rental.id','=','bill_detail.rental_id')
            ->join('cars','rental.car_id','=','cars.id')
            ->where('rental.account_id','=',Auth::user()->id)
            ->select('rental.*','bill_detail.total_amount','bill_detail.paid','cars.name as carname')
            ->orderBy('rental.created_at','desc')
            ->paginate(8);
            // dd($data);
            return view('fe.pages.bookinghistory',$data);
        } else {
            return redirect()->route('fe.home');
        }
    }





}