@extends('admin.dashboard')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header" style="padding: 0 !important">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active">Feeds</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Feeds</h2>
            </div>
            <div class="pull-right">
                @can('feed-create')
                <a class="btn btn-success btn-sm mb-2" href="{{ route('feeds.create') }}"> <i class="fas fa-plus"></i> Feeds</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Feeds</th>
            <th>Captions</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($images as $image)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $image->name }}</td>
	        <td>
                {{-- {{ $image->image }} --}}
                <img src="{{ url($image->image) }}" class="img-circle elevation-2" alt="Feed Image" style="height: 70px; width: 70px;">
            </td>
	        <td>{{ $image->caption }}</td>
	        <td>
                <form action="{{ route('feeds.destroy',$image->id) }}" method="POST">
                    <a class="btn btn-info btn-sm" href="{{ route('feeds.show',$image->id) }}"><i class="fas fa-eye"></i></a>
                    @can('feed-edit')
                    <a class="btn btn-primary btn-sm" href="{{ route('feeds.edit',$image->id) }}"><i class="fas fa-edit"></i></i></a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('feed-delete')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $images->links() !!}
@endsection
