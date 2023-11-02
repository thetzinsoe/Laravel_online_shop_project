@extends('admin.layout.master')
@section('title', 'Category')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <a href="{{ route('category#list') }}" class="mb-3"><i class="fa fa-arrow-left"></i> back</a>
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">
                                    Admin List
                                </h2>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <h4 class="text-success">
                                Total Account : {{ $accountData->total() }}
                            </h4>
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
                        {{-- @dd($accountData) --}}
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th class="text-center px-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accountData as $p)
                                    <tr class="tr-shadow @if (Auth::user()->id == $p->id) bg-primary @endif">
                                        <td class=""><img src="{{ asset('storage/' . $p->image) }}" class=""
                                                style="width: 100px" alt="not found"></td>
                                        <td class="@if (Auth::user()->id == $p->id) text-white @endif">
                                            {{ $p->name }}</td>
                                        <td class="@if (Auth::user()->id == $p->id) text-white @endif">
                                            {{ $p->email }}</td>
                                        <td class="@if (Auth::user()->id == $p->id) text-white @endif">
                                            {{ $p->phone }}</td>
                                        <td class="@if (Auth::user()->id == $p->id) text-white @endif">
                                            {{ $p->gender }}</td>
                                        <td class="@if (Auth::user()->id == $p->id) text-white @endif">
                                            {{ $p->address }}</td>
                                        <td class="@if (Auth::user()->id == $p->id) text-white @endif">
                                            <div class="table-data-feature">
                                                <form action="{{ route('admin#accountRemove', $p->id) }}" method="get">
                                                    @csrf
                                                    <button class="item mx-1" data-toggle="tooltip" data-placement="top"
                                                        title="remove" type="submit">
                                                        <i class="fa fa-circle-xmark"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin#accountDelete', $p->id) }}" method="get">
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
                            {{-- {{$accountData->links()}} --}}
                            {{ $accountData->appends(request()->query())->links() }}
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
