@extends('layouts.master')
@section('title')
<title>{{ __('Natural lavender products') }} - Mirasoil</title>
@endsection
@section('content')
<div class="conatiner">
<section id="animatie">
    <div class="animated-text">
        <span class="animation-text">M</span>
        <span class="animation-text">I</span>
        <span class="animation-text">R</span>
        <span class="animation-text">A</span>
        <span class="animation-text">S</span>
        <span class="animation-text">O</span>
        <span class="animation-text">I</span>
        <span class="animation-text">L</span>
        <h2 class="header-animated">{{ __('Natural lavender products') }}</h2>
    </div>
</section>
<section>
<div id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicator" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block img-fluid w-100" src="../img/slider1cropped.jpg" alt="First slide">
                
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid w-100" src="../img/slider3.1.jpg" alt="Second slide">
                
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid w-100" src="../img/slider4.JPG" alt="Third slide">
                
            </div>
        </div>
        <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
</section>
<!----------------About-------------->
<section id="about">
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ __('About us') }}</h2>
                <div class="about-content">
                    {{ __('As for us, this business is based on our own strengths, passion for lavender and its workmanship. We offer quality, natural products, processed in good conditions and carefully maintained.') }}
                </div>
            </div>
            
            <div class="col-md-6 findButton">
                <a href="{{ url(app()->getLocale().'/about') }}"><button class="findmore"><span>{{ __('Find out more') }} </span></button></a>
            </div>
        </div>
    </div>

</section>
<!--------------Servicii------------>
<section id="services">
        <div class="container">
            <div class="inner-container">
                <h1>{{ __('Manufacturing process') }}</h1>
            </div>
            <div class="row">
                <div class="col-12 col-lg-3 mb-4">
                    <a href="{{ url(app()->getLocale().'/manufacture') }}">
                    <div class="text-center">
                        <div class="card card-body">
                            <div class="icon">
                                <i class="fab fa-pagelines" style="font-size: 64px;"> </i>
                            </div>
                        <h3 class="card-title">{{ __('Harvesting')}}</h3>
                        <p class="card-text">{{ __('Lavender is harvested, and one part is left to dry, while one part goes through the next process.') }}</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-12 col-lg-3 mb-4">
                    <a href="{{ url(app()->getLocale().'/manufacture') }}">
                    <div class="text-center">
                        <div class="card card-body">
                            <div class="icon">
                                <i class="fab fa-pagelines" style="font-size: 64px;"></i>
                            </div>
                            <h3 class="card-title">{{ __('Distillation') }}</h3>
                            <p class="card-text">{{ __('With the help of this process, the floral water is obtained together with the essential oil, and the residues pass to the next process.') }}</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-12 col-lg-3 mb-4">
                    <a href="{{ url(app()->getLocale().'/manufacture') }}">
                    <div class="text-center">
                        <div class=" card card-body">
                            <div class="icon">
                                <i class="fab fa-pagelines" style="font-size: 64px;"></i>
                            </div>
                            <h3 class="card-title">{{ __('Recycling') }}</h3>
                            <p class="card-text">{{ __('Despite the fact that many processed things cannot be recycled, well, our leftovers do!') }}</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div> 
        </div>       
</section>
<!---------------------------Preturi---------->
<section id="price">
    <div class="container">
        <h1> {{ __('Our products') }} </h1>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card card-body">
                        <h2 class="card-title1"> {{ __('Floral water') }}</h2>
                        <p class="card-text">10 lei</p>
                        <p class="card-text">100ml</p>
                        <ul>
                            <li><i class="far fa-check-circle"></i> 100ml</li>
                            <li><i class="far fa-check-circle"></i> 500ml</li>
                            <li><i class="far fa-check-circle"></i> 1l</li>
                        </ul>
                        <a href="{{ url(app()->getLocale().'/details/hidrolat') }}"><button type="button" class="btn btn-primary w-100">{{ __('Details') }}</button></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card card-body">
                        <h2 class="card-title1">{{ __('Essential Oil') }}</h2>
                        <p class="card-text">20 lei</p>
                        <p class="card-text">10ml</p>
                        <ul>
                            <li><i class="far fa-check-circle"></i> 30ml</li>
                            <li><i class="far fa-check-circle"></i> 50ml</li>
                            <li><i class="far fa-check-circle"></i> 100ml</li>
                        </ul>
                        <a href="{{ url(app()->getLocale().'/details/ulei') }}"><button type="button" class="btn btn-primary w-100">{{ __('Details') }}</button></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card card-body">
                        <h2 class="card-title1"> {{ __('Soap') }}</h2>
                        <p class="card-text">5 lei</p>
                        <p class="card-text">100g</p>
                        <ul>
                            <li><i class="far fa-check-circle"></i> 100g</li>
                            <li><i class="far fa-check-circle"></i> 250g</li>
                            <li><i class="far fa-check-circle"></i> 250g</li>
                        </ul>
                        <a href="{{ url(app()->getLocale().'/details/sapun') }}"><button type="button" class="btn btn-primary w-100">{{ __('Details') }}</button></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card card-body">
                        <h2 class="card-title1"> {{ __('Syrup') }}</h2>
                        <p class="card-text">25 lei</p>
                        <p class="card-text">330ml</p>
                        <ul>
                            <li><i class="far fa-check-circle"></i> 330ml</li>
                            <li><i class="far fa-check-circle"></i> 750ml</li>
                            <li><i class="far fa-check-circle"></i> 1l</li>
                        </ul>
                        <a href="{{ url(app()->getLocale().'/details/sirop') }}"><button type="button" class="btn btn-primary w-100">{{ __('Details') }}</button></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card card-body">
                        <h2 class="card-title1"> {{ __('Floral bouquets') }}</h2>
                        <p class="card-text">25 lei</p>
                        <p class="card-text">la comandă</p>
                        <ul>
                            <li><i class="far fa-check-circle"></i> {{ __('small') }} </li>
                            <li><i class="far fa-check-circle"></i> {{ __('medium') }}</li>
                            <li><i class="far fa-check-circle"></i> {{ __('big') }}</li>
                        </ul>
                        <a href="{{ url(app()->getLocale().'/details/buchete') }}"><button type="button" class="btn btn-primary w-100">{{ __('Details') }}</button></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card card-body">
                        <h2 class="card-title1">{{ __('Fire briquettes') }}</h2>
                        <p class="card-text">50 lei</p>
                        <p class="card-text">1kg</p>
                        <ul>
                            <li><i class="far fa-check-circle"></i> </li>
                            <li><i class="far fa-check-circle"></i> 250g</li>
                            <li><i class="far fa-check-circle"></i> 250g</li>
                        </ul>
                        <a href="{{ url(app()->getLocale().'/details/brichete') }}"><button type="button" class="btn btn-primary w-100">{{ __('Details') }}</button></a>
                    </div>
                </div>
            </div>            
    </div>
</section>
@include('sections.contact')
<!---Social--->
<section id="social">
    <div class="container">
        <h2 class="follow">{{ __('Stay tuned!') }} </h2>
        <div class="row">
            <div class="col-md-5 m-3">
                <iframe class="embed-responsive embed-responsive-1by1" id="fbsection" src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fmirasoil16%2Fposts%2F130384935324771" height="611" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
            <div class="col-md-5 m-3">
                <div class="fb-post" data-href="https://www.facebook.com/mirasoil16/posts/172198311143433" data-show-text="true" data-width=""><blockquote cite="https://www.facebook.com/mirasoil16/posts/172198311143433" class="fb-xfbml-parse-ignore"><p>Pachet promoțional: 2 sticluțe de ulei esențial de lavandă + 1 sticluță de apă florală la prețul de 50 de lei..</p>Posted by <a href="https://www.facebook.com/mirasoil16/">MiraSoil</a> on&nbsp;<a href="https://www.facebook.com/mirasoil16/posts/172198311143433">Thursday, September 3, 2020</a></blockquote></div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
