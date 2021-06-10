@extends('layouts.app')
<style>
    .container {
        min-width: 100%;
    }
    body::-webkit-scrollbar {
        display: none;
    }

    .rows::-webkit-scrollbar {
        display: none;
    }

    #app > main > div > div > div.col.col-lg-6.colm > div > aside > div > div.likes.col.col-sm-6 > li > span {
    color: #7d7575;
    margin-left: 10px;
    -webkit-font-smoothing: antialiased;
    font-weight: 700;
    position: absolute;
    top: 2px;
    transition: 0.8s;
    }

</style>

@section('content')

    <div class="container">
        <div class="row rows d-flex flex-row">

            <div class="col col-lg-3 coll flex-fill d-lg-block">
                {{-- <a href="/home" class="btn btn-warning">Upload</a> --}}
            </div>

            <div class="col col-lg-6 colm">

                <form action="/image" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card cardups">
                        <div class="row">
                            <div class="cols col-sm-2 img-div" >
                                <div class="imgdiv">
                                    <img class="imgups" src="{{ url('images/profile/'.Auth::user()->profile_image) }}" alt="Broken">
                                </div>
                            </div>
                            <div class="col col-sm-10">
                                <input type="text" name="caption" class="inputups" placeholder="What are you thinking?">
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col col-sm-6">
                                <div class="uploaddiv">
                                    <input type="file" name="image[]" id="img" multiple accept="image/" style="position: absolute;">
                                    <div class="upload-view">
                                        <img class="logo-up" src="{{ asset('css/img.png') }}" alt="">
                                        <p class="fileName">Upload images</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-sm-6">
                                <div class="sendbtn">

                                    <button type="submit" class="btnsend">Send</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- <div class="jam">
                    <p class="menit">Howsit © {{ date('d-m-Y | H:i:s') }}</p>
                </div> --}}
                @forelse ($images as $image)
                <div class="recipe-card shadow-sm">

                    <article>
                        <div class="feed-header row">
                            <div class="img-div">
                                <img class="imgups" src="{{ url('/images/profile/'.$image->user->profile_image) }}" alt="" style="margin-left: 10px;">
                            </div>
                            <div class="col">
                                <h3 style="font-weight: bold; text-transform: capitalize;">{{ $image->name }}</h3>
                                <ul>
                                    <li><i class="fas fa-clock o"></i><span>{{ date('d-m-Y -- H:i', strtotime($image->created_at)) }};</span></li>
                                </ul>
                            </div>
                        </div>
                        {{-- <h3 class="text-warning">!important</h3> --}}



                        <p>{{  $image->caption }}</p>
                        {{-- <p class="ingredients"><span>Image Uploader Feed:&nbsp;</span>Howsit Web App</p> --}}
                    </article>

                    <aside>
                        <img class="img-up" src="{{ asset($image->image) }}" alt="Broken" />

                        <div class="actions row">
                            <div class="del col col-sm-6">
                                @if(Auth::check())
                                @if ($image->user_id == Auth::user()->id)

                                    <form action="/image/{{ $image->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                        <a href="">
                                            <button class="delet" type="submit" value="Delete"><i class="bi bi-trash-fill" style=""></i>
                                            </button>
                                            <span>Delete</span>
                                        </a>
                                @endif
                                @endif
                                    </form>
                            </div>
                            <div class="likes col col-sm-6">
                                <li  value="" class="like">
                            @guest
                                <i class="bi bi-heart" style=""></i>{{$image->likedUsers->count()}} <span>like this</span>
                            @else
                                <button id="like" class="like-a" onclick="document.getElementById('like-form-{{ $image->id }}').submit();">
                                    <i class="bi bi-heart" style="">
                                    </i>
                                </button>
                                <span style="line-height: 2;"> {{$image->likedUsers->count()}} liked</span>
                                <form action="{{ route('image.like', $image->id) }}" method="POST" style="display: none;" id="like-form-{{ $image->id }}">
                                    @csrf
                                </form>
                            @endguest
                                </li>

                            </div>


                        </div>
                    </aside>

                    <div class="comment">

                        {{-- <div class="comment-title">
                            <h6 style="right: 10px;">All Comment</h6>
                        </div> --}}

                        @include('comment.comment', ['comments' => $image->comments, 'image_id' => $image->id])

                        {{-- <hr /> --}}

                        <h4>Add comment</h4>

                        <form method="post" id="comments" action="{{ route('comments.store'   ) }}">

                            @csrf

                            <div class="form-group">

                                <textarea placeholder="Write public comments" class="form-control reply" name="body"></textarea>

                                <input type="hidden" name="image_id" value="{{ $image->id }}" />

                            </div>


                            <button type="submit" value="">
                                <img class="send-icon" src="{{ asset('icon/send.png') }}" alt="">
                            </button>


                        </form>
                    </div>

                </div>
            @empty
                <h1 class="text-danger">There is no upload</h1>
            @endforelse
        </div>
                <div class="col col-lg-3 flex-fill colr d-lg-block">

                </div>
    </div>

</div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">

$('#like').click(function(e){
    e.preventDefault();
    // Code goes here
});

$(document).on('change', ".uploaddiv input[type='file']",function(){
        if ($(this).val()) {

            var filename = $(this).val().split("\\");

            filename = filename[filename.length-1];

            $('.fileName').text(filename);
        }
 });


$(document).ready(function (e) {


   $('#img').change(function(){

    let reader = new FileReader();

    reader.onload = (e) => {

      $('#preview-image-before-upload').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);

   });

});

let timer;

document.addEventListener('input', e => {
  const el = e.target;

  if( el.matches('[data-color]') ) {
    clearTimeout(timer);
    timer = setTimeout(() => {
      document.documentElement.style.setProperty(`--color-${el.dataset.color}`, el.value);
    }, 100)
  }
});

</script>
