@extends('admin.dashboard')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Feed</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('feeds.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('feeds.update_feed', $image->id) }}" method="POST">
    	@csrf
        {{-- @method('PUT') --}}
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group mt-2">
                    <img src="{{ url($image->image) }}" class="img-circle elevation-2" alt="Feed Image" style="height: 100px; width: 100px;">
		            <div class="form-group">
                        <strong>Change Image</strong>
                        <input type="file" name="image[]" id="img" class="form-control" multiple accept="image/" >
                    </div>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $image->caption }}</textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>

@endsection
