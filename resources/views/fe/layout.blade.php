<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>EasyCar</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta content="Free HTML Templates" name="keywords">
   <meta content="Free HTML Templates" name="description">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

   <!-- Favicon -->
   <link href="{{asset('public/fe')}}/img/icon-car.png" rel="icon">

   <!-- Google Web Fonts -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
      rel="stylesheet">

   <!-- Font Awesome -->
   <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />





   <!-- Libraries Stylesheet -->
   <link href="{{asset('public/fe')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
   <link href="{{asset('public/fe')}}/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

   <!-- Customized Bootstrap Stylesheet -->
   <link href="{{asset('public/fe')}}/css/bootstrap.min.css" rel="stylesheet">

   <!-- Template Stylesheet -->
   <link href="{{asset('public/fe')}}/css/style.css" rel="stylesheet">



</head>

<body>
   <!-- Topbar Start -->
   <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">

   </div>
   <!-- Topbar End -->

   <!-- lấy action từng trang -->
   <?php
        $namepage=explode(".", Route::currentRouteName()); // lấy action từng trang từ sau dấu chấm 
         // echo $namepage[1];
         //         echo "<pre>";
         // print_r($namepage);
         // echo "</pre>";
        
        $car_type = App\Models\CarCategory:: where('type_status',1)->get();
    ?>
   <!-- Navbar Start -->
   <div class="container-fluid position-relative nav-bar p-0">
      <div class="position-relative px-lg-5" style="z-index: 9;">
         <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="{{route('fe.home')}}" class="navbar-brand">
               <h1 class="text-primary mb-1"><i class="fas fa-car"></i>&nbsp; Easy Car</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
               <div class="navbar-nav ml-auto py-0">
                  <a href="{{route('fe.home')}}" class="nav-item nav-link active">Home</a>
                  <div class="nav-item dropdown">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Cars</a>
                     <div class="dropdown-menu rounded-0 m-0">
                        <?php
                           foreach($car_type as $item){
                        ?>
                        <a href="{{route('fe.category' , $item->id)}}" class="dropdown-item">{{$item->name}}</a>
                        <?php } ?>
                     </div>
                  </div>
                  <a href="{{route('fe.aboutus')}}" class="nav-item nav-link">About</a>
                  <a href="{{route('fe.contactus')}}" class="nav-item nav-link">Contact</a>
                  <a href="{{route('fe.listblogs')}}" class="nav-item nav-link">Blogs</a>


                  @if (!Auth::check())
                  <a href="{{route('fe.login')}}" class="nav-item nav-link">Login</a>
                  <a href="{{route('fe.register')}}" class="nav-item nav-link">Register</a>
                  @endif
                  @if (Auth::check())

                  <div class="nav-item dropdown">
                     <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user"></i>
                        {{Auth::user()->username}}
                     </a>
                     <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{route('fe.profile_user')}}" class="dropdown-item">Profile</a>
                        <a href="{{route('fe.bookinghistory')}}" class="dropdown-item">Booking History</a>
                        <a href="{{route('fe.logout')}}" class="dropdown-item">Log out</a>
                     </div>
                  </div>
                  {{-- --}}
                  @endif
               </div>
            </div>
         </nav>
      </div>
   </div>
   <!-- Navbar End -->


   {{-- =============================================================================================--}}

   @yield('content')

   {{-- =============================================================================================--}}


   <!-- Footer Start -->
   <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
      <div class="row pt-5">
         <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>No. 62, Street 36, Van Phuc Urban Area,
               City. Thu Duc, Ho Chi Minh City</p>
            <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>028 7300 8866</p>
            <p><i class="fa fa-envelope text-white mr-3"></i>aptech.fpt@fe.edu.vn</p>
            <h6 class="text-uppercase text-white py-2">Follow Us</h6>
            <div class="d-flex justify-content-start">
               <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
               <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
               <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
               <a class="btn btn-lg btn-dark btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Usefull Links</h4>
            <div class="d-flex flex-column justify-content-start">
               <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Private Policy</a>
               <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Term & Conditions</a>
               <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>New Member
                  Registration</a>
               <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Affiliate
                  Programme</a>
               <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Return & Refund</a>
               <a class="text-body" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Help & FQAs</a>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Car Gallery</h4>
            <div class="row mx-n1">
               <div class="col-4 px-1 mb-2">
                  <a href=""><img class="w-100" src="{{asset('public/fe')}}/img/gallery-1.jpg" alt=""></a>
               </div>
               <div class="col-4 px-1 mb-2">
                  <a href=""><img class="w-100" src="{{asset('public/fe')}}/img/gallery-2.jpg" alt=""></a>
               </div>
               <div class="col-4 px-1 mb-2">
                  <a href=""><img class="w-100" src="{{asset('public/fe')}}/img/gallery-3.jpg" alt=""></a>
               </div>
               <div class="col-4 px-1 mb-2">
                  <a href=""><img class="w-100" src="{{asset('public/fe')}}/img/gallery-4.jpg" alt=""></a>
               </div>
               <div class="col-4 px-1 mb-2">
                  <a href=""><img class="w-100" src="{{asset('public/fe')}}/img/gallery-5.jpg" alt=""></a>
               </div>
               <div class="col-4 px-1 mb-2">
                  <a href=""><img class="w-100" src="{{asset('public/fe')}}/img/gallery-6.jpg" alt=""></a>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Newsletter</h4>
            <p class="mb-4">Volup amet magna clita tempor. Tempor sea eos vero ipsum. Lorem lorem sit sed elitr sed kasd
               et</p>
            <div class="w-100 mb-3">
               <div class="input-group">
                  <input type="text" class="form-control bg-dark border-dark" style="padding: 25px;"
                     placeholder="Your Email">
                  <div class="input-group-append">
                     <a href="{{route('fe.register')}}" class="btn btn-primary text-uppercase px-3 text-center">Sign
                        Up</a>
                  </div>
               </div>
            </div>
            <i>Lorem sit sed elitr sed kasd et</i>
         </div>
      </div>
   </div>
   <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
      <p class="mb-2 text-center text-body">&copy; <a href="#">FPT APTECH</a>. All Rights Reserved.</p>

      <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
      <p class="m-0 text-center text-body">Designed by <a href="#">Group 1</a></p>
   </div>
   <!-- Footer End -->


   <!-- Back to Top -->
   <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


   <!-- JavaScript Libraries -->

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
   <script src="{{asset('public/fe')}}/lib/easing/easing.min.js"></script>
   <script src="{{asset('public/fe')}}/lib/waypoints/waypoints.min.js"></script>
   <script src="{{asset('public/fe')}}/lib/owlcarousel/owl.carousel.min.js"></script>
   <script src="{{asset('public/fe')}}/lib/tempusdominus/js/moment.min.js"></script>
   <script src="{{asset('public/fe')}}/lib/tempusdominus/js/moment-timezone.min.js"></script>
   <script src="{{asset('public/fe')}}/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

   <!-- Template Javascript -->
   <script src="{{asset('public/fe')}}/js/main.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

   <!-- mới -->

   {{--
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
   @yield('content2')
</body>

</html>