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
            <h2 class="card-title">Rental List</h2>
            <a href="{{route('be.rental-add')}}" class="btn btn-outline-primary float-right">Add new Rental</a>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Order Code</th>
                     <th>Car</th>
                     <th>User</th>
                     <th>Pickup Date</th>
                     <th>Return Date</th>
                     <th>Processing</th>
                     <th>Order Datetime</th>
                     <th>Action</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($rentals as $rental_item)
                  <tr>
                     <td>{{$rental_item->id}}</td>
                     <td>{{$rental_item->code}}</td>
                     <td>{{$rental_item->name}}</td>
                     <td>{{$rental_item->email}}</td>
                     <td>{{$rental_item->pickup_date}}</td>
                     <td>{{$rental_item->return_date}}</td>
                     <td>
                        @php
                        if($rental_item->processing==3) {
                        echo '<span class=" btn btn-outline-warning">Waiting</span>';
                        } elseif ($rental_item->processing==2) {
                        echo '<span class=" btn btn-outline-info">Confirmed</span>';
                        } elseif ($rental_item->processing==1) {
                        echo '<span class=" btn btn-outline-primary">Picked up</span>';
                        } else {
                        echo '<span class=" btn btn-outline-success">Completed</span>';
                        }
                        @endphp
                     </td>
                     <td>{{$rental_item->created_at}}</td>
                     <td><a class="btn btn-info" href="{{route('be.rental-detail',$rental_item->id)}}">Detail</a></td>
                     <td>@php
                        if($rental_item->status==1) {
                        echo '<span class=" btn btn-outline-primary">Active</span>';
                        } else {
                        echo '<span class=" btn btn-outline-secondary">Canceled</span>';
                        }
                        @endphp
                     </td>
                  </tr>
                  @endforeach
               </tbody>
               {{-- <tfoot>
                  <tr>
                     <th>ID</th>
                     <th>Car</th>
                     <th>User</th>
                     <th>Pickup Date</th>
                     <th>Return Date</th>
                     <th>Process</th>
                  </tr>
               </tfoot> --}}
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[0, 'desc']], 
      "columnDefs": [
    { "visible": false, "targets": [9]}] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
  });
</script>
@endsection