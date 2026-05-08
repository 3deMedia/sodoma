<div class="container"><div class="l-topbanner"><div class="row">
<div class="col-12 col-lg-6 px-0"><h1 class="h1home">Escorts de Lujo</h1>
<p class="phome">Directorio de escorts de alto standing con muchas chicas jóvenes y preciosas, disponibles hoy en tu ciudad. Secrets es el portal de contactos relax donde están las mejores escorts de lujo, señoritas de compañía, independientes, agencias, pisos y clubs.</p>
</div>
<div class="col-12 col-lg-6 px-0">
<a class="pt-2 pt-sm-0" href="{{ route('register') }}"><img src="{{ asset('images/escorts-de-lujo-anuncio.jpg') }}" style="width:100%;" alt="Directorio de Escorts de Lujo" /></a>
</div></div></div>
{{-- <div class="row my-4"> <div class="d-flex flex-auto" >
@php
$agencies_left=App\Models\Profile::where('is_vip',0)->where('type_id',2)->get()->random(0);
$n = '0';
@endphp
@foreach ($agencies_left as $item_left)
@php
$n = $n+1;
@endphp
<div class="topban-{{$n}}" style="margin:0 auto;">
<a href="{{route('show-an-agency',$item_left->uid)}}">
<img src="{{asset('storage')}}/agency_photos/{{$item_left->MainPhoto()->path}}/{{$item_left->MainPhoto()->filename}}" alt="" />
</a></div>
@endforeach
</div></div></div> --}}
