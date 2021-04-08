@extends('layouts.master')
@section('title')
<title>{{ __('My Account') }} - Mirasoil</title>
@endsection
@section('content')
<div class="container">
@if (\Session::has('user-success'))
<div class="alert alert-success">
<p id="message-response">{{ \Session::get('user-success') }}</p>
</div><br />
@endif
@if (\Session::has('user-failure'))
<div class="alert alert-danger">
<p id="message-response">{{ \Session::get('user-failure') }}</p>
</div><br />
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Account') }}</div>

                <div class="card-body">
                    <h1>{{ __('Welcome back') }}, {{ Auth::user()->firstname }} !</h1>
                        <form id="update-data-form">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                            <input id="userId" type="text" class="form-control d-none" value="{{ Auth::user()->id }}">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autocomplete="current-firstname" value="{{ Auth::user()->firstname }}">

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autocomplete="current-lastname" value="{{ Auth::user()->lastname }}">

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="current-phone" value="{{ Auth::user()->phone }}">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="current-address" value="{{ Auth::user()->address }}">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="county" class="col-md-4 col-form-label text-md-right">{{ __('County') }}</label>

                            <div class="col-md-6">
                                <input id="county" type="county" class="form-control @error('county') is-invalid @enderror" name="county" required autocomplete="current-county" value="{{ Auth::user()->county }}">

                                @error('county')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="city" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="current-city" value="{{ Auth::user()->city }}">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('Zipcode') }}</label>

                            <div class="col-md-6">
                                <input id="zipcode" type="zipcode" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" required autocomplete="current-zipcode" value="{{ Auth::user()->zipcode }}">

                                @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary" id="edit-user-data">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@for ($i = 0; $i < 10; $i++)
    <br>
@endfor
<script>
$(document).ready(function(){

$(document).on("click", "#edit-user-data", function() { 
    var user_id = $('#userId').val();
    var url = "{{ url(app()->getLocale().'/user') }}"+'/'+user_id;
    $.ajax({
        url: url,
        type: "PATCH",
        cache: false,
        data:{
            _token:'{{ csrf_token() }}',
            user_id: user_id,
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            county: $('#county').val(),
            city: $('#city').val(),
            zipcode: $('#zipcode').val()
        },
        success: function(dataResult){
            dataResult = JSON.parse(dataResult);
         if(dataResult.statusCode)
         {
            $(".alert").addClass("alert-success")  //stilizare
            $("#message-response").html("Informațiile au fost actualizate")  //continutul mesajului  
            $('#update-data-form').load(); //resetare formular pentru a afisa detaliile noi introduse 
         }
         else{
             alert("Internal Server Error");
         }
            
        }
    });
}); 
});
</script>
@endsection