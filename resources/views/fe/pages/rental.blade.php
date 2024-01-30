@extends('fe/layout')
@section('content')

<!-- Detail Start -->
<div class="container-fluid pt-5">
   <div class="container pt-5 pb-3">
      <div class="row align-items-center pb-2">
         <div class="col-lg-6 mb-4">
            <h1 class="display-4 text-uppercase mb-5">{{$car->name}}</h1>
            <h4 class="mb-2">{{number_format(Session::get('price_per_day'), 0, '.', ' ') }} VND/Day</h4>
            {!!$car->overview!!}
         </div>
         <div class="col-lg-6 mb-4">
            <img class="img-fluid" src="{{asset('public/be/images/products/thumbnail/'.$car->thumbnail)}}" alt="">
         </div>
      </div>

   </div>
</div>
<!-- Detail End -->


<!-- Car Booking Start -->
<div class="container-fluid pb-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <h2 class="mb-4">Booking Detail</h2>
            <form action="{{route('fe.rental')}}" method="post">
               @csrf
               <div class="mb-5">
                  <div class="row">
                     <div class="col-12">
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Pickup Date</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('pickup_date')}}</span>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Return Date</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('return_date')}}</span>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Total Days</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('total_days')}}</span>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Total Amount</h6>
                           </div>
                           <div class="col-9">
                              <span>
                                 {{number_format(Session::get('total_days')*Session::get('price_per_day'), 0, '.', '
                                 ')}}
                                 VND</span>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Select amount to pay</h6>
                           </div>
                           <div class="col-9">
                              <div class="row">
                                 <div class="col-5">
                                    <input type="radio" name="pay_amount"
                                       value="{{Session::get('total_days')*Session::get('price_per_day')}}" checked> Pay
                                    all:
                                    {{number_format(Session::get('total_days')*Session::get('price_per_day'), 0, '.', '
                                    ')}} VND
                                 </div>
                                 <div class="col-7">
                                    <input type="radio" name="pay_amount"
                                       value="{{Session::get('total_days')*Session::get('price_per_day')*0.3}}"> Pay 30%
                                    in advance:
                                    {{number_format(Session::get('total_days')*Session::get('price_per_day')*0.3, 0,
                                    '.', '
                                    ')}} VND
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-2 col-form-label" for="">
                        <h6>Note</h6>
                     </label>
                     <textarea name="note" class="form-control col-9 py-3 px-4" rows="3"
                        placeholder="Special Request"></textarea>
                  </div>
                  <div class="row"><button type="submit" name="redirect" class="btn btn-primary">Book</button></div>
               </div>
            </form>
         </div>
         {{-- <div class="col-lg-4">
            <div class="bg-secondary p-5 mb-5">
               <h2 class="text-primary mb-4">Payment</h2>
               <div class="form-group">
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="payment" id="paypal">
                     <label class="custom-control-label" for="paypal">Momo</label>
                  </div>
               </div>
               <div class="form-group">
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                     <label class="custom-control-label" for="directcheck">ZaloPay</label>
                  </div>
               </div>
               <div class="form-group mb-4">
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                     <label class="custom-control-label" for="banktransfer">VNPay</label>
                  </div>
               </div>
               <a href="" class="btn btn-block btn-primary py-3">Reserve Now</a>
            </div>
         </div> --}}
      </div>
   </div>
</div>
<!-- Car Booking End -->

@endsection