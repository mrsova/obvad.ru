<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon icon -->

    <title>Blog</title>
    <!-- common css -->
    <link rel="stylesheet" href="/css/front.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">
</head>

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Навигация</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/images/logo.png" alt=""></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    @if(Auth::check())
                        <li><a href="/profile">Мой Профиль</a></li>
                        <li><a href="/logout">Выйти</a></li>
                    @else
                        <li><a href="/register">Регистрация</a></li>
                        <li><a href="/login">Вход</a></li>
                    @endif
                </ul>
                {{--<ul class="nav navbar-nav text-uppercase pull-right"></ul>--}}

            </div>
            <!-- /.navbar-collapse -->


            <div class="show-search">
                <form role="search" method="get" id="searchform" action="#">
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-info">
                    {{session('status')}}
                </div>
            @endif
        </div>
    </div>
</div>

@yield('content')

<!-- end main content-->
<footer class="footer-widget-section">
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">&copy; 2018 Вадинск</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script type="text/javascript" src="/js/front.js"></script>
</body>
</html>