<x-app-layout>


  <div class="p-4">
      <x-forms.update-escort :admin="false" :profile="$profile" :agency="$agency->id"  />
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
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P3fvbshvJOW8re3caz4gqAqi8CwZUmI&libraries=places"
></script>
<script src="{{mix('js/profileform.js')}}"></script>
@endpush

</x-app-layout>
