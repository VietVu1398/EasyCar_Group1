@extends('be/layout')
@section('content')


<!-- Main content -->
{{-- <div class="row"> --}}
   <div class="col-12">

      <!-- Display message added successfully -->
      @if(Session::has("note"))
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
         {{ Session::get("note") }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif
      <div class="card">
         <div class="card-header">
            <h2 class="card-title">Feedback List</h2>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <table id="feebacklist" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Status</th>
                     <th>Fullname</th>
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Content</th>
                     <th>Reply Content</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($load as $fb)
                  <tr>
                     <td>{{$fb->id}}</td>
                     <td>
                        @if ($fb->reply_status==0)
                        <span class="btn btn-outline-warning">Not reply</span>
                        @else
                        <span class="btn btn-outline-success">Replied</span>
                        @endif
                     </td>
                     <td>{{$fb->fullname}}</td>
                     <td>{{$fb->phone}}</td>
                     <td>{{$fb->email}}</td>
                     <td style="max-width: 200px;">
                        <p class="text-truncate">
                           {{$fb->content}}</p>
                     </td>
                     <td style="max-width: 200px;">
                        <p class="text-truncate">{!!$fb->reply_content!!} </p>
                     </td>
                     <td>
                        <a class="btn btn-primary" href="{{route('be.feedbackdetail',$fb->id)}}">Detail</a>
                     </td>
                  </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   {{--
</div> --}}
<!-- /.container-fluid -->

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
    $("#feebacklist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [0, 'desc'],
      "columnDefs": [
    { "visible": false, "targets": [5,6]}] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
  });
</script>
@endsection