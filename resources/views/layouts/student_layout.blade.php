@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))
<style>
    tr:hover{
        color: rgba(0,0,0,0.5);
    }
    .logo{
        position:fixed;
        top:5;
        left:20px;
        width: 40px;
        height:40px;
    }
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    li {
        float: left;
        display:inline;
    }
    .middle{
        position: absolute;
        top:0;
        bottom:0;
        right:0;
        left:0;
        margin: auto 0 ;
    }
    .header{
        font-weight:bold;
        width:200px;
        position:fixed;
        left:80px;
        top:15px;
    }
    ul li a{
        color:#fff;
        font-weight:bold;
    }
    li a:hover{
        background-color: rgba(0,0,0,0.4) !important;
        color:#fff !important;
    }
    a li{
        color:#fff;
    }
    body{
        background-image: radial-gradient(circle at bottom right, #43cea2, #185a9d);        
        color:#fff !important;
    }
    .dropdown-menu{
        background: rgba(0,0,0,0.3) !important;
    }
    .dropdown-menu li a{
        color: #fff !important;
    }
    .dropdown-menu li{
        width: 100% !important;
    }
    .dropdown-menu li a:hover{
        background-color: rgba(0,0,0,0.2) !important;
    }
    .navbar-custom-menu{
        position:fixed;
        right:10;
        top:0;
    }
    .btn{
        background-color: #00B0FF !important;
        border : 0px !important;
    }
    textarea, input[type="text"]{
        border : 0px;
        border-radius: 3px !important;
    }
    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none !important;
    }
</style>
@section('body')
    <div class="">
        <!-- Main Header -->     
            <nav class="navbar navbar-static-top">
                <div class="logo">
                    <ul class="nav navbar-nav middle">
                        <a href="/student/home">
                            <li>
                                <img class="logo" height="20px" width="20px" src="{{ asset('images/Logo_transparent.png') }}">
                            </li>
                            <li class="header">
                                    V-Buddy
                            </li>
                        </a>
                    </ul>
                </div>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/student/profile">
                                        Profile 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/student/logout"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="/student/logout" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>


        <!-- Content Wrapper. Contains page content -->
        
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
