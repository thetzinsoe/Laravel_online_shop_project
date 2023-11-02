@extends('layout.master')
@section('title', 'register')

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="form-control @error('name') is-invalid @enderror au-input au-input--full" type="text"
                    name="name" value="{{ old('name') }}" placeholder="Username">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input class="form-control @error('email') is-invalid @enderror au-input au-input--full" type="email"
                    name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input class="form-control @error('phone') is-invalid @enderror au-input au-input--full" type="text"
                    name="phone" value="{{ old('phone') }}" placeholder="09xxxxx">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Choose Gender</label>
                <select name="gender" id="" class="form-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="form-control @error('address') is-invalid @enderror au-input au-input--full" type="text"
                    name="address" value="{{ old('address') }}" placeholder="Address">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Image</label>
                <input class="form-control" type="file" name="image">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password') is-invalid @enderror au-input au-input--full" type="password"
                    name="password" placeholder="Password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror au-input au-input--full"
                    type="password" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="au-btn au-btn--block au-btn--green m-b-20 mt-3" type="submit">register</button>
        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>

@endsection
