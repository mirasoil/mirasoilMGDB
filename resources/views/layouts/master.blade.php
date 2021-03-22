<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- <title> HOME | Lavandă Miraslău</title> -->
    @yield('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Ești fan lavandă ? Ei bine, la Mirasoil avem o gamă largă de produse naturale pentru tine. Află mai multe chiar acum !">
    <meta name="keywords" content="ulei de lavandă, apă florală, săpun, buchete florale lavandă, produse naturale din lavandă">
    <meta http-equiv="expires" content="0">  <!-- force the browser to not cache a page -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script> 
    <!---For cart--->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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

</body>
</html>