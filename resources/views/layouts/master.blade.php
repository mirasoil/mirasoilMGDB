<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- <title> HOME | Lavandă Miraslău</title> -->
    @yield('title')
    <link rel="icon" href="{{URL::asset('/img/Logo-mirasoil.png')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Ești fan lavandă ? Ei bine, la Mirasoil avem o gamă largă de produse naturale pentru tine. Află mai multe chiar acum !">
    <meta name="keywords" content="ulei de lavandă, apă florală, săpun, buchete florale lavandă, produse naturale din lavandă">
    <meta http-equiv="expires" content="0">  <!-- force the browser to not cache a page -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}" defer></script> 
    <!---For cart--->
    
    
    <!--Slider--->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!---Link footer--->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    @yield('extra-scripts')

</head>
<body class="wrapper">
<!--Left Sidebar Holder --> 
@include('sections.left-sidebar')
<div id="content">
    @include('sections.navigation')
        @if (\Session::has('message-area-success'))
        <div class="alert alert-success">
        <p id="message-response">{{ \Session::get('message-area-success') }}</p>
        </div>
        @endif
        @if (\Session::has('message-area-failure'))
        <div class="alert alert-danger">
        <p id="message-response">{{ \Session::get('message-area-failure') }}</p>
        </div>
        @endif

    @yield('content')


@include('sections.footer')
</div>
@include('sections.right-sidebar')

@yield('extra-js')

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>