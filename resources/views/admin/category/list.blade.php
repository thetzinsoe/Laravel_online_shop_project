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
                                Total Categories : {{ $categories->total() }}
                            </h4>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if ($categories->total())
                            <!-- START DATA TABLE -->
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Create Date</th>
                                        <th class="text-center px-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->updated_at }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <form action="{{ route('category#edit', $category->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('category#delete', $category->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
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
                                {{ $categories->links() }}
                            </div>
                            <!-- END DATA TABLE -->
                        @else
                            <hr>
                            <h3 class=" mt-5 text-secondary text-center">No Category Found!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
