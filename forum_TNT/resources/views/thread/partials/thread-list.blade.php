@forelse($threads as $thread)
    <div class = "jumbotron">
        <div class = "list-group">
            <a href = "{{route('thread.show',$thread->id)}}" class = "list-group-item">
                <h4 class = "list-group-item-heading">{{$thread->subject}}</h4>
                <p class = "list-group-item-text">{{$thread->thread}}</p>
            </a>
        </div>
    </div>
@empty
    <h5>No threads To Show</h5>
@endforelse
