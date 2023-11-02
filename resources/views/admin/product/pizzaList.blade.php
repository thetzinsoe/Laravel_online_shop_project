@extends('admin.layout.master')
@section('title', 'Category')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">
                                    Product List
                                </h2>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <h4 class="text-success">
                                Total Pizza : {{ $pizza->total() }}
                            </h4>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#pizzaCreatePage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Pizza
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (session('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('updated') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('created'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('created') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('deleted') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{-- @dd($pizza) --}}
                        @if ($pizza->total())
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        </th>
                                        <th class="text-center px-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizza as $p)
                                        <tr class="tr-shadow ">
                                            <td class=""><img src="{{ asset('storage/' . $p->image) }}" class=""
                                                    style="width: 100px" alt="not found"></td>
                                            <td>{{ $p->name }}</td>
                                            <td> {{ $p->price }}Ks</td>
                                            <td>{{ $p->category_name }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <form action="{{ route('product#pizzaSeemore', $p->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button class="item mx-1" data-toggle="tooltip" data-placement="top"
                                                            title="Seemore" type="submit">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('product#pizzaEditPage', $p->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button class="item mx-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('product#pizzaDelete', $p->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button class="item mx-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete" type="submit">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" float-right mt-2">
                                {{-- {{$pizza->links()}} --}}
                                {{ $pizza->appends(request()->query())->links() }}
                            </div>

                            <!-- END DATA TABLE -->
                        @else
                            <hr>
                            <h3 class=" mt-5 text-secondary text-center">No Pizza Found!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
