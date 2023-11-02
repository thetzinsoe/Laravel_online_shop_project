@extends('admin.layout.master')
@section('title', '')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-8 m-auto">
                    <a href="{{ route('category#list') }}" class="m-4"><i class="fa fa-arrow-left"></i>back</a>
                </div>
                @if (count($data) != 0)
                    <h4 class="text-center mb-4 text-danger">Customers' Messages!</h4>
                    @foreach ($data as $d)
                        <div class="col-md-8 m-auto">
                            <div class="d-flex ms-head">
                                <div class="col-2 p-0 d-flex justify-content-end">
                                    <div>
                                        <div class="bg-primary rounded-circle float-end d-flex justify-content-center align-items-center"
                                            style="width: 50px;height: 50px">
                                            <h3 class="text-white">{{ substr($d->name, 0, 1) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div>{{ $d->name }}</div>
                                        <small>{{ $d->email }}</small>
                                    </div>
                                    <div>
                                        @if ($d->created_at > date('Y-m-d'))
                                            {{ $d->updated_at->format('h:i:sa') }}
                                        @else
                                            {{ $d->created_at->format('M-d') }}
                                            {{-- {{ date('h:i:s') }} --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-md-10 offset-2 mt-2 ms-body d-flex justify-content-between mb-5 align-items-center">
                                <div class="bg-success text-white p-2 rounded shadow">
                                    {{ $d->message }}
                                </div>
                                <div class="">
                                    <form action="{{ route('admin#userMessageDelete', $d->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm bg-white text-danger rounded-circle mx-2"><i
                                                class="fa fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    <h3 class="text-danger text-center">No Message Here!</h3>
                @endif

            </div>
        </div>
    </div>
@endsection
