@extends('fe/layout')
@section('content')
<!-- Search Start -->
<div class="container-fluid bg-white pt-3 px-lg-5">
    <div class="row mx-n2">

    </div>
</div>
<!-- Search End -->

<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Car Listing</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="{{route('fe.home')}}">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Car Listing</h6>
    </div>
</div>
<!-- Page Header Start -->

<!-- Rent A Car Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase text-center mb-5">List Cars</h1>
        <div class="row">
            <?php
                    foreach ($loadcarproduct as $item ) {
                ?>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="rent-item mb-4">
                    <img class="img-fluid mb-4"
                        src="{{asset('public/be/images/products/thumbnail/'.$item->thumbnail)}}">
                    <h4 class="text-uppercase mb-4">{{$item->name}}</h4>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-2">
                            <i class="fa fa-car text-primary mr-1"></i>
                            <span>{{$item->year}}</span>
                        </div>
                        <div class="px-2">
                            <i class="fa fa-users text-primary mr-1"></i>
                            <span>{{$item->seat}}</span>

                        </div>
                    </div>
                    <a class="btn btn-primary px-3" href="">{{number_format($item->price, 0, '.', ' ')}}/Day</a>
                    <a class="btn btn-primary px-3"
                        href="{{route('fe.detail',[khongdau($item->name),$item->id] )}}">View
                        Detail</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- Pagination Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-10 pb-1 text-right">
                    {{$loadcarproduct->links()}}
                </div>
            </div>
        </div>
        <!-- Pagination End -->
    </div>
</div>
<!-- Rent A Car End -->
@endsection