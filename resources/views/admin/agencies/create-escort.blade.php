<x-admin-layout>
    <div class="container pt-5 mb-4">
        <div class="row">
            <h4>Creando escort para: {{$profile->name}}</h4>
            <p class="text-danger fw-bold">No se descontaran coins</p>
            <p>Si se debe descontar coins ir  <a href="{{route('admin-user-show',$profile->User->id)}}" target="_blank" rel="noopener noreferrer">Aquí</a>. Actualmente el usuario tiene {{$profile->User->coins}} coins </p>
        </div>
        <div class="row">
            <div class="col-12 col-md-10 ">
               <x-forms.create-escort :admin="true" :agency="$profile->id" />
            </div>
        </div>
    </div>
    @push('js')
    <script src="{{mix('js/profileform.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P3fvbshvJOW8re3caz4gqAqi8CwZUmI&libraries=places" async ></script>
    @endpush
</x-admin-layout>
