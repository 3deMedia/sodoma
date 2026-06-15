<x-admin-layout>
    @php
        $type_text = intval($type) == 1 ? 'escort' : 'agencia';

    @endphp

    <div class="container-fluid pt-5 px-2 mb-4">
        <div class="row py-4">
            <h2> Crear Usuario tipo {{$type_text}}</h2>
        </div>
        @php
            $admin = true;
        @endphp
        @if($type == 1)
            <x-forms.create-escort :admin="$admin" :agency="false" />
        @else
            <x-forms.create-agency :admin="$admin" />
        @endif

        @push('js')
            <script src="{{mix('js/profileform.js')}}"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=@php $api_key = env('MAPS_GOOGLE_MAPS_ACCESS_TOKEN2');
            echo $api_key . '&loading=async&libraries=places';@endphp" async></script>
        @endpush
    </div>


</x-admin-layout>