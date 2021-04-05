<div class="row align-items-center">
  <div class="col"><a href="{{ route('/', app()->getLocale()) }}"><img src="{{URL::asset('/img/Logo-mirasoil.png')}}" alt="Logo"  width="100"></a></div>
  <div class="col"> <input type="search" id="search" class="form-control" placeholder="{{ __('Search product') }}" style="margin-left:-2rem;width:10rem;" /> </div>
    <button type="button" class="btn btn-primary d-inline-block" style="margin-left:-0.9rem;">
        <i class="fas fa-search"></i>
    </button> 
    <span id="suggestions"></span>
    <span id="suggestions"></span>
    <span id="suggestions"></span>
</div>

<script type="text/javascript">
$('#search').on('keyup',function(){
    value = $(this).val();
    novalue = "{{ __('Product not found!') }}"
    if(value != ""){
        $.ajax({
            type : 'get',
            url : "{{URL::to(app()->getLocale().'/search')}}",
            data:{'search':value},
            success:function(data){
                $('#suggestions').html(data); 
            }
        });
    }else {
        $('#suggestions').html(novalue);
    }
})
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>