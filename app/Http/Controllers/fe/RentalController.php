<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;


use App\Models\CarProduct;
use App\Models\Rental;
use App\Models\BillDetail;


class RentalController extends Controller
{

    public function search(Request $request) {
        $schedule = [];
        $pk_date = $request->input('pk_date');
        $rt_date = $request->input('rt_date');
        $ctype = $request->input('ctype');
        $validator = Validator::make($request->all(), [
            'pk_date'=> ['required','date_format:Y-m-d','after:today'],
            'rt_date'=> ['required','date_format:Y-m-d','after_or_equal:pk_date']
        ]);
        if ($validator->fails()) {
            // return back()->withErrors($validator);
            return redirect()->back()->withErrors($validator);
        };
        if($pk_date && $rt_date) {
            $start_date = Carbon::parse($pk_date);
            $end_date = Carbon::parse($rt_date);
            while ($start_date <= $end_date) {
                $schedule[] = $start_date->toDateString();
                $start_date->addDay();
            }
        }
        // Tìm các xe không có sẵn trong date range do user nhập vào tìm kiếm
        // Car Not Available
        $car_na = DB::table('rental')  
        ->whereIn('rental.pickup_date', $schedule)
        ->orWhereIn('rental.return_date', $schedule)
        ->where('rental.status','=',1)
        ->select('rental.car_id')->get();
        // List chứa id các xe không có sẵn
        $list_idcar = [];
        foreach($car_na as $c) {
            array_push($list_idcar, $c->car_id);
        }
        //Lấy danh sách các xe
        if($ctype) {
            $data['list_car'] = DB::table('cars')->where('product_status',1)
            ->where('type_id','=',$ctype)->whereNotIn('cars.id',$list_idcar)->get();
        } else {
            $data['list_car'] = DB::table('cars')->join('car_type','car_type.id','=','cars.type_id')
            ->where('car_type.type_status',1)->where('cars.product_status',1)->whereNotIn('cars.id',$list_idcar)
            ->select('cars.*')->get();
        }
        return view('fe/pages/search', $data);
    }

    //Trang Thue xe
    public function rental(Request $request) {
        if(Auth::check() && Session::has('car_id')){
            if(Session::has('car_id')) {
                $data['car'] = CarProduct::find(Session::get('car_id'));
            }
            if($request->isMethod('post')) {
                $pay_amount =  $request->pay_amount;
                $note = $request->note;
                Session::put('pay_amount',$pay_amount);
                Session::put('note',$note);
                $madonhang = time().Str::upper(Str::random(4,'alpha'));
                Session::put('madonhang',$madonhang);
                return redirect()->route('fe.payment');
            } else {
                return view('fe/pages/rental',$data);
            }
        } else {
            return redirect()->route('fe.home');
        }
    }
    // Trang thanh toasn 
    public function payment() {
        if(Auth::check() && Session::has('madonhang')){
        $data['car'] = CarProduct::find(Session::get('car_id'));
         return view('fe/pages/payment',$data);
        } else {
            return redirect()->route('fe.home');
        }
    }
    
    public function paymentvnpay() {
        //Code cua VNPay
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:83/easycar/noti";
        $vnp_TmnCode = "IWL1VFWN";//Mã website tại VNPAY 
        $vnp_HashSecret = "XOOBOTMAMIEAKUVEHLSRIYCVNJXVCKOQ"; //Chuỗi bí mật

        $vnp_TxnRef = Session::get('madonhang');//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toan don hang '.Session::get('madonhang');
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = Session::get('pay_amount') * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=>$vnp_ExpireDate
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    }

    public function noti() {
        if(Auth::check() && Session::has('madonhang')) {
            if(request('vnp_ResponseCode') == '00' && request('vnp_TxnRef') == Session::get('madonhang'))  {
                $data['thongbao'] = "Payment Successful, We will contact to you soon to confirm your order again!!";
                // Ghi vao Database
                $rental = new Rental();
                $rental->code = Session::get('madonhang');
                $rental->car_id = Session::get('car_id');
                $rental->account_id = Auth::user()->id;
                $rental->pickup_date =Session::get('pickup_date');
                $rental->return_date = Session::get('return_date');
                $rental->note = Session::get('note');
                $rental->processing=3;
                $rental->status=1;
                $rental->save();
                // Ghi vao Database bill
                $bill = new BillDetail();
                $bill->rental_id = (int)$rental->id;
                $bill->payment_method = "VNPAY";
                $bill->total_amount = Session::get('total_days')*Session::get('price_per_day');
                $bill->paid =  request('vnp_Amount')/100;
                $bill->note = request('vnp_OrderInfo');
                $bill->save();
                Session::forget(['madonhang','car_id','pickup_date','return_date','note',
                'total_days','price_per_day']);
            } else {
                $data['thongbao'] = "Payment failed, We hope that you will come back to use our services";
                Session::forget(['madonhang','car_id','pickup_date','return_date','note',
                'total_days','price_per_day']);
            }
            return view('fe/pages/noti',$data);
        }else {
            return redirect()->route('fe.home');
        }


}
}


        //  echo "<pre>";
        // print_r($data);
        // echo "</pre>";
