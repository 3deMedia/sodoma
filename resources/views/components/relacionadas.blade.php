<div class="container mt-6"><h2 class="mcolor border-bottom border-mcolor">Escorts de la zona</h2>
<div class="row my-4"><div class="d-flex flex-wrap mx-auto">
@foreach ($relacionadas as $scrt)
@php $mainPhoto = $scrt->MainPhoto(); @endphp
<div class="p-2 rounded text-center profile-view2"><div class="bg-white">
<a href="{{ route('show-escorts', [$scrt->Address->City->slug,$scrt->uid]) }}" class="w-100 ">
<div style="width: 100%; position: relative;"  class="@if($scrt->is_vip) corner @endif" >
<div  @if($scrt->verified) class="verified" @endif><img loading="lazy" src='{{ asset("storage/escort_photos/$mainPhoto->path/$mainPhoto->filename") }}' alt="{{ $scrt->name }}" /></div></div></a>
<p class="profile-name">{{ $scrt->name }} <br /><span class="profile-under">
@if (!empty($scrt->Features->age)) <i class="fa fa-square-full icosquare"></i> {{ $scrt->Features->age }} años @endif
@if (!empty($scrt->Features->height)) <i class="fa fa-square-full icosquare mleft"></i> {{ $scrt->Features->height }} cm @endif
{{-- @if (!empty($scrt->Rates->one_hour))<i class="fa fa-square-full icosquare mleft"></i> {{ $scrt->Rates->one_hour }} €@endif  --}}
</span>
</p></div></div>
@endforeach
</div></div></div>
