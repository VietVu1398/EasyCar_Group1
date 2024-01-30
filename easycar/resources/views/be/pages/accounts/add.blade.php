@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Add Account</h2>
                </div>
                <!-- form start -->
                <form action="{{ route('be.accountadd') }}" method="post" enctype="multipart/form-data" id="addAccountForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="{{old('fullname')}}"
                                placeholder="Please input name ">
                            {!!$errors->first('fullname','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Day Of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{old('dob')}}">
                            {!!$errors->first('dob','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                            placeholder="Please input phone " autofocus>
                            {!!$errors->first("phone",'<div class="text-danger">:message</div>')!!}
                         </div>
                         <div class="form-group col-md-10">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                            placeholder="Please input email " autofocus>
                            {!!$errors->first("address",'<div class="text-danger">:message</div>')!!}
                         </div>
                        
                        <div class="form-group col-md-10">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{old('email')}}"
                                placeholder="Please input type id ">
                            {!!$errors->first('email','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="{{old('username')}}"
                                placeholder="Please input username ">
                            {!!$errors->first('username','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="pass" value="{{ old('pass') }}" autofocus>
                            {!!$errors->first("pass",'<div class="text-danger">:message</div>')!!}
                         </div>
             
                         <div class="form-group col-md-10">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="pass_confirmation"
                               value="{{ old('pass_confirmation') }}" autofocus>
                            {!!$errors->first("pass_confirmation",'<div class="text-danger">:message</div>')!!}
                         </div>
                        {{-- <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Role Value</label>
                            <input type="text" name="role_value" class="form-control" value="{{old('role_value')}}"
                                placeholder=" Please input role_value">
                            {!!$errors->first('role_value','<div class="text-danger">:message</div>')!!}
                        </div> --}}
                        <div class="form-group col-md-10">
                            <label for="">Role value</label>
                            {{-- <input type="text" class="form-control" name="username" value="{{ $load->role_value}}" autofocus> --}}
                                {{-- {{ $load->username }} --}}

                                <select class="form-control" name="role" >
                                    
                                    @if(Auth::user()->role_value == 0)
                                    <option value="1">Moderator</option>
                                    @endif
                                    <option value="2" selected>User</option>
                                    
                                </select>
                                
                            
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="status" checked value=1> Active
                            <input type="radio" name="status" value=0> Hide
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa fa-undo"></i>
                            Reset</button>
                        <a href="{{route('be.account')}}" class="btn btn-danger"><i
                                class="fa fa-arrow-circle-left"></i> Back</a>
                        
                    </div>
                </form>
                <!-- form end -->
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>

<script>
    function resetForm() {
        document.getElementById("addAccountForm").reset();
    }
    
</script>


@endsection 