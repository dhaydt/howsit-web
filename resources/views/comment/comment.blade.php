@foreach($comments as $comment)

    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>


        <div class="comment-content row">
            <div class="img-user-div">
                <img class="usr-img" style="margin-left: 10px;" src="{{ url('/images/profile/'.$comment->user->profile_image) }}" alt="Broken">

            </div>
            <div class="comment-body">

                <strong style="line-height: 2; margin-left: 20px;">{{ $comment->user->name }}</strong>
                <p>{{ $comment->body }}</p>
            </div>
        </div>

        <a href="" id="reply"></a>

        <form method="post" action="{{ route('comments.store') }}" id="form">

            @csrf

            <div class="form-group">

                {{-- <input type="text" name="body" placeholder="Type replies" class="form-control reply" onkeyup="submit()" style="text-align: right;" /> --}}

                <input type="hidden" name="image_id" value="{{ $image_id }}" />

                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />

            </div>

            <div class="form-group">

                {{-- <input type="submit" class="btn btn-warning" value="Reply" /> --}}

            </div>

        </form>

        {{-- @include('comment.comment', ['comments' => $comment->replies]) --}}

    </div>

@endforeach

