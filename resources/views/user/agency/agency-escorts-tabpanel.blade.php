<x-app-layout>

<div class="container mb-8" style="min-height: 70vh;">
    @if ($message=session('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Enhorabuena!</strong> {{$message}}
    </div>
    @endif

    <div class="row mb-3 mt-6 text-center">
        <div><h2 class="fw-bold mb-4">{{__('general.yourads')}}</h2></div>

        <p>{{__('general.youradstxt')}}</p>

    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist" class="w-100">
        <li class="nav-item " role="presentation">
            <button class="nav-link active" id="actived-tab" data-bs-toggle="tab" data-bs-target="#actived"
                type="button" role="tab" aria-controls="actived" >
              <span class="panel-link">  {{ __('agency.all') }}</span>
            </button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link nav-link-new" id="newescort-tab" data-bs-toggle="tab" data-bs-target="#newescort"
                type="button" role="tab" aria-controls="newescort" aria-selected="">
               <span class="panel-link">{{ __('agency.addEscort') }}</span>
            </button>

        </li>

    </ul>

    <div class="tab-content w-100 overflow-auto" id="myEscortTabs">
        <div class="tab-pane active" id="actived" role="tabpanel" aria-labelledby="actived-tab">
            <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name"></th>
                        <th scope="col" class="sort" data-sort="name">{{__('agency.Escort_name')}}</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="sort" data-sort="budget">{{__('general.Edit')}}</th>
                        <th scope="col" class="sort" data-sort="status"> {{ __('general.visible') }} </th>
                        <th scope="col">{{ __('general.agency.create_vip') }}</th>


                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($escorts as $act_scrt)

                    <tr>
                        <td scope="row">
                            <div class="">
                                @php
                                $mfoto = $act_scrt->MainPhoto();
                                @endphp
                                @if ($mfoto)
                                <a href="#" class="mavatar mr-3">
                                    <img loading="lazy" style="border-radius:8px"  alt="" src="{{ asset("storage/escort_photos/$mfoto->path/$mfoto->filename") }}">
                                </a>
                                @endif

                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$act_scrt->name}}</span>
                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <span class="name mb-0 text-sm">

                                    @if (!$act_scrt->approved)
                                    <i class="fa fa-circle text-red"></i> {{ __('general.notaprove') }}

                                    @elseif(!$act_scrt->active)
                                        <i class="fa fa-circle text-gray"></i> {{ __('general.hidden') }}
                                    @elseif($act_scrt->active)
                                        <i class="fa fa-circle text-green"></i> {{ __('general.active') }}
                                    @endif

                                </span>
                            </div>
                        </td>

                        <td>
                            <button class="btn btn-warning edit-scrt" data-render="{{ $act_scrt->id }}">
                                <i class="fas fa-user-edit"></i>
                            </button>
                        </td>
                        <td>
                            @if($act_scrt->active)
                            <button class="btn btn-dark hide-prof" data-render="{{ $act_scrt->id }}">
                                <i class="fas fa-eye-slash"></i>

                            </button>
                            Ocultar
                            @else
                            <button class="btn btn-success show-prof" data-render="{{ $act_scrt->id }}">
                                <i class="fas fa-eye"></i>

                            </button>
                            Mostrar
                            @endif
                        </td>
                        <td>
                           @if($act_scrt->approved)
                                @if(!$act_scrt->is_vip )
                                <button class="btn btn-info user-wants-vip text-white"
                                    data-render="{{ $act_scrt->id }}">
                                    <i class="fas fa-gem" aria-hidden="true"></i>
                                </button>
                                @else
                                <p class="p-2">{{ __('general.vip.ends_at_message')}}
                                    {{$act_scrt->Vip()->ends_at->format('d-m-Y')}}</p>
                                @endif
                            @else

                            <p>{{ __('general.need_profile')}}</p>

                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="tab-pane fade " id="newescort" role="tabpanel" aria-labelledby="newescort-tab">
            @if ($can_purchase)
            <p class="pt-4 fw-bold">Cada nuevo perfil tiene un coste de {{escortCost()}} € </p>
            <x-forms.create-escort :admin="false" :agency="$profile->id"/>
            @else
            <p class="font-bold text-lg p-2 pt-5">
                {{ __('general.need_profile')}}. <br>{{ __('general.needs_profile_or_coins')}}  <a href="{{route('buy-coins')}}">Haz click aquí</a>.
            </p>
            @endif

        </div>
    </div>
</div>
@push('js')
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P3fvbshvJOW8re3caz4gqAqi8CwZUmI&libraries=places"
></script>
<script src="{{mix('js/profileform.js')}}"></script>
@endpush
</x-app-layout>
