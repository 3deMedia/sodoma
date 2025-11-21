@props(['active'])
<div>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name"></th>
                                <th scope="col" class="sort" data-sort="name">{{__('agency.Escort_name')}}</th>
                                <th scope="col">{{__('general.status')}}<</th>
                                <th scope="col">{{ __('general.Visits') }} / {{__('agency.month')}}</th>
                                <th scope="col" class="sort" data-sort="budget">{{__('general.Edit')}}</th>
                                <th scope="col" class="sort" data-sort="status"> {{ __('general.agency.hide_escort') }} </th>
                                <th scope="col">{{ __('general.agency.create_vip') }}</th>


                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($active as $act_scrt)
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
                                            <i class="fa fa-circle text-red"></i>{{ __('general.notaprove') }} <strong><a
                                                href="{{ route('my-profile') }}">{{ __('general.updateprofile') }}</a></strong>

                                            @elseif(!$act_scrt->active)
                                                <i class="fa fa-circle text-gray"></i> {{ __('general.hidden') }}
                                            @elseif($act_scrt->active)
                                                <i class="fa fa-circle text-green"></i> {{ __('general.active') }}
                                            @endif

                                        </span>
                                    </div>
                                </td>
                                <td class="text-center mcolor fw-bold">
                                    {{$act_scrt->vzt()->period('month')->count()}}
                                </td>
                                <td>
                                    <button class="btn btn-warning edit-scrt" data-render="{{ $act_scrt->id }}">
                                        <i class="fas fa-user-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-dark hide-prof" data-render="{{ $act_scrt->id }}">
                                        <i class="fas fa-eye-slash"></i>

                                    </button>
                                </td>
                                <td>
                                    @if(!$act_scrt->is_vip)
                                    <button class="btn btn-info ae-make-vip text-white"
                                        data-render="{{ $act_scrt->id }}">
                                        <i class="fas fa-gem" aria-hidden="true"></i>
                                    </button>
                                    @else
                                    <p class="p-2">{{ __('general.vip.ends_at_message')}}
                                        {{$act_scrt->Vip()->ends_at->format('d-m-Y')}}</p>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

