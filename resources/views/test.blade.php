@extends('layouts.master')
@section('title')
<title>{{ __('My Orders') }} - Mirasoil</title>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<style>
        .card {
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent
}

@media(max-width:767px) {
    .shopping-card {
        margin: 3vh auto
    }
}

.cart-div {
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem
}

@media(max-width:767px) {
    .cart-div {
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem
    }
}

.summary {
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65)
}

@media(max-width:767px) {
    .summary {
        border-top-right-radius: unset;
        border-bottom-left-radius: 1rem
    }
}

.summary .col-2 {
    padding: 0
}

.summary .col-10 {
    padding: 0
}

.row {
    margin: 0
}

.title b {
    font-size: 1.5rem
}

.main {
    margin: 0;
    padding: 2vh 0;
    width: 100%
}

.col-2,
.col {
    padding: 0 1vh
}

a {
    padding: 0 1vh
}

.close {
    margin-left: auto;
    font-size: 0.7rem
}

img {
    width: 3.5rem
}

.back-to-shop {
    margin-top: 4.5rem
}

.summary-header {
    margin-top: 4vh
}


select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

.checkout-btn {
    background-color: #000;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0
}

.checkout-btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.checkout-btn:hover {
    color: white
}

#code {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}
</style>
@endsection
@section('content')
<div class="container">
<nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/user') }}">{{ __('My Account') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/shop') }}">{{ __('Shop') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('My Cart') }}</li>
        </ol>
    </nav>
<div class="card shopping-card">
    <div class="row">
        <div class="col-md-8 cart-div">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                    @if(session('cart'))
                        <div class="col align-self-center text-right text-muted">{{ count((array) session('cart')) }}</div>
                    @endif
                </div>
            </div>
            <?php $total = 0 ?>
        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
        <?php $total += $details['price'] * $details['quantity'] ?>
            <div class="row border-top border-bottom pl-4" id="product-show-{{ $id }}">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="../img/{!!$details['image']!!}" ></div>
                    <div class="col">
                        <div class="row text-muted">{{ $details['name'] }}</div>
                        <div class="row">{{ $details['price'] * $details['quantity'] }} Lei </div>
                    </div>
                    <div class="col"> <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity{{$id}}" min="1" oninput="validity.valid||(value='');"/> </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        @endforeach
        <div class="col-md-4 summary">
            <div>
                <h5 class="summary-header"><b>Summary</b></h5>
            </div>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">{{ $total }} Lei</div>
            </div> <button class="btn checkout-btn">CHECKOUT</button>
        </div>
        @endif
    </div>
</div>
</div>
@endsection