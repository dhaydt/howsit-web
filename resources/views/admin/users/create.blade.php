@extends('admin.dashboard')


@section('content')

{{-- card --}}
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Create New User</h3>
    </div>
    <!-- /.card-header -->
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- form start -->
    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control'))
            !!}
        </div>

        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Custom Elements</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- checkbox -->
                        
                        <div class="form-group">
                            @foreach($roles as $role)
                            <div class="custom-control custom-checkbox">
                                {!! Form::checkbox('1', $role->id, false, (
                                    'class' => 'name custom-control-input custom-control-input-danger'
                            )) !!}

                                {!!  Form::label('1', $role->name, array('class' => 'custom-control-label')); !!}
                                {{-- <label for="{{ $role->name }}" class="custom-control-label">
                                    {{ $role->name }}</label> --}}
                                </div>
                                @endforeach
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                                <label for="customCheckbox2" class="custom-control-label">Custom
                                    Checkbox checked</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                                <label for="customCheckbox3" class="custom-control-label">Custom
                                    Checkbox disabled</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="customCheckbox4" checked>
                                <label for="customCheckbox4" class="custom-control-label">Custom
                                    Checkbox with custom color</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input
                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                    type="checkbox" id="customCheckbox5" checked>
                                <label for="customCheckbox5" class="custom-control-label">Custom
                                    Checkbox with custom color outline</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="form-check">
                @foreach($roles as $role)
                {!! Form::checkbox('roles[]', $role->id, false, array('class' => 'name')) !!}
                <span>{{ $role->name }}</span>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>


    <!-- /.card -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>






    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' =>
                'form-control'))
                !!}
            </div>
        </div>
        <div hidden>
            <input type="text" name="profile_image" value="profile.png">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                @foreach($roles as $role)
                <div class="d-flex flex-column">
                    <label class="mr-2 ml-2">{!! Form::checkbox('roles[]', $role->id, false, array('class' => 'name'))
                        !!}
                        <span>{{ $role->name }}</span> </label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}


    @endsection