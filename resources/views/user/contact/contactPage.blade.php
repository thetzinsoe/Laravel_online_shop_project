@extends('user.layout.master')
@section('shop')
    <div class="col-lg-6 m-auto shadow">
        <div class="py-2 m-2">
            <a href="{{ route('user#home') }}" class="text-decoration-none"><i class="fa fa-arrow-left"></i> back</a>
            <h4 class="text-center text-warning">Contact To Admin Team</h4>
        </div>
        <form action="{{ route('users#contactSendMessage') }}" method="POST" class="m-2 rounded">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" id="userName" name="userName"
                        class="form-control @error('userName') is-invalid @enderror" placeholder="Enter Name"
                        value="{{ old('userName', $info->name) }}">
                    @error('userName')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <input type="email" id="userEmail" name="userEmail" placeholder="Enter Email"
                        class="form-control @error('userEmail') is-invalid @enderror"
                        value="{{ old('userEmail', $info->email) }}">
                    @error('userEmail')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-3">
                <input type="text" name="subject" class="form-control @error('subject')is-invalid @enderror"
                    placeholder="Subject" value="{{ old('subject') }}">
                @error('subject')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-3">
                <textarea name="message" rows="8" class="form-control @error('message') is-invalid @enderror"
                    placeholder="Enter your message">{{ old('message') }}</textarea>
                @error('message')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-warning text-dark rounded my-3">Send Message</button>
            </div>
        </form>
    </div>
@endsection
