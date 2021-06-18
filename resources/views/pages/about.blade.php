@extends('layouts.master')
@section('title')
<title>{{ __('About us') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
    <div class="titlu-about">
        <h1 class="animate__animated animate__rubberBand animate__repeat-2">{{ __('Our story') }}</h1> 
    </div>
    <div class="text-about">
        <p>
        {{ __('As for us, it all started 4 years ago, in 2016 to be exact, when we decided to make this plantation. On the fertile territory of our area, it was quite difficult to maintain due to the grass growing between the rows, but with a lot of effort we managed to cope with it. In the first year, the production was not high enough but this generally happens in the first year of harvest, and only in the third year will be able to produce a sufficient amount of oil.') }}
        </p>
        <h2>{{ __('Gallery') }}</h2>
    </div>
    <div class="row m-0 p-1">
        <div class="col-3 p-1">
            <img src="../img/lav1.jpg" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav2.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav3.jpg" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav5.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav8.jpg" style="width:100%" onclick="openModal();currentSlide(5)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav7.jpg" style="width:100%" onclick="openModal();currentSlide(6)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav6.jpg" style="width:100%" onclick="openModal();currentSlide(7)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav9.jpg" style="width:100%" onclick="openModal();currentSlide(8)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav32.jpg" style="width:100%" onclick="openModal();currentSlide(9)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav34.jpg" style="width:100%" onclick="openModal();currentSlide(10)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav15.jpg" style="width:100%" onclick="openModal();currentSlide(11)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav11.jpg" style="width:100%" onclick="openModal();currentSlide(12)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav10.jpg" style="width:100%" onclick="openModal();currentSlide(13)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav20.jpg" style="width:100%" onclick="openModal();currentSlide(14)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav36.jpg" style="width:100%" onclick="openModal();currentSlide(15)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav18.jpg" style="width:100%" onclick="openModal();currentSlide(16)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav17.jpg" style="width:100%" onclick="openModal();currentSlide(17)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav22.jpg" style="width:100%" onclick="openModal();currentSlide(18)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav14.jpg" style="width:100%" onclick="openModal();currentSlide(19)" class="hover-shadow cursor">
        </div>
        <div class="col-3 p-1">
            <img src="../img/lav25.jpg" style="width:100%" onclick="openModal();currentSlide(20)" class="hover-shadow cursor">
        </div>
    </div>

    <div id="myModal" class="modal modal-c">
        <span class="close close-c cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content modal-content-c">

            <div class="mySlides">
                <div class="numbertext">1 / 20</div>
                <img src="../img/lav1.jpg" alt="Anul1" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">2 / 20</div>
                <img src="../img/lav2.jpg" alt="Anul2" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">3 / 20</div>
                <img src="../img/lav3.jpg" alt="Anul3" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">4 / 20</div>
                <img src="../img/lav5.jpg" alt="Anul3" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">5 / 20</div>
                <img src="../img/lav6.jpg" alt="Anul3" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">6 / 20</div>
                <img src="../img/lav7.jpg" alt="Anul3" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">7 / 20</div>
                <img src="../img/lav8.jpg" alt="Anul3" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">8 / 20</div>
                <img src="../img/lav9.jpg" alt="Anul3" style="width:100%">
            </div>

            <div class="caption-container">
                <p id="caption"></p>
            </div>
            <div class="mySlides">
                <div class="numbertext">9 / 20</div>
                <img src="../img/lav32.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">10 / 20</div>
                <img src="../img/lav34.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">11 / 20</div>
                <img src="../img/lav15.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">12 / 20</div>
                <img src="../img/lav11.jpg" alt="Anul1" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">13 / 20</div>
                <img src="../img/lav10.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">14 / 20</div>
                <img src="../img/lav20.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">15 / 20</div>
                <img src="../img/lav36.jpg" alt="Anul1" style="width:100%">
            </div><div class="mySlides">
                <div class="numbertext">16 / 20</div>
                <img src="../img/lav18.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">17 / 20</div>
                <img src="../img/lav17.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">18 / 20</div>
                <img src="../img/lav22.jpg" alt="Anul1" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">19 / 20</div>
                <img src="../img/lav14.jpg" alt="Anul1" style="width:100%">
            </div><div class="mySlides">
                <div class="numbertext">20 / 20</div>
                <img src="../img/lav25.jpg" alt="Anul1" style="width:100%">
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="row m-0 bg-dark">
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav1.jpg" style="width:100%" onclick="currentSlide(1)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav2.jpg" style="width:100%" onclick="currentSlide(2)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav3.jpg" style="width:100%" onclick="currentSlide(3)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav5.jpg" style="width:100%" onclick="currentSlide(4)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav6.jpg" style="width:100%" onclick="currentSlide(5)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav7.jpg" style="width:100%" onclick="currentSlide(6)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav8.jpg" style="width:100%" onclick="currentSlide(7)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav9.jpg" style="width:100%" onclick="currentSlide(8)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav32.jpg" style="width:100%" onclick="currentSlide(9)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav34.jpg" style="width:100%" onclick="currentSlide(10)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav15.jpg" style="width:100%" onclick="currentSlide(11)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav11.jpg" style="width:100%" onclick="currentSlide(12)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav10.jpg" style="width:100%" onclick="currentSlide(13)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav20.jpg" style="width:100%" onclick="currentSlide(14)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav36.jpg" style="width:100%" onclick="currentSlide(15)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav18.jpg" style="width:100%" onclick="currentSlide(16)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav17.jpg" style="width:100%" onclick="currentSlide(17)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav22.jpg" style="width:100%" onclick="currentSlide(18)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav14.jpg" style="width:100%" onclick="currentSlide(19)" >
                </div>
                <div class="col-1 p-1">
                    <img class="demo cursor" src="../img/lav25.jpg" style="width:100%" onclick="currentSlide(20)" >
                </div>
            </div>
        </div>
    </div>
    <div class="text-about container">
        <p>
        {{ __('We decided to dedicate our time to this plantation out of love and passion for natural products, which is why we decided to set up a project supported by European funds to spread the quality of our products on the market. In 2019, we have gone through the formalities for inclusion in the project, and this year it will be approved and implemented. Meanwhile, the 3rd year of cultivation brought us some surprises. Due to careful care, the plantation reached in July 2019 the peak year of the harvest, producing more than 30 liters of essential oil, 150 liters of essential oil and more than 200 kg of fire briquettes, obtained from the residues already processed to extract the essential oil. Not long ago we started to create our own image of the company, looking for a suitable name that would represent us further. The process took a long time, despite the expectations, but we can say that it was worth the patience. We tried to we play with several words that represent us and combine them, and this led to the following result:') }}
        </p>

        <div class="rebus-logo">
            <h3>MiraSoil</h3>
            <p class="rebus" style="letter-spacing: 5px;">ARO<span><b>M</b></span>A</p>
            <p class="rebus1" style="letter-spacing: 5px;">TERAP<span><b>I</b></span>E</p>
            <p class="rebus2" style="letter-spacing: 5px;">FLOA<span><b>R</b></span>E</p>
            <p class="rebus3" style="letter-spacing: 5px;">LAV<span><b>A</b></span>NDA</p>
            <p class="rebus4" style="letter-spacing: 5px;"><span><b>S</b></span>APUN</p>
            <p class="rebus5" style="letter-spacing: 5px;">SIR<span><b>O</b></span>P</p>
            <p class="rebus6" style="letter-spacing: 5px;">BR<span><b>I</b></span>CHETE</p>
            <p class="rebus7" style="letter-spacing: 5px;">U<span><b>L</b></span>EI</p>

        </div>
        <p>{{ __('Also') }}, <b>"MIRA"</b> {{ __('stands for the first 4 letters of our village') }}: <b>"MIRASLĂU"</b>, {{ __('but also from the word') }} <b>"MIRACOL"</b>, {{ __('thus having a double meaning, which makes it even more special. As for the word') }} <b>"SOIL"</b>,
            {{ __('it comes from an English word') }}: <b>"SOIL"</b>, {{ __('which means') }} <i> {{ __('the upper layer of the earth, the fertile one, in which the plants grow')}}. </i> {{ __('Also') }}, {{ __('the word') }} <b>"OIL"</b> {{ __('also appears') }}, {{ __('which means the most important part of the whole process production, namely') }}
            <i>{{ __('the essential lavender oil') }}.</i>
        </p>
        <p>{{ __('With that being said, we try to carry on the tradition, respecting the traditions so far, more precisely the manual harvesting and the production of semi-manufactured and finished products by hand, carefully. For more details we are at your disposal on the pages social network where we try to be as active as possible, offering you a wide range of services and recipes that you can prepare yourself at home') }}.<br>
            <p class="bottom-text"> {{ __('Thank you for your attention and support!') }}</p>
        </p>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/about.js') }}"></script>
@endsection