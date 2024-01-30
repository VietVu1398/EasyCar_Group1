@extends("be/layout")
@section("content")
<div class="container-fluid px-4">
    <h1 class="mt-4">BLOGS</h1>
</div>
<div class="card-header">
    <a href="{{route('be.blogadd')}}" class="btn btn-sm btn-primary">
        <i class="fas fa-plus "></i>
        ADD BLOG
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
                                <th>Title</th>
                                <th>Content</th>
                                <th>Images</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $item)
                            <?php 
                                        if($item->status ==1){
                                            $status ='<a href="" class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>'; 
                                        }else{
                                            $status ='<a href="" class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hided</a>'; 
                                        }
                                ?>
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{!!substr($item->content, 0, 300)!!}...</td>
                                <td>
                                    @if(!empty($item->images))
                                    @foreach(json_decode($item->images, true) as $img)
                                    <img src="{{asset('public/be/blogimages/'.$img)}}" alt="" width="50px"
                                        height="50px">
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                    <a href="{{route('be.statusBlog', $item->id)}}"
                                        class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>
                                    @else
                                    <a href="{{route('be.statusBlog', $item->id)}}"
                                        class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hidden</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('be.blogedit' ,$item->id)}}"
                                        class="btn btn-sm btn-success">Edit</a>
                                    &nbsp; &nbsp;
                                    <a href="{{route('be.blogdel' ,$item->id)}}"
                                        class="btn btn-sm btn-danger">Delete</a>
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
                { "visible": false, "targets": [3] }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>



@endsection