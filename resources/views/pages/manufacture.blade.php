@extends('layouts.master')
@section('title')
<title>{{ __('The manufacture process') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="process-title">
    <h1>{{ __('The manufacture process') }}</h1>
</div>
<section id="descriere">
    <div class="bg-text">
        <h3 class="text-centrat mt-5">{{ __('The process by which lavender essential oil is obtained consists of several stages:')}} </h3>
            <p class="text-centrat"> {{ __('The first step is to harvest lavender flowers, which is done manually at the moment, twice a year. The first harvest takes place in July and is the richest harvest,') }}<br> {{ __('and the second one takes place in September, but it is considerably smaller than the previous one.') }}
        </p>
        <div class="container">
                <iframe class="videoclip" src="https://www.youtube.com/embed/690nVZoRM5g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>              
                <p class="text-prelucrare"><span class="process-text"> {{ __('As soon as the lavender flowers were harvested,') }}</span> {{ __('the distillation process begins by which the water with the essential oil is obtained. This method is quite complex. Lavender flowers are placed in a container with a capacity of 1000 liters, so that it is well compressed so that no air remains.') }} 
                <br> {!! __('In another smaller container, the water is heated through the wood burning system, and when it has reached a sufficiently high temperature, the steam is released through an airtight tube into the lavender container. Thus, the steam passes through the lavender flowers, extracts the oil and the essence from them, and through another hermetic tube they reach a third container, filled with cold water, where through condensation it transforms into floral water and oil. <br> The latter are collected in a smaller vessel. Due to the much higher density of the oil, these two compositions do not mix, the oil remaining on the surface, which makes it very easy to separate the oil.') !!}
                </p>
                <p class="text-prelucrare">
                    <span class="process-text">{{ __('The whole') }}</span> {{ __('idea is to turn water from liquid into steam (steam) so that it can rise through the vessel laden with flowers. Due to the high temperature of the steam and the tightly closed container, the lavender buds (calyx) are stimulated to release their essential oils.') }} <br>
                    {{ __('The third container to which the system is connected is called a condenser, which has the role of cooling the pipe containing the steam and the particles of essential oil. Due to its cold water content, the steam passes from the gas state to the liquid state, through the condensation process. The water around the condenser coil heats up during this process, so we have hot water coming out of the tap at the top of the condenser. Hot water is replaced by cold water entering the bottom of the condenser vessel. This allows the condenser to cool the steam gradually. After it cools and returns to the liquid, it drains from the end of the condenser into our separating funnel.') }}
                </p>
                <p class="text-prelucrare"> {{ __('This is the process of processing lavender flowers. Of course, it differs from region to region and from producer to producer.')}} </p>
        </div>
    </div>
</section>
@endsection