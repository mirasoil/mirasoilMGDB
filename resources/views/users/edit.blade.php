@extends('layouts.master')
@section('content')
<div class="container">
    <h1 class="text-center">{{ $user['name'] }}</h1>
    <h3 class="text-center">{{ __('Update details') }}</h3>
    <div class="panel panel-default" style="padding:50px">
        <div class="panel-body">
            <!---exista inregistrari in tabelul task --->
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!--populez campurile formularului cu datele aferente din tabela tbl_user pe care le pot modifica-->
            <form id="userForm">
            @csrf
            <div class="form-group row">
            <input id="userId" class="form-control d-none" name="userId" value="{{ $user['_id'] }}">
                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                <div class="col-md-6">
                    <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autocomplete="current-firstname" value="{{ $user['firstname'] }}">

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
                    <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autocomplete="current-lastname" value="{{ $user['lastname'] }}">

                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user['email'] }}" required autocomplete="email" autofocus>

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
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="current-phone" value="{{ $user['phone'] }}">

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
                    <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="current-address" value="{{ $user['address'] }}">

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
                    <input id="county" type="county" class="form-control @error('county') is-invalid @enderror" name="county" required autocomplete="current-county" value="{{ $user['county'] }}">

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
                    <input id="city" type="city" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="current-city" value="{{ $user['city'] }}">

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
                    <input id="zipcode" type="zipcode" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" required autocomplete="current-zipcode" value="{{ $user['zipcode'] }}">

                    @error('zipcode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button id="updateUserDetails" class="btn btn-success">{{ __('Save') }}</button>
                <a href="{{route('users', app()->getLocale()) }}" class="btn btn-danger">{{ __('Cancel')}}</a>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
   
   $('#updateUserDetails').on('click', function() {
     var user_id = $('#userId').val();

     var firstname = $('#firstname').val();
     var lastname = $('#lastname').val();
     var email = $('#email').val();
     var phone = $('#phone').val();
     var address = $('#address').val();
     var county = $('#county').val();
     var city = $('#city').val();
     var zipcode = $('#zipcode').val();

     if(firstname!="" && lastname!="" && email!="" && phone!="" && address!="" && county!="" && city!="" && zipcode!=""){
         $.ajax({
             url: "{{ url(app()->getLocale().'/user/edit/')}}"+'/'+user_id,
             type: "PATCH",
             data: {
                 _token: '{{ csrf_token() }}',
                 user_id: user_id,
                 firstname: firstname,
                 lastname: lastname,
                 email: email,
                 phone: phone,
                 address: address,
                 county: county,
                 city: city,
                 zipcode: zipcode
             },
             cache: false,
             success: function(dataResult){
                //  console.log(dataResult);
                 var dataResult = JSON.parse(dataResult);
                 if(dataResult.statusCode==200){			
                   document.getElementById('userForm').reset(); //page still reloads
                 }
                 else if(dataResult.statusCode==201){
                    alert("Error occured !");
                 }  
             }
         });
     }
     else{
         alert('Please fill all the field !');
     }
 });
});
</script>
@endsection
