@extends('be/layout')

@section('content1')
<style>
   .to-display {
      display: block;
      width: 100%;
      height: calc(2.25rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      box-shadow: inset 0 0 0 transparent;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
   }

   .to-edit,
   .save-change {
      display: none;
   }
</style>
@endsection

@section('content')
{{-- <div class="row"> --}}
   <div class="col-md-9 col-sm-12">
      <div class="card">
         <div class="card-header">
            @if(Session::has("note"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ Session::get("note") }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            @endif
            <h3 class="card-title">Rental Order {{$rental->code}}</h3>
         </div>
         <form action="{{route('be.rental-detail',$rental->id)}}" method="post" class="form-horizontal">
            @csrf
            <div class="card-body">
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">User ID</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-user"></span>
                     <input name="account_id" type="text" class="form-control to-edit"
                        value="{{$rental->account_id}}" />
                     {!!$errors->first('account_id','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Car</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-car"></span>
                     <select name="car_id" class="form-control to-edit">
                        @foreach ($car_type as $type)
                        <optgroup label="{{$type->name}}">
                           @foreach ($cars as $car)
                           @if ($type->id==$car->type_id)
                           <option value="{{$car->id}}" @if ($rental->car_id==$car->id) selected @endif
                              >{{$car->name}}
                           </option>
                           @endif
                           @endforeach
                        </optgroup>
                        @endforeach
                     </select>
                     {!!$errors->first('car_id','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pickup Date</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-pickup"></span>
                     <input name="pickup_date" type="text" class="form-control to-edit"
                        value="{{$rental->pickup_date}}" />
                     {!!$errors->first('pickup_date','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Return Date</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-return"></span>
                     <input name="return_date" type="text" class="form-control to-edit"
                        value="{{$rental->return_date}}" />
                     {!!$errors->first('return_date','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-note"></span>
                     <input name="note" type="text" class="form-control to-edit" value="{{$rental->note}}" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Processing</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-processing"></span>
                     <select name="processing" class="form-control to-edit">
                        <option value="3" @if ($rental->processing==3) selected @endif>Waiting</option>
                        <option value="2" @if ($rental->processing==2) selected @endif>Confirmed</option>
                        <option value="1" @if ($rental->processing==1) selected @endif>Picked up</option>
                        <option value="0" @if ($rental->processing==0) selected @endif>Completed</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                     <span class="to-display" id="sp-status"></span>
                     <select name="status" class="form-control to-edit">
                        <option value="1" @if ($rental->status==1) selected @endif>Active</option>
                        <option value="0" @if ($rental->status==0) selected @endif>Canceled</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="card-footer save-change">
               <button type="submit" class="btn btn-info">Save</button>
            </div>
         </form>
      </div>
   </div>
   <div class="col-md-3 col-sm-12">
      <div class="card">
         <div class="card-header">
            <p>
               <span>Action</span>
               <span>
                  <a href="{{route('be.rental')}}" class="btn btn-outline-secondary float-right">Back</a>
               </span>
            </p>
         </div>
         <div class="card-body">
            <div class="row mb-3">
               <button type="button" id="enableEdit" class="btn btn-warning">Edit</button>
            </div>
            <div class="row mb-3">
               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
                  Delete
               </button>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="modal-default">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body text-center">
            <p>Do you want to delete this order and its bill?</p>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> &nbsp;&nbsp;
            <a class="btn btn-danger" href="{{route('be.rental-del',$rental->id)}}">Delele</a>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
</div>
<!-- /.modal-dialog -->
{{--
</div> --}}
@endsection


@section('content2')
<script>
   $(document).ready(function(){
         $("#sp-user").text($('input[name="account_id"]').val());
         $("#sp-pickup").text($('input[name="pickup_date"]').val());
         $("#sp-return").text($('input[name="return_date"]').val());
         $("#sp-note").text($('input[name="note"]').val());
         $("#sp-car").text($('select[name="car_id"] option:selected').text()); 
         $("#sp-processing").text($('select[name="processing"] option:selected').text()); 
         $("#sp-status").text($('select[name="status"] option:selected').text()); 
      $("#enableEdit").click(function(){
         $(".to-display").toggle();
         $(".to-edit").toggle();
         $(".save-change").toggle();
         $(this).text(function(i, v){ return v === 'Edit' ? 'Done' : 'Edit' });
         $("#sp-user").text($('input[name="account_id"]').val());
         $("#sp-pickup").text($('input[name="pickup_date"]').val());
         $("#sp-return").text($('input[name="return_date"]').val());
         $("#sp-note").text($('input[name="note"]').val());
         $("#sp-car").text($('select[name="car_id"] option:selected').text()); 
         $("#sp-processing").text($('select[name="processing"] option:selected').text()); 
         $("#sp-status").text($('select[name="status"] option:selected').text()); 
      });
   });
</script>
@endsection