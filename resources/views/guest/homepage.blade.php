<x-guest-layout>
    @push('meta')
    <meta name="description" content="{{$seo->seo_description}}" />
    <title>{{$seo->seo_title}}</title>
@endpush
@include('guest.layouts.bannerstop')
@include('guest.layouts.filtros')
<div class="container">
    @if (Route::is('show-escorts'))
    @php
        $category=str_replace("-","",stristr(request()->path(),"-"));
        $title=str_replace("-"," ",request()->path());
        $cat_record= App\Models\Categtext::where('name',$category)->first();
        $default_text = App\Models\Categtext::where('name','default')->first();
    @endphp
    <div class="row pt-4">
        <div class="col-12 px-0 htext">
            <h1>{{$title}}</h1>
        </div>
        <div class="col-12 px-2">
            @if ($cat_record && $cat_record->description_1)
            <p>{!! nl2br($cat_record->description_1) !!}</p>
          @else
          <p>{!! nl2br($default_text->description_1) !!}</p>
            @endif

        </div>
    </div>
    @endif
    @foreach ($grouped_escorts as $escort_group)
    <div class="row my-4">
        <div class="col-12 d-flex flex-wrap px-0">
            @foreach ($escort_group->take(10) as $scrt)

                @php
                    $mainPhoto = $scrt->MainPhoto();

                @endphp
{{-- @dd($mainPhoto) --}}
                    <div class="p-2 rounded text-center profile-view">
                        <div class="bg-white">
                            <a href="{{ route('show-escorts', [$scrt->Address->Region->slug,$scrt->uid]) }}" class="w-100 ">
                                <div style="width: 100%; position: relative;" @if ($scrt->is_vip) class="corner" @endif>
                                    <img loading="lazy" src='{{ asset("storage/escort_photos/$mainPhoto->path/$mainPhoto->filename") }}' alt="{{ $scrt->name }}" />

                                </div>
                            </a>
                            <p class="profile-name">{{ $scrt->name }} <br /><span class="profile-under">
                                 @if (!empty($scrt->Features->age)) <i class="fa fa-square-full icosquare"></i> {{ $scrt->Features->age }} años @endif
                                 @if (!empty($scrt->Features->height)) <i class="fa fa-square-full icosquare mleft"></i> {{ $scrt->Features->height }} cm @endif
                                 @if (!empty($scrt->Rates->one_hour))<i class="fa fa-square-full icosquare mleft"></i> {{ $scrt->Rates->one_hour }} €@endif </span></p>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endforeach

@if (Route::is('show-escorts'))
<div class="row">
    <div class="col-12 px-0">
        @if ($cat_record && $cat_record->description_2)
        <p>{!! nl2br($cat_record->description_2) !!}</p>
     @else
     <p>{!! nl2br($default_text->description_1) !!}</p>
     @endif
    </div>
</div>
@endif
</div>
</x-guest-layout>
