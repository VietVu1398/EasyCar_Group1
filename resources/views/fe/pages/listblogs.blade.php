@extends('fe/layout')

@section('content')
<div class="container-fluid py-5">
   <div class="container pt-5 pb-3">
      <h1 class="display-4 text-uppercase text-center mb-5">Blogs</h1>
      @foreach ($list_blogs as $item)
      <div class="row">
         <div class="card mb-5 ">
            <div class="card-header">
               <h5 class="card-title">{{$item->title}}</h5>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-2">
                     @if(!empty($item->images))
                     @foreach(json_decode($item->images, true) as $img)
                     <img src="{{asset('public/be/blogimages/'.$img)}}" alt="" class="w-100"><br><br>
                     <?php break; ?>
                     @endforeach
                     @endif
                  </div>
                  <div class="col-md-9">
                     <div class="">

                        {!!substr($item->content, 0, 300)!!} ...
                     </div>
                     <a href="{{route('fe.blogweb',[$item,khongdau($item->title)])}}" class="text-primary">Continue
                        Reading...</a>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         {{--
         <!-- Pagination Start --> --}}
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-10 pb-1 text-right">
                  {{$list_blogs->links()}}
               </div>
            </div>
         </div>
         <!-- Pagination End -->
      </div>
   </div>
   @endsection

   @section('content2')
   <script>
      document.addEventListener("DOMContentLoaded", function() {
        var truncateText = document.querySelector('.truncate-text');
        var maxLength = 500; // Số ký tự tối đa bạn muốn hiển thị
  
        if (truncateText.textContent.length > maxLength) {
          var truncatedText = truncateText.textContent.substring(0, maxLength);
          truncateText.textContent = truncatedText + '...';
        }
      });
   </script>
   @endsection