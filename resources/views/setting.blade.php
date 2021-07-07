@extends('layouts.app')
@stack('css')
@section('content')
{{-- <setting-page :users="{{ auth()->user()}}"></setting-page> --}}
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 ml-auto col-xl-6 mr-auto">
            <!-- Nav tabs -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs justify-content-center" id="tabMenu" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#myaccount" role="tab">
                                <i class="fas fa-user-cog me-1"></i> My Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#backup" role="tab">
                                <i class="fas fa-hdd me-2"></i> Mpesa etc
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#delete" role="tab">
                                <i class="fas fa-trash me-2"></i> Delete Account
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-center">
                        <div class="tab-pane active" id="myaccount" role="tabpanel">
                            {{-- <h3 class="mb-4 category">
                                    My Account
                                </h3> --}}
                            @include('components.account')
                        </div>
                        <div class="tab-pane" id="backup" role="tabpanel">
                            @include('components.mpesa')
                            
                        </div>
                        <div class="tab-pane" id="restore" role="tabpanel">

                        </div>
                        <div class="tab-pane" id="delete" role="tabpanel">
                            <h3 class="category">delete account</h3>
                            <a data-toggle="modal" id="smallButton" data-target="#smallModal"
                                data-attr="{{ route('delete') }}" title="Delete Account">
                                <button class="btn btn-danger elevation-2" dark><i
                                        class="fas fa-trash text-light me-2"></i> <span class="text-white">Delete
                                        Account</span> </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- !-- Delete Warning Modal --> --}}


        <!-- small modal -->
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Account Confirmation</h5>
                    </div>
                    <div class="modal-body" id="smallBody">
                        <div>
                            <!-- the result to be displayed apply here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tabs on plain Card -->
    </div>
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/tooltip.js"></script>
<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });

    $("[data-toggle=tooltip").tooltip();

    $(document).ready(function () {
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>


@push('css')
<style>
    a {
        color: #f96332;
    }

    a:hover,
    a:focus {
        color: #f96332;
    }

    p {
        line-height: 1.61em;
        font-weight: 300;
        font-size: 1.2em;
    }

    .category {
        text-transform: capitalize;
        font-weight: 700;
        color: #9A9A9A;
    }

    body {
        color: #2c2c2c;
        font-size: 14px;
        font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
        overflow-x: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
    }

    .nav-item .nav-link,
    .nav-tabs .nav-link {
        -webkit-transition: all 300ms ease 0s;
        -moz-transition: all 300ms ease 0s;
        -o-transition: all 300ms ease 0s;
        -ms-transition: all 300ms ease 0s;
        transition: all 300ms ease 0s;
    }

    .card a {
        -webkit-transition: all 150ms ease 0s;
        -moz-transition: all 150ms ease 0s;
        -o-transition: all 150ms ease 0s;
        -ms-transition: all 150ms ease 0s;
        transition: all 150ms ease 0s;
    }

    [data-toggle="collapse"][data-parent="#accordion"] i {
        -webkit-transition: transform 150ms ease 0s;
        -moz-transition: transform 150ms ease 0s;
        -o-transition: transform 150ms ease 0s;
        -ms-transition: all 150ms ease 0s;
        transition: transform 150ms ease 0s;
    }

    [data-toggle="collapse"][data-parent="#accordion"][aria-expanded="true"] i {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }


    .now-ui-icons {
        display: inline-block;
        font: normal normal normal 14px/1 'Nucleo Outline';
        font-size: inherit;
        speak: none;
        text-transform: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    @-webkit-keyframes nc-icon-spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @-moz-keyframes nc-icon-spin {
        0% {
            -moz-transform: rotate(0deg);
        }

        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @keyframes nc-icon-spin {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .now-ui-icons.objects_umbrella-13:before {
        content: "\ea5f";
    }

    .now-ui-icons.shopping_cart-simple:before {
        content: "\ea1d";
    }

    .now-ui-icons.shopping_shop:before {
        content: "\ea50";
    }

    .now-ui-icons.ui-2_settings-90:before {
        content: "\ea4b";
    }

    .nav-tabs {
        border: 0;
        padding: 15px 0.7rem;
    }

    .nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
        box-shadow: 0px 5px 20px 0px rgb(236 240 1);
    }

    .card .nav-tabs {
        border-top-right-radius: 0.1875rem;
        border-top-left-radius: 0.1875rem;
    }

    .nav-tabs>.nav-item>.nav-link {
        color: #888888;
        margin: 0;
        margin-right: 5px;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 30px;
        font-size: 14px;
        padding: 11px 23px;
        line-height: 1.5;
    }

    .nav-tabs>.nav-item>.nav-link:hover {
        background-color: transparent;
    }

    .nav-tabs>.nav-item>.nav-link.active {
        background-color: #ffed4a;
        border-radius: 30px;
        color: #000;
    }

    .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
        font-size: 14px;
        position: relative;
        top: 1px;
        margin-right: 3px;
    }

    .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
        color: #FFFFFF;
    }

    .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
    }

    .card {
        border: 0;
        border-radius: 0.1875rem;
        display: inline-block;
        position: relative;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }

    .card .card-header {
        background-color: transparent;
        border-bottom: 0;
        background-color: transparent;
        border-radius: 0;
        padding: 0;
    }

    .card[data-background-color="orange"] {
        background-color: #f96332;
    }

    .card[data-background-color="red"] {
        background-color: #FF3636;
    }

    .card[data-background-color="yellow"] {
        background-color: #FFB236;
    }

    .card[data-background-color="blue"] {
        background-color: #2CA8FF;
    }

    .card[data-background-color="green"] {
        background-color: #15b60d;
    }

    [data-background-color="orange"] {
        background-color: #e95e38;
    }

    [data-background-color="black"] {
        background-color: #2c2c2c;
    }

    [data-background-color]:not([data-background-color="gray"]) {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) p {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) a:not(.btn):not(.dropdown-item) {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
        color: #FFFFFF;
    }


    @font-face {
        font-family: 'Nucleo Outline';
        src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot");
        src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot") format("embedded-opentype");
        src: url("https://raw.githack.com/creativetimofficial/now-ui-kit/master/assets/fonts/nucleo-outline.woff2");
        font-weight: normal;
        font-style: normal;

    }

    .now-ui-icons {
        display: inline-block;
        font: normal normal normal 14px/1 'Nucleo Outline';
        font-size: inherit;
        speak: none;
        text-transform: none;
        /* Better Font Rendering */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }


    footer {
        margin-top: 50px;
        color: #555;
        background: #fff;
        padding: 25px;
        font-weight: 300;
        background: #f7f7f7;

    }

    .footer p {
        margin-bottom: 0;
    }

    footer p a {
        color: #555;
        font-weight: 400;
    }

    footer p a:hover {
        color: #e86c42;
    }

    @media screen and (max-width: 768px) {

        .nav-tabs {
            display: inline-block;
            width: 100%;
            padding-left: 100px;
            padding-right: 100px;
            text-align: center;
        }

        .nav-tabs .nav-item>.nav-link {
            margin-bottom: 5px;
        }
    }
</style>
@endpush