@extends('fe/layout')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="row">

         <div class="offset-3 col-lg-5 mb-5">
            <h3>{{$thongbao}}</h3>
         </div>
      </div>
      <div class="row">
         <div class="offset-3 col-lg-5 mb-5">
            <a href="{{route('fe.home')}}">Home Page</a> &nbsp; <a href="{{route('fe.bookinghistory')}}">View Order</a>
         </div>
      </div>
   </div>
</div>
@endsection