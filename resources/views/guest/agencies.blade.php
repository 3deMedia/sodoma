<x-guest-layout>
    @push('meta')
        <meta name="description" content="{{$seo->seo_description}}" />
        <title>{{config('app.name')}} | {{$seo->seo_title}}</title>
    @endpush
    <div class="container" style="min-height: 70vh">
        <div class="row">
            <div class="col-12 text-center mt-6">
                <h1 class="text-center mcolor display-3">Agencias</h1>
            </div>
            @foreach ($agencies as $agen)

            @php
                $photo= $agen->MainPhoto();
            @endphp
            <div class="col-12 col-sm-6 col-lg-6 my-2">
                <div class="bg-white shadow-lg p-2 rounded text-center">
                    {{-- <a href="{{ route('show-an-agency',$agen->uid) }}" class="w-100 @if($agen->is_vip) corner-agen @endif"> --}}
                        <a href="{{ route('show-an-agency',$agen->uid) }}">
                        <div><img src='{{asset("storage/agency_photos/$photo->path/$photo->filename")}}' height="100" alt="{{$agen->name}}"></div></a>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</x-guest-layout>

