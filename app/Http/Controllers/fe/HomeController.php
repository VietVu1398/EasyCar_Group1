<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;
use Hash;
use Session;
//Models
use App\Models\CarAccount;
use App\Models\BlogWeb;
use App\Models\Comment_Car;
use App\Models\CarCategory;
use App\Models\CarProduct;
use App\Models\Feedback;

class HomeController extends Controller
{

    public function home() { // home là trang chủ index
        
        $data['hotcar'] = CarProduct::take(6)->orderby("id", "desc")->get();
        $data['randomproduct'] = CarProduct::inRandomOrder()->limit(4)->get();
        $data['blogs'] = BlogWeb::NewBlog()->get();
        return view('fe/pages/home' , $data);
    }

    // Category
    public function category($id = null){
         // load sản phẩm ra theo id
        $data['loadcarproduct'] = CarProduct::where('type_id', $id)->where('product_status',1)->paginate(9);
        if ($data['loadcarproduct']) {
             // không lỗi hiển thị thằng view lên
             return view("fe/pages/category", $data);
        } else {
             // có lỗi chuyển về trang chủ
            return redirect()->route('fe.home');
        }
    }

    // Detail
    public function detail(Request $request, $name = null, $id = null)
    {
        
         // Lấy commnet ra với điều kiện là id của car và id của comment và status = 1, orderBy lấy giá trị mới nhất
         $data['comments'] = Comment_Car::where('car_id', $id)->where('status', 1)
         ->orderBy('id', 'DESC')->get();

        //Lấy dữ liệu ngày đã được thuê trong database để loại bỏ khỏi lịch khi user chọn ngày
        $data['db_dates'] = DB::table('rental')->select('pickup_date','return_date')
        ->where([['car_id','=',$id],['status','=',1],['processing','!=',0]])->get();
        $data['rented_dates'] = [];
        foreach ($data['db_dates'] as $ddd) {
            $start_date = Carbon::parse($ddd->pickup_date);
            $end_date = Carbon::parse($ddd->return_date);
            while ($start_date <= $end_date) {
                $data['rented_dates'][] = $start_date->toDateString();
                $start_date->addDay();
            }
        }
        // đúng dữ liệu mới chạy xử lý
        $data['detail'] = CarProduct::where("id", $id)->where("product_status", 1)->first();
        if ($data['detail']) {
            $data['randomproduct'] = CarProduct::where("type_id", $data['detail']->type_id)->inRandomOrder()->limit(8)->get(); // lấy ngẫu nhiên các phần tử ra cùng id_cat rồi mới random
            //Xu ly user nhap ngay
            if($request->has('booking')) {
                if(Auth::check()) {
                    // if(Auth::user()->role_value==2) {
                        
                        

                        $validator = Validator::make($request->all(), [
                            'pickup_date'=> ['required','date_format:Y-m-d','after:today',Rule::notIn($data['rented_dates']),],
                            'return_date'=> ['required','date_format:Y-m-d','after_or_equal:pickup_date',Rule::notIn($data['rented_dates']),],
                        ]);
                        if ($validator->fails()) {
                            return back()->withErrors($validator);
                        }
                        $pk_date = Carbon::parse($request->pickup_date);
                        $rt_date = Carbon::parse($request->return_date);
                        foreach ($data['db_dates'] as $ddd) {
                            $start_date = Carbon::parse($ddd->pickup_date);
                            $end_date = Carbon::parse($ddd->return_date);
                            if($pk_date<=$start_date && $rt_date>=$end_date) {
                                Session::flash('contain_invalid', 'Your schedule contain invalid date');
                                // break;
                                return redirect()->back();
                            }
                        }

                        $total_days = $pk_date->diffInDays($rt_date) + 1;    
                        Session::put('pickup_date',$request->pickup_date);
                        Session::put('return_date',$request->return_date);
                        Session::put('total_days',$total_days);
                        Session::put('car_id',$id);
                        Session::put('price_per_day',$data['detail']->price);
                        return redirect()->route('fe.rental');
                    // } else {
                        // echo "Can not";}
                    } else {
                        return redirect()->route('fe.login');
                    }
                } 
            return view("fe/pages/detail", $data);
        } else {
            // có lỗi chuyển về trang chủ
            return redirect()->route('fe.home');
        }
        
    }




    public function aboutus() {
        return view('fe/pages/aboutus');
    }

    //CONTACT US & FEEDBACK
    public function contactus(Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request, [
                "phone" => "required|numeric|digits_between:10,12",
                "email" => "required|email",
                "fullname" => "required|string|max: 50",
                "content" => "required|string|max: 1000",
            ]);
            $fb = new Feedback();
            $fb->fullname = $request->fullname;
            $fb->email = $request->email;
            $fb->phone = $request->phone;
            $fb->content = $request->content;
            $fb->reply_status = 0;
            $fb->save();
            Session::flash('note','Feedback Received!!');
            return redirect()->back();
        }else {
            return view('fe/pages/contactus');
        }
    }


    public function profile_user(Request $request) {
        
        if($request->has('change_info')) {
            $this->validate($request, [
                "fullname" => "required|string|max:32",
                "dob" => "required|date|before_or_equal:today",
                "phone" => "required|numeric|digits_between:6,12",
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
            return redirect()->route("fe.profile_user");
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

        return view('fe/pages/profile_user');
    }

    // Comment Car
    public function post_comment(Request $request, $car_id)
    {
        if ($request->has("send_comment")) {
            $this->validate($request, [
                'comment' => 'required|string',
            ]);
            $comments = new Comment_Car;
            $comments['account_id'] = Auth::user()->id;
            $comments['car_id'] = $car_id;
            $comments->comment = $request->input('comment');
            $comments->status = 1;
            // dd($comments->all());
            if ($comments->save()) {
                return redirect()->back();
            } else {
                return redirect()->back()->with('message', 'Can not create comment');
            }

        }
    }

    //Delete Comment for user 
    public function del_comment ($id) {
        $cm = Comment_Car::find($id);
        $cm->delete();
        return redirect()->back();
    }
    //======= BLOGS
    public function listblogs() {
        $data['list_blogs'] = BlogWeb::where('status',1)->paginate(7);
        return view('fe/pages/listblogs',$data);
    }

    public function blogweb(BlogWeb $blog, $slug)
    {
        // dd($blog);
        $blog_id = $blog->id;
        return view('fe/pages/blogweb', compact('blog', 'blog_id'));
    }

    
}
