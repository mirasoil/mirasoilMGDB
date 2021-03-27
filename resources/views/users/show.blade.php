@extends('layouts.master')
@section('content')
<div class="container">
<h5 class="text-center">{{ __('User') }} {{$user['id']}}</h5>
    <div class="panel panel-default">
        <div class="panel-body text-center my-5">
            <div class="form-group">
                <strong>{{ __('First Name') }}: </strong><p>{{ $user['firstname'] }}</p>
            </div>
            <div class="form-group">
                <strong>{{ __('Last Name') }}: </strong><p>{{ $user['lastname'] }}</p>
            </div>
            <div class="form-group">
                <strong>{{ __('Email') }}: </strong><p> {{ $user['email'] }}</p>
            </div>
            <div class="form-group">
                <strong>{{ __('Phone') }}: </strong><p> {{ $user['phone'] }}</p>
            </div>
            <div class="form-group">
                <strong>{{ __('Address') }}: </strong><p> {{ $user['address'] }} </p>
            </div>
            <div class="form-group">
                <strong>{{ __('City') }}: </strong><p> {{ $user['city'] }} </p>
            </div>
            <div class="form-group">
                <strong>{{ __('County') }}: </strong><p> {{ $user['county'] }} </p>
            </div>
            <div class="form-group">
                <strong>{{ __('Zipcode') }}: </strong><p> {{ $user['zipcode'] }} </p>
            </div>
            <div class="float-right m-4">
                <a class="btn btn-info m-4" href="{{ route('users', app()->getLocale()) }}">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
</div>
<div class="p-5"></div>
@endsection
<!--- afiseaza datele pe ecran cum sunt in baza de date cu id-ul curent --->