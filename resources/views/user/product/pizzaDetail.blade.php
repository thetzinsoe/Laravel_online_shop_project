@extends('user.layout.master')
@section('shop')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#home') }}" class="text-decoration-none text-primary"><i
                        class="fa fa-arrow-left"></i>back</a>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
            <input type="hidden" id="pizzaId" value="{{ $pizza->id }}">
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 class="mb-3">{{ $pizza->name }}</h3>
                    <p class="font-weight-semi-bold mb-2">{{ $pizza->price }}Ks</p>
                    <div class="mb-2">
                        <i class="fa fa-eye align-middle"></i>
                        <span class="mx-2">{{ $pizza->view_count + 1 }}</span>
                    </div>
                    <p class="mb-4">{{ $pizza->description }}</p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 150px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btnPlus" style="width: 45px">+</button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="countValue"
                                value="">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btnMinus" style="width: 45px">-</button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 addToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">You May Also Like</span>
        </h2>

        <div class="row px-xl-5">
            @php
                if (count($morePizza) >= 4) {
                    $count = 4;
                } else {
                    $count = count($morePizza);
                }
            @endphp
            @for ($i = 0; $i < $count; $i++)
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $morePizza[$i]->image) }}"
                                    style="height: 230px" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#productPizzaDetail', $morePizza[$i]->id) }}"><i
                                            class="fa fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="">{{ $morePizza[$i]->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $morePizza[$i]->price }}Ks</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>
    </div>
    <!-- Products End -->
@endsection
@section('coustmizeJs')
    <script>
        $(document).ready(function() {
            $value = 1;
            $('#countValue').val($value);
            $("button.btnPlus").click(function() {
                if ($value < 20) {
                    $value += 1;
                    $('#countValue').val($value);
                }
            });
            $("button.btnMinus").click(function() {
                if ($value > 1) {
                    $value -= 1;
                    $('#countValue').val($value);
                }
            });
            $('button.addToCart').click(function() {
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/pizza/addToCart',
                    data: {
                        'userId': $('#userId').val(),
                        'pizzaId': $('#pizzaId').val(),
                        'pizzaCount': $value,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            window.location.href =
                                'http://localhost:8000/user/home';
                        };
                    },
                });
            });
            $.ajax({
                type: 'get',
                url: '/user/ajax/pizza/viewCount',
                data: {
                    'pizzaId': $('#pizzaId').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log('success');
                }
            })
        });
    </script>
@endsection
