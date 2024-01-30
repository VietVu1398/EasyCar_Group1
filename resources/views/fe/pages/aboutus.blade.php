@extends('fe.layout')
@section('content')
{{-- For a margin --}}
<div class="container-fluid bg-white pt-3 px-lg-5">
    <div class="row mx-n2">
    </div>
</div>
<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">About</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="{{route('fe.home')}}">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">About</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase text-center mb-5">Welcome To <span class="text-primary">Easy Car</span></h1>
        <h2 class="text-center mb-5">Your Gateway to Self-Drive Adventures!</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <img class="w-75 mb-4" src="{{asset('public/fe/img/about.png')}}" alt="">

            </div>
        </div>
        <p>At Easy Car, we are passionate about providing you with the ultimate freedom to explore at your own pace. Our
            mission is to make your journey seamless, convenient, and, most importantly, enjoyable. As a leading
            self-drive car rental company, we bring you a fleet of top-quality vehicles, a commitment to exceptional
            service, and a promise of unforgettable experiences on the road.</p>

        {{-- code aboutus img2 --}}
        <div class="container pt-5 pb-3">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <img class="w-75 mb-4" src="{{asset('public/fe/img/aboutus-2.jpg')}}" alt="">
                </div>
            </div>
            <p>Who We Are
                Founded with a vision to revolutionize the way you travel, Easy Car is your trusted partner for
                self-drive adventures. Our team comprises dedicated professionals who share a common goal: to empower
                you with the convenience of exploring new destinations without the hassles of traditional
                transportation.</p>
            <p>1. Exceptional Customer Service:</p>
            <p> Our customer service team is here to assist you at every step. From answering your queries to helping
                you choose the perfect vehicle, we are committed to providing personalized service that exceeds your
                expectations.
                Our Commitment</p>

            <div class="row mt-3">
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-headset text-secondary"></i>
                        </div>
                        <h4 class="text-uppercase m-0">24/7 Car Rental Support</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-clock text-secondary"></i>
                        </div>
                        <h4 class="text-light text-uppercase m-0">Car Reservation Anytime</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-car text-secondary"></i>
                        </div>
                        <h4 class="text-uppercase m-0">Lots Of Cars with reasonable prices</h4>
                    </div>
                </div>
            </div>
            {{-- aboutus img3 --}}
            <p>What Sets Us Apart</p>
            <p>2. Diverse Fleet of Vehicles:
                Choose from our extensive range of vehicles, including compact cars, SUVs, and luxury models. We
                ensure that each vehicle in our fleet is meticulously maintained, providing you with a safe and
                reliable driving experience.</p>
            <div class="container pt-5 pb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <img class="w-75 mb-4" src="{{asset('public/fe/img/aboutus-3.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <P> 3. Easy Booking Process:</p>
            <p>We believe in simplicity and efficiency. Our user-friendly online platform allows you to book your
                desired vehicle with just a few clicks. No hidden fees, no complicated paperwork – just a
                straightforward booking process.</p>
            <p>4. Flexible Rental Options:</p>
            <p> Whether you need a car for a day, a weekend getaway, or an extended road trip, we have flexible
                rental options to suit your needs. Enjoy the freedom to plan your itinerary without the constraints
                of fixed schedules.
            </P>
        </div>
    </div>
    <!-- About End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-secondary d-flex align-items-center justify-content-between"
                        style="height: 350px;">
                        <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4"
                            src="{{asset('public/fe/img/banner-left.png ')}}" alt="">
                        <div class="text-right">
                            <h3 class="text-uppercase text-light mb-3">Want to be driver?</h3>
                            <p class="mb-4">Lorem justo sit sit ipsum eos lorem kasd, kasd labore</p>
                            <a class="btn btn-primary py-2 px-4" href="">Start Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                        <div class="text-left">
                            <h3 class="text-uppercase text-light mb-3">Looking for a car?</h3>
                            <p class="mb-4">Lorem justo sit sit ipsum eos lorem kasd, kasd labore</p>
                            <a class="btn btn-primary py-2 px-4" href="">Start Now</a>
                        </div>
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4"
                            src="{{asset('public/fe/img/banner-right.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p>At Easy Car, we understand that every journey is unique. Whether you're a solo traveler, a family on
        vacation, or a group of friends seeking adventure, we are here to cater to your specific requirements. Our
        commitment to excellence extends beyond the vehicles we provide – it encompasses the entire experience of
        renting with us.</p>
    <!-- Banner End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-1.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-2.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-3.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-4.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-5.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-6.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-7.png')}}" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('public/fe/img/vendor-8.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    @endsection