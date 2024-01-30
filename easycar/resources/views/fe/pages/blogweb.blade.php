@extends('fe/layout')
@section('content')

<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1>{{$blog->title}}</h1><br>
        @if(!empty($blog->images))
        @foreach(json_decode($blog->images, true) as $img)
        <img src="{{asset('public/be/blogimages/'.$img)}}" alt="" class="w-100"><br><br>
        @endforeach
        @endif
        <p>{!!$blog->content!!}</p>
    </div>
    <!-- create comment -->
    <div class="container">
        <h3>Commnet This Blog</h3>
        @if(Auth::check())
        <form action="" method="POST" role="form">
            <legend>Hello: {{Auth::user()->fullname}}</legend>
            <div class="form-group">
                <label for="">Internal comments</label>
                <input type="hidden" value="{{$blog->id}}" name="blog_id">
                <!-- lấy name này giống trong CSDL table comment_blog -->
                <textarea id="comment-content" class="form-control" placeholder="Enter comment (*)"></textarea>
                <small id="comment-error" class="help-blog"></small>
                <br>
                <button type="button" id="btn-comment" class=" btn-sm btn btn-primary">Submit</button>
            </div>
        </form>
        @else
        <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">Please
            login to comment</button>
        <hr>
        @endif
        <button type="button" id="toggle-comments-btn" class="btn btn-info">Toggle Comments</button>
        <div class="container toggle-comments">

            <h3>Other comments</h3><br>
            <div id="comment">

                <!-- paste div bên list-comment-blog qua bên đây -->
                <!--file include này cần 1 cái biến cho nên sẽ lấy biến $blog ra trỏ đến comments 'comments'=>$blog->comments -->
                @include('fe/pages/list-comment-blog', ['comments' => $blog->comments])

            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog odal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Login Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="error">

                </div>
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Input email">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Input password">
                    </div>

                    <button type="button" id="btn-login" class="btn btn-primary btn-block">Submit</button>
                </form>

            </div>
            <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
        </div>
    </div>
</div>

@endsection
@section('content2')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var _csrf = '{{csrf_token()}}';
    let _commentUrl = '{{ route("ajax.commentBlog", $blog_id) }}'; // blog_id là số nguyên
    $('#btn-login').click(function (ev) {
        ev.preventDefault();
        
        var _loginUrl = '{{route("ajax.login")}}';
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: _loginUrl,
            type: 'POST',
            data: {
                email: email,
                password: password,
                _token: _csrf
            },
            success: function (res) {
                if (res.error) {
                    var _html_error = `<div class="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>`;
                    for (let error of res.error) {
                        _html_error += `<li>${error}</li>`;
                    }
                    _html_error += `</div>`;
                    $('#error').html(_html_error);
                } else {
                    alert('Login Susscess');
                    location.reload();
                }
            }
        });
    });


    $('#btn-comment').click(function (ev) {
        ev.preventDefault();
        let content = $('#comment-content').val();
        // blog_id là số nguyên

        $.ajax({
            url: _commentUrl,
            type: 'POST',
            data: {
                content: content,
                _token: _csrf
            
            },
            success: function (res) {
                if (res.error) {
                    $('#comment-error').html(res.error);
                } else {
                    $('#comment-error').html('');
                    $('#comment-content').val('');
                    $('#comment').html(res);
                    location.reload();
                    // console.log(res);

                }
            }
        });

        // console.log(_commentUrl);
    });
    // lưu ý khi lần đầu comment post thì sẽ hiển thị commet, còn khi click lại reply sẽ load lại trang lấy dữ liệu của reply
    // khai báo sự kiện onclick lên nút button đó
    $(document).on('click', '.btn-show-reply-form', function (ev) {
        ev.preventDefault();
        var id = $(this).data('id');
        var comment_reply_id = '#content-reply-' + id; // khai bái nút replay bên list-comment-blog
        var contentReply = $(comment_reply_id).val();
        var form_reply = '.form-reply-' + id; // lấy dữ liệu trong class bên form trang list-comment-blog + id giá trị của nút đó để khai báo cho form_reply
        $('.formReply').slideUp(); // lấy biến đó .slideUp() đóng reply trên
        $(form_reply).slideDown(); // lấy biến đó .slideDown() sẽ xổ reply xuống

    });
    $(document).on('click', '.btn-send-reply-comment', function (ev) {
        ev.preventDefault();
        var id = $(this).data('id');
        var comment_reply_id = '#content-reply-' + id; // khai bái nút replay bên list-comment-blog
        var contentReply = $(comment_reply_id).val();
        var form_reply = '.form-reply-' + id; // lấy dữ liệu trong class bên form trang list-comment-blog + id giá trị của nút đó để khai báo cho form_reply

        // alert(contentReply);
        $.ajax({
            url: _commentUrl,
            type: 'POST',
            data: {
                content: contentReply, // content trong cơ sở dữ diệu sẽ truyền biến contentReply khai báo ở trên
                reply_id: id,
                _token: _csrf
            },
            success: function (res) {
                if (res.error) {
                    $('#comment-error').html(res.error);
                } else {
                    $('#comment-error').html('');
                    $('#comment-content').val('');
                    $('#comment').html(res);
                    location.reload();
                    // alert(res);
                }
            }
        });

    });

</script>

<style>
    .toggle-comments {
        overflow: hidden;
        max-height: auto;
        /* set a max height, adjust as needed */
        transition: max-height 0.3s ease-out;
        /* add a smooth transition effect */
    }

    .comments-collapsed {
        max-height: 0;
    }
</style>

<script>
    $(document).ready(function () {
        // Hide comments initially
        $('.toggle-comments').addClass('comments-collapsed');

        // Add a click event to toggle visibility
        $('#toggle-comments-btn').click(function () {
            $('.toggle-comments').toggleClass('comments-collapsed');
            
            // Scroll to comments when expanding
            if (!$('.toggle-comments').hasClass('comments-collapsed')) {
                $('html, body').animate({
                    scrollTop: $('.toggle-comments').offset().top
                }, 800);
            }
        });
    });
</script>

@endsection
<!-- btn-send-reply-comment  -->