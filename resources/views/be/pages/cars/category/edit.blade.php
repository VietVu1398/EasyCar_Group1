@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Edit Category</h2>
                </div>
                <!-- form start -->
                <form action="{{route('be.categoryedit', $load->id)}}" method="post" enctype="multipart/form-data"
                    id="editCategoryForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{old('name',isset($load)?$load->name:null)}}" placeholder="Please input name ">
                            {!!$errors->first('name','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Description</label>
                            <input type="text" name="description" class="form-control"
                                value="{{old('description',isset($load)?$load->name:null)}}"
                                placeholder=" Please input description">
                            {!!$errors->first('description','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Image</label>
                            <input type="file" name="image_type" class="form-control">
                            {!!$errors->first('image_type','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="type_status" value=1 <?php if(($load->type_status)==1) echo
                            "checked";?>> Active
                            <input type="radio" name="type_status" value=0 <?php if(($load->type_status)==0) echo
                            "checked"; ?>> Hide
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Edit</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa fa-undo"></i>
                            Reset</button>
                        <a href="{{route('be.category')}}" class="btn btn-danger"><i
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
        document.getElementById("editCategoryForm").reset();
    }
</script>
@endsection