@extends('fe.layout')

@section('content')
<div class="offset-3 col-6">

   <div class="card card-primary">
      <div class="card-header text-center">
         <h3 class="card-title">Register</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('fe.register')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="card-body">
            <div class="form-group">
               <label for="exampleInputEmail1">Full Name</label>
               <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}"
                  autofocus>
               {!!$errors->first("fullname",'<div class="text-danger">:message</div>')!!}
            </div>
            <div class="form-group">
               <label for="">Date of Birth</label>
               {{-- <div class="" id="date1" data-target-input="nearest"> --}}
                  <input type="date" class="form-control datetimepicker-input" name="dob" value="{{ old('dob') }}"
                     data-target="#date1" data-toggle="datetimepicker" autofocus>
                  {!!$errors->first("dob",'<div class="text-danger">:message</div>')!!}
                  {{--
               </div> --}}
            </div>
            {{--
            <div class="schedule col-9" id="date1" data-target-input="nearest">
               <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                  name="pickup_date" data-target="#date1" data-toggle="datetimepicker" onkeydown="return false" />
               {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
            </div> --}}

            <div class="form-group">
               <label for="">Phone</label>
               <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" autofocus>
               {!!$errors->first("phone",'<div class="text-danger">:message</div>')!!}
            </div>
            <div class="form-group">
               <label for="">Address</label>
               <input type="text" class="form-control" name="address" value="{{ old('address') }}" autofocus>
               {!!$errors->first("address",'<div class="text-danger">:message</div>')!!}
            </div>
            <div class="form-group">
               <label for="">Email</label>
               <input type="text" class="form-control" name="email" value="{{ old('email') }}" autofocus>
               {!!$errors->first("email",'<div class="text-danger">:message</div>')!!}
            </div>
            <div class="form-group">
               <label for="">Username</label>
               <input type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus>
               {!!$errors->first("username",'<div class="text-danger">:message</div>')!!}
            </div>
            <div class="form-group">
               <label for="">Password</label>
               <input type="password" class="form-control" name="pass" value="{{ old('pass') }}" autofocus>
               {!!$errors->first("pass",'<div class="text-danger">:message</div>')!!}
            </div>

            <div class="form-group">
               <label for="">Confirm Password</label>
               <input type="password" class="form-control" name="pass_confirmation"
                  value="{{ old('pass_confirmation') }}" autofocus>
               {!!$errors->first("pass_confirmation",'<div class="text-danger">:message</div>')!!}
            </div>
            <div class="form-group">
               <label for="">Profile Image</label>
               <input type="file" class="form-control" name="profile_image" autofocus onchange="previewImage()">
               {!!$errors->first("profile_image",'<div class="text-danger">:message</div>')!!}
            </div>
            <div>
               <img id="photo" src="{{asset('public/be/images/profile_image/default-profile-image.jpg')}}" alt="Photo"
                  style="max-width: 200px; max-height: 200px">
               <script>
                  function previewImage() {
                     photo.src=URL.createObjectURL(event.target.files[0]);
                        }
               </script>
            </div>
         </div>
         <!-- /.card-body -->

         <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </form>
   </div>
</div>
@endsection

@section('content2')
<script>
   $(document).ready(function () {
  
  $('#date1').datetimepicker({
     format: 'MM-DD-YYYY',
     maxDate: new Date(),
  });
})

</script>
@endsection