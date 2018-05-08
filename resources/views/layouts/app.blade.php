<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CMS') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    {{--  <style>
        body{background-color:#ECF0F1;}

        .navbar-inverse {
            background-color: #34495E;
            border-color: #34495E;
        }
        .navbar {
        position: relative;
        min-height: 50px;
        margin-bottom: 20px;
        border: 0px solid transparent;
        border-radius:0px;
        
        }
        .navbar-brand {
       
        float: left;
        height:auto;
        padding: 10px 10px;
        font-size: 18px;
        line-height: 20px;
        }
        .navbar-brand>img{ width:80%;}
    
        .navbar-inverse .navbar-nav > li > a {
            color: #F39C12;
        }
        .navbar-inverse .navbar-nav > li > a:hover {
        background-color: #009688;
        }
    </style>  --}}
</head>
<body>
    <div id="app">
        {{--  <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}"><img src="https://lh3.googleusercontent.com/-N4NB2F966TU/WM7V1KYusRI/AAAAAAAADtA/fPvGVNzOkCo7ZMqLI6pPITE9ZF7NONmawCJoC/w185-h40-p-rw/logo.png"></a>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        CMS
                    </a>
                </div>

                 <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li ><a href="{{ route('login') }}" class="glyphicon glyphicon-log-in">Login</a></li>
                            <li><a href="{{ route('register') }}" class="glyphicon glyphicon-user">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }}
                                     <span class="caret"></span>
                                </a>
                               
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <a href="{{ url('admin') }}">
                                            Admin
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>     --}}
        @yield('content')
        {{--  <section class="container-fluid">
           
        </section>>  --}}
    </div>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Scripts -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{--  <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>  --}}
    
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
   
   <!-- jQuery library -->
    {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  --}}

    <!-- Latest compiled JavaScript -->
    {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  --}}
    
</body>
</html>
