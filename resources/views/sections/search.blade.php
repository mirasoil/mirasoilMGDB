<div class="row align-items-center">
    <div class="col">
      <a href="{{ route('/', app()->getLocale()) }}">
      <img src="{{URL::asset('/img/Logo-mirasoil.png')}}" alt="Logo"  width="100"></a>
    </div>
    <div class="col"> 
        <input type="search" id="search" class="form-control" placeholder="{{ __('Search product') }}" style="margin-left:-2rem;width:10rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/> 
        <div class="dropdown-menu" aria-labelledby="search" id="suggestions">
        <!--Search result items -->
        </div>
    </div>
    <button type="button" class="btn btn-primary inline" style="margin-left:-0.9rem;" id="searchBtn">
        <i class="fas fa-search"></i>
    </button> 
</div>

<script type="text/javascript">
$('#search').on("keyup", function() {
    value = $('#search').val();
    novalue = "{{ __('Product not found!') }}"
    if(value != ""){
        $.ajax({
            type : 'get',
            url : "{{URL::to(app()->getLocale().'/search')}}",
            data:{'search':value},
            success:function(data){
                 $('#suggestions').html(data); 
                //$('#suggestions').append(data);
            }
        });
    }else {
        $('#suggestions').html(novalue);
    }
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>