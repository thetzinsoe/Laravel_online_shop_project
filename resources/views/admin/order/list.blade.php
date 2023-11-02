@extends('admin.layout.master')
@section('title', 'Order')
@section('content')
    <div class="container-fluid mt-5" style="height: 500px">
        <div class="row px-xl-5">
            <div class="col-lg-11 table-responsive m-auto">
                <div class="mt-5 d-flex align-items-center mb-3">
                    <h4 class="">Order status</h4>
                    <div class="col-3">
                        <select name="" id="selectStatus" class="form-control rounded">
                            <option value="all">All</option>
                            <option value="0">Pending </option>
                            <option value="1">Success</option>
                            <option value="2"> Reject</option>
                        </select>
                    </div>
                </div>
                <table class="table table-light table-borderless table-hover text-center mt-2">
                    <thead class="thead-dark">
                        <tr class="col">
                            <th>Date</th>
                            <th>User Name</th>
                            <th>Order Code</th>
                            <th class="">Total Amount</th>
                            <th>Status</th>
                            <th class="">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataList">
                        @if ($data->count() == 0)
                            <tr>
                                <td class="align-middle" colspan="6">
                                    <h3 class=" text-danger">No order hisory!</h3>
                                </td>
                            </tr>
                        @else
                            @foreach ($data as $i => $order)
                                {{-- @dd($order->status) --}}
                                <tr>
                                    <input type="hidden" class="orderId" value="{{ $order->id }}">
                                    <td class="align-middle">
                                        {{ $order->created_at->format('d-M') }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $order->name }}
                                    </td>
                                    <td class="align-middle">{{ $order->order_code }}
                                    </td>
                                    <td class="align-middle amount">
                                        {{ $order->total_price }}Ks
                                    </td>
                                    <td class="align-middle ">
                                        <select class="form-control rounded statusOption">
                                            <option value="0" @if ($order->status == '0') selected @endif>
                                                Pending
                                            </option>
                                            <option value="1" @if ($order->status == '1') selected @endif>
                                                Success</option>
                                            <option value="2" @if ($order->status == '2') selected @endif>
                                                Reject</option>
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('order#detail', $order->order_code) }}"
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

@section('coustmizeJs')
    <script>
        $(document).ready(function() {
            $('#selectStatus').change(function() {
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/order/sorting',
                    data: {
                        'select': $('#selectStatus').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        $item = "";
                        $statusMessage = '';
                        for ($i = 0; $i < response.length; $i++) {

                            if (response[$i].status == '0') {
                                $statusMessage = `
                            <select class = "form-control rounded statusOption">
                                <option value = "0" selected> Pending </option>
                                <option value = "1" > Success </option>
                                <option value = "2">  Reject </option>
                            </select>`
                            } else if (response[$i].status == '1') {
                                $statusMessage = `
                                <select class = "form-control rounded statusOption">
                                <option value = "0" > Pending </option>
                                <option value = "1" selected> Success </option>
                                <option value = "2" >  Reject </option>
                            </select>`
                            } else if (response[$i].status == '2') {
                                $statusMessage = `
                                <select class = "form-control rounded statusOption">
                                <option value = "0"> Pending </option>
                                <option value = "1" > Success </option>
                                <option value = "2" selected >  Reject </option>
                            </select>`
                            }
                            $item += `
                                <tr>
                                    <input type="hidden" class="orderId" value="${response[$i].id}">
                                    <td class="align-middle">
                                        ${new Date(response[$i] . created_at).toLocaleDateString('en-us', {  month:"short", day:"numeric"}) }
                                    </td>
                                    <td class="align-middle">
                                        ${ response[$i] . name }
                                    </td>
                                    <td class="align-middle">${ response[$i] . order_code }</td>
                                    <td class="align-middle">
                                        ${ response[$i] . total_price }Ks
                                    </td>
                                    <td class="align-middle ">
                                        ${$statusMessage}
                                    </td>
                                    <td class="align-middle">
                                        <a href="${'detail/' +response[$i] . order_code}"
                                            class="btn btn-sm btn-warning rounded">more>></a>
                                    </td>
                                </tr>
                            `;
                        };
                        $('#dataList').html($item);
                        orderConfirm();
                    },
                });
            });

            function orderConfirm() {
                $('.statusOption').change(function() {
                    console.log($(this).val());
                    $currentStatus = $(this).val();
                    $partentNode = $(this).parents("tr");
                    $orderId = $partentNode.find('.orderId').val();
                    $data = {
                        'status': $currentStatus,
                        'orderId': $orderId
                    };
                    // console.log($data);
                    $.ajax({
                        type: 'get',
                        data: $data,
                        url: '/order/change/status',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response['status']);
                        }
                    })
                });
            }
            orderConfirm();
        });
    </script>
@endsection
