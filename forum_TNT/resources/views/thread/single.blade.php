@extends('layouts.front')

@section('content')
    <h4>{{$thread->subject}}</h4>
    <hr>
    <div class = "thread-details">
        {!! \Michelf\Markdown::defaultTransform($thread->thread)  !!}
    </div>
  @if(auth()->user()->id == $thread->user_id)
      <div class = "actions">
          <a href = "{{route('thread.edit',$thread->id)}}" class = "btn btn-info btn-xs">Edit</a>
          <form action = "{{route('thread.destroy',$thread->id)}}" method = "post" class="inline-it">
              @csrf
              {{method_field('DELETE')}}
              <input type = "submit" class="btn btn-xs btn-danger" value="Delete">
          </form>
      </div>
  @endif
{{--Comment/Answer--}}
        <div class="comment-list">
            <div class="jumbotron">
                @foreach($thread->comments as $comment)
                    <strong>{{$comment->body}}</strong>
                    <br>
                    <strong >(Commented By) </strong>
                    <h5 align="center">{{$comment->user->name}}</h5>
                    <br>
                {{-- editing comments section--}}
                    <a class="btn btn-primary" data-toggle = "modal" href = "#{{$comment->id}}">Edit</a>
                    <div class = "modal fade" id = "{{$comment->id}}">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <button type = "button" class = "close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class = "modal-body">
                                    <div class="comment-form">
                                        <form action="{{route('comment.update',$comment->id)}}" method = "post" role = "form">
                                            {{csrf_field()}}
                                            {{method_field('put')}}
                                            <div class="form-group">
                                                <h4>Edit Comment..</h4>
                                                <input type="text" class="form-control" name = "body" id = "" placeholder="" value="{{$comment->body}}">
                                            </div>
                                            <button type = "submit" class="btn btn-primary">Comment</button>

                                        </form>

                                    </div>
                                </div>
                                <div class = "modal-footer">
                                    <button type = "button" class = "btn btn-default" data-dismiss="modal">Close </button>
                                    <button type = "button" class = "btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


                        <form action = "{{route('comment.destroy',$comment->id)}}" method = "post" class="inline-it">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type = "submit" class="btn btn-xs btn-danger" value="Delete">
                        </form>
                    </div>
                {{--reply to comments --}}
                    @foreach($comment->comments as  $reply)
                        <div class="small well text-info reply-list">
                            <p>{{$reply->body}}</p>
                            <lead>by{{$reply->user->name}}</lead>
                            {{-- reply editing information --}}
                            <a class="btn btn-primary" data-toggle = "modal" href = "#{{$reply->id}}">Edit</a>
                            <div class = "modal fade" id = "{{$reply->id}}">
                                <div class = "modal-dialog">
                                    <div class = "modal-content">
                                        <div class = "modal-header">
                                            <button type = "button" class = "close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Modal Title</h4>
                                        </div>
                                        <div class = "modal-body">
                                            <div class="comment-form">
                                                <form action="{{route('comment.update',$reply->id)}}" method = "post" role = "form">
                                                    {{csrf_field()}}
                                                    {{method_field('put')}}

                                                    <div class="form-group">
                                                        <h4>Edit Reply..</h4>
                                                        <input type="text" class="form-control" name = "body" id = "" placeholder="" value="{{$reply->body}}">
                                                    </div>
                                                    <button type = "submit" class="btn btn-primary">Reply</button>

                                                </form>

                                            </div>
                                        </div>
                                        <div class = "modal-footer">
                                            <button type = "button" class = "btn btn-default" data-dismiss="modal">Close </button>
                                            <button type = "button" class = "btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
            {{--reply form --}}
            <div class="reply-form">
                <form action="{{route('replycomment.store',$comment->id)}}" method = "post" role = "form">
                    @csrf

                    <div class="form-group">
                        <h4>Write Reply </h4>
                        <input type="text" class="form-control" name = "body" id = "" placeholder="Reply">
                    </div>
                    <button type = "submit" class="btn btn-primary">Reply</button>

                </form>

            </div>
                @endforeach
            </div>

{{-- this thread is for creating comments --}}
    <div class="comment-form">
        <form action="{{route('threadcomment.store',$thread->id)}}" method = "post" role = "form">
            @csrf

            <div class="form-group">
                <h4>Write Comment..</h4>
                <input type="text" class="form-control" name = "body" id = "" placeholder="">
            </div>
            <button type = "submit" class="btn btn-primary">Comment</button>

        </form>

    </div>



@endsection
