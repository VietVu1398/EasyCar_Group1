@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Add Banner</h2>
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                </div>
                <!-- form start -->
                <form action="{{ route('be.addBanner') }}" method="post" enctype="multipart/form-data" id="addAccountForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Banner Name</label>
                            <input type="text" name="banner_name" class="form-control" value="{{old('banner_name')}}"
                                placeholder="Please input banner_name ">
                            {!!$errors->first('banner_name','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Images</label>
                            <input type="file" name="images" class="form-control" value="{{old('images')}}">
                            {!!$errors->first('images','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Content</label>
                            <input type="text" class="form-control" name="content" value="{{ old('content') }}"
                            placeholder="Please input content " autofocus>
                            {!!$errors->first("content",'<div class="text-danger">:message</div>')!!}
                         </div>

                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="status" checked value=1> input
                            <input type="radio" name="status" value=0> output
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Banner</button>
                        <a href="{{route('be.banner')}}" class="btn btn-danger"><i
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