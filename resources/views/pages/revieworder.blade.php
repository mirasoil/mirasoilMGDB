@extends('layouts.master')
@section('title')
<title>{{ __('Place order') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')
<div id="checkout" class="container">
    <div class="pt-3 text-center">
        <h2>{{ __('Place order') }}</h2>
        <p class="lead"></p>
    </div>
    <div class="alert">
        <p id="message-response"></p>
    </div>
    <br />
    <div class="row">
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
                            <img src="../img/{{ $details['image'] }}" alt="Hidrolat de lavandă" width="60" height="60">
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
            <div class="card p-2 mb-3">
                <a href="{{ url(app()->getLocale().'/cart') }}" class="btn btn-danger m-1"> &lt;&lt; Înapoi la Coșul meu</a> 
                <a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-warning m-1"> &lt;&lt; Continuă Cumpărăturile </a>
                <a href="{{ url(app()->getLocale().'/checkout') }}" class="btn btn-success m-1"> Finalizare Comandă &gt;&gt; </a>    
            </div>
            <h4 class="d-flex text-center mb-3"><span class="text-muted">{{ __('Billing Adress') }}</span></h4>
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
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ Auth::user()->email }}">

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
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8">
                        <button id="update-user-details" data-id="{{ Auth::user()->id }}" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8">
                        <button type="submit" id="complete-order" data-id="{{ Auth::user()->id }}" class="btn btn-primary mt-3">
                            {{ __('Proceed to payment') }}
                        </button>
                    </div>
                </div>
            </form>
            <form id="payment-form" class="d-none my-4">
                @csrf
                <h5 class="mt-5">{{ __('Payment details') }}</h5>
                <hr>
                <input type="text" id="email-stripe" class="form-control" placeholder="Email address" value="{{ Auth::user()->email }}" />
                    <div id="card-element" class="my-3"><!--Stripe.js injects the Card Element--></div>
                    <button id="submitButton" type="submit" class="btn btn-success my-4">
                        <span id="button-text">{{ __('Pay') }}</span>
                    </button>
                    <p id="card-error" role="alert"></p>
                    <p class="result-message d-none">
                        {{ __('Payment successful!') }}
                    </p>
            </form>
        </div>  
    </div>
    <button id="invoice-generator" class="btn btn-primary btn-lg btn-block" type="submit" data-id="{{ Auth::user()->id }}">{{ __('Proceed to payment') }}</button>
    <a href="{{ url(app()->getLocale().'/checkout') }}">INVOICE</a>
</div>
@for ($i = 0; $i < 5; $i++)
    <br>
@endfor
<script>
$('#invoice-generator').click(function(event){
    event.preventDefault();

    var id = $(this).data('id');

    $.ajax({
        url: "{{ url(app()->getLocale().'/checkout/') }}"+'/'+id,
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            id:id,
        },
        // success: function(response){
        //     console.dir(response);   
        // },
    });    
});

$('#update-user-details').click(function(event){
      event.preventDefault();

      let firstname = $("input[name=firstname]").val();
      let lastname = $("input[name=lastname]").val();
      let email = $("input[name=email]").val();
      let phone = $("input[name=phone]").val();
      let address = $("#address").val();
      let county = $("#county").val();
      let city = $("input[name=city]").val();
      let zipcode = $("input[name=zipcode]").val();

      var id = $(this).data('id');

      $.ajax({
        url: "{{ url(app()->getLocale().'/revieworder/') }}"+'/'+id,
        type:"PATCH",
        data:{
            "_token": "{{ csrf_token() }}",
            id:id,
            firstname:firstname,
            lastname:lastname,
            email:email,
            phone:phone,
            address:address,
            county:county,
            city:city,
            zipcode:zipcode,
        },
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function(response){
            $(".alert").addClass("alert-success")  //stilizare
            $("#message-response").html("Informațiile au fost actualizate")  //continutul mesajului  
            $('#update-data-form').load(); //resetare formular pentru a afisa detaliile noi introduse    
        },
       });
});

$("#complete-order").click(function(event){
      event.preventDefault();

      let firstname = $("input[name=firstname]").val();
      let lastname = $("input[name=lastname]").val();
      let email = $("input[name=email]").val();
      let phone = $("input[name=phone]").val();
      let address = $("#address").val();
      let county = $("#county").val();
      let city = $("input[name=city]").val();
      let zipcode = $("input[name=zipcode]").val();
      //accesez totalul 
      let str = $('#total').html();
      var res = str.split(" ");
      let total = parseInt(res[0]);

      var id = $(this).data('id');

      $.ajax({
        url: "{{route('orders.store', app()->getLocale())}}",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            id:id,
            firstname:firstname,
            lastname:lastname,
            email:email,
            phone:phone,
            address:address,
            county:county,
            city:city,
            zipcode:zipcode,
            total: total,
        },
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function(response){
            showPaymentForm();        
        },
       });
  });

function showPaymentForm(){
    $('#payment-form').removeClass('d-none');
    $('#complete-order').remove();
}

//Stripe script
const stripe = Stripe("pk_test_51IIzThFPoGjTfy5WZEzx4HhJ923HVamP4Ul8zA1D1Z961FxJXnnK6im7bDRA17LzsToUNLe0YySRY0Dn75M2HAjm00c0GgoLHD");
const elements = stripe.elements();

const clientSecret = 'pi_1IJ0LNFPoGjTfy5WMpaX3SCT_secret_ZtZJcMKUJEKXNGhYwrWjcFevU';

var style = {
    base: {
    color: "#32325d",
    fontFamily: 'Arial, sans-serif',
    fontSmoothing: "antialiased",
    fontSize: "16px",
    "::placeholder": {
        color: "#32325d"
    }
    },
    invalid: {
    fontFamily: 'Arial, sans-serif',
    color: "#fa755a",
    iconColor: "#fa755a"
    }
};
var card = elements.create("card", { style: style });
// Stripe injects an iframe into the DOM
card.mount("#card-element");

card.on("change", function (event) {
    // Disable the Pay button if there are no card details in the Element
    document.querySelector("button").disabled = event.empty;
    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
});

var form = document.getElementById("payment-form");
form.addEventListener("submit", function(event) {
    event.preventDefault();
    // Complete payment when the submit button is clicked
    payWithCard(stripe, card, data.clientSecret);
});

submitButton.addEventListener('click', function(ev) {
stripe.confirmCardPayment(clientSecret, {
    receipt_email: document.getElementById('email-stripe').value,
    payment_method: {
    card: card
    }
})
.then(function(result) {
    if (result.error) {
    // Show error to your customer
    showError(result.error.message);
    } else {
    // The payment succeeded!
    orderComplete(result.paymentIntent.id);
    $('.result message').removeClass('d-none');
    console.log($paymentIntent);
    }
});
});
</script>
@endsection