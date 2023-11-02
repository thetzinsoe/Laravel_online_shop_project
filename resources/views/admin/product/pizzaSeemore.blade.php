@extends('admin.layout.master')
@section('title', 'Detail Account')
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
                                <h3 class="text-center title-2">{{ $pizza->name }}</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#pizzaEditPage', $pizza->id) }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-8 d-flex align-items-center justify-content-center">
                                        @if ($pizza->image)
                                            <img src="{{ asset('storage/' . $pizza->image) }}" class=""
                                                alt="Image not found!">
                                        @else
                                            <img src="{{ asset('admin/images/bg-title-01.jpg') }}" class=""
                                                alt="user photo">
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <div class="row">
                                            {{-- - {{ $pizza->category_id }} <br><br> --}}
                                            <h5 class="p-0 m-0">Category Name</h5><br>
                                        </div>
                                        {{ $category->name }} <br><br>
                                        <div class="row">
                                            <h5> Description</h5><br>
                                        </div>
                                        {{ $pizza->description }} <br><br>
                                        <div class="row">
                                            <div class="btn btn-sm btn-warning">
                                                <i class="fa fa-money"></i>
                                                $ {{ $pizza->price }} <br>
                                            </div>
                                            <div class="btn btn-sm btn-warning mx-1">
                                                <i class="fa fa-clock"></i>
                                                {{ $pizza->waiting_time }} <br>
                                            </div>
                                            <div class="btn btn-sm btn-warning align-items-center">
                                                <i class="fa fa-eye"></i> {{ $pizza->view_count }}
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark col-6 offset-3 mt-3"><i
                                            class="fa fa-pen-to-square mx-3"></i>Edit</button>
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
