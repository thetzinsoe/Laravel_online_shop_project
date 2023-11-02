@extends('user.layout.master')
@section('shop')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <a href="{{ route('user#home') }}" class="text-decoration-none text-primary"><i
                        class="fa fa-arrow-left"></i>back</a>
                <table class="table table-light table-borderless table-hover text-center mb-0 mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" style="height: 350px">
                        @if ($total != 0)
                            @foreach ($data as $i => $pizza)
                                <tr>
                                    <td class=" align-middle col-1">
                                        {{ $i + 1 }}
                                        <input type="hidden" name="" id="userId" value="{{ $pizza->userId }}">

                                        <input type="hidden" name="" id="productId" value="{{ $pizza->productId }}">

                                        {{-- <input type="text" name="" id="" value="{{$pizza->}}"> --}}
                                    </td>
                                    <td class=" align-middle col-5">
                                        <div class="row align-items-center">
                                            <img src="{{ asset('storage/' . $pizza->pizzaImg) }}" alt=""
                                                class="col-5" style="">
                                            <span class="col-7 d-flex ">{{ $pizza->pizzaName }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle col-2">
                                        <span class="pizzaPrice">{{ $pizza->pizzaPrice }}</span>Ks
                                    </td>
                                    <td class="align-middle col-3">
                                        <div class="input-group quantity mx-auto" style="width: 105px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <span
                                                class="form-control form-control-sm bg-secondary border-0 text-center orderQty">{{ $pizza->pizzaQty }}</span>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle col-2">
                                        {{-- {{ $amount[$i] }} --}}
                                        <span class="pizzaAmount"> {{ $amount[$i] }}</span> Ks
                                    </td>
                                    <td class="align-middle col-1">
                                        <form action="{{ route('user#cartRemove', $pizza->itemId) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="align-middle" colspan="6">
                                    <h3 class=" text-danger">There is no item in
                                        cart!</h3>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="col-lg-4 ">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    @if ($total == 0)
                        <div class="" style="height: 350px"></div>
                    @else
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6><span id="subTotal">{{ $total }}</span> Ks</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">10 Ks</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5><span id="total">{{ $total + 10 }}</span>Kyats</h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed
                                To
                                Checkout</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('coustmizeJs')
    <script>
        $(document).ready(function() {
            $subTotal = Number($('#subTotal').text());
            $total = Number($('#total').text())
            $('button.btn-plus').click(function() {
                $amount = Number($(this).parents("tr").find(".pizzaAmount").text());
                $counter = parseInt($(this).parents("tr").find(".orderQty").text());
                $price = Number($(this).parents("tr").find(".pizzaPrice").text());
                if ($counter < 20) {
                    ++$counter;
                    $(this).parents("tr").find(".orderQty").text($counter);
                    currentAmount();
                    $(this).parents("tr").find(".pizzaAmount").text($counter * $price);
                    $subTotal += $price;
                    finalCalc();
                    findAmount();
                };
            })
            $('button.btn-minus').click(function() {
                $amount = Number($(this).parents("tr").find(".pizzaAmount").text());
                $counter = parseInt($(this).parents("tr").find(".orderQty").text());
                $price = Number($(this).parents("tr").find(".pizzaPrice").text());
                if ($counter > 1) {
                    --$counter;
                    $(this).parents("tr").find(".orderQty").text($counter);
                    currentAmount();
                    $(this).parents("tr").find(".pizzaAmount").text($counter * $price);
                    $subTotal -= $price;
                    finalCalc();
                    findAmount();
                };
            })
            // final calculation fn()
            function finalCalc() {
                $('#subTotal').text($subTotal);
                $('#total').text($subTotal + 10);
            }
            $('#orderBtn').click(function() {
                $randonNum = Math.floor(Math.random() * 1000000001);
                $dataList = [];
                $('table tbody tr').each(function(index, row) {
                    $dataList.push({
                        'user_id': $(row).find('#userId').val(),
                        'product_id': $(row).find('#productId').val(),
                        'qty': parseInt($(row).find('.orderQty').text()),
                        'total': $(row).find('.pizzaAmount').text() * 1,
                        'order_code': 'tpb' + 0 + $(row).find('#userId').val() +
                            $randonNum,
                    })
                });
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/order',
                    data: Object.assign({}, $dataList),
                    dataType: 'json',
                    success: function(response) {
                        // console.log("order ok");
                        if (response.status == 'success') {
                            window.location.href =
                                '/user/home';
                        };
                    },
                });
            });


            // to find amount
            function findAmount() {
                $amountNew = 0;
                $('table tbody tr').each(function(index, row) {
                    $currentAmount = ($(row).find('.pizzaPrice').text() * 1) * ($(row).find(
                        '.orderQty').val());;
                    $amountNew += $currentAmount;
                })
                // console.log('new amount = ' + $amountNew + '....' + 'current = ' + $currentAmount);
            }

            function currentAmount() {
                $('table tbody tr').each(function(index, row) {
                    $currentAmount = ($(row).find('.pizzaPrice').text() * 1) * ($(row).find(
                        '.orderQty').val());
                    // console.log('current = ' + $currentAmount);
                })
            }
        });
    </script>
@endsection
