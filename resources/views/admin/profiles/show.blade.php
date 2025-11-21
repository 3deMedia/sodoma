<x-admin-layout>

    <div class="container-fluid mb-4 py-4 mt-4">

        @if (session('success'))
            <div class="bg-success p-3 my-2 w-100 rounded text-white">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-danger p-3 my-2 w-100 rounded text-white">{{ session('error') }}</div>
        @endif
          <x-admin-top-buttons :profile="$profile" :agencycost="$agency_cost" :escortcost="$new_escort_cost" />
          <div class="row">
            <div class="col-12">
                <div class="p-2 rounded border">
                    <p>El coste vip para escorts es de {{$new_escort_cost}}, y el usuario tiene {{ $profile->User->coins}} coins;</p>
                    <p>Al crear el Vip no se descuentan coins, ya puede haber hecho transferencia. SI es necesario quitar coins quitar desde el boton "Ver usuario"</p>

                    @if($profile->Owner)
                    Este perfil pertenece a la agencia  <a href="{{route('admin-profile-show',$profile->id)}}"> {{ $profile->Owner->name }}</a>
                    @else
                    Este perfil es una escort independiente
                    @endif
                </div>

            </div>

          </div>


        <div class="row">
            <div class="col-12 col-md-10 col-xl-8 pt-3">

            @php
                $admin = true;
            @endphp

            @if ($profile->type_id == 1)
                <x-forms.update-escort :profile="$profile" :admin="$admin" :agency="null" />
            @else
                <x-forms.update-agency :profile="$profile" :admin="$admin" />
            @endif

        </div>
    </div>

    @push('js')
        <script>
            $('.profile-image').on('click', function() {
                $('.profile-image').removeClass('profile-main-image');
                $(this).addClass('profile-main-image')
                let photo_id = $(this).attr('data-render');
                $('input[name=main_photo]').val(photo_id)
            });
        </script>

    <script src="{{mix('js/profileform.js')}}"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P3fvbshvJOW8re3caz4gqAqi8CwZUmI&callback=initAutocomplete&libraries=places"
    async
   ></script>

    @endpush

</x-admin-layout>
