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
    <h1 class="display-3 text-uppercase text-white mb-3">Car Details</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="{{route('fe.home')}}">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Car Details</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- Detail Start -->
<div class="container-fluid pt-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <h1 class="display-4 text-uppercase mb-5">{{$detail->name}}</h1>


                <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="2000">
                    <div class="carousel-inner">
                        @if(!empty(json_decode($detail->images)))
                        @foreach(json_decode($detail->images) as $image)
                        <div class="carousel-item">
                            <img class="w-100" src="{{asset('public/be/images/products/images/'.$image)}}" alt="Image">
                        </div>
                        @endforeach
                        @endif

                        <div class="carousel-item active">
                            <img class="w-100"
                                src="{{asset('public/be/images/products/thumbnail/'.$detail->thumbnail)}}" alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>





                {!!$detail->overview!!}
                <!-- Start rating -->
                <div class="average-rating" style="display: inline-block;">
                    <!-- Display average rating when not logged in -->
                    <label for="defaultStar" title="stars" style="color: yellow; font-size: 30px;">
                        <i class="fas fa-star"></i></label>&nbsp;&nbsp; {{number_format($detail->averageRating(), 1)}}
                </div>

                @if(auth()->check())
                <!-- Your form for logged-in users -->
                <form action="{{ route('fe.rate', $detail['id']) }}" method="post">
                    @csrf
                    <div class="container mt-5 d-flex flex-column align-items-center"></div>
                    {{-- <div class="rating"> --}}
                        <!-- Your star rating input using Font Awesome -->
                        <div class="rating">
                            <!-- Your star rating input using Font Awesome -->
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 star"><i class="fas fa-star"></i></label>


                            <button type="submit" class="btn btn-primary " name="rate">Submit Rating</button>
                            <!-- Add more stars if needed -->
                        </div>

                        <!-- Add more stars if needed -->
                        {{--
                    </div> --}}


                </form>
                @endif

                <!-- End rating -->

                <!-- chi tiết xe -->
                <div class="row pt-2">
                    <div class="col-md-6 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Brand: {{$detail->brand}}</span>
                    </div>

                    <div class="col-md-6 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Color: {{$detail->color}}</span>
                    </div>

                    <div class="col-md-6 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Name: {{$detail->name}}</span>
                    </div>

                    <div class="col-md-6 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Year: {{$detail->year}}</span>
                    </div>


                    <div class="col-md-6 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Price: {{$detail->price}} VND</span>
                    </div>

                    <div class="col-md-6 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Seat: {{$detail->seat}}</span>
                    </div>

                </div>
            </div>




            <div class="col-lg-4 mb-5">
                <div class="row bg-light p-5 mb-4">
                    <h3 class="text-primary text-center mb-4">{{number_format($detail->price, 0, '.', ' ')}} VND/DAY
                    </h3>
                </div>
                <div class="row bg-light p-5 mb-4">
                    <h3 class="text-primary text-center mb-4">Schedule</h3>
                    <form action="" method="post" class="col-12">
                        @csrf
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="">
                                <h6>Pickup Date</h6>
                            </label>
                            <div class="schedule col-9" id="date1" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input"
                                    placeholder="Pickup Date" name="pickup_date" data-target="#date1"
                                    data-toggle="datetimepicker" />
                                {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
                                @if (Session::has('contain_invalid'))
                                <div class="text-danger">{{Session::get('contain_invalid')}}</div>
                                @endif


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="">
                                <h6>Return Date</h6>
                            </label>
                            <div class="schedule col-9" id="date2" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input"
                                    placeholder="Return Date" name="return_date" data-target="#date2"
                                    data-toggle="datetimepicker" />
                                {!!$errors->first("return_date",'<div class="text-danger">:message</div>')!!}

                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" name="booking" class="btn btn-primary">Book</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Detail End -->


<!-- Start Comment Detail -->
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <hr>
        <h3>Comments</h3>
        @if(Session::has("note"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get("note") }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(Auth::check())
        <form action="{{ route('fe.comment_car', $detail->id) }}" method="post" role="form">
            @csrf
            <div class="form-group">
                <textarea name="comment" class="form-control" placeholder="Enter comment (*)"></textarea>
                <span>{!!$errors->first()!!}</span>
            </div>
            <input type="hidden" name="status" value="1">
            <button name="send_comment" type="submit" class="btn btn-primary">Send</button>
        </form><br>
        @else
        <div class="alert alert-danger">
            <strong class="mr-2">Login to comment.</strong> Click here <a href="{{ route('fe.login') }}">Login</a>
        </div>
        @endif

        @foreach($comments as $index => $comment)
        <div class="media comment-item" style="{{ $index < 2 ? '' : 'display: none;' }}">
            <a class="pull-left" href="#">
                <img class="media-object mr-3"
                    src="{{asset('public/be/images/profile_image/'.$comment->account->profile_image)}}" alt="Image"
                    width=50>
            </a>
            <div class="media-body">
                <h5 class="media-heading">{{ $comment->account->fullname }}
                    <small class="ml-3" style="color: #A9A9A9; font-size: 1.5px;">
                        {{ $comment->created_at->format('d/mY') }}
                    </small>
                </h5>
                <p>{{ $comment->comment }}</p>
                @if(auth()->check() && auth()->user()->id == $comment->account_id)
                <a href="{{route('fe.delete_car' ,$comment->id)}}" class="btn btn-sm btn-danger">Delete</a>
                @endif
                <!-- admin check -->
                {{-- @if(auth()->check() &&auth()->user()->role_value == 0 && $comment->reply == null)
                <form action="{{ route('fe.comment_car', $detail->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="reply" class="form-control" placeholder="Enter comment (*)"></textarea>
                        <button type="reply_comment" class="btn btn-primary">Reply</button>
                    </div>
                    <input type="hidden" name="status" value="1">
                    @endif
                </form> --}}

                <p class="ml-5">
                    @if ($comment->reply)
                    <a class="pull-left" href="#">
                        <i class="fas fa-car " style="font-size:30px"></i>
                        <strong>Admin: </strong>
                    </a>
                    @endif
                    {{$comment->reply}}
                </p>
            </div>

        </div>
        @endforeach
        <button id="showButton" class="btn btn-primary">Show More</button>
    </div>
    <!-- End Comment -->

    <!-- Các sản phẩm liên quan -->
    <!-- Related Car Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <h2 class="mb-4">Related Cars</h2>
            <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
                @foreach($randomproduct as $random )
                <div class="rent-item">
                    <img class="img-fluid mb-4"
                        src="{{asset('public/be/images/products/thumbnail/'.$random->thumbnail)}}" alt="">
                    <h4 class="text-uppercase mb-4">{{$random->name}}</h4>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-2">
                            <i class="fa fa-car text-primary mr-1"></i>
                            <span>{{$random->color}}</span>
                        </div>
                        <div class="px-2 border-left border-right">
                            <i class="fa fa-users text-primary mr-1"></i>
                            <span>{{$random->seat}}</span>
                        </div>
                        <div class="px-2">

                        </div>
                    </div>
                    <a class="btn btn-primary px-3"
                        href="{{route('fe.detail',[khongdau($random->name),$random->id] )}}">{{$random->price}}
                        VND/DAY</a>
                </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Related Car End -->





    <!-- style rating -->
    <style>
        /* Add your custom styles for the rating here */
        .rating {
            display: inline-block;
            direction: rtl;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked~label {
            color: #f39c12;
        }

        /* Thêm phần này để áp dụng Font Awesome icon cho nhãn trong .rating */
        .rating label:before {
            font-family: 'Font Awesome 5 Free';
            /* Đảm bảo bạn chọn đúng tên font */
            font-weight: 900;
            /* Đảm bảo bạn chọn đúng trọng lượng font */
        }
    </style>
    <!-- style mới -->

    @endsection

    @section('content2')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
                    // Tạo mảng chứa dữ liệu ngày tháng xe đã được thuê
                var dateArray = {!! json_encode($rented_dates)!!};
                $('#date1, #date2').datetimepicker({
                    format: 'YYYY-MM-DD',
                    minDate: new Date(),
                    disabledDates: dateArray
                });

                var visibleComments = 3;

                $('#showButton').on('click', function () {
                    $('.comment-item:hidden').slice(0, 3).slideDown(); // Show the next 3 hidden comments
                    visibleComments += 3;

                    if (visibleComments >= $('.comment-item').length) {
                        $(this).hide(); // Hide the button when all comments are visible
                    }
                });
            });
    </script>

    @endsection