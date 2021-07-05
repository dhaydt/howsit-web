<link href="{{ asset('css/b5vtabs.min.css') }}" rel="stylesheet">
<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-tabs left-tabs"  id="tabMenu" role="tablist">
            <h6 class="text-start">Add Money with :</h6>
            <li class="nav-item" role="presentation">
                <div id="swap-left-tab" class="nav-link tab-clickable active" data-bs-toggle="tab"
                    data-bs-target="#swap-left" role="tab" aria-controls="swap-left" aria-selected="true">Swap
                    number</a>
            </li>
            <li class="nav-item" role="presentation">
                <!-- use the title attribute to show a tooltip with the full long name
                in case the tab is trucated-->
                <div id="backup-left-tab" class="nav-link tab-clickable" data-bs-toggle="tab"
                    data-bs-target="#backup-left" role="tab" aria-controls="backup-left" aria-selected="false">Backup
                    Account</div>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <!-- use the title attribute to show a tooltip with the full long name
                in case the tab is trucated-->
                <div id="restore-left-tab" class="nav-link tab-clickable" data-bs-toggle="tab"
                    data-bs-target="#restore-left" title="venmo" role="tab" aria-controls="restore-left"
                    aria-selected="false">
                    Restore Account</a>
            </li> --}}
        </ul>
    </div>

    <div class="col-md-9">
        <div class="container">
            <div class="tab-content">
                <article class="tab-pane fade show active" role="tabpanel" aria-labelledby="swap-left-tab"
                    id="swap-left">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="left border">
                                            <div class="d-flex container">
                                                <div class="m-auto align-items-center d-flex">
                                                    <h4 class="fw-bold">Swap number</h4>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <a href="{{ url('/profile') }}"><button class="btn btn-primary">Swap
                                                        number here</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <article class="tab-pane fade" role="tabpanel" aria-labelledby="backup-left-tab" id="backup-left">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="left border">
                                            <div class="d-flex container">
                                                <div class="m-auto align-items-center d-flex">
                                                    <h4 class="fw-bold">Backup to Cloud</h4>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <form method="POST" action="{{ route('upload-file') }}">
                                                    @csrf

                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text"
                                                            id="inputGroup-sizing-sm">ID</span>
                                                        <input id="id" name="id" type="text" class="form-control"
                                                            value="{{ Auth::user()->id }}" readonly
                                                            aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text"
                                                            id="inputGroup-sizing-sm">Name</span>
                                                        <input id="name" name="name" type="text" class="form-control"
                                                            value="{{ Auth::user()->name }}" readonly
                                                            aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text"
                                                            id="inputGroup-sizing-sm">Phone</span>
                                                        <input id="phone" name="phone" type="text" class="form-control"
                                                            value="{{ Auth::user()->phone }}" readonly
                                                            aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text"
                                                            id="inputGroup-sizing-sm">Email</span>
                                                        <input id="email" name="email" type="text" class="form-control"
                                                            value="{{ Auth::user()->email }}" readonly
                                                            aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-evenly input-group">
                                                        <button class="btn btn-primary" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Backup to Google Drive"
                                                            type="submit" style="color: white; font-weight: 600;">
                                                            <i class="fab fa-google-drive" style="color:white"></i>
                                                            Google Drive</button>
                                                        <button class="btn btn-warning disabled" type="submit"
                                                            style="font-weight: 600;">DropBox</button>
                                                        <button class="btn btn-secondary disabled"
                                                            style="color: white; font-weight: 600;"
                                                            type="submit">OneDrive</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                {{-- <article class="tab-pane fade" role="tabpanel" aria-labelledby="restore-left-tab" id="restore-left">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="left border">
                                            <div class="d-flex container">
                                                <div class="m-auto align-items-center d-flex">
                                                    <h4 class="fw-bold">Restore Data</h4>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <form action="{{ route('file-import') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose
                            file</label>
                    </div>
                </div>
                <button class="btn btn-primary">Restore data</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
</article> --}}
</div>
</div>
</div>
</div>
