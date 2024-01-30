@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Add Product</h2>
                </div>
                <!-- form start -->
                <form action="{{ route('be.productadd') }}" method="post" enctype="multipart/form-data"
                    id="addProductForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Brand</label>
                            <input type="text" name="brand" class="form-control" value="{{old('brand')}}"
                                placeholder="Please input brand ">
                            {!!$errors->first('brand','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}"
                                placeholder="Please input name ">
                            {!!$errors->first('name','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Type Id</label>
                            <select name="type_id" class="form-control ">
                                @foreach( $dm as $item)
                                <option value="{{$item -> id}}">{{$item -> name}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('type_id','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" value="{{old('color')}}"
                                placeholder="Please input color ">
                            {!!$errors->first('color','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="{{old('price')}}"
                                placeholder="Please input price ">
                            {!!$errors->first('price','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control" value="{{old('year')}}"
                                placeholder="Please input year ">
                            {!!$errors->first('year','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Seat</label>
                            <input type="text" name="seat" class="form-control" value="{{old('seat')}}"
                                placeholder="Please input seat ">
                            {!!$errors->first('seat','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Image</label>
                            <input type="file" name="thumbnail" class="form-control" placeholder="Thumbnail">
                            {!!$errors->first('thumbnail','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Images</label>
                            <input type="file" name="images[]" multiple="multiple" class="form-control"
                                placeholder="Images">
                            {!!$errors->first('images.*','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Product Status</label> &nbsp; &nbsp;
                            <input type="radio" name="product_status" checked value=1> Active
                            <input type="radio" name="product_status" value=0> Hide
                        </div>
                        <div class="form-group col-md-10">
                            <label>Overview</label>
                            <textarea name="overview" id="overview" class="form-control"></textarea>
                            <script>
                                CKEDITOR.replace('overview');
                            </script>
                            {!!$errors->first('overview','<div class="text-danger">:message</div>')!!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa fa-undo"></i>
                            Reset</button>
                        <a href="{{route('be.product')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>
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
        document.getElementById("addProductForm").reset();
    }
</script>

@endsection