@extends('user.layout.master')
@section('shop')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5 m-auto">
                <a href="{{ route('user#orderHistory') }}" class="text-decoration-none text-primary"><i
                        class="fa fa-arrow-left"></i>back</a>

                <table class="table table-light table-borderless table-hover text-center mb-0 mt-4">
                    <thead class="thead-dark">
                        <tr class="col">
                            <th>Image</th>
                            <th>Qty</th>
                            <th class="col-3">Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" style="height: 350px">
                        @if ($data->count() == 0)
                            <tr>
                                <td class="align-middle" colspan="6">
                                    <h3 class=" text-danger">No order hisory!</h3>
                                </td>
                            </tr>
                        @else
                            @foreach ($data as $i => $order)
                                <tr>
                                    <td class="align-middle">
                                        <img src="{{ asset('storage/' . $order->image) }}" alt=""
                                            class="img-thumbnail" style="width: 150px">
                                    </td>
                                    <td class="align-middle">{{ $order->qty }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $order->price }}Ks
                                    </td>
                                    <td class="align-middle">
                                        {{ $order->total }}Ks
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if ($data->count() != 0)
                    <div class="d-flex justify-content-between mt-2 bg-warning rounded p-1 text-dark">
                        <p class="p-0 m-0">Order Code - {{ $data[0]->order_code }}</p>
                        <p class="p-0 m-0">Total Amoutn with Deli Charges - {{ $data[0]->totalAmount }} Ks</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
