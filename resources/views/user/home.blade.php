@extends('user.layout.master')
@section('shop')
    {{-- user id for ajax call --}}
    <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Category
                        List</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        @foreach ($category as $c)
                            <div class="d-flex align-items-center">
                                <a href="{{ route('user#categoryFilter', $c->id) }}">
                                    <label class="">{{ $c->name }}</label>
                                </a>
                            </div>
                            <hr>
                        @endforeach
                    </form>
                </div>
            </div>
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cart') }}">
                                    <button type="button" class="btn btn-primary position-relative rounded"
                                        title="my cart">
                                        <i class="fa fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cartCount">
                                            {{ count($cart) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#orderHistory') }}" class="mx-3">
                                    <button type="button" class="btn btn-primary rounded" title="order history">
                                        <i class="fa fa-clock-rotate-left px-2"></i>history
                                    </button>
                                </a>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('accupdate'))
                                <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                                    {{ session('accupdate') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div>
                                <select class="form-select btn btn-outline-dark rounded" aria-label="Default select example"
                                    id="sortingOption">
                                    <option value="" selected>Sorting</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Product start -->
                    @if (count($pizza) != 0)
                        <div class="row " id="sortingData">
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 parent">
                                    <input type="hidden" id="pizzaId" value="{{ $p->id }}">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 230px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square addToCart" href="#">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#productPizzaDetail', $p->id) }}">
                                                    <i class="fa fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}Ks</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col mt-5">
                            <h2 class="text-danger text-center" style="height: 300px">There is no avilable!</h2>
                        </div>
                    @endif
                    <!-- Shop Product End -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('coustmizeJs')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $userId = $('#userId').val();
                $eventOption = $('#sortingOption').val();
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http:/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log($userId);
                            // console.log(data);
                            $item = "";
                            for ($i = 0; $i < data.length; $i++) {
                                $item += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 parent">
                                <input type="hidden" id="pizzaId" value="${data[$i].id}">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 230px"
                                            src="{{ asset('storage/${data[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square addToCart" href="#">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="btn btn-outline-dark btn-square" href="/user/product/pizzaDetail/${data[$i].id}">
                                                <i class="fa fa-circle-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${data[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5> ${data[$i].price}$</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;
                            };
                            $('#sortingData').html($item);
                            $('a.addToCart').click(function() {
                                $pizzaId = $(this).parents('.parent').find(
                                    '#pizzaId').val();
                                $cartCount = parseInt($('.cartCount').text());
                                $.ajax({
                                    type: 'get',
                                    url: '/user/ajax/pizza/addToCart',
                                    data: {
                                        'userId': $userId,
                                        'pizzaId': $pizzaId,
                                        'pizzaCount': 1,
                                    },
                                    dataType: 'json',
                                });
                                $('.cartCount').text($cartCount + 1);
                            });
                        },
                    });
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: "get",
                        url: "/user/ajax/pizza/list",
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $item = "";
                            for ($i = 0; $i < data.length; $i++) {
                                $item += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 parent">
                                <input type="hidden" id="pizzaId" value="${data[$i].id}">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 230px"
                                            src="{{ asset('storage/${data[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square addToCart" href="#">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="btn btn-outline-dark btn-square" href="/user/product/pizzaDetail/${data[$i].id}">
                                                <i class="fa fa-circle-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${data[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5> ${data[$i].price}Ks</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;
                            };
                            $('#sortingData').html($item);
                            $('a.addToCart').click(function() {
                                $pizzaId = $(this).parents('.parent').find(
                                    '#pizzaId').val();
                                $cartCount = parseInt($('.cartCount').text());
                                $.ajax({
                                    type: 'get',
                                    url: '/user/ajax/pizza/addToCart',
                                    data: {
                                        'userId': $userId,
                                        'pizzaId': $pizzaId,
                                        'pizzaCount': 1,
                                    },
                                    dataType: 'json',
                                });
                                $('.cartCount').text($cartCount + 1);
                            });
                        },
                    });
                }
            });
        });
        $('a.addToCart').click(function() {
            $pizzaId = $(this).parents('.parent').find('#pizzaId').val();
            $cartCount = parseInt($('.cartCount').text());
            console.log($cartCount);
            $.ajax({
                type: 'get',
                url: '/user/ajax/pizza/addToCart',
                data: {
                    'userId': $('#userId').val(),
                    'pizzaId': $pizzaId,
                    'pizzaCount': 1,
                },
                dataType: 'json',
            });
            $('.cartCount').text($cartCount + 1);
        });
    </script>
@endsection
