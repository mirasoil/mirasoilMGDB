@extends('layouts.master')
@section('title')
<title>{{ __('My Account') }} - Mirasoil</title>
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
                <li class="breadcrumb-item active" aria-current="page">{{ __('My Account') }}</li>
            </ol>
        </nav>
        @if (\Session::has('forbiddenmsg'))
            <div class="alert alert-danger">
                {!! \Session::get('forbiddenmsg') !!}
            </div>
        @endif
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
                        <li class="list-group-item">
                            <a style="text-decoration: none;" href="{{ route('logout', app()->getLocale()) }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <strong>{{ __('Logout') }}</strong>
                            </a>
                            <form id="logout-form-user" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
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
                            <div class="form-group">
                                    <button class="btn btn-success float-right" id="edit-user-data" type="button">
                                        {{ __('Update Details') }}
                                    </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="messages"><h2></h2>
                    <hr>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@for ($i = 0; $i < 3; $i++)
    <br>
@endfor
<script>
// Edit user information
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
</script>
@endsection