@extends('layouts.master')
@section('title')
<title>{{ __('Cart') }} - Mirasoil</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('extra-scripts')
<!--Axios-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/user') }}">{{ __('My Account') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/cart') }}">{{ __('My Cart') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Order Confirmation') }}</li>
        </ol>
    </nav>
<!--If payment was successfull, the order gets stored in the database-->
@if (session('paymentSuccessfull'))
    <script>
        var id = "{{ Auth::user()->id }}";
        let url = "{{route('orders.store', app()->getLocale())}}";

        let axiosConfig = {
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
            }
        };

        axios({
            method: 'post',
            url: url,
            headers: axiosConfig,
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            }
        })
        .then((response) => {			
            window.history.forward();
        })
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        })
    </script>
    <div class="alert alert-success">
        {{ session('paymentSuccessfull') }}
    </div>
    <h5 class="text-center">{{ __('Your order was placed succesfully! Please check My Orders section for further details') }}</h5>
    <div class="text-center mt-5">
        <a href="{{ url(app()->getLocale().'/myorders') }}" class="btn btn-warning">{{ __('My Orders') }}</a>
    </div>
@elseif(session('paymentDeclined'))
    <div class="alert alert-danger">
        {{ session('paymentDeclined') }}
    </div>
    <div class="text-center mt-5">
        <a href="{{ url(app()->getLocale().'/cart') }}" class="btn btn-warning">{{ __('My Cart') }}</a>
    </div>
@else
<script>
        var id = "{{ Auth::user()->id }}";
        let url = "{{route('orders.store', app()->getLocale())}}";

        let axiosConfig = {
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
            }
        };

        axios({
            method: 'post',
            url: url,
            headers: axiosConfig,
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            }
        })
        .then((response) => {			
            history.pushState(null, document.title, location.href);
        })
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        })
    </script>
<div class="alert alert-success">
    {{ session('paymentSuccessfull') }}
</div>
<h5 class="text-center">{{ __('Your order was placed succesfully! Please check My Orders section for further details') }}</h5>
<div class="text-center mt-5">
    <a href="{{ url(app()->getLocale().'/myorders') }}" class="btn btn-warning">{{ __('My Orders') }}</a>
</div>
@endif
 <br />
 <br />
 <br />
 <br />
 <br />
 <br />

</div>
@endsection