<x-guest-layout>
@push('meta')
<title>{{ $profile->name }} - Escort en {{ $profile->Address->Region->name }} - Secrets</title>
<meta name="description" content="{{ substr($profile->description, 0, 200) }}" />
@endpush
<div class="pt-2 pt-md-2 container" style="min-height:75vh;">
<div class="row bg-white"><div class="w-100"><div class="d-flex flex-wrap putas">
@php $main_images = $profile->Photos->where('approved', 1)->take(2); @endphp
@foreach ($main_images as $key => $mimage)
<div class="col-12 col-sm-6 px-0 flex flex-row" data-nav="thumbs"><img src="{{ asset("/storage/escort_photos/$mimage->path/$mimage->filename") }}" alt="" data-fit="contain" data-width="100%" data-height="auto"></div>
@endforeach </div></div>
<div class="breaddiv w-100 mr-3">
<ul class="breadcrumb_scor" itemscope="" itemtype="http://schema.org/BreadcrumbList">
<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href="{{ route('show-all-escorts') }}"><span itemprop="name">Escorts</span></a><meta itemprop="position" content="1"> ></li>
<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href="{{ route('show-escorts', $profile->Address->City->slug) }}"><span itemprop="name">{{ $profile->Address->City->name }}</span></a><meta itemprop="position" content="2"></li>
<li class="active"><span>{{ $profile->name }}</span></li>
</ul></div>
<div class="row w-100 px-1 px-md-2"><h1 class="fs-3 fw-bold mcolor">{{ $profile->name }}</h1></div>
<div class="row w-100 px-0">
    {{-- <div class="col-md-6 mb-4 mb-md-0 px-2"><div class="pt-2"><strong>Escort en {{ $profile->Address->City->name }}</strong><br />{{ __('forms.profile.1h') }} {{ $profile->Rates->one_hour }} €</span> --}}
<div class="col-md-6 mb-4 mb-md-0 px-2"><div class="pt-2"><strong>Escort en {{ $profile->Address->City->name }}</strong></span>
@if ($profile->Features->private_apartament == 1)
<span> | <i class="fa fa-home"></i> {{ __('forms.profile.private_apartment') }}</span>
@endif
</div></div>
<div class="col-md-6 px-2 place-items-center">
<div class="botsficha bottel"><a href="tel:0034{{ $profile->phone }}">{{ __('forms.profile.callme') }}<br /><i class="fa fa-phone"></i> {{ $profile->phone }}</a></div>
<div class="botsficha botwhats"><a href="https://api.whatsapp.com/send?phone=34{{ $profile->phone }}&text=Consulta sobre {{ $profile->name }}">{{ __('forms.profile.attended') }}<br /><img src="{{ asset('images/whatsapp.png') }}" /> Whatsapp</a></div></div></div>
<div class="col-12 pt-4 px-2"><div>{!! $profile->description!!}</div>
@if ($profile->is_vip == 1)
@if (!empty($profile->web))
<p>Puedes visitar mi página Web: <a href="{{ $profile->web }}">{{ $profile->web }}</a></p>
@endif @endif </div>
<div class="d-flex flex-wrap w-100 pt-3">
@if ($profile->is_vip == 1) <div class="col-12 col-lg-4"> @else
<div class="col-12 col-lg-6"> @endif
<h4 class="fs-4 fw-bold mcolor border-bottom border-mcolor w-100 pt-3">{{ __('general.data') }}</h4>
<table class="table">
<tbody>
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.age') }}</td><td class="border-0">{{ $profile->Features->age }}</td></tr>
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.height') }}</td><td class="border-0">{{ $profile->Features->height }}</td></tr>
@if (!empty($profile->Features->eye_color_id))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.eye_color') }}</td><td class="border-0">{{ $profile->Features->Eyes() }}</td></tr>
@endif
@if (!empty($profile->Features->Hair()))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.Hair_color') }}</td><?php $hair = $profile->Features->Hair(); ?><td class="border-0"> {{ __("forms.profile.$hair") }}</td></tr>
@endif
@if (!empty($profile->Features->weight))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.weight') }}</td><td class="border-0">{{ $profile->Features->weight }}</td> </tr>
@endif
@if (!empty($profile->Features->breast_size))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.breast_size') }}</td><td class="border-0">{{ $profile->Features->breast_size }}</td></tr>
@endif
@if ($profile->Features->breast_type == 1)
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.breast_type') }}</td><td class="border-0">Natural</td></tr>
@endif
</tbody></table></div>
@if ($profile->is_vip == 1)
<div class="col-12 col-lg-4">
@else
<div class="col-12 col-lg-6">
@endif
<h4 class="fs-4 fw-bold mcolor border-bottom border-mcolor w-100 pt-4">{{ __('general.rates') }}</h4>
<div class="table-responsive">
<table class="table align-items-center table-flush rounded">
<tbody class="list">
@if (!empty($profile->Rates->half_hour))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.30min') }}</td><td class="border-0">{{ $profile->Rates->half_hour }} </td></tr>
 @endif
 <tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.1h') }}</td><td class="border-0">{{ $profile->Rates->one_hour }} €</td></tr>
@if (!empty($profile->Rates->added_hour))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.1h+') }}</td><td class="border-0">{{ $profile->Rates->added_hour }} €</td></tr>
@endif
@if (!empty($profile->Rates->half_day))
<tr><td scope="row" class="fw-bold  border-0">{{ __('forms.profile.12h') }}</td><td class="border-0">{{ $profile->Rates->half_day }} €</td></tr>
@endif
@if (!empty($profile->Rates->one_day))
<tr><td scope="row" class="fw-bold border-0">{{ __('forms.profile.24h') }}</td><td class="border-0">{{ $profile->Rates->one_day }} €</td></tr>
@endif
</tbody></table></div>
<div class="row px-2">
@if ($profile->Features->creditcard_acceptance == 1)
<div class="w-50 featser"><span><i class="fa fa-credit-card"></i> {{ __('forms.profile.paycard') }}</span></div>
@endif
@if ($profile->Features->is_pornstar == 1)
<div class="w-50 featser"><span><i class="fa fa-mobile"></i> {{ __('forms.profile.paybizum') }}</span></div>
@endif
</div></div>
@if ($profile->is_vip == 1)
<div class="col-12 col-lg-4 pt-3 pt-md-0"><h4 class="fs-4 fw-bold mcolor border-bottom border-mcolor w-100 pt-4">{{ __('general.map') }}</h4><x-mapa-escort :center="$center" /></div>
@endif
</div></div>
<div class="col-12 mb-6 px-2 pt-3 pt-md-0"><h4 class="fs-4 fw-bold mcolor border-bottom border-mcolor w-100 pt-3">{{ __('forms.profile.services') }}</h4>
@php
$services = DB::table('services')->get();
@endphp
<ul class="ulservices mt-3">@foreach ($services as $service) @if (in_array($service->id, $profile->Features->services))<li>{{ __("forms.services.$service->name") }}</li>@endif @endforeach</ul></div>
<div class="w-100"><div class="d-flex flex-wrap putas">
@if ($profile->is_vip || $is_ignored)
@php
$other_images = $profile->Photos->where('approved', 1)->skip(2);
@endphp
@foreach ($other_images as $key => $oimage)
@if ($oimage->orientation == 'portrait')
<div class="col-12 col-sm-6 px-0 flex flex-row" data-nav="thumbs"><img src="{{ asset("/storage/escort_photos/$oimage->path/$oimage->filename") }}" alt="{{ $profile->name }}" data-fit="contain" data-width="100%" data-height="auto"></div>
@else
<div class="col-12 px-0 flex flex-row" data-nav="thumbs"><img src="{{ asset("/storage/escort_photos/$oimage->path/$oimage->filename") }}" alt="{{ $profile->name }}" data-fit="contain" data-width="100%" data-height="auto"></div>
@endif @endforeach @endif
</div></div></div>
@if ($related_escorts->count() > 2)
<x-relacionadas :relacionadas="$related_escorts" />
@endif
</x-guest-layout>
