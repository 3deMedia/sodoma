<x-app-layout>
    <div class="container">
        <div class="col-12">
            <h2 class="fw-bold mb-4 text-center">{{__('general.agencydata')}}</h2>
            <p class="text-center">{{__('general.completeagdata')}}</p>
        </div>
        <div class="row mt-4">
            <div class="col-12 mx-auto">

                @php
                    $admin=false
                @endphp
                @if (!$profile)
                    <x-forms.create-agency :admin="$admin"/>
                @else
                    <x-forms.update-agency :admin="$admin" :profile="$profile"/>
                @endif

            </div>
        </div>
        @push('js')

     <script
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P3fvbshvJOW8re3caz4gqAqi8CwZUmI&libraries=places"

   ></script>

   <script src="{{mix('js/profileform.js')}}"></script>

@endpush
    </div>
</x-app-layout>
