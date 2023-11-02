@extends('user.layout.master')

@section('shop')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="row">
                        <div class="mb-4 mx-2">
                            <a href="{{ route('user#home') }}"><i class="fa fa-arrow-left"></i>back</a>
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
                            <form action="{{ route('user#changePassword', Auth::user()->id) }}" method="POST">
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
                                    <button type="submit" class="btn btn-lg btn-primary btn-block"><i
                                            class="fa-solid fa-key mx-2"></i>Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
