@extends('layouts.master')
@section('title')
<title>{{ __('Orders Editor') }} - Admin</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/users') }}">{{ __('Users Editor') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('User') }}</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if($user['avatar'])
                        <img src="../../uploads/avatars/{{ $user['avatar'] }}" class="rounded-circle" alt="avatar" width="150">
                    @else
                        <img src="../../uploads/avatars/default.jpg" class="rounded-circle" alt="avatar" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{ $user['firstname'] }} {{ $user['lastname'] }}</h4>
                      <p class="text-secondary mb-1">{{ __('Account created at') }}</p>
                      <p class="text-muted font-size-sm">{{ $user['created_at']->isoFormat('D MMM YYYY hh:mm') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ __('Full name') }}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user['firstname'] }} {{ $user['lastname'] }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ __('E-Mail') }}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user['email'] }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ __('Phone') }}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{ $user['phone'] }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ __('Address') }}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        @if($user['address'])
                            {{ $user['address'] }}, {{ $user['city'] }}, {{ $user['county'] }}
                        @else

                        @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ __('Zipcode') }}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user['zipcode'] }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
                <div class="card-body">
                    <div class="mt-2">
                      <h4>{{ __("User's orders") }}</h4>
                      <hr>
                      @if(empty($orders))
                        @foreach($orders as $order)
                        <div class="mt-3">
                            <a href="{{ url(app()->getLocale().'/order/'.$order['id']) }}" class="text-decoration-none h5">{{ $order['id'] }}</a> 
                            <p class="text-muted font-size-sm d-inline-block">&rarr; {{ __('Registered at') }} {{ $order->created_at->isoFormat('D MMM YYYY hh:mm') }}</p>
                        </div>
                        @endforeach
                      @else
                        <div class="mt-3">
                            <p class="text-muted font-size-sm">{{ __('This user has no orders registered yet') }}</p>
                        </div>
                      @endif
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection




