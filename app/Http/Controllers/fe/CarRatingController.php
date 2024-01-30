<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarProduct;
use App\Models\CarRating;
use Auth;

class CarRatingController extends Controller
{
    //
    public function rate(Request $request, $id)
    {


        // Lấy người dùng hiện tại
        $user = Auth::user();
        // echo $user;

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $detail = CarProduct::find($id);
        // dd($user);

        // // Kiểm tra xem $product có tồn tại và có id không
        if ($detail && $detail->id) {
            // Lấy hoặc tạo đánh giá của người dùng cho sản phẩm
            $rating = $user->ratings()->where('car_id', $detail->id)->first();

            if ($rating) {
                // Nếu đã đánh giá, cập nhật lại đánh giá
                $rating->update(['stars_rated' => $request->rating]);
                $message = 'Đánh giá đã được cập nhật.';


            } else {
                // Nếu chưa đánh giá, tạo mới và lưu
                $user->ratings()->create([
                    'account_id' => $user->id,
                    'car_id' => $detail->id,
                    'stars_rated' => $request->rating,
                ]);
                $message = 'Đánh giá mới đã được tạo.';
            }
            // return redirect()->back();

            // Truyền cả hai tham số {name} và {key} cho route fe.detail
            return redirect()->back();
            // return redirect()->view('fe.detail', $detail->id);
        } else {
            // Xử lý khi $product không hợp lệ hoặc không tìm thấy sản phẩm
            return redirect()->back()->with('message', 'Không thể thực hiện đánh giá. Vui lòng thử lại.');
        }

    }

    public function showRatingForm($id)
    {
        $averageRating = $id->averageRating();

        // Nếu đăng nhập, hiển thị form đánh giá
        if (Auth::check()) {
            return view('fe.detail', compact('product', 'averageRating'));
        }

        // Nếu không đăng nhập, chỉ hiển thị số đánh giá trung bình
        return view('fe.detail', compact('product', 'averageRating'));
    }

}
