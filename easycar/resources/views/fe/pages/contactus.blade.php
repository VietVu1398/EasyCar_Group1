@extends('fe/layout')

@section('content')

{{-- For a margin --}}
<div class="container-fluid bg-white pt-3 px-lg-5">
   <div class="row mx-n2">
   </div>
</div>

<!-- Page Header Start -->
<div class="container-fluid page-header">
   <h1 class="display-3 text-uppercase text-white mb-3">Contact</h1>
   <div class="d-inline-flex text-white">
      <h6 class="text-uppercase m-0"><a class="text-white" href="{{route('fe.home')}}">Home</a></h6>
      <h6 class="text-body m-0 px-3">/</h6>
      <h6 class="text-uppercase text-body m-0">Contact</h6>
   </div>
</div>
<!-- Page Header Start -->

<div class="row">
   <div class="offset-2 col-8">
      <h3 class="text-primary">
         @if(Session::has("note"))
         {{ Session::get("note") }}
         @endif
      </h3>
   </div>
</div>
<!-- Contact Start -->
<div class="container-fluid py-5">
   <div class="container pt-5 pb-3">
      <h1 class="display-4 text-uppercase text-center mb-5">Contact Us</h1>
      <div class="row">
         <div class="col-lg-7 mb-2">
            <div class="contact-form bg-light mb-4" style="padding: 30px;">
               <form action="" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-6 form-group">
                        <input type="number" class="form-control p-4" placeholder="Your Phone" name="phone"
                           required="required">
                        {!!$errors->first("phone",'<div class="text-danger">:message</div>')!!}
                     </div>
                     <div class="col-6 form-group">
                        <input type="email" class="form-control p-4" placeholder="Your Email" name="email"
                           required="email">
                        {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
                     </div>
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control p-4" placeholder="Your Fullname" name="fullname"
                        required="required">
                     {!!$errors->first("fullname",'<div class="text-danger">:message</div>')!!}
                  </div>
                  <div class="form-group">
                     <textarea class="form-control py-3 px-4" rows="5" placeholder="Your Messege" name="content"
                        required="required"></textarea>
                  </div>
                  <div>
                     <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-5 mb-2">
            <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
               <div class="d-flex mb-3">
                  <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                  <div class="mt-n1">
                     <h5 class="text-light">Head Office</h5>
                     <p>No. 62, Street 36, Van Phuc Urban Area,
                        City. Thu Duc, Ho Chi Minh City</p>
                  </div>
               </div>
               <div class="d-flex mb-3">
                  <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                  <div class="mt-n1">
                     <h5 class="text-light">Customer Service</h5>
                     <p>aptech.fpt@fe.edu.vn</p>
                  </div>
               </div>
               <div class="d-flex">
                  <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                  <div class="mt-n1">
                     <h5 class="text-light">Return & Refund</h5>
                     <p class="m-0">aptech.fpt@fe.edu.vn</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Contact End -->

<!-- Vendor Start -->
<div class="container-fluid py-5">
   <div class="container py-5">
      <div class="owl-carousel vendor-carousel">
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-1.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-2.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-3.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-4.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-5.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-6.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-7.png" alt="">
         </div>
         <div class="bg-light p-4">
            <img src="{{ asset('public/fe') }}/img/vendor-8.png" alt="">
         </div>
      </div>
   </div>
</div>
<!-- Vendor End -->
@endsection