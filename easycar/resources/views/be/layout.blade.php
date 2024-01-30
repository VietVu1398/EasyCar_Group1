<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SYSTEM</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('public/be') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- ck editor -->
    <script src="{{ asset('public') }}/editor/ckeditor/ckeditor.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/be') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('public/be') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @yield('content1')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('fe.home') }}" target="_blank" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li>
                    @if (!Auth::check())
                    <a href="{{ route('fe.login') }}" class="nav-item nav-link">Login</a>
                    <a href="{{ route('fe.register') }}" class="nav-item nav-link">Register</a>
                    @endif
                    @if (Auth::check())
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i>
                            {{-- {{Auth::user()->username}} --}}
                        </a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{ route('be.admin.profile') }}" class="dropdown-item">Profile</a>
                            {{-- <a href="testimonial.html" class="dropdown-item">Booking History</a> --}}
                            <a href="{{ route('fe.logout') }}" class="dropdown-item">Log out</a>
                        </div>
                    </div>
                    {{-- --}}
                    @endif
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('be.main')}}" class="brand-link">
                <i class="fas fa-car"></i>
                <span class="brand-text font-weight-light">EasyCar</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="{{asset('public/be')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image"> --}}
                        <img src="{{ asset('public/be/images/profile_image/' . Auth::user()->profile_image) }}"
                            alt="User profile picture">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->username }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- @php
                echo \Illuminate\Support\Facades\Route::currentRouteName();
                @endphp --}}


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-car-side"></i>
                                <p>
                                    Car Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('be.category') }}" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('be.product') }}" class="nav-link">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Cars</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('be.rating') }}" class="nav-link">
                                        <i class="fa fa-star nav-icon"></i>
                                        <p>Car Rating</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('be.commentCar') }}" class="nav-link">
                                        <i class="fa fa-comment nav-icon"></i>
                                        <p>Comments Car</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Account Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('be.account') }}" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                @if (Auth::user()->role_value == 0)
                                <li class="nav-item">
                                    <a href="{{ route('be.account.viewMod') }}" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p>Moderator</p>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>
                                    Rentals & Bills
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('be.rental')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rentals</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('be.bill')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bills</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>
                                    Feedbacks/Comments
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Comments</p>
                                    </a>
                                </li> --}}

                                <li class="nav-item">
                                    <a href="{{route('be.feedback')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Feedbacks</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>
                                    Website
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('be.banner')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('be.blogWeb')}}" class="nav-link">
                                        <i class="fas fa-blog nav-icon"></i>
                                        <p>Blogs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('be.commentBlog')}}" class="nav-link">
                                        <i class="fas fa-comment nav-icon"></i>
                                        <p>Blogs</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        {{-- ================================================================================ --}}
                        @yield('content')
                        {{-- ================================================================================ --}}

                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2024 <a href="{{route('fe.home')}}">EasyCar</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('public/be') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/be') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/be') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('public/be') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('public/be') }}/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('public/be') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('public/be') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('public/be') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('public/be') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('public/be') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('public/be') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('public/be') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/be') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/be') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('public/be')}}/dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('public/be') }}/dist/js/pages/dashboard.js"></script>

    @yield('content2')
</body>

</html>