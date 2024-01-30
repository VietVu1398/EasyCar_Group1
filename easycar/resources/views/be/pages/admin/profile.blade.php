@extends('be.layout')

@section('content')

{{-- <div class="row mb-2">
   <div class="col-sm-6">
      <h1>Profile</h1>
   </div>
   <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item"><a href="#">Home</a></li>
         <li class="breadcrumb-item active">User Profile</li>
      </ol>
   </div>
</div> --}}
{{-- <div class="row"> --}}
   <div class="col-4">
      <form action="{{route('be.admin.profile')}}" method="post" enctype="multipart/form-data">
         @csrf
         <!-- Profile Image -->
         <div class="card card-primary card-outline">
            <div class="card-body box-profile">
               <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle admin_picture" id="admin_image" style="width: 200px"
                     src="{{asset('public/be/images/profile_image/'.Auth::user()->profile_image)}}"
                     alt="User profile picture">
               </div>

               <h3 class="profile-username text-center admin_name"></h3>

               <p class="text-muted text-center">Admin</p>

               <input type="file" name="profile_image" id="profile_image" style="opacity: 0;height:1px;display:none"
                  onchange="previewImage()">
               <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Change
                     picture</b></a>

            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->


   </div>
   <!-- /.col -->
   <div class="col-8">
      <div class="card">
         <div class="card-header p-2">
            <ul class="nav nav-pills">
               <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Personal
                     Information</a></li>
               <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change
                     Password</a></li>
            </ul>
         </div><!-- /.card-header -->
         <div class="card-body">
            <div class="tab-content">
               <div class="active tab-pane" id="personal_info">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Full Name</label>
                     <input id="fullname" type="text" class="form-control" name="fullname"
                        value="{{Auth::user()->fullname}}" autofocus>
                     {!!$errors->first("fullname",'<div class="text-danger">:message</div>')!!}
                  </div>
                  <div class="form-group">
                     <label for="">Date of Birth</label>
                     <input type="date" class="form-control " name="dob" value="{{Auth::user()->dob}}">
                     {!!$errors->first("dob",'<div class="text-danger">:message</div>')!!}
                  </div>
                  {{--
                  <div class="schedule col-9" id="date1" data-target-input="nearest">
                     <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                        name="pickup_date" data-target="#date1" data-toggle="datetimepicker" onkeydown="return false" />
                     {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
                  </div> --}}

                  <div class="form-group">
                     <label for="">Phone</label>
                     <input type="text" class="form-control" name="phone" value="{{Auth::user()->phone}}" autofocus>
                     {!!$errors->first("phone",'<div class="text-danger">:message</div>')!!}
                  </div>
                  <div class="form-group">
                     <label for="">Address</label>
                     <input type="text" class="form-control" name="address" value="{{Auth::user()->address}}" autofocus>
                     {!!$errors->first("address",'<div class="text-danger">:message</div>')!!}
                  </div>
                  <div class="form-group">
                     <label for="">Email</label>
                     <span type="text" class="form-control" name="email">{{Auth::user()->email}}
                     </span>
                  </div>
                  <div class="form-group">
                     <label for="">Username</label>
                     <span type="text" class="form-control" name="username" autofocus>
                        {{Auth::user()->username}}
                     </span>
                  </div>
                  <div class="form-group row">
                     <div class=" col-sm-10">
                        <button type="submit" name="change_info" class="btn btn-danger float-right">Save
                           Changes</button>
                     </div>
                  </div>
               </div>
               </form>


               <!-- /.tab-pane -->
               <div class="tab-pane" id="change_password">
                  <form class="form-horizontal" action="{{route('be.admin.profile')}}" method="post">
                     @csrf
                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Passord</label>
                        <div class="col-sm-10">
                           <input type="password" class="form-control" id="inputName"
                              placeholder="Enter current password" name="oldpass">
                           {!!$errors->first("oldpass",'<div class="text-danger">:message</div>')!!}

                           @if (Session::get('error'))
                           <div class="text-danger">{{Session::get('error')}}</div>
                           @endif

                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                           <input type="password" class="form-control" id="newpassword" placeholder="Enter new password"
                              name="newpass">
                           {!!$errors->first("newpass",'<div class="text-danger">:message</div>')!!}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
                        <div class="col-sm-10">
                           <input type="password" class="form-control" id="cnewpassword"
                              placeholder="ReEnter new password" name="newpass_confirmation">
                           {!!$errors->first("newpass_confirmation",'<div class="text-danger">:message</div>')!!}
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                           <button type="submit" name="change_password" class="btn btn-danger">Update Password</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!-- /.tab-content -->
         </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <!-- /.col -->
   {{--
</div> --}}
<!-- /.row -->
<!-- /.content -->
@endsection

@section('content2')
<script>
   $(document).on('click','#change_picture_btn', function(){
      $('#profile_image').click();
    });
    
    function previewImage() {
      admin_image.src=URL.createObjectURL(event.target.files[0]);
                        }


    
</script>
@endsection