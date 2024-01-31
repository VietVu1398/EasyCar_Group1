@extends("be/layout")
@section("content")
<div class="container-fluid px-4">
    <h1 class="mt-4">Comment Car Detail</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- Display message added successfully -->
                    @if(Session::has("note"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get("note") }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- Display message error -->
                    @if(Session::has("error"))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get("error") }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Account</th>
                                <th>Car</th>
                                <th>Comment</th>
                                <th>Reply</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comm)
                            <?php 
                                        if($comm->status ==1){
                                            $status ='<a href="" class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>'; 
                                        }else{
                                            $status ='<a href="" class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hided</a>'; 
                                        }
                                ?>
                            <tr>
                                <td>{{$comm->id}}</td>
                                <td>
                                    {{-- @foreach ($users as $user)
                                    @if ($user->id==$comm->account_id)
                                    {{$user->username}}
                                    @endif
                                    @endforeach --}}
                                    {{$comm->account->username}}
                                <td>{{$comm->car->name}}</td>
                                <td>{{$comm->comment}}</td>
                                <td>{{$comm->reply}}</td>
                                <td>
                                    @if($comm->status == 1)
                                    <a href="{{route('be.statusComment', $comm->id)}}"
                                        class=" btn-sm btn btn-outline-success d-flex justify-content-center ">Actived</a>
                                    @else
                                    <a href="{{route('be.statusComment', $comm->id)}}"
                                        class=" btn-sm btn btn-outline-warning d-flex justify-content-center ">Hided</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="reply-btn btn btn-primary"
                                        data-comment-id="{{ $comm->id }}">Reply</a>
                                    &nbsp;
                                    <a href="{{route('be.delCommentCar',$comm->id)}}"
                                        class=" btn  btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="replyModal" tabindex="-1" role="dialog"
                                aria-labelledby="replyModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="replyModalLabel">Reply to Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('be.replycomment')  }}" method="post">
                                                @csrf
                                                <input type="hidden" name="comment_id" id="reply-parent-id"
                                                    value="{{$comm->id}}">
                                                <textarea name="reply_content" placeholder="Type your reply"></textarea>
                                                <button name="submit_reply" type="submit"
                                                    class="btn btn-primary">Reply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[0, 'desc']], 
      "columnDefs": [
    { "visible": false, "targets": [3]}] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const replyLinks = document.querySelectorAll('.reply-btn');
        const replyModal = new bootstrap.Modal(document.getElementById('replyModal'));

        replyLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent the default behavior of the anchor tag
                const commentId = this.getAttribute('data-comment-id');

                // Update the hidden input value in the modal
                document.getElementById('reply-parent-id').value = commentId;

                // Show the Bootstrap modal
                replyModal.show();
            });
        });
    });
</script>

<style>
    /* Custom styles for the reply textarea */
    textarea[name="reply_content"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
        /* Allow vertical resizing */
        min-height: 80px;
        /* Set a minimum height */
    }

    /* Optional: Add some styling to the submit button */
    button.btn-primary {
        margin-top: 10px;
    }
</style>

@endsection