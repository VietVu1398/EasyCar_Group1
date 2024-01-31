@extends('fe/layout')
@section('content')
<!-- Search Start -->
<div class="container-fluid bg-white pt-3 px-lg-5">
    <form action="{{ route('fe.search') }}" method="get">
        {{-- @csrf --}}
        <div class="row mx-n2 justify-content-center">
            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <div class="mb-3" id="pdate" data-target-input="nearest">
                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                        name="pk_date" data-target="#pdate" data-toggle="datetimepicker" onkeydown="return false" />
                    {!!$errors->first("pk_date",'<div class="text-danger">:message</div>')!!}
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <div class="mb-3" id="rdate" data-target-input="nearest">
                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date"
                        name="rt_date" data-target="#rdate" data-toggle="datetimepicker" onkeydown="return false" />
                    {!!$errors->first("rt_date",'<div class="text-danger">:message</div>')!!}
                </div>
            </div>

            @php
            $car_type = App\Models\CarCategory::where('type_status', 1)->get();
            @endphp
            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <select class="custom-select px-4 mb-3" style="height: 50px;" name="ctype">
                    <option value="0" disabled selected>Select car type</option>
                    @foreach ($car_type as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">Search</button>
            </div>
        </div>
    </form>
</div>
<!-- Search End -->


<!-- Carousel Start -->
<div class="container-fluid p-0" style="margin-bottom: 90px;">
    <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
            @php
            $all_banne = App\Models\BannerADS::where('status', 1)->get();
            $i = 0;
            @endphp
            @foreach ($all_banne as $item)
            @php
            $i++;
            @endphp
            <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                <img class="w-100 " height=600px src="{{ asset('public/be/images/banners/' . $item->images) }}"
                    alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white text-uppercase mb-md-3">{{ $item->banner_name }}</h3>
                        <h1 class="display-1 text-white mb-md-4">{{ $item->content }}</h1>
                        <!-- <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
        <div class="btn btn-dark " style="width: 45px; height: 45px;">
            <span class="carousel-control-prev-icon mb-n2"></span>
        </div>
    </a>
    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-next-icon mb-n2"></span>
        </div>
    </a>
</div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase text-center mb-5">Welcome To <span class="text-primary">Easy Cars</span>
        </h1>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <img class="w-75 mb-4" src="{{ asset('public/fe') }}/img/about.png" alt="">
                <p>At Easy Car, we are passionate about providing you with the ultimate freedom to explore at your own
                    pace. Our
                    mission is to make your journey seamless, convenient, and, most importantly, enjoyable. As a leading
                    self-drive car rental company, we bring you a fleet of top-quality vehicles, a commitment to
                    exceptional
                    service, and a promise of unforgettable experiences on the road.</p>
            </div>
        </div>
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
    </div>
</div>
<!-- About End -->


<!-- Rent A Car Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase text-center mb-5">Top Choices</h1>
        <div class="row">
            @foreach($hotcar as $car)
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="rent-item mb-4">
                    <img class="img-fluid mb-4" src="{{ asset('public/be/images/products/thumbnail/'.$car->thumbnail)}}"
                        alt="">
                    <h4 class="text-uppercase mb-4">{{$car->name}}</h4>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-2">
                            <i class="fa fa-car text-primary mr-1"></i>
                            <span>{{$car->year}}</span>
                        </div>
                        <div class="px-2 border-left border-right">

                        </div>
                        <div class="px-2">
                            <i class="fa fa-users text-primary mr-1"></i>
                            <span>{{$car->seat}}</span>
                        </div>
                    </div>
                    <a class="btn btn-primary px-3" href="{{route('fe.detail',[khongdau($car->name),$car->id] )}}">View
                        Detail</a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Rent A Car End -->

<!-- BlogWeb Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="display-4 text-uppercase text-center mb-5">New Blogs</h1>
        <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
            @foreach($blogs as $blog)
            <div class="team-item">
                <img class="img-fluid w-100" src="{{$blog->images}}" alt="">
                <div class="position-relative py-4">
                    <h4 class="text-uppercase">
                        <a
                            href="{{route('fe.blogweb', ['blog'=>$blog->id, 'slug'=>Str::slug($blog->title)])}}">{{$blog->title}}</a>
                    </h4>
                    <p class="m-0">{!!Str::words($blog->content, 10)!!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- BlogWeb End -->

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

@section('content2')

<script>
    $(document).ready(function () {
        $('#pdate, #rdate').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: new Date()
        });
    })
</script>

@endsection