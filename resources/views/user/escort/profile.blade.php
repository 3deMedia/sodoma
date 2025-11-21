<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mx-auto">
                @php
                $is_admin=false;
                @endphp
                @if (!$profile)
                    <x-forms.create-escort-form :admin="$is_admin"/>
                @else
                    <x-forms.update-escort-form :profile="$profile" :admin="$is_admin"/>
                @endif
            </div>
        </div>
        @push('js')
        <script>
            $('.profile-image').on('click',function(){
                $('.profile-image').removeClass('profile-main-image');
                $(this).addClass('profile-main-image')
                let photo_id= $(this).attr('data-render');
                $('input[name=main_photo]').val(photo_id)
            });
        </script>
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P3fvbshvJOW8re3caz4gqAqi8CwZUmI&libraries=places"></script>
      <script src="{{mix('js/profileform.js')}}"></script>
    @endpush
    </div>
</x-app-layout>
