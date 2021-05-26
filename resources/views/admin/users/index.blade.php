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
                <li class="breadcrumb-item active">Users</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            @can('user-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> User</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table id="datatable" class="table table-bordered">
 <thead>
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
      </tr>
 </thead>
 <tbody>
    @foreach ($users as $key => $user)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @if(!empty($user->getRoleNames()))
          @foreach($user->getRoleNames() as $v)
             <label class="badge badge-success">{{ $v }}</label>
          @endforeach
        @endif
      </td>
      <td>
         <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye"></i></a>
         <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i></a>
          {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
              {!! Form::button('<i class="fas fa-trash"></i>', ['class' => 'btn btn-danger btn-sm' , 'type' => 'submit']) !!}
          {!! Form::close() !!}
      </td>
    </tr>
   @endforeach
 </tbody>
</table>

{!! $users->render() !!}

@endsection

