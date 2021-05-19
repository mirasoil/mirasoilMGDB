@extends('layouts.master')
@section('title')
<title>{{ __('My Account') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<!--Axios-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
@endsection
@section('content')
<div class="container">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('My Account') }}</li>
            </ol>
        </nav>
        <div class="alert"> 
            <p id="messageResp"></p>
        </div>
        <div class="container bootstrap snippet">
            <div class="row">
  		        <div class="col-sm-3"><!--left col-->
                    <div class="text-center">
                    @if(isset(Auth::user()->avatar))
                        <img src="../uploads/avatars/{{ Auth::user()->avatar }}" class="avatar img-circle img-thumbnail" alt="avatar" style="width:200px; height:200px;border-radius:50%;">
                    @else
                        <img src="../uploads/avatars/default.jpg" class="avatar img-circle img-thumbnail" alt="avatar" style="width:200px; height:200px;border-radius:50%;">
                    @endif
                        <h6 class="my-3">{{ __('Upload a different photo') }}</h6>
                        <form id="update-photo-data" enctype="multipart/form-data" action="{{ url(app()->getLocale().'/user') }}" method="POST">
                        @csrf
                            <input type="file" class="text-center center-block file-upload" name="avatar">
                            <input type="submit" class="btn btn-sm btn-primary mt-3" value="{{ __('Modify') }}">
                        </form>
                    </div>
                    <hr><br>
                    
                    <ul class="list-group">
                        <li class="list-group-item text-muted">{{ __('Activities') }} </li>
                        <li class="list-group-item"><a href="{{ url(app()->getLocale().'/shop') }}" style="text-decoration: none;"><strong>{{ __('Check products')}}</strong></a></li>
                        <li class="list-group-item"><a href="{{ url(app()->getLocale().'/cart') }}" style="text-decoration: none;"><strong>{{ __('My Cart')}} </strong></a></li>
                        <li class="list-group-item"><a href="{{ url(app()->getLocale().'/myorders') }}" style="text-decoration: none;"><strong>{{ __('Check history')}} </strong></a></li>
                    </ul> 
                </div><!--/col-3-->
                <div class="col-sm-9 mt-3">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <form id="update-data-form">
                            @csrf
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input id="userId" type="text" class="form-control d-none" value="{{ Auth::user()->id }}">
                                    <label for="firstname"><h5>{{ __('First Name') }}</h5></label>
                                    <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autocomplete="current-firstname" value="{{ Auth::user()->firstname }}">
                                </div>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lastname"><h5>{{ __('Last Name') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autocomplete="current-lastname" value="{{ Auth::user()->lastname }}">

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"><h5>{{ __('E-Mail') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone"><h5>{{ __('Phone') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="current-phone" value="{{ Auth::user()->phone }}">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address"><h5>{{ __('Address') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="current-address" value="{{ Auth::user()->address }}">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city"><h5>{{ __('City') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="city" type="city" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="current-city" value="{{ Auth::user()->city }}">

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="county"><h5>{{ __('County') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="county" type="county" class="form-control @error('county') is-invalid @enderror" name="county" required autocomplete="current-county" value="{{ Auth::user()->county }}">

                                    @error('county')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="zipcode"><h5>{{ __('Zipcode') }}</h5></label>

                                <div class="col-xs-6">
                                    <input id="zipcode" type="zipcode" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" required autocomplete="current-zipcode" value="{{ Auth::user()->zipcode }}">

                                    @error('zipcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mt-2">
                                <div class="col-xs-6">
                                    <button class="btn btn-success" id="edit-user-data" type="button">
                                        {{ __('Save') }}
                                    </button>
                                    <a class="btn btn-primary float-right" href="{{ route('logout', app()->getLocale()) }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div><!--/tab-pane-->
                    <div class="tab-pane" id="messages"><h2></h2>
                    <hr>
                </div><!--/tab-pane-->
                </div><!--/tab-content-->
            </div><!--/col-9-->
        </div>
    </div>
</div>
@for ($i = 0; $i < 3; $i++)
    <br>
@endfor
<script>
    $(document).on("click", "#edit-user-data", function() { 
        var user_id = $('#userId').val();
        var url = "{{ url(app()->getLocale().'/user') }}"+'/'+user_id;

        formElement = document.getElementById("update-data-form")
        formObject = new FormData(formElement)
        formObject.append("user_id", user_id);

        dataObject = {}
        formObject.forEach(function(valoare,cheie) {
            dataObject[cheie]=valoare
            })
        finalData = JSON.stringify(dataObject)
        
        axios
        .patch(url, finalData, {
            headers: {"Content-Type": "application/json"}
            }) 
            .then(response => {
                if(response.status == 200)
                {
                    $(".alert").addClass("alert-success"); 
                    $("#messageResp").html("Informațiile au fost actualizate");  
                }
                else{
                    alert("Internal Server Error");
                }
            })
        });
// $(document).on("click", "#edit-user-data", function() { 
//     var user_id = $('#userId').val();
//     var url = "{{ url(app()->getLocale().'/user') }}"+'/'+user_id;
//     axios
//     .patch(url, { 
//             _token:'{{ csrf_token() }}',
//             user_id: user_id,
//             firstname: $('#firstname').val(),
//             lastname: $('#lastname').val(),
//             email: $('#email').val(),
//             phone: $('#phone').val(),
//             address: $('#address').val(),
//             county: $('#county').val(),
//             city: $('#city').val(),
//             zipcode: $('#zipcode').val()
//         }) 
//         .then(response => {
//             if(response.data.statusCode == 200)
//             {
//                 $(".alert").addClass("alert-success");  //stilizare
//                 $("#messageResp").html("Informațiile au fost actualizate");  //continutul mesajului  
//             }
//             else{
//                 alert("Internal Server Error");
//             }
//         })
//     });

 
</script>
@endsection