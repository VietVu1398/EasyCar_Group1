@extends('fe/layout')
@section('content')
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">LOGIN</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-6 offset-lg-3 mb-5">
            <div class="contact-form">
                <!-- start notication of session -->
                @if(Session::has('note'))
                <div id="success">{{Session::get('note')}}</div>
                @endif
                <!-- end notication -->
                <form action="{{route('fe.login')}}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email" />
                        {!!$errors->first('email','<p class="help-block text-danger">:message</p>')!!}
                    </div>
                    <div class="control-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                        {!!$errors->first('password','<p class="help-block text-danger">:message</p>')!!}
                    </div>
                    

                    <div class="control-group">
                        <input type="checkbox" name="remember"> Remember
                        <a href="{{route('fe.forgetpass')}}">Forget Password</a>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit">Login</button>
                    </div>
                    
                    
                </form>
            </div>
        </div>

    </div>
</div>

@endsection