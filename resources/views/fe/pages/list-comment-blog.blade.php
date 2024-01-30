@foreach($comments as $com)
<div class="media">
    <a class="pull-left mr-2" href="#">
        <img class="media-object" src="{{asset('public/be/images/profile_image/'.$com->acc->profile_image)}}"
            alt="Image" width="50">
    </a>

    <!-- cấp con đầu tiên -->
    <div class="media-body ">
        <h4 class="media-heading">{{$com->acc->fullname}}</h4>
        <p>{{$com->content}}</p>
        <p>
            @if(Auth::check())
            <!-- thêm class btn-show-reply-form và tạo data-id="{{$com->id}}" để khi click sự kiện nút button sẽ lấy id của reply đó" -->
            <a href="" class="btn btn-sm btn-primary  btn-show-reply-form " data-id="{{$com->id}}">Reply</a>
            @else
            <button type="button" class="btn-sm btn btn-danger" data-toggle="modal"
                data-target="#exampleModalLong">Please login to reply</button>
            @endif
            <hr>
        </p>
        <!-- thêm class from-reply để khi click sự kiện sẽ gọi form ra và thêm biến {{$com->id}} |
         và khai báo thêm formReply để bắt sự kiện khi thu click khác cái trên sẽ thu lại -->
        <form action="" method="post" style="display:none" class=" formReply  form-reply-{{$com->id}}">
            <legend>Form Title</legend>
            <div class="form-group">
                <label for="">Internal comments</label>

                <!-- lấy name này giống trong CSDL table comment_blog -->
                <!-- Thêm content-reply-{{$com->id}} vào id dưới để bắt sự kiện reply gửi dữ liệu-->
                <textarea id="content-reply-{{$com->id}}" class="form-control "
                    placeholder="Enter comment (*)"></textarea>
                <br>
                <!-- Thêm btn-send-reply-comment để gọi bên blogweb bắt sự kiện nút send -->
                <button type="submit" data-id="{{$com->id}}"
                    class=" btn-sm btn btn-primary    btn-send-reply-comment ">Send</button>
            </div>
        </form>

        <!-- các bình luận con cấp thứ 2 -->
        @foreach($com->replies as $child)
        <div class="media">
            <a class="pull-left mr-2" href="#">
                <img class="media-object" src="{{asset('public/be/images/profile_image/'.$child->acc->profile_image)}}"
                    alt="Image" width="50">
            </a>
            <div class="media-body ">
                <h4 class="media-heading">{{$child->acc->fullname}}</h4>
                <p>{{$child->content}}</p>
                @if(Auth::check())
                <p><a href="" class="btn btn-sm btn-primary  btn-show-reply-form " data-id="{{$child->id}}">Reply</a>
                </p>
                @else
                <button type="button" class="btn-sm btn btn-danger" data-toggle="modal"
                    data-target="#exampleModalLong">Please login to reply</button>
                @endif
                <form action="" method="POST" style="display:none" class=" formReply  form-reply-{{$child->id}}">
                    <legend>Reply here</legend>
                    <div class="form-group">
                        <label for=""> </label>

                        <!-- lấy name này giống trong CSDL table comment_blog -->
                        <!-- Thêm content-reply-{{$com->id}} vào id dưới để bắt sự kiện reply gửi dữ liệu-->
                        <textarea id="content-reply-{{$child->id}}" class="form-control "
                            placeholder="Enter comment (*)"></textarea>
                        <br>
                        <!-- Thêm btn-send-reply-comment để gọi bên blogweb bắt sự kiện nút send -->
                        <button type="submit" data-id="{{$child->id}}"
                            class=" btn-sm btn btn-primary    btn-send-reply-comment ">Send</button>
                    </div>
                </form>

                <hr>
                <!-- các bình luận con cấp thứ 3 lấy thằng child trỏ đến replies gán cho $child1 -->
                @foreach($child->replies as $child1)
                <div class="media">
                    <a class="pull-left mr-2" href="#">
                        <img class="media-object"
                            src="{{asset('public/be/images/profile_image/'.$child1->acc->profile_image)}}" alt="Image"
                            width="50">
                    </a>
                    <div class="media-body ">
                        <h4 class="media-heading">{{$child1->acc->fullname}}</h4>
                        <p>{{$child1->content}}</p>


                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach