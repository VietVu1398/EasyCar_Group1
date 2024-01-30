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
</style>
@endsection

@section('content')
{{-- <div class="row"> --}}
   <div class="offset-1 col-md-10 col-sm-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Feedback from {{$feed->email}}</h3>
         </div>
         <div class="card-body">
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Fullname: </label>
               <div class="col-sm-10">
                  <span class="to-display">{{$feed->fullname}}</span>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Email</label>
               <div class="col-sm-10">
                  <span class="to-display" id="sp-car">{{$feed->email}}</span>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Phone</label>
               <div class="col-sm-10">
                  <span class="to-display" id="sp-pickup">{{$feed->phone}}</span>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Feedback Message</label>
               <div class="col-sm-10">
                  <p class="to-display" id="sp-return">{{$feed->content}}</p>
               </div>
            </div>
            <form action="{{route('be.mailfeedback',$feed->id)}}" method="post">
               @csrf
               <input type="hidden" name="email" value="{{$feed->email}}">
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Reply: </label>
                  <div class="col-sm-10">
                     @if ($feed->reply_content==null)

                     <textarea class="form-control" name="reply_content" id="reply_content" cols="30"
                        rows="10"></textarea>

                     <script>
                        CKEDITOR.replace('reply_content');
                     </script>
                     @else
                     <div class="">{!!$feed->reply_content!!}</div>
                     @endif
                  </div>
               </div>
         </div>
         <div class="card-footer text-center">
            @if ($feed->reply_status==0)
            <button type="submit" class="btn btn-info">Send Reply</button>
            @endif
            &nbsp; &nbsp;&nbsp;
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
               Delete
            </button>
         </div>
         </form>
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
            <p>Are you sure you want to delete this feedback?</p>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> &nbsp;&nbsp;
            <a href="{{route('be.delfeedback',$feed->id)}}" class="btn btn-danger">Delele</a>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
</div>
@endsection