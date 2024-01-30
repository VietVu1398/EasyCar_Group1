@extends('fe/layout')
@section('content')
<div class="container-fluid pt-5">
   <div class="container pt-5 ">
      <div class="row mb-5">
         <div class="col-6">
            <div class="row mb-3">
               <div class="col-10">
                  <h3>{{$car->name}}</h3>
                  <h6>From {{Session::get('pickup_date')}} to {{Session::get('return_date')}}</h6>
               </div>
               <img class="img-fluid" src="{{asset('public/be/images/products/thumbnail/'.$car->thumbnail)}}" alt="">

            </div>

         </div>
         <div class="col-4 ml-5 bg-light">
            <h1>Payment Method</h1>
            <div class="row mb-3 mt-3">
               <div class="col-5">
                  <h6 class="text-primary">Payment Amount</h6>
               </div>
               <div class="col-6">
                  <h6>
                     {{number_format(Session::get('pay_amount'), 0, '.', ' ')}} VND</h6>
               </div>
            </div>
            <div class="row mb-3">
               <div class="col-6 p-2">
                  <form action="{{route('fe.paymentvnpay')}}" method="post">
                     @csrf
                     <div class="ro">
                        <button type="submit" name="redirect" class="btn btn-primary">Pay with VNPay</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection