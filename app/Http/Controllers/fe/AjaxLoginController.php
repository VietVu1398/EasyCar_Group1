<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogWeb;
use App\Models\CommentBlog;
use Auth;
use Validator;

class AjaxLoginController extends Controller
{
    //
    public function loginajax(Request $request)
    {
        if ($request->isMethod('post')) {
            // Thực hiện xác thực đăng nhập
            $validator = Validator::make($request->all(), [
                "email" => "required|email|exists:account,email",
                "password" => "required",
            ], [
                'email.required' => 'Địa chỉ email không để trống',
                'password.required' => 'Địa chỉ password không để trống',
                'email.email' => 'Địa chỉ email không đúng định dạng',
                'email.exists' => 'Địa chỉ email không tồn tại trong hệ thống',

            ]);
            if ($validator->passes()) {
                $data = $request->only('email', 'password');
                if (Auth::attempt($data)) {
                    // Đăng nhập thành công, chuyển hướng đến trang 'home'
                    // return response()->json(['error' => ['Tài Khoản Chưa Xác Thực']]); // Thay 'home' bằng tên route mong muốn
                    return response()->json(['success' => 'Đăng nhập thành công']);
                } else {
                    // Đăng nhập thất bại, hiển thị thông báo lỗi
                    // return response()->json(['data' => Auth::user()]);
                    return response()->json(['error' => 'Tài khoản chưa xác thực']);
                }
            }

        }
        return response()->json(['error' => $validator->errors()->all()]);
        
    }

    public function comment($blog_id, Request $request)
    {
        $blog = CommentBlog::orderBy('id','DESC')->first();
        if ($request->isMethod('post')) {
            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if (Auth::check()) {
                $account_id = Auth::user()->id;
            } else {
                // Xử lý trường hợp người dùng chưa đăng nhập (có thể redirect hoặc trả về thông báo lỗi)
                return response()->json(['error' => 'Người dùng chưa đăng nhập']);
            }

            $validator = Validator::make($request->all(), [
                "content" => "required",
            ], [
                'content.required' => 'Không được để trống',
            ]);

            if ($validator->passes()) {
                $data = [
                    'account_id' => $account_id,
                    'blog_id' => $blog_id,
                    'content' => $request->content,
                    'reply_id' => $request->reply_id ? $request->reply_id : 0 // có thì lấy reply_id còn không thì là 0
                ];

                if ($comments = CommentBlog::create($data)) {
                    // điều kiện lấy comment dangg where theo id và reply = 0 và lấy giá trị theo DESC mới nhất
                    $comments = CommentBlog::where(['blog_id' => $blog_id, 'reply_id' => 0])->get();
                    // return response()->json(['comments' => $comments]);
                    return view('fe/pages/list-comment-blog', compact('comments'));

                }
            }

            // Trả về lỗi nếu kiểm tra không thành công
            return response()->json(['error' => $validator->errors()->first()]);
        }

        // Trả về lỗi nếu không phải là yêu cầu POST
        return response()->json(['error' => 'Yêu cầu không hợp lệ']);


    }
    public function logoutnajax()
    {

    }

}
