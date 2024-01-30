@extends('be/layout')
@section('content')
<div class="col-4">

    <form action="{{ route('be.accountedit', $load->id) }}" method="post" enctype="multipart/form-data">
        @csrf


        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle admin_picture" id="admin_image"
                        style="width: 200px" src="{{ asset('public/be/images/profile_image/' . $load->profile_image) }}"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center admin_name"></h3>

                <p class="text-muted text-center">{{ $load->username }}</p>

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
                <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">History Login</a>
                </li>
            </ul>
            <a href="{{ route('be.account') }}" class=" float-right btn btn-danger"><i
                    class="fa fa-arrow-circle-left"></i>
                Back</a>
        </div><!-- /.card-header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="personal_info">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input id="fullname" type="text" class="form-control" name="fullname"
                            value="{{ $load->fullname }}" autofocus>
                        {!! $errors->first('fullname', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <input type="date" class="form-control " name="dob" value="{{ $load->dob }}">
                        {!! $errors->first('dob', '<div class="text-danger">:message</div>') !!}
                    </div>
                    {{--
                    <div class="schedule col-9" id="date1" data-target-input="nearest">
                        <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                            name="pickup_date" data-target="#date1" data-toggle="datetimepicker"
                            onkeydown="return false" />
                        {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
                    </div> --}}

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $load->phone }}" autofocus>
                        {!! $errors->first('phone', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $load->address }}" autofocus>
                        {!! $errors->first('address', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <span type="text" class="form-control" name="email">{{ $load->email }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <span type="text" class="form-control" name="username" autofocus>
                            {{ $load->username }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Role value</label>
                        {{-- <input type="text" class="form-control" name="username" value="{{ $load->role_value}}"
                            autofocus> --}}
                        {{-- {{ $load->username }} --}}

                        <select class="form-control" name="role">

                            @if(Auth::user()->role_value == 0)
                            <option value="1" @if($load->role_value == 1) selected @endif>Moderator</option>
                            @endif
                            <option value="2" @if($load->role_value == 2) selected @endif>User</option>

                        </select>


                    </div>

                    <div class="form-group mb-0 col-md-10">
                        <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;

                        <input type="radio" name="status" value=1 @if($load->status == 1) checked @endif> Active
                        <input type="radio" name="status" value=0 @if($load->status == 0) checked @endif> Hide
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                {{-- <th>Account</th> --}}
                                {{-- <th>Full Name</th>
                                <th>Email</th> --}}
                                <th>Login DateTime</th>
                                <th>Login DateTime</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loginhis as $item )
                            <tr>
                                {{-- <td>{{$item->account_id-}}</td> --}}
                                <td>{{$item->login_datetime}}</td>
                                <td>{{$item->logout_datetime}}</td>

                                @endforeach
                        </tbody>
                    </table>
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
    $(document).on('click', '#change_picture_btn', function() {
            $('#profile_image').click();
        });

        function previewImage() {
            admin_image.src = URL.createObjectURL(event.target.files[0]);
        }
</script>
@endsection