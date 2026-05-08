<x-guest-layout>
    @push('meta')
    <meta name="description" content="{{$seo->seo_description}}" />
    <title>{{$profile->name}}</title>
@endpush
@php
$photo=$profile->MainPhoto()
 @endphp
    <div class="container pt-5 pt-md-6">
        <div class="col-12">
            <img id="previewer" src={{ asset("storage/agency_photos/$photo->path/$photo->filename") }} alt="{{$profile->name}}"  class="w-100" />
      </div>
        <div class="row">
            <div class="col-12 fw-bold mt-4">
                <div class="row">
                    <div class="col-12 col-lg-6">

                          <img id="previewer" width="100%"
                          src={{ asset("storage/agency_photos/$photo->path/$photo->filename") }}  alt="{{$profile->name}}" />

                    </div>
                    <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                        <h1>{{$profile->name}}</h1>
                        <p><a href="tel:{{$profile->phone}}"><i class="fa fa-phone"></i> {{$profile->phone}}</a></p>
                        <p><a href="{{$profile->web}}" target="_blank" rel="nofollow noopener noreferer">{{$profile->web}}</a></p>
                    </div>
                </div>
                <div class="mt-4">
                <p>{{$profile->description}}</p>
                </div>
                <div class="col-12 col-lg-4">
                    <h4 class="fs-4 fw-bold mcolor border-bottom border-mcolor w-100 pt-4">{{ __('general.map') }}</h4>
                    {{-- MAPA ESCORTS --}}
                    <x-mapa-escort :center="$center"/>
                </div>

                @if ($profile->Escorts()->count()>0)
                <div class="row">

                    <h4 class=" mcolor display-4 w-100 border-bottom pt-4 mb-2">Escorts</h4>
                    <div class="col-12 d-flex flex-wrap">
                        @foreach ($profile->Escorts() as $scrt)
                        @if($scrt->approved && $scrt->active)
                        <p class="profile-name">{{ $scrt->name }} </p>
                        <div class="shadow-lg p-2 rounded text-center profile-view">
                            <div>
                                <a href="{{ route('show-escorts', $scrt->Address->Region->slug,$scrt->uid)}}" class="w-100 ">
                                    <div style="width: 100%; position: relative;" @if($scrt->is_vip) class="corner" @endif>
                                        @php
                                            $image=$scrt->Mainphoto()->filename;
                                            $path= $scrt->Mainphoto()->path;
                                        @endphp
                                        <img loading="lazy" src='{{ asset("storage/escort_photos/$path/$image") }}'>
                                          <p class="profile-name">{{ $scrt->name }} </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
                @else
                    no tiene escorts
                @endif

            </div>
        </div>
    </div>
</x-guest-layout>
