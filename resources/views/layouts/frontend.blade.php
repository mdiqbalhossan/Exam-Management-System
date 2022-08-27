<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}" />
    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    @stack('css')
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="{{ route('home') }}" class="navbar-brand logo">
                <img src="assets/img/logo.png" alt="" width="48px" />
                <span class="">Amuse Exam</span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav">
                    <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
                    <a href="#" class="nav-item nav-link">About</a>

                    <a href="#" class="nav-item nav-link">Contact</a>
                </div>
                <form class="navbar-form form-inline search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <div class="navbar-nav ml-auto">
                    @guest
                    <div class="nav-item dropdown login-dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-item nav-link login-btn dropdown-toggle"><i
                                class="fa fa-user-o"></i>
                            Login</a>
                        <div class="dropdown-menu">
                            <form class="form-inline login-form" action="{{ route('user.login.post') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="fa fa-user"></span>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="user_id" placeholder="User Id"
                                        required />
                                </div>

                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('dashboard') }}" class="nav-item nav-link nav-btn"><i class="fa fa-user-o"></i>
                        Dashboard</a>
                    <a href="{{ route('user.logout') }}" class="nav-item nav-link nav-btn"><i class="fa fa-user-o"></i>
                        Logout</a>
                    @endguest
                </div>
            </div>
        </nav>
        @yield('content')
        <footer>
            <p>
                © 2022<a style="color: #0a93a6; text-decoration: none" href="#">
                    Amuse Exam</a>, All rights reserved 2022. || Developed By
                <a style="color: #0a93a6; text-decoration: none" href="#">Md Iqbal</a>
            </p>
        </footer>
    </div>

    <!-- Js File -->
    <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    {{-- <script src="{{ asset('frontend') }}/js/custom.js"></script> --}}
    <script>
        document.querySelector(".button").onmousemove = function (e) {
                var x = e.pageX - e.target.offsetLeft;
                var y = e.pageY - e.target.offsetTop;
        
                e.target.style.setProperty("--x", x + "px");
                e.target.style.setProperty("--y", y + "px");
              };
    </script>
    @stack('js')
</body>

</html>