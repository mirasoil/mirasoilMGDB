@extends('layouts.master')
@section('title')
<title>{{ __('Shipping details - Mirasoil')}}</title>
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div id="transport">
         	<div class="columns-container">
				<div id="columns" class="container">
					<div class="row">
						<div id="center_column" class="center_column col-xs-12 col-sm-12">
						<article class="rte">
						<h1 class="page-heading bottom-indent">{{ __('Shipping and delivery') }}</h1>
							<div class="row">
								<div class="col-xs-12 col-sm-4">
									<div class="cms-block">
									<h3 class="page-subheading" id="romania">{{ __('Shipping taxes - Romania') }}</h3>
									<p><strong class="dark">{!! __('On the Romanian territory, we ship orders with products worth <strong>200 lei or more</strong> free of charge') !!}.</strong></p>
									<p class="expediere"><i class="fas fa-truck"></i><span> </span>{{ __('Shipping in 1-3 working days') }}</p>
									<p>{!! __('For any order under 200 lei, the shipping fee of the package is <strong> 25 lei </strong> (VAT included).') !!}</p>
									<p>{!! __('In Alba County, for orders under 200 lei, the shipping fee is <strong> 9 lei </strong> (VAT included).') !!}</p>
									<p>{!! __('We use GLS and FanCourier express courier companies to ship products. <br /> During periods with special discounts or holidays, deliveries may take 2-3 days or even longer.') !!}</p>
									<p>{{ __('*These standard shipping charges do not apply to special orders or those with a very high volume/weight.') }}</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="cms-box">
									<h3 class="page-subheading">{{ __('Where is my order?') }}</h3>
									<p><strong class="dark">{{ __('For future reference, check order status') }}</strong></p>
									<p>{{ __('For various reasons, the delivery of the package may be delayed. You can check the status of your order at any time by visiting the')}} <strong><a href="{{ url(app()->getLocale().'/myorders') }}">{{ __('customer account') }}</a></strong> {{ __('on our site.')}}</p>
									<p>{{ __('If at least 7 working days have passed since placing the order and you have not received the package or you have not been contacted by the courier, please contact us by phone, through the contact section or by email.')}} </p>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="cms-box">
								<h3 class="page-subheading">{{ __('Customer Support')}}</h3>
								<p><strong class="dark">{{ __('If I am not at home on delivery, what happens?')}}</strong></p>
								<p>{{ __('On the day of delivery of the package, the courier will contact you a few hours in advance, usually by phone. If you do not reply and/or cannot be found at the address, the package will be kept in the courier\'s warehouse for approximately 7 days. You can contact the courier company or you can contact us by phone or through the section')}} <a href="{{ url(app()->getLocale().'/#contact') }}">{{ __('contact')}}</a> {{ __('or by') }} <a href="mailto:contact@mirasoil.ro">{{ __('email') }}</a> {{ __('for discussing a new shipping date.')}}</p>
								<p><strong class="dark">{{ __('How do you ship special orders?') }}</strong></p>
								<p>{{ __('Special orders are those orders that contain a large quantity of products or in volumes that are not available for online order directly from the site. The shipping cost and delivery time are set individually for these orders, the customer support team is available by phone, email or contact.')}}</p>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection