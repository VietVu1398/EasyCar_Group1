@extends("be/layout")
@section("content")
<div class="container-fluid px-4">
    <h1 class="mt-4">PRODUCT</h1>
</div>
<div class="card-header">
    <a href="{{route('be.productadd')}}" class="btn btn-sm btn-primary">
        <i class="fas fa-plus "></i>
        ADD PRODUCT
    </a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- Display message added successfully -->
                    @if(Session::has("note"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get("note") }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- Display message error -->
                    @if(Session::has("error"))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get("error") }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Brand</th>
                                <th>Name</th>
                                <th>Qr Code</th>
                                <th>Rating</th>
                                <th>Price</th>
                                <th>Year</th>
                                <th>Seat</th>
                                <th>Color</th>
                                <th>Thumbnail</th>
                                <th>Images</th>
                                <th>Overview</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                            <?php 
                                        if($item->type_status ==1){
                                            $type_status ='<a href="" class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>'; 
                                        }else{
                                            $type_status ='<a href="" class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hide</a>'; 
                                        }
                                ?>
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->brand}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    {!! QrCode::size(100)->encoding('UTF-8')->generate(
                                    "EASY CAR COMPANY LIMITED\n\n" .
                                    "Name: " . $item->name . "\n" .
                                    "thumbnail: " . $item->thumbnail . "\n" .
                                    "Price: " . number_format($item->price, 0, ',', '.') . " VND \n" .
                                    "Brand: " . $item->brand . "\n" .
                                    "Color: " . $item->color
                                    ) !!}
                                    <br>
                                    <a href="{{ route('download.qrcode', ['filename' => rawurlencode("
                                        Product_{$item->name}.png")]) }}">Download QR</a>
                                </td>
                                <td>
                                    <i style="color: yellow" class="fas fa-star"></i>
                                    {{number_format($item->averageRating(), 1)}}
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->year}}</td>
                                <td>{{$item->seat}}</td>
                                <td>{{$item->color}}</td>
                                <td>
                                    <img width="80" height="80"
                                        src="{{asset('public/be/images/products/thumbnail/'.$item->thumbnail)}}" />
                                </td>
                                <td>
                                    @if(!empty($item->images))
                                    @foreach(json_decode($item->images, true) as $img)
                                    <img src="{{asset('public/be/images/products/images/'.$img)}}" alt="" width="50px"
                                        height="50px">
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{$item->overview}}</td>
                                <td>
                                    @if($item->product_status == 1)
                                    <a href="{{route('be.changeStatusCar', $item->id)}}"
                                        class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>
                                    @else
                                    <a href="{{route('be.changeStatusCar', $item->id)}}"
                                        class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hide</a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{route('be.productedit' ,$item->id)}}"
                                        class="far fa-edit mr-1 btn btn-sm btn-success"></a>
                                    &nbsp; &nbsp;
                                    <a href="{{route('be.productdel' ,$item->id)}}"
                                        class="fas fa-trash-alt btn btn-sm btn-danger"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content2')
{{-- data table --}}
<script src="{{asset('public/be')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('public/be')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('public/be')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('public/be')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('public/be')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[0, 'desc']], 
      "columnDefs": [
    { "visible": false, "targets": [6,7,8,10,11]}] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
  });
</script>
@endsection