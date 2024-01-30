@extends('fe/layout')
@section('content')
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">FORGET PASSWORD</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-6 offset-lg-3 mb-5">
                <div class="contact-form">
                    @if (Session::has('note'))
                        <div id="success">{{ Session::get('note') }}</div>
                    @endif
                    <form action="{{ route('fe.forgetpass') }}" method="post">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control" name="email" placeholder="Email" />
                            {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}

                        </div>
                        <div>
                            <button class="btn btn-primary py-2 mt-3 px-4" type="submit">
                                SEND PASSWORD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
