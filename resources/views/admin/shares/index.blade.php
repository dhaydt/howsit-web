@extends('admin.dashboard')


@section('content')

<!-- Content Wrapper. Contains page content -->

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
                    <li class="breadcrumb-item active">Shares</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Shares Management</h3>
        </div>
        <div class="pull-right">
            @can('saldo-create')
            <a class="btn btn-success btn-sm mb-2 create" href="#" data-toggle="modal" data-target="#create-modal"> <i
                    class="fas fa-plus"></i> Shares</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::has('success'))
<div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
</div>
@endif


<table id="sharetable" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Shares</th>
            <th>From</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shares as $key => $share)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $share->id }}</td>
            <td>{{ $share->name }}</td>
            <td>{{ $share->share }}</td>
            <td>{{ $share->from }}</td>
            <td>
                {{-- <a class="btn btn-info btn-sm" href="{{ route('shares.show',$share->id) }}"><i --}}
                        {{-- class="fas fa-eye"></i></a> --}}
                {{-- <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#show-modal"><i class="fas fa-eye"></i></a> --}}
                @can('saldo-edit')
                <a class="btn btn-primary edit btn-sm" data-toggle="modal" href="{{ route('shares.edit',$share->id) }}"
                    data-target="#edit-modal"><i class="fas fa-edit"></i></a>
                @endcan
                @can('saldo-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['shares.destroy',
                $share->id],'style'=>'display:inline']) !!}
                {!! Form::button('<i class="fas fa-trash"></i>', ['class' => 'btn btn-danger btn-sm', 'type' =>
                'submit']) !!}
                {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('admin.shares.create')
@include('admin.shares.edit')
{{-- @include('admin.shares.show') --}}

{!! $shares->render() !!}


@endsection
<script>

</script>
<style>
    #sharetable_wrapper>div:nth-child(3) {
        display: none;
    }
</style>