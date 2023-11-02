<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>The Pizza Box</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @php
        use App\Models\Cart;
        $cart = Cart::where('user_id', Auth::user()->id)->get();
    @endphp
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block m-auto">
                <img src="{{ asset('admin/images/icon/logo.png') }}" class="m-auto" style="height: 50px" alt="">
                <span class="h4 text-uppercase text-primary bg-dark px-2">The Pizza Box</span>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Pizza</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('user#contactPage') }}" class="nav-item nav-link">Contact</a>
                        </div>

                        {{-- user start  --}}
                        <div class="btn-group ml-2">
                            <button class="btn btn-link dropdown-toggle text-decoration-none p-0"
                                data-bs-toggle="dropdown">
                                <div class="btn-group">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail"
                                            style="height: 40px" alt="">
                                    @else
                                        <i class="fas fa-user text-primary"></i>
                                    @endif
                                </div>
                                <span class="text-white">{{ Auth::user()->name }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">

                                <div class="dropdown-item">
                                    {{-- edit account --}}
                                    <form action="{{ route('user#accountEdit') }}" method="get">
                                        @csrf
                                        <button class="btn px-0 ml-3" type="submit">
                                            <i class="fas fa-pen-to-square text-primary"></i>
                                            <span class="text-dark mx-2">Account Edit</span>

                                        </button>
                                    </form>
                                </div>
                                <div class="dropdown-item">
                                    {{-- change password --}}
                                    <form action="{{ route('user#changePasswordPage') }}" method="get">
                                        @csrf
                                        <button class="btn px-0 ml-3" type="submit">
                                            <i class="fas fa-key text-primary"></i>
                                            <span class="text-dark mx-2">Change Password</span>
                                        </button>
                                    </form>
                                </div>

                                <div class="dropdown-item">
                                    <form action="{{ route('logout') }}" method="post" class="d-inline ">
                                        @csrf
                                        <button class="btn px-0 ml-3" type="submit">
                                            <i class="fas fa-arrow-right-from-bracket text-primary"></i>
                                            <span class="text-dark mx-2">Logout</span>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- user end --}}
            </div>
            </nav>
        </div>
    </div>
    </div>
    <!-- Navbar End -->

    <!-- Shop Start -->

    @yield('shop')

    <!-- Shop End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                    dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; All Rights Reserved. Designed by
                    <a class="text-primary" href="https://htmlcodex.com">Codex</a>
                    | Developed by
                    <a class="text-primary" href="https://htmlcodex.com">TZS</a>
                </p>
                {{-- <p class="mb-md-0 text-center text-md-left text-secondary">
                </p> --}}
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('user/img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    {{-- bootstrap5 --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    {{-- jquery link --}}
    <script src="{{ asset('jquery.js') }}"></script>
    {{-- <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
</body>
{{-- customer js script --}}
@yield('coustmizeJs')

</html>
