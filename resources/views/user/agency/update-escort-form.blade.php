<x-app-layout>


    <div class="p-4">
        <x-forms.update-escort :admin="false" :profile="$profile" :agency="$agency->id" />
    </div>
    @push('js')
        <script>

            $('.profile-image').on('click', function () {
                $('.profile-image').removeClass('profile-main-image');
                $(this).addClass('profile-main-image')
                let photo_id = $(this).attr('data-render');
                $('input[name=main_photo]').val(photo_id)
            });


        </script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1U0Z-vA_q8EAzCAT8mK6P8fYuLkzad0o&loading=async&libraries=places&callback=initialize"></script>
        <script src="{{mix('js/profileform.js')}}"></script>
    @endpush

</x-app-layout>