@extends('fe/layout')

@section('content')
<div class="container-fluid py-5">
   <div class="container pt-5 pb-3">
      <h1 class="display-4 text-uppercase text-center mb-5">Booking History</h1>
      @foreach ($list_booking as $item)
      <div class="card mb-3">
         <div class="card-header">
            <h5 class="card-title">{{$item->carname}} - Book form {{$item->pickup_date}} to {{$item->return_date}}</h5>
            @if ($item->status==0)
            <span class="float-right text-danger">Canceled</span>
            @endif
            <button class="btn btn-outline-primary " type="button" data-toggle="collapse"
               data-target="#t{{$item->code}}" aria-expanded="false" aria-controls="">
               Detail
            </button>
         </div>
         <div class="collapse" id="t{{$item->code}}">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-2">
                     <h6>Car: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->carname}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Pickup Date: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->pickup_date}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Return Date: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->return_date}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Processing: </h6>
                  </div>
                  <div class="col-md-8">
                     @php
                     if ($item->processing==3) {
                     echo "Waiting for confirmation";
                     } elseif ($item->processing==2) {
                     echo " confirmed";
                     } elseif ($item->processing==1) {
                     echo "Picked up car";
                     } else {
                     echo "returned car";
                     }
                     @endphp
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Total Amount: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->total_amount}} VND
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Paid: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->paid}} VND
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Note: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->note}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <h6>Book at: </h6>
                  </div>
                  <div class="col-md-8">
                     {{$item->created_at}}
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endforeach
      <!-- Pagination Start -->
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-10 pb-1 text-right">
               {{$list_booking->links()}}
            </div>
         </div>
      </div>
      <!-- Pagination End -->
   </div>
</div>
@endsection