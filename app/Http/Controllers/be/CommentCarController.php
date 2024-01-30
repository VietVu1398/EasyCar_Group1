<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment_Car;
use App\Models\CarAccount;
use Session;

class CommentCarController extends Controller
{
    //
    public function index()
    {
        $data['comments'] = Comment_Car::get();
        $data['users'] = CarAccount::get();
        return view('be/pages/cars/comment/index', $data);
    }

    public function statusComment($id)
    {
        $change = Comment_Car::find($id);
        if ($change->status == 0) {
            $change->status = 1;
        } else {
            $change->status = 0;
        }
        $change->save();
        return redirect()->back();
    }

    public function replyCommentCar(Request $request)
    {
        if ($request->has("submit_reply")) {
            $this->validate($request, [
                'reply_content' => 'required|string',

            ]);
            $comm = Comment_Car::find($request->comment_id);
            if ($comm) {
                $comm->reply = $request->reply_content;
                $comm->save();
                return redirect()->back();
            } else {
                return redirect()->back();
            }

        }
    }

    public function delcomment($id){
       
            $comment = Comment_Car::find($id);
        
            // Kiểm tra xem comment có tồn tại không
            if ($comment === null) {
                // Comment không tồn tại
                Session::flash("note", "Comment not found");
                return redirect()->back();
            }
            // Kiểm tra xem có comment nào liên quan đến car_id và account_id hay không
           
            Comment_Car::destroy($id);
            // Comment đã được xóa thành công
            Session::flash("note", "Comment deleted successfully");
            return redirect()->back();
    }
    

}

