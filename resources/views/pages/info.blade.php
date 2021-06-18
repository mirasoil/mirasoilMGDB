@extends('layouts.master')
@section('title')
<title>{{ __('Customer support - Mirasoil')}}</title>
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
					    <h1 class="page-heading bottom-indent text-center pb-5">{{ __('Useful customer information') }}</h1>
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="cms-block">
									<h3 class="page-subheading text-center pb-4" id="romania">{{ __('Delivery method - important details') }}</h3>
									<p><strong class="dark">{{ __('At this time, all orders processed online are paid') }} <strong> {{ __('courier refund') }} </strong>.</strong></p>
							
									<p>{{ __('Orders are processed by phone, at the email address') }} <a href="mailto:contact@mirasoil.ro">contact@mirasoil.ro</a> {{ __('or by private message on the facebook page you find')}} <a href="https://www.facebook.com/mirasoil16/">{{ __('here') }}</a>.</p>
									<p><strong class="dark">{{ __('In Alba county, for orders under 200 lei, the shipping fee is') }} <strong> 9 lei </strong>.</strong></p>
									<p>{{ __('We use the GLS and FanCourier express courier companies to send parcels.') }}<br /></p>
									<p>{{ __('*Due to the small number of orders processed online, we are obliged to calculate the shipping cost for each order, which is why we encourage you to contact us by phone or by') }} <a href="index.php#contact">{{ __('email address') }}</a>.</p>
									<p>{{ __('*Courier companies are contacted on the day you want to purchase products from us, except on Saturdays and Sundays, not having prior contact with them at this time.') }} </p>
								</div>
							</div>
						    <div class="col-xs-12 col-sm-4">
								<div class="cms-box">
									<h3 class="page-subheading text-center pb-4">{{ __('Frequently asked questions') }}</h3>
									<p><strong class="dark">{{ __('All your questions will be posted in this section') }}</strong></p>
									<p>{{ __('With the help of these questions we try to improve the quality of your visit on our page!') }}<strong></strong> </p>
									<form method = "post" action = "#">
                                    <label for="exampleFormControlTextarea3">{{ __('Post your question:') }}</label>
										<textarea rows="4" cols="35" name="question" id="exampleFormControlTextarea3">{{ __('Insert question here..') }}</textarea>
                                        <br>
										<input type = "submit">
                                    </form>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="cms-box">
								<h3 class="page-subheading text-center pb-4">{{ __('Have you ordered a product from us in the past?') }}</h3>
								<p><strong class="dark">{{ __('Leave us a review!') }}</strong></p>
								<p>{{ __('We want to know your opinion about the experience with our products. Whether you are satisfied or have some dissatisfaction, we encourage you to express your opinion to help others make an impression!') }}</p>
								<ul>
								    <li><p>{{ __('Tell us why you liked/disliked a product') }}</p></li>
								    <li><p>{{ __('Tell us what we could improve') }}</p></li>
								    <li><p>{{ __('Share with us why you would recommend the products to other customers') }}</p></li>
							    </ul>
								<p><strong class="dark">{{ __('There are situations where reviews can be rejected for several reasons:')}}</strong></p>
								<ul>
									<li><p>{{ __('inappropriate language') }}</p></li>
									<li><p>{{ __('use of personal data - avoid including information related to name, address, telephone number, etc.') }}</p></li>
									<li><p>{{ __('non-product related details - for these please contact us at') }} <a href="index.php#contact">{{ __('private') }}</a> </p></li>
								</ul>
								<p><i>{{ __('The site is still under construction, so we recommend that you check it regularly to keep up to date.') }}</i></p>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection