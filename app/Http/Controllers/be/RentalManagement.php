<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
//Model
use App\Models\Rental;
use App\Models\BillDetail;
use App\Models\CarProduct;


class RentalManagement extends Controller
{
    public function index() {
        $data['rentals'] = DB::table('rental')
        ->join('cars', 'rental.car_id', '=', 'cars.id')
        ->join('account', 'rental.account_id', '=', 'account.id')
        ->select('rental.*', 'cars.name','account.email')->get();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('be/pages/rental/index',$data);
    }
    public function addnew(Request $request) {
        $data['car_type'] = DB::table('car_type')->select('car_type.id','car_type.name')->get();
        $data['cars'] = DB::table('cars')->select('cars.id','cars.name','cars.type_id')->get();
        if($request->isMethod('post')) {

            //Tạo mảng chứa ngày xe đã được thuê 
            $data['db_dates'] = DB::table('rental')->select('pickup_date','return_date')
            ->where([['car_id','=',$request->car_id],['status','=',1],['processing','!=',0]])->get();
            $data['rented_dates'] = [];
            foreach ($data['db_dates'] as $ddd) {
                $start_date = Carbon::parse($ddd->pickup_date);
                $end_date = Carbon::parse($ddd->return_date);
                while ($start_date <= $end_date) {
                    $data['rented_dates'][] = $start_date->toDateString();
                    $start_date->addDay();
                }
            }
            //Validate du lieu
            $validator = Validator::make($request->all(), [
                'account_id' => ['required','exists:account,id'],
                'car_id' => ['required','exists:cars,id'],
                'pickup_date'=> ['required','date_format:Y-m-d','after:today',Rule::notIn($data['rented_dates']),],
                'return_date'=> ['required','date_format:Y-m-d','after_or_equal:pickup_date',Rule::notIn($data['rented_dates']),],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            //Tim thong tin xe
            $car = CarProduct::find($request->car_id);
            //Tao don hang
            $rental = new Rental();
            $rental->car_id = $request->car_id;
            $rental->code = time().Str::upper(Str::random(4,'alpha'));
            $rental->account_id = $request->account_id;
            $rental->pickup_date = $request->pickup_date;
            $rental->return_date = $request->return_date;
            $rental->note = $request->note;
            $rental->processing = $request->processing;
            $rental->status = 1;
            $rental->save();
            //Tinh ngay, tinh tien tao hoa don
            $pk_date = Carbon::parse($request->pickup_date);
            $rt_date = Carbon::parse($request->return_date);
            $total_days = $pk_date->diffInDays($rt_date) + 1;   
            //Tao hoa don 
            $bill = new BillDetail();
            $bill->rental_id = $rental->id;
            $bill->payment_method = "CASH";
            $bill->total_amount = $total_days * $car->price;
            $bill->paid = $total_days * $car->price;
            $bill->note = "Thanh toan don hang ".$rental->code;
            $bill->save();
            Session::flash('note','Add new Rental Order Successful!!');
            return redirect()->route('be.rental');
        } else {
        return view('be/pages/rental/addnew',$data);
        }
    }
    public function detail(Request $request, $id=null) {
        if($request->isMethod('post')) {
            $this->validate($request,[
                "car_id"=>"required|exists:cars,id",
                "account_id"=>"required|exists:account,id",
                "pickup_date"=>"required|date_format:Y-m-d",
                "return_date"=>"required|date_format:Y-m-d"
            ]);
            $rental =Rental::find($id);
            $rental->car_id = $request->car_id;
            $rental->account_id = $request->account_id;
            $rental->pickup_date = $request->pickup_date;
            $rental->return_date = $request->return_date;
            $rental->note = $request->note;
            $rental->processing = $request->processing;
            $rental->status = $request->status;
            $rental->save();
            Session::flash('note',"Edit Success!!");
            return redirect()->back();
        } else {
            $data['rental'] = Rental::find($id);
            $data['car_type'] = DB::table('car_type')->select('car_type.id','car_type.name')->get();
            $data['cars'] = DB::table('cars')->select('cars.id','cars.name','cars.type_id')->get();
            $data['account'] = DB::table('account')->select('id','email')
            ->where('id','=',$data['rental']->account_id)->first();
            return view('be/pages/rental/rental-detail',$data);
        }

    }
    public function del($id) {
        $rental = Rental::find($id);
        if ($rental === null) {
            Session::flash("note", "Rental order not found");
            return redirect()->route('be.rental');
        } 
        // $bill = BillDetail::where('rental_id',$rental->id)->delete();
        $rental->delete();
        Session::flash("note", "Deleted Successfully Rental Order and Bill");
        return redirect()->route("be.rental");
    }


    // BILL MANAGEMENT
    public function indexbill() {
        $data['listbill'] = BillDetail::all();
        return view ('be/pages/rental/bill/index',$data);
    }
    //Hoàn thành thanh toán
    public function finishpay($id) {
        $bill = BillDetail::find($id);
        $rental = Rental::find($bill->rental_id);
        $bill->paid = $bill->total_amount;
        $bill->save();
        Session::flash('note', 'The Order no '.$rental->code.' has finished payment!!');
        return redirect()->route('be.bill');
    }
}
