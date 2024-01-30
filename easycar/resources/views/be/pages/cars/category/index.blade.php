@extends("be/layout")
@section("content")
<div class="container-fluid px-4">
    <h1 class="mt-4">CATEGORY</h1>
</div>
<div class="card-header">
    <a href="{{route('be.categoryadd')}}" class="btn btn-sm btn-primary">
        <i class="fas fa-plus "></i>
        ADD CATEGORY
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cate as $item)
                            <?php 
                                        if($item->type_status ==1){
                                            $type_status ='<a href="" class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>'; 
                                        }else{
                                            $type_status ='<a href="" class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hide</a>'; 
                                        }
                                ?>
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    <img width="70" height="70"
                                        src="{{asset('public/be/images/categories/'.$item->image_type)}}" />
                                </td>
                                <td>
                                    {{$item->created_at}}
                                </td>
                                <td>
                                    {{$item->updated_at}}
                                </td>
                                <td>
                                    @if($item->type_status == 1)
                                    <a href="{{route('be.statusType', $item->id)}}"
                                        class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>
                                    @else
                                    <a href="{{route('be.statusType', $item->id)}}"
                                        class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hide</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('be.categoryedit' ,$item->id)}}"
                                        class="far fa-edit mr-1 btn btn-sm btn-success"></a>
                                    &nbsp;
                                    <a href="{{route('be.categorydel' ,$item->id)}}"
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
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this category?");
    }

</script>
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
            { "visible": false, "targets": [2]}] 
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });


</script>
@endsection