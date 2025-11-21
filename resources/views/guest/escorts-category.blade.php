<x-guest-layout>
@push('meta')
<title>{{$seo->seo_title}}</title>
<meta name="description" content="{{$seo->seo_description}}" />
@endpush
<div class="container">
@if (Route::is('show-escorts'))
<div class="row">
<div class="col-12"><h1>{{request()->path()}}</h1></div>
<div class="col-12"><p>Primera descirpcion categoria</p></div></div>
@endif
<div class="row">
<div class="col-12"><h1>{{request()->path()}}</h1></div>
<div class="col-12"><p>Descirpcion categoria</p></div></div>
@foreach ($grouped_escorts as $escort_group)
<div class="row my-4">
<div class="col-12 d-flex flex-wrap px-0">
@foreach ($escort_group->shuffle() as $scrt)
@php
$mainPhoto = $scrt->MainPhoto();
@endphp
<div class="shadow-lg p-2 rounded text-center profile-view">
<div class="bg-white"><a href="{{ route('show-escorts', [$scrt->Address->Region->slug,$scrt->uid]) }}" class="w-100 ">
<div style="width: 100%; position: relative;" @if ($scrt->is_vip) class="corner" @endif>
<div  @if($scrt->verified) class="verified" @endif>
<img loading="lazy" src='{{ asset("storage/escort_photos/$mainPhoto->path/$mainPhoto->filename") }}' alt="{{ $scrt->name }}" /></div>
<div class="custom-layer" style="display: none">
<div class="description">
<ul><li>{{ __('forms.profile.age')}}<span class="text-white">{{ $scrt->Features->age }}</span> </li>
<li>{{ __('forms.profile.height')}}:<span class="text-white">{{ $scrt->Features->height }} cm</span> </li>
<li>{{ __('forms.profile.eye_color')}}:<span class="text-white">@php $eyes= $scrt->Features->Eyes()@endphp {{ __("forms.profile.$eyes") }}</span> </li>
<li>{{ __('forms.profile.Hair_color')}}:<span class="text-white">@php $hair= $scrt->Features->Hair() @endphp {{ __("forms.profile.$hair") }}</span> </li>
<li>{{ __('forms.profile.Ethnicity')}} :<span class="text-white">@php $etnic= $scrt->Features->Ethnic() @endphp {{ __("forms.profile.$etnic") }}</span> </li>
<li>{{ __('forms.profile.eye_color')}}:<span class="text-white">{{ $scrt->Features->weight }} kg</span> </li>
</ul></div></div></div></a>
<p class="profile-name">{{ $scrt->name }} </p></div></div>
@endforeach
</div></div>
@endforeach
@push('js')
<script defer>$('.profile-view').hover(function() { let elem = $(this).find('.custom-layer'); elem.slideToggle('normal') }, function() { let elem = $(this).find('.custom-layer'); elem.slideToggle('normal') })</script>
 @endpush
</div>
</x-guest-layout>
