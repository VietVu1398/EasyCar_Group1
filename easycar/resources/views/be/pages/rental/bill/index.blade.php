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
            <h2 class="card-title">Bill List</h2>
            {{-- <a href="{{route('be.rental-add')}}" class="btn btn-outline-primary float-right">Add new Rental</a>
            --}}
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Rental ID</th>
                     <th>Note</th>
                     <th>Payment Method</th>
                     <th>Total Amount</th>
                     <th>Paid</th>
                     <th>Datetime</th>
                     <th>Action</th>
                     {{-- <th>Action</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($listbill as $bill)
                  <tr>
                     <td>{{$bill->id}}</td>
                     <td>{{$bill->rental_id}}</td>
                     <td>{{$bill->note}}</td>
                     <td>{{$bill->payment_method}}</td>
                     <td>{{number_format($bill->total_amount, 0, '.', ' ')}} VND</td>
                     <td>{{number_format($bill->paid, 0, '.', ' ')}} VND</td>
                     <td>{{$bill->updated_at}}</td>
                     <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                           data-target="#modal-finish{{$bill->id}}">
                           Finish
                        </button>

                        <div class="modal fade" id="modal-finish{{$bill->id}}">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body text-center">
                                    <p>Do you confirm that the customer have finished payment?</p>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    &nbsp;&nbsp;
                                    <a class="btn btn-primary" href="{{route('be.finishpay',$bill->id)}}">Finish
                                       Payment</a>
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                        </div>
                     </td>
                     {{-- <td><a class="btn btn-info" href="{{route('be.rental-detail',$rental_item->id)}}">Detail</a>
                     </td> --}}
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
   <!-- /.modal-dialog -->
   {{--
</div> --}}

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
    { "visible": false, "targets": [1]}] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
  });
</script>
@endsection