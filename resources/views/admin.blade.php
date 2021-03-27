@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    {{ __('Hi boss! What are you up for ?') }}
                </div>
            </div>
            <div>
                <a href="{{ route('products.index', app()->getLocale()) }}" style="text-decoration:none;">
                    <button class="btn btn-info mt-3 ml-5"> {{ __('Control Panel') }}</button>
                </a>
                <a href="{{ url(app()->getLocale().'/orders') }}" style="text-decoration:none;">
                    <button class="btn btn-info mt-3 ml-5"> {{ __('Orders Editor') }}</button>
                </a>
                <a href="{{ url(app()->getLocale().'/users') }}" style="text-decoration:none;">
                    <button class="btn btn-info mt-3 ml-5"> {{ __('Users Editor') }}</button>
                </a>
            </div>
        </div>
    </div>
</div>
@for($i=0;$i<=10;$i++)
 <br>
@endfor
@endsection