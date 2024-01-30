<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Feedback;
use Mail;
use App\Mail\RepFeedback;
use Session;

class FeedbackController extends Controller
{
    //
    public function index() {
        $data['load'] = Feedback::all();
        return view('be/pages/feedbacks/index',$data);
    }

    public function feedbackdetail($id) {
        $data['feed'] = Feedback::find($id);
        return view('be/pages/feedbacks/feedbackdetail',$data);
    }

    public function mailfeedback(Request $request, $id) {
        $feed = Feedback::find($id);
        $feed->reply_content = $request->reply_content;
        $feed->reply_status = 1;
        $feed->save();
        // print_r($request->reply_content);
        $this->guimail($request->email, $request->reply_content);
        Session::flash('note', 'Email reply feedback has been sent to customer!!');

        return redirect()->route('be.feedback');
    }

    public function guimail($mail=null,$reply_content=null){
        $data=[
            'title'=>'From EasyCar: Reply your feedback',
            'content'=>$reply_content,
        ];
        Mail::to($mail)->send(new RepFeedback($data));
    }

    public function delfeedback($id) {
       $feed = Feedback::find($id);
       $feed->delete();
       Session::flash('note', 'Delete Feedback Success!!');
        return redirect()->route('be.feedback');
    }
}
