@extends('user.layout.master')

@section('shop')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class=" mb-4">
                        <a href="{{ route('user#home') }}"><i class="fa fa-arrow-left"></i>back</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Account</h3>
                            </div>
                            <hr>
                            <form action="{{ route('user#accountUpdate', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="">
                                            @if (Auth::user()->image)
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    class="img-thumbnail" alt="Images not found!">
                                            @else
                                                <img src="{{ asset('admin/images/no_image_found.jpg') }}"
                                                    class="img-thumbnail" alt="user photo">
                                            @endif
                                            <input type="file" name="image"
                                                class="form-control mt-4 @error('image') is-invalid @enderror">
                                            @error('image')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                            <button type="submit" class="col btn btn-dark mt-4"><i
                                                    class="fa fa-pen-to-square"></i>Update Account</button>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', Auth::user()->name) }}">
                                        @error('name')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', Auth::user()->email) }}">
                                        @error('email')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="" cols="30" rows="5"
                                            class=" form-control @error('address') is-invalid @enderror">{{ old('address', Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                        @error('phone')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female
                                            </option>
                                            <option value="other" @if (Auth::user()->gender == 'other') selected @endif>Other
                                            </option>
                                        </select>
                                        <label for="role" class="form-label">Role</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->role }}"
                                            disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
