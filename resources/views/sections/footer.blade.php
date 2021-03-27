<!-- Footer -->
<section id="footer-section" class="pt-5">
<footer>
    <div class="footer-wrap">
    <div class="container first_class">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <h3>{{ __('Be the first one that finds out!') }}</h3>
                    <p>{{ __('Subscribe to our newsletter.') }}</p>
                </div>
                <div class="col-md-4 col-sm-6" id="subscribe-container">
                <form method="post" action="{{url(app()->getLocale().'/newsletter')}}" class="newsletter">
                    @csrf
                    <input type="text" name="email" placeholder="Email Address"> 
                    <button class="newsletter_submit_btn" type="submit"><i class="fa fa-paper-plane"></i></button>  
                </form>
                <br>
                @if (\Session::has('subscribe-success'))
                <div class="alert alert-success">
                <p>{{ \Session::get('subscribe-success') }}</p>
                </div><br />
                @endif
                @if (\Session::has('subscribe-failure'))
                <div class="alert alert-danger">
                <p>{{ \Session::get('subscribe-failure') }}</p>
                </div><br />
                @endif
                </div>
                <div class="col-md-4 col-sm-6">
                <div class="col-md-12">
                    <div class="standard_social_links">
                <div>
                    <li class="round-btn btn-facebook"><a href="https://www.facebook.com/mirasoil16/"><i class="fab fa-facebook-f"></i></a>

                    </li>
                    <li class="round-btn btn-linkedin"><a href="https://ro.pinterest.com/mirasoilproduction/"><i class="fab fa-pinterest" aria-hidden="true"></i></a>

                    </li>
                    
                    <li class="round-btn btn-instagram"><a href="https://www.instagram.com/mirasoil16/"><i class="fab fa-instagram" aria-hidden="true"></i></a>

                    </li>
                    <li class="round-btn btn-whatsapp"><a href="https://www.google.com/maps/place/Mirasoil+-+produse+naturale+din+lavanda/@46.3682234,23.6984833,17z/data=!4m8!1m2!2m1!1sMirasoil+!3m4!1s0x47495b1cddbd8c7f:0xc5717c5adb87f1ba!8m2!3d46.3684154!4d23.700494"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></a>

                    </li>
                    
                </div>
            </div>  
                </div>
                    <div class="clearfix"></div>
                <div class="col-md-12"><h3 style="text-align: right;">{{ __("Let's be friends") }}</h3></div>
                </div>
            </div>
    </div>
        <div class="second_class">
            <div class="container second_class_bdr">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="footer-logo">
                        <img src="{{ url('img/Logo-mirasoil.png') }}" width="100" height="100" alt="logo" class="ml-5">
                    </div>
                    <p>{{ __('Your favorite products are now online!') }}</p>
                    <div itemscope itemtype="http://schema.org/LocalBusiness" class="d-none">

                        <p itemprop="name">MIRASOIL</p>

                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <p itemprop="streetAddress">Str. Principală, Nr. 130</p>
                            <p itemprop="addressLocality">Miraslău</p>
                            <p itemprop="addressRegion">Alba</p>
                            <p itemprop="postalCode">515470</p>
                        </div>
                        <p itemprop="telephone">0754916986</p>
                        <meta itemprop="latitude" content="46.361340"/>

                        <meta itemprop="longitude" content="23.705730"/>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <h3>{{ __('Quick access') }}</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url(app()->getLocale()) }}">{{ __('Home') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/about') }}">{{ __('About us') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/shop') }}">{{ __('Products') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'#contact') }}">{{ __('Contact') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/info') }}" target="_blank">{{ __('Terms') }} &amp; {{ __('Conditions') }}</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h3>{{ __('Our products') }}</h3>
                    @if(Auth::guard('admin')->check())
                    <ul class="footer-category">
                        <li><a href="{{ url(app()->getLocale().'/products/ulei') }}">{{ __('Oil') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/products/hidrolat') }}">{{ __('Floral water') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/products/sapun') }}">{{ __('Soap') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/products/sirop') }}">{{ __('Syrup') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/products/buchete') }}">{{ __('Bouquettes') }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="footer-category">
                        <li><a href="{{ url(app()->getLocale().'/details/ulei') }}">{{ __('Oil') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/details/hidrolat') }}">{{ __('Floarl water') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/details/sapun') }}">{{ __('Soap') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/details/sirop') }}">{{ __('Syrup') }}</a>
                        </li>
                        <li><a href="{{ url(app()->getLocale().'/details/buchete') }}">{{ __('Bouquettes') }}</a>
                        </li>
                    </ul>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h3>{{ __('Events') }}</h3>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('Photo sessions') }}</a>
                        </li>

                        <!-- <li><a href="#">Jobs &AMP; Internship Fair 2019</a>
                        </li> -->
                    </ul>
                </div>
            </div>
            
        </div>
        </div>
        
        <div class="row">
            
            <div class="container-fluid">
            <div class="copyright"> Copyright 2021 Teodora Ispas | All Rights Reserved </div>
            </div>
            
        </div>
    </div>
</footer>
</section>
<!--footer end-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
<!-- Font Awesome 5 links-->
<script src="https://kit.fontawesome.com/fddf5c0916.js" crossorigin="anonymous"></script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!--NavBar Script-->
<script>
    $('#errorSystem').modal('show');
</script>
<script type="text/javascript">
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});
$(document).ready(function () {
    $('#sidebarCollapseRight').on('click', function () {
                $('#sidebar-right').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
</script>
