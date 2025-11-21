<div class="pt-2 pt-md-2 container">
    <div class="row bg-white">
        <div class="col-12">
            <div id="map" style="min-height:25vh;width:100%; margin:10px; border-radius:15px;"></div>
        </div>
    </div>
</div>

@push('js')
    <script>
        let center = {!! json_encode($center) !!};
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_GOOGLE_MAPS_ACCESS_TOKEN2') }}"></script>

    <script>
          const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: center,
        disableDefaultUI: true,
        panControl: false,
        zoomControl: true,
        scaleControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        MapTypeControl: false,
        fullScreenControl: false,
        streetViewControl: false,
        OverviewMapControl: false,
        mapTypeControlOptions: false
    });
    const marker = new google.maps.Marker({
        position: { lat: center.lat, lng: center.lng },
        map
    });

    </script>
@endpush
