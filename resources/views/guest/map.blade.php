<x-guest-layout>
    @push('meta')
        <title>Mapa Escorts en {{ $city->name }}</title>
        <meta name="description"
            content="Mapa de escorts en {{ $city->name }} consulta donde están las mejores escorts en tu ciudad. Escorts más cerca de tí." />
    @endpush
    @include('guest.layouts.filtros')

    <div class="pt-4 pt-md-4 container" style="min-height:75vh;">
        <div class="row bg-white">
            <div class="col-12 px-0 htext">
                <h1>Mapa Escorts en {{ $city->name }}</h1>
                <p>Descubra en nuestro mapa donde se encuentran las acompañantes más cerca de usted. Acompañantes
                    disponibles en su ciudad, zona o barrio.</p>
            </div>
            <div class="w-100">

                <div id="map" style="min-height:70vh;width:100%"></div>
            </div>
            <div class="col-12 px-0 htext">
                <p>En Escorts Secrets se ofrece un servicio discreto y a medida, muy cerca de usted. Escorts y
                    acompañantes de lujo reales y exclusivas.</p>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            let center = {!! json_encode($center) !!};
            let geodata = {!! json_encode($geo_escorts) !!}
        </script>
        <script src="{{ mix('js/maps.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_GOOGLE_MAPS_ACCESS_TOKEN2') }}"></script>
    @endpush



    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->

</x-guest-layout>