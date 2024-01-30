@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Add Blog</h2>
                </div>
                <!-- form start -->
                <form action="{{ route('be.blogadd') }}" method="post" enctype="multipart/form-data" id="addBlogForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                placeholder="Please input title ">
                            {!!$errors->first('title','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Images</label>
                            <input type="file" name="images[]" multiple="multiple" class="form-control"
                                placeholder="Images">
                            {!!$errors->first('images.*','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="status" checked value=1> Active
                            <input type="radio" name="status" value=0> Hide
                        </div>
                        <div class="form-group col-md-10">
                            <label>Content</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                            {!!$errors->first('content','<div class="text-danger">:message</div>')!!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</button>
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
        document.getElementById("addBlogForm").reset();
    }
</script>

@endsection