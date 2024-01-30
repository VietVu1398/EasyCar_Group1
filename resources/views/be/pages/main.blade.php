@extends('be/layout')
@section('content')

<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-info">
      <div class="inner">
         <h3>{{$order}}</h3>

         <p>New Orders</p>
      </div>
      <div class="icon">
         <i class="ion ion-bag"></i>
      </div>
      <a href="{{route('be.rental')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-success">
      <div class="inner">
         <h3>{{number_format($bill->sum('paid'),0, '.', ' ')}} VND</h3>

         <p>Latest month's revenue</p>
      </div>
      <div class="icon">
         <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{route('be.bill')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-warning">
      <div class="inner">
         <h3>{{$user}}</h3>

         <p>User Registrations</p>
      </div>
      <div class="icon">
         <i class="ion ion-person-add"></i>
      </div>
      <a href="{{route('be.account')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-danger">
      <div class="inner">
         <h3>{{$car}}</h3>

         <p>New Car</p>
      </div>
      <div class="icon">
         <i class="ion ion-model-s"></i>
      </div>
      <a href="{{route('be.product')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->


@endsection