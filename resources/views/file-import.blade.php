@extends('layouts.app')

@section('content')
<body>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Backup Data
        </h2>

        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
        </form>
        <form method="POST" action="{{ route('file-export') }}">
            @csrf

            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">ID</span>
                <input id="id" name="id" type="text" class="form-control" value="{{ Auth::user()->id }}" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
                <input id="name" name="name" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Phone</span>
                <input id="phone" name="phone" type="text" class="form-control" value="{{ Auth::user()->phone }}" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                <input id="email" name="email" type="text" class="form-control" value="{{ Auth::user()->email }}" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <button class="btn btn-success" type="submit">Export data</button>
        </form>
    </div>
</body>
@endsection
