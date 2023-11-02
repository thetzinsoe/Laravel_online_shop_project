@php
    use App\Models\Contact;
    $message = Contact::where('created_at', date('y-m-d'))
        ->orderBy('updated_at', 'desc')
        ->get();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    {{-- local fontawesome --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" class="w-25" alt="Cool Admin" /> <span
                        class="text-dark">The Pizza
                        Box</span>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('category#list') }}">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{ route('product#pizzaList') }}">
                                <i class="fas fa-plate-wheat"></i>Product</a>
                        </li>
                        <li>
                            <a href="{{ route('order#list') }}">
                                <i class="fas fa-list"></i>Order</a>
                        </li>
                        <li>
                            <a href="{{ route('admin#userList') }}">
                                <i class="fa fa-users"></i>User List</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="{{ url()->current() }}" method="get">
                                @csrf
                                <input class="au-input au-input--xl" type="text" name="key"
                                    value="{{ request('key') }}" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="fa fa-comment-dots text-primary"></i>
                                        <span class="quantity">{{ count($message) }}</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>
                                                    You have {{ count($message) }} Message Today!
                                                </p>
                                            </div>
                                            @php
                                                if (count($message) < 4) {
                                                    $count = count($message);
                                                } else {
                                                    $count = 3;
                                                }
                                            @endphp
                                            @if (count($message) != 0)
                                                @for ($i = 0; $i < $count; $i++)
                                                    <div class="notifi__item">
                                                        <div
                                                            class="bg-primary text-white img-cir img-40 d-flex justify-content-center align-items-center">
                                                            {{ substr($message[$i]->name, 0, 3) }}
                                                        </div>
                                                        <div class="content">
                                                            <p>
                                                                {{ $message[$i]->message }}
                                                            </p>
                                                            <span
                                                                class="date">{{ $message[$i]->updated_at->format('h:i') }}</span>
                                                        </div>
                                                    </div>
                                                @endfor
                                            @endif
                                            <div class="notifi__footer">
                                                <a href="{{ route('admin#userMessageShow') }}">All Messages!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content d-flex">
                                            @if (Auth::user()->image)
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    class="rounded rounded-circle d-flex align-items-center mx-2"
                                                    style="width: 50px; height:50px">
                                            @else
                                                <i class="fas fa-user text-primary d-flex align-items-center mx-2"></i>
                                            @endif
                                            <a class="js-acc-btn d-flex align-items-center"
                                                href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image d-flex align-items-center">
                                                    <a href="#">
                                                        @if (Auth::user()->image)
                                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                                class="img-thumbnail" alt="Images not found!">
                                                        @else
                                                            <img src="{{ asset('admin/images/no_image_found.jpg') }}"
                                                                class="img-thumbnail" alt="user photo">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin#accountList') }}" method="get">
                                                @csrf
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="" class="p-0">
                                                            <button type="submit" class="col px-4 py-3 text-left">
                                                                <i class="zmdi zmdi-accounts"></i>
                                                                Admin list
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>

                                            <form action="{{ route('admin#accountDetail') }}" method="get">
                                                @csrf
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="" class="p-0">
                                                            <button type="submit" class="col px-4 py-3 text-left">
                                                                <i class="zmdi zmdi-account"></i>
                                                                Account Detail
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                            <form action="{{ route('admin#passwordChangePage') }}" method="get">
                                                @csrf
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="" class="p-0">
                                                            <button type="submit" class="col px-4 py-3 text-left">
                                                                <i class="fa-solid fa-key"></i>
                                                                Change Password
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <a href="" class="p-0">
                                                        <button type="submit" class="col px-4 py-3 text-left">
                                                            <i class="zmdi zmdi-power"></i>Logout
                                                        </button>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    @yield('coustmizeJs')
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>
    {{-- local bootstrap js --}}
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
</body>

</html>
