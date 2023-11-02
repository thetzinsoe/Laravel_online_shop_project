@extends('admin.layout.master')
@section('title', 'Detail Account')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="mb-4">
                        <a href="{{ route('category#list') }}"><i class="fa fa-arrow-left"></i> back</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Details</h3>
                            </div>
                            <hr>
                            @if (session('accupdate'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('accupdate') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('passMiss'))
                                passMiss
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('passMiss') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('admin#accountEdit') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col col-lg-4 d-flex align-items-center justify-content-center">
                                        @if (Auth::user()->image)
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="rounded rounded-circle" style="width: 200px;height: 200px"
                                                alt="Image not found!">
                                        @else
                                            <img src="{{ asset('admin/images/no_image_found.jpg') }}"
                                                class="rounded rounded-circle" style="width: 200px;height: 200px;"
                                                alt="user photo">
                                        @endif
                                    </div>
                                    <div class="col col-lg-8">
                                        <div class="row">
                                            <span class="col col-lg-5">
                                                <i class="fa fa-solid fa-user mx-3"></i>
                                                User Name
                                            </span>
                                            - {{ Auth::user()->name }} <br><br>
                                        </div>
                                        <div class="row">
                                            <span class="col col-lg-5">
                                                <i class="fa fa-envelope mx-3"></i>
                                                Email
                                            </span>
                                            - {{ Auth::user()->email }} <br><br>
                                        </div>
                                        <div class="row">
                                            <span class="col col-lg-5">
                                                <i class="fa fa-solid fa-phone mx-3"></i>
                                                Phone
                                            </span>
                                            - {{ Auth::user()->phone }} <br><br>
                                        </div>
                                        <div class="row">
                                            <span class="col col-lg-5">
                                                <i class="fa fa-house-chimney mx-3"></i>
                                                Address
                                            </span>
                                            - {{ Auth::user()->address }} <br><br>
                                        </div>
                                        <div class="row">
                                            <span class="col-5">
                                                <i class="fa fa-transgender mx-3"></i>
                                                Gender
                                            </span>
                                            - {{ Auth::user()->gender }}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark col col-lg-6 offset-3 mt-3"><i
                                            class="fa fa-pen-to-square mx-3"></i>Edit Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
