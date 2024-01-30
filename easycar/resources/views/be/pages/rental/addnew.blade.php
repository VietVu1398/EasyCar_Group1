@extends('be/layout')

@section('content')
{{-- <div class="row"> --}}
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Add new Rental order</h3>
            <a href="{{route('be.rental')}}" class="btn btn-outline-secondary float-right">Back</a>
         </div>
         <form action="{{route('be.rental-add')}}" method="post" class="form-horizontal">
            @csrf
            <div class="card-body">
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">User ID</label>
                  <div class="col-sm-10">
                     <input name="account_id" type="text" class="form-control" value="{{old('account_id')}}" />
                     {!!$errors->first('account_id','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Car</label>
                  <div class="col-sm-10">
                     <select name="car_id" class="form-control">
                        @foreach ($car_type as $type)
                        <optgroup label="{{$type->name}}">
                           @foreach ($cars as $car)
                           @if ($type->id==$car->type_id)
                           <option value="{{$car->id}}">{{$car->name}}</option>
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
                     <input name="pickup_date" type="text" class="form-control" value="{{old('pickup_date')}}" />
                     {!!$errors->first('pickup_date','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Return Date</label>
                  <div class="col-sm-10">
                     <input name="return_date" type="text" class="form-control" value="{{old('return_date')}}" />
                     {!!$errors->first('return_date','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                     <input name="note" type="text" class="form-control" value="{{old('note')}}" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Processing</label>
                  <div class="col-sm-10">
                     <select name="processing" class="form-control">
                        <option value="3">Waiting</option>
                        <option value="2" selected>Confirmed</option>
                        <option value="1">Picked up</option>
                        <option value="0">Completed</option>
                     </select>
                     {!!$errors->first('processing','<div class="text-danger">:message</div>')!!}
                  </div>
               </div>
            </div>
            <div class="card-footer save-change">
               <button type="submit" class="btn btn-info">Add</button>
            </div>
         </form>
      </div>
   </div>
   {{--
</div> --}}
@endsection