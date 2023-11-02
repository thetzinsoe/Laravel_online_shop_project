@extends('admin.layout.master')
@section('title', 'Pizza Create')
@section('content')

    {{-- @dd(url()->current()); --}}
    {{-- @if (!Auth::check())
    @dd("the user is logged in ")
@else
    @dd("The user is logout")
@endif --}}
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="mb-4">
                        <a href="{{ route('product#pizzaList') }} ">
                            <i class="fa fa-arrow-left "></i> back
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#pizzaCreate') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Name</label>
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter pizza name..." value="{{ old('name') }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category" class="control-label mb-1">Category</label>
                                    <select name="categoryId" id="" class="form-control">
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="control-label mb-1">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="30" rows="5"></textarea>
                                    @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image" class="control-label mb-1">Image</label>
                                    <input id="image" name="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price" class="control-label mb-1">Price</label>
                                    <input id="price" name="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter price..." value="{{ old('price') }}">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                    <input id="waitingTime" name="waitingTime" type="text"
                                        class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter waiting time..."
                                        value="{{ old('Waiting Time') }}">
                                    @error('waitingTime')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
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
