@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Edit Banner</h2>
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                </div>
                <!-- form start -->
                <form action="{{ route('be.editBanner',$load->id) }}" method="post" enctype="multipart/form-data" id="addAccountForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Banner Name</label>
                            <input type="text" name="banner_name" class="form-control" value="{{$load->banner_name}}"
                                placeholder="Please input banner_name " >
                            {!!$errors->first('banner_name','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Images</label>
                            <input type="file" name="images" class="form-control" value="{{$load->images}}" >
                            {!!$errors->first('images','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="">Content</label>
                            <input type="text" class="form-control" name="content" value="{{ $load->content }} autofocus"
                            placeholder="Please input content " >
                            {!!$errors->first("content",'<div class="text-danger">:message</div>')!!}
                         </div>

                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="status" value=1 @if($load->status == 1) checked @endif> Active
                            <input type="radio" name="status" value=0 @if($load->status == 0) checked @endif> Hide
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit Banner</button>
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