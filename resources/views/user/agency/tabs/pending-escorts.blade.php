
@props(['pending'])
<div>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">#</th>
                                <th scope="col" class="sort" data-sort="name">{{__('agency.Escort_name')}}</th>
                                <th scope="col" class="sort" data-sort="name">{{__('agency.Escort_created')}}</th>
                                <th scope="col" class="sort" data-sort="budget">{{__('general.Edit')}}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($pending as $pnd_scrt)
                            <tr>
                                <td scope="row">
                                    <div class="">
                                        <a href="#" class="mavatar mr-3">
                                            @php
                                            $mfoto = $pnd_scrt->MainPhoto();
                                            @endphp
                                            @if($mfoto)
                                            <img loading="lazy"  style="border-radius:8px"   src="{{ asset("storage/escort_photos/$mfoto->path/$mfoto->filename") }}">
                                            @endif
                                        </a>

                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{$pnd_scrt->name}}</span>
                                    </div>
                                </td>
                                <td class="budget">
                                    {{ $pnd_scrt->created_at }}
                                </td>
                                <td>
                                    <a href="{{route('agency-escort-edit',$pnd_scrt->id)}}" class="btn btn-warning">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
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


