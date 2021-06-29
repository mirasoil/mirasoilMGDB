@extends('layouts.master')
@section('title')
<title>{{ __('Product Details') }} - Mirasoil</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
    <div class="alert d-none">
        <p class="shop-success"></p>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Product added to cart') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ __('Verify your shopping cart for more details') }}
        </div>
        <div class="modal-footer">
            <a href="{{ url(app()->getLocale().'/cart') }}"><button type="button" class="btn btn-primary">{{ __('Check cart') }}</button></a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        </div>
        </div>
    </div>
    </div>
    <div id="ulei">
        <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content text-center pt-4">
                    <div class="tab-pane active" id="pic-1"><img src="{{'../../img/'.$shop->image}}" alt="{{$shop->name}}" height="350"></div>
                    </div>
                </div>
                <div class="col-md-6 pt-5 text-center">
                    <h3 class="product-title">{{$shop->name}}</h3>
                    <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
                <hr>
                <div class="product-price"><strong>Preț:</strong> {{$shop->price}} RON</div>
                <div class="product-stock">În stoc</div>
                <hr>
                @if(Auth::guard('user')->check())
                <div class="btn-group cart">
                    <button  class="btn btn-info btn-block text-center" id="{{$shop->id}}" onclick="btnAddCart(this.id)">
                        {{ __("Add to cart")}} 
                    </button>
                </div>
                <div class="btn-group wishlist">
                    <button  class="btn btn-warning btn-block text-center" id="{{$shop->id}}" onclick="btnAddCart(this.id)">
                        {{ __("Add to favorites")}} 
                    </button>
                </div>
                @else 
                <div class="btn-group cart">
                    <button  class="btn btn-info btn-block text-center" id="{{$shop->id}}" onclick="alert('Please login first!')">
                        {{ __("Add to cart")}} 
                    </button>
                </div>
                <div class="btn-group wishlist">
                    <button  class="btn btn-warning btn-block text-center" id="{{$shop->id}}" onclick="alert('Please login first!')">
                        {{ __("Add to favorites")}} 
                    </button>
                </div>
                @endif
            </div>
            <div class="container-fluid">       
                <div class="col-md-12 product-info p-4">
                    <nav>
                        <div id="myTab" class="nav nav-tabs nav_tabs">
                            <a class="nav-item nav-link active" href="#service-one" data-toggle="tab">{{ __('DESCRIPTION') }} </a>
                            <a class="nav-item nav-link" href="#service-two" data-toggle="tab">{{ __('PROPERTIES') }} </a>
                            <a class="nav-item nav-link" href="#service-three" data-toggle="tab">{{ __('USES') }} </a>
                        </div>  
                    </nav>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade show active" id="service-one">
                            <section class="container product-info">
                            <p class="text-justify">{!!$shop->description!!}</p>
                            </section>               
                        </div>
                        <div class="tab-pane fade" id="service-two">
                            <section class="container product-info">
                            <p class="text-justify">{!!$shop->properties!!}</p>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="service-three">
                            <p class="text-justify">{!!$shop->uses!!}</p>   
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="py-5"></div>
<script>
function btnAddCart(param){
    var product = param;
    var url = "{{ url(app()->getLocale().'/add-to-cart/') }}"+'/'+product;  

    let axiosConfig = {
		headers: {
			'Content-Type' : 'application/json; charset=UTF-8',
			'Accept': 'Token',
			"Access-Control-Allow-Origin": "*",
		}
    };

    axios({
      method: 'post',
      url: url,
      headers: axiosConfig,
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
            "product": product
      }
    })
   .then(response => {
        $("#cart-button").load(" #cart-button > *");
        $("#exampleModal").modal("show");

        var myModal = $("#exampleModal");  //automatically hides modal after 3 seconds
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 5000));
   })
   .catch(function (error) {
    	console.log(error);
  })  
}





</script>
@endsection
