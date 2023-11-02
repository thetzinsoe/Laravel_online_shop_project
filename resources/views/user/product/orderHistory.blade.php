@extends('user.layout.master')
@section('shop')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5 m-auto">
                <a href="{{ route('user#home') }}" class="text-decoration-none text-primary"><i
                        class="fa fa-arrow-left"></i>back</a>
                <div class="mt-4">
                    <h4>Your Order</h4>
                </div>
                <table class="table table-light table-borderless table-hover text-center mb-0 mt-2">
                    <thead class="thead-dark">
                        <tr class="col">
                            <th>Date</th>
                            <th>Order Code</th>
                            <th class="col-lg-3">Total Amount</th>
                            <th>Status</th>
                            <th class="col-lg-1">Detail</th>
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
                                        {{ $order->created_at->format('d-M') }}
                                    </td>
                                    <td class="align-middle">{{ $order->order_code }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $order->total_price }}Ks
                                    </td>
                                    <td class="align-middle ">
                                        @if ($order->status == 0)
                                            <span class="text-warning">Pending...</span>
                                        @elseif($order->status == 1)
                                            <span class="text-success">Success...</span>
                                        @elseif ($order->status == 2)
                                            <span class="text-danger">Reject...</span>
                                        @endif
                                    </td>
                                    <td class="align-middle col-lg-2">
                                        <a href="{{ route('user#orderHistoryDetail', $order->order_code) }}"
                                            class="btn btn-sm btn-primary rounded">more>></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
