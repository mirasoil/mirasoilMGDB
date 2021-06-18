@extends('layouts.master')
@section('title')
<title>{{ __('Place order') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
@section('content')
<div id="checkout" class="container">
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/user') }}">{{ __('My Account') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/cart') }}">{{ __('My Cart') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Review order') }}</li>
        </ol>
    </nav>
    <div class="alert alert-warning">
        <h6>{{ __('Please do not refresh the page or use the back button during the process. These actions can lead to order cancellation.') }}</h6>
    </div>
    <div id="alert" class="alert d-none">
        <h6 id="message-response"></h6>
    </div>
    <div class="row mt-4">
        <!-- Sectiunea Cosul Meu si Adresa facturare -->
        <div class="col-md-4 order-md-2 mb-2">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">{{ __('My Cart') }}</span>
                <span class="badge badge-primary badge-pill">{{ count((array) session('cart')) }}</span>
            </h4>
            <hr>
            <ul class="list-group mb-3">
                <?php $total = 0 ?>
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <img src="../img/{{ $details['image'] }}" alt="{{ $details['name'] }}" width="60" height="60">
                            <div>
                                <h6 class="my-0">{{ $details['name'] }}</h6>
                                <small class="text-muted">{{ __('Quantity') }}: {{ $details['quantity'] }}</small><br>
                                <small class="text-muted">{{ __('Unit price') }}: {{ $details['price'] }} RON</small>
                            </div>
                            <span class="text-muted">{{ $details['price'] * $details['quantity'] }} RON</span>
                        </li>
                    @endforeach
                @endif
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (RON)</span>
                    <strong id="total">{{ $total.' RON' }}</strong>
                </li>
            </ul>
            <h4 class="d-flex text-center mb-3"><span class="text-muted">{{ __('Billing Address') }}</span></h4>
            <hr>
            <div class="card p-2">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" id="firstName1" placeholder="Prenume" value="{{ Auth::user()->firstname }}" disabled="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">{{ __('Last Name') }}</label>
                        <input type="text" class="form-control" id="lastName1" placeholder="Nume" value="{{ Auth::user()->lastname }}" disabled="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email1">{{ __('Email') }}</label>
                    <input type="email1" class="form-control" id="email1" placeholder="exemplu@example.com" value="{{ Auth::user()->email }}" b="" disabled="">
                </div>
                <div class="form-group">
                    <label for="address">{{ __('Address') }}</label>
                    <textarea class="form-control" id="address1" rows="3" disabled="">{{ Auth::user()->address }}</textarea>
                </div>
            </div>  
            <div class="card p-2 my-3">
                <a href="{{ url(app()->getLocale().'/cart') }}" class="btn btn-info m-1"> Înapoi la Coșul meu</a> 
                <a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-primary m-1"> Continuă Cumpărăturile </a>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <form method="POST" id="update-data-form">
            @csrf
                <!-- Sectiunea Adresa de Livrare -->
                <h4 class="mb-3">{{ __('Shipping Address') }}</h4><hr>
                <div class="card p-2 mb-3 shadow-sm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstname">{{ __('First Name') }}</label>
                            <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{ Auth::user()->firstname }}" required="">

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastname">{{ __('Last Name') }}</label>
                            <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname" value="{{ Auth::user()->lastname }}" required="">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input readonly type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ Auth::user()->email }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tel">{{ __('Phone') }}</label>
                            <input type="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" required value="{{ Auth::user()->phone }}" required="">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }}</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3" required="">{{ Auth::user()->address }}</textarea>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="county">{{ __('County') }}</label>
                            <select class="custom-select d-block w-100" name="county" id="county">
                            <option value="{{ Auth::user()->county }}">{{ Auth::user()->county }}</option>
                            <option value="Bucuresti">Bucuresti</option>
                            <option value="Alba">Alba</option>
                            <option value="Arad">Arad</option>
                            <option value="Arges">Arges</option>
                            <option value="Bacau">Bacau</option>
                            <option value="Bihor">Bihor</option>
                            <option value="Bistrita-Nasaud">Bistrita-Nasaud</option>
                            <option value="Botosani">Botosani</option>
                            <option value="Brasov">Brasov</option>
                            <option value="Braila">Braila</option>
                            <option value="Buzau">Buzau</option>
                            <option value="Caras-Severin">Caras-Severin</option>
                            <option value="Calarasi">Calarasi</option>
                            <option value="Cluj">Cluj</option>
                            <option value="Constanta">Constanta</option>
                            <option value="Covasna">Covasna</option>
                            <option value="Dambovita">Dambovita</option>
                            <option value="Dolj">Dolj</option>
                            <option value="Galati">Galati</option>
                            <option value="Giurgiu">Giurgiu</option>
                            <option value="Gorj">Gorj</option>
                            <option value="Harghita">Harghita</option>
                            <option value="Hunedoara">Hunedoara</option>
                            <option value="Ialomita">Ialomita</option>
                            <option value="Iasi">Iasi</option>
                            <option value="Ilfov">Ilfov</option>
                            <option value="Maramures">Maramures</option>
                            <option value="Mehedinti">Mehedinti</option>
                            <option value="Mures">Mures</option>
                            <option value="Neamt">Neamt</option>
                            <option value="Olt">Olt</option>
                            <option value="Prahova">Prahova</option>
                            <option value="Satu Mare">Satu Mare</option>
                            <option value="Salaj">Salaj</option>
                            <option value="Sibiu">Sibiu</option>
                            <option value="Suceava">Suceava</option>
                            <option value="Teleorman">Teleorman</option>
                            <option value="Timis">Timis</option>
                            <option value="Tulcea">Tulcea</option>
                            <option value="Valcea">Valcea</option>
                            <option value="Vaslui">Vaslui</option>
                            <option value="Vrancea">Vrancea</option>
                            </select>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="city">{{ __('City') }}</label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" required="" value="{{ Auth::user()->city }}">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zipcode">{{ __('Zipcode') }}</label>
                            <input type="zipcode" name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" value="{{ Auth::user()->zipcode }}" required="">

                            @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">{{ __('Shipping address is the same as billing address') }}</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">{{ __('Save for later') }}</label>
                    </div>
                    <div class="col-md-8 my-3">
                        <button id="update-user-details" data-id="{{ Auth::user()->id }}" class="btn btn-primary" type="button">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
                <div class="form-group mt-5">
                    <h3>{{ __('Complete order') }}</h3>
                    <hr />
                    <p>{{ __('Choosing the payment method will lead to placing the order. Please check all the details') }}</p>
                    <p>{{ __('Payment method:') }}</p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="font-weight-light">{{ __('Pay with credit card') }} <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> </span>
                            <div class="float-right">
                                <form action="{{ url(app()->getLocale().'/revieworder') }}" method="POST" id="payment-form" class="my-5 ml-5">
                                    {{ csrf_field() }}
                                    <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-label="{{ __('Pay') }}"
                                            data-key="{{ env('STRIPE_KEY') }}"
                                            data-amount="{{$total*100}}"
                                            data-name="Plata comenzii"
                                            data-description="Va rugam sa verificati datele introduse"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-locale="auto"
                                            data-currency="ron">
                                    </script>
                                </form>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-light">{{ __('Courier refunds') }}</span>
                            <div class="float-right">
                                <button type="button" onclick="placeOrder()" class="text-light" id="ramburs">
                                    {{ __('Pay') }}
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
            
            
        </div>  
    </div>
</div>
@for ($i = 0; $i < 5; $i++)
    <br>
@endfor
<script>
// Update user details - on checkout
$( document ).ready(function(){

    let firstname = $("input[name=firstname]").val();
    let lastname = $("input[name=lastname]").val();
    let email = $("input[name=email]").val();

    let phone = $("input[name=phone]").val();
    let address = $("#address").val();
    let county = $("#county").val();
    let city = $("input[name=city]").val();
    let zipcode = $("input[name=zipcode]").val();

    let str = $('#total').html();
    var res = str.split(" ");
    let total = parseInt(res[0]);

    var id = "{{ Auth::user()->id }}";
    let url = "{{ url(app()->getLocale().'/revieworder/session/') }}"+'/'+id;

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
            id: id,
            firstname: firstname,
            lastname: lastname,
            email: email,
            phone: phone,
            address: address,
            county: county,
            city: city,
            zipcode: zipcode,
            total: total
    }
    })
});


$('#update-user-details').click(function(event){
    event.preventDefault();

    let firstname = $("input[name=firstname]").val();
    let lastname = $("input[name=lastname]").val();

    let phone = $("input[name=phone]").val();
    let address = $("#address").val();
    let county = $("#county").val();
    let city = $("input[name=city]").val();
    let zipcode = $("input[name=zipcode]").val();

    var id = $(this).data('id');
    let url = "{{ url(app()->getLocale().'/revieworder/') }}"+'/'+id;

    let axiosConfig = {
        headers: {
            'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
        }
    };
    axios({
    method: 'patch',
    url: url,
    headers: axiosConfig,
    data: {
            _token: "{{ csrf_token() }}",
            id: id,
            firstname: firstname,
            lastname: lastname,
            phone: phone,
            address: address,
            county: county,
            city: city,
            zipcode: zipcode
    }
    })
    .then((response) => {		
        $('#alert').removeClass('d-none');	
        $(".alert").addClass("alert-success")  //stilizare
        $("#message-response").html("Informațiile au fost actualizate")  //continutul mesajului   
    })
    .catch(function (error) {
        alert('A intervenit o eroare. Va rugam sa incercati din nou');
    })
});

function placeOrder(){
    if(confirm('Această acțiune va plasa comanda cu modalitatea de plată ramburs. Sunteți sigur că doriți să continuați ?')){
        window.location.href='{{ route('checkout.index', app()->getLocale()) }}'
    }
}

</script>
@endsection