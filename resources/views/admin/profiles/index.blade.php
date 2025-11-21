<x-admin-layout>
    <div class="container pt-5 px-2">

        @php
            $type = request()->route('type');
            $type_name = $type == 1 ? 'Escorts':'Agencias';

        @endphp
        <h1>{{ "$type_name" }}</h1>
        <div class="row">

            @if($type==1)
                <x-tables.admin-escorts :profiles="$profiles" />
            @else
                <x-tables.admin-agencies :profiles="$profiles" />
            @endif
        </div>
    </div>
</x-admin-layout>
