@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Edit Blog</h2>
                </div>
                <!-- form start -->
                <form action="{{route('be.blogedit',$load->id)}}" method="post" enctype="multipart/form-data"
                    id="editBlogForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title"
                                value="{{old('title',isset($load)?$load->title:null)}}">
                            {!!$errors->first('title','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Images</label>
                            <input type="file" class="form-control" multiple="multiple" name="images[]">
                            {!!$errors->first('images.*','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="status" <?php if($load->status ==1) {echo
                            "checked"; }else {echo "";} ?>
                            value=1> Active
                            <input type="radio" name="status" <?php if($load->status ==0) {echo
                            "checked"; }else {echo "";} ?>
                            value=0> Hide
                        </div>
                        <div class="form-group col-md-10">
                            <label>Content</label>
                            <textarea name="content" id="content" class="form-control" >{!!isset($load)?$load->content:null!!}</textarea>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                            {!!$errors->first('content','<div class="text-danger">:message</div>')!!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa fa-undo"></i>
                            Reset</button>
                        <a href="{{route('be.blogWeb')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>
                            Back</a>
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
        document.getElementById("editBlogForm").reset();
    }
</script>

@endsection