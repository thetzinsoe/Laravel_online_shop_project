@extends('admin.layout.master')
@section('title', 'Category Edit')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="mb-4">
                        <a href="{{ route('product#pizzaList') }}"><i class="fa fa-arrow-left"></i>back</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Category Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#pizzaUpdate') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="pizzaId" value="{{ request('id') }}">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="">
                                            @if ($data->image)
                                                <img src="{{ asset('storage/' . $data->image) }}" alt="Images not found!">
                                            @else
                                                <img src="{{ asset('admin/images/bg-title-01.jpg') }}" class=""
                                                    alt="user photo">
                                            @endif
                                            <input type="file" name="image"
                                                class="form-control mt-4 @error('image') is-invalid @enderror ">
                                            @error('image')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                            <button type="submit" class="col btn btn-dark mt-4"><i
                                                    class="fa fa-pen-to-square"></i>Update</button>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $data->name) }}">
                                        @error('name')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror

                                        <label for="category" class="control-label mb-1">Category</label>
                                        <select name="categoryId" id=""
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            value="{{ old('category_id', $data->category_id) }}">
                                            @foreach ($category as $c)
                                                <option value="{{ $c->id }}"
                                                    @if ($data->category_id == $c->id) selected @endif>
                                                    {{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror

                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="" cols="30" rows="5"
                                            class=" form-control @error('description') is-invalid @enderror">{{ old('description', $data->description) }}</textarea>
                                        @error('description')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror

                                        <label for="price" class="form-label">price</label>
                                        <input type="text" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $data->price) }}">
                                        @error('price')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror

                                        <label for="waitingTime" class="form-label">Waiting Time</label>
                                        <input type="text" name="waitingTime"
                                            class="form-control @error('waitingTime') is-invalid @enderror"
                                            value="{{ old('waitingTime', $data->waiting_time) }}">
                                        @error('waitingTime')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
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
