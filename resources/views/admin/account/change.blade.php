@extends('admin.layout.master')
@section('title', 'Change Password')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="row">
                        <div class="mx-2 mb-4">
                            <a href="{{ route('category#list') }}"><i class="fa fa-arrow-left"></i>back</a>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            @if (session('passMiss'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('passMiss') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('admin#passwordChange') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                    <input id="oldPassword" name="oldPassword" type="password"
                                        class="form-control @error('oldPassword') is-invalid @enderror "
                                        aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="newPassword" class="control-label mb-1">New Password</label>
                                    <input id="newPassword" name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror "
                                        aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                    @error('newPassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                    <input id="confirmPassword" name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror "
                                        aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-solid fa-key"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
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
