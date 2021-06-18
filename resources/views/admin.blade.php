@extends('layouts.master')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="container">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ __('Home') }}</li>
        </ol>
    </nav>
    <div class="text-center"><p><i class="fas fa-user-shield"></i> {{ __('Dashboard') }}</p></div>
    <div class="mt-3">
        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatarAdmin" width="200" height="200">
        <div>
        <div class="text-center">
        <h5>{{ __('Hi') }}, {{ auth()->user()->name }} !</h5>
        <p class="mt-3">{{ __('What are you up for ?') }}</p>
        </div>
            <div class="text-center">
                <a href="{{ route('products.index', app()->getLocale()) }}" style="text-decoration:none;">
                    <button class="btn btn-lg btn-info mt-3"> {{ __('Control Panel') }}</button>
                </a>
                <a href="{{ url(app()->getLocale().'/orders') }}" style="text-decoration:none;">
                    <button class="btn btn-lg btn-info mt-3 ml-5"> {{ __('Orders Editor') }}</button>
                </a>
                <a href="{{ url(app()->getLocale().'/users') }}" style="text-decoration:none;">
                    <button class="btn btn-lg btn-info mt-3 ml-5"> {{ __('Users Editor') }}</button>
                </a>
                <a href="{{ url(app()->getLocale().'/messages') }}" style="text-decoration:none;">
                    <button class="btn btn-lg btn-info mt-3 ml-5"> {{ __('Messages Editor') }}</button>
                </a>
            </div>
            <div class="card mt-5">
                <div class="card-header"><i class="fab fa-mailchimp" height="50"></i> {{ __('Audience') }}</div>

                <div class="card-body">
                    <p class="mt-3">{{ __('For displaying all subscribed user, you need to connect to our MailChimp Account.') }}</p>
                    <button class="btn btn-lg btn-warning" onclick="location.href='https://us7.admin.mailchimp.com/lists/dashboard/overview?id=549934'"><i class="fab fa-mailchimp"></i> {{ __('Connect') }}</button>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <h4>10</h4>
                        <p>{{ __('Subscribed Contacts') }}</p>
                    </div>
                    <div class="col">
                        <h4>0</h4>
                        <p>{{ __('Non-Subscribed Contacts') }}</p>
                    </div>
                    <div class="col">
                        <h4>0</h4>
                        <p>{{ __('Unsubscribed Contacts') }}</p>
                    </div>
                    <div class="col">
                        <h4>0</h4>
                        <p>{{ __('Cleaned Contacts') }}</p>
                    </div>
                </div>
                <div class="iactiveImg" data-ii="29243"></div><script src="https://interactive-img.com/js/include.js"></script>
            </div>
        </div>
        <div class="mt-5 float-right">
            <a class="btn btn-lg" href="{{ route('logout', app()->getLocale()) }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="background-image: linear-gradient(to right, #50C9C3 0%, #96DEDA  51%, #50C9C3  100%)">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@for($i=0;$i<=8;$i++)
 <br>
@endfor
@endsection