
@props(['unactive'])
<div>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table align-items-center table-light table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name" >#</th>
                                <th scope="col" class="sort" data-sort="name" >{{__('agency.Escort_name')}}</th>
                                   {{-- <th scope="col" class="sort" data-sort="name">{{__('agency.Escort_created')}}</th> --}}
                                   <th scope="col">{{ __('general.Visits') }} / {{__('agency.month')}}</th>
                                <th scope="col" class="sort" data-sort="budget" >{{__('general.Edit')}}</th>
                                <th scope="col" class="sort" data-sort="status" > {{ __('general.agency.show_escort') }} </th>
                                <th scope="col" class="sort" data-sort="status" > VIP </th>


                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($unactive as $hdn_scrt)
                            <tr>
                                <td scope="row">
                                    <div class="">
                                        @php
                                        $mfoto = $hdn_scrt->MainPhoto();
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
                                        <span class="name mb-0 text-sm">{{$hdn_scrt->name}}</span>
                                    </div>
                                </td>
                                <td class="text-center mcolor fw-bold">
                                    {{-- {{ $act_scrt->created_at->format('d-m-Y') }} --}}
                                    {{$hdn_scrt->vzt()->period('month')->count()}}
                                </td>
                                <td>
                                    <button class="btn btn-warning edit-scrt" data-render="{{ $hdn_scrt->id }}">
                                        <i class="fas fa-user-edit"></i>

                                    </button>

                                </td>
                                <td>
                                    <button class="btn btn-primary show-prof" data-render="{{ $hdn_scrt->id }}">
                                        <i class="fas fa-eye"></i>

                                    </button>
                                </td>
                                <td>
                                    @if($hdn_scrt->is_vip)

                                    <p class="p-2">{{ __('general.vip.ends_at_message')}}
                                        {{$hdn_scrt->Vip()->ends_at->format('d-m-Y')}}</p>

                                    @else
                                        No
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

