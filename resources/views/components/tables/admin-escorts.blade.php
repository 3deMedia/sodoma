<div class="col-12 col-md-10 ">
    <table id="users_table" class="table table-striped ">

        <thead>
            <tr>
                <th>#</th>
                <th>Fecha creacion</th>
                <th>Nombre</th>
                <th>UID</th>
                <th>Email</th>
                <th>Ver</th>
                <th>Is Vip</th>
                <th>Agencia</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $profile )
            <tr>
                <td>{{$profile->id}}</td>
                <td>{{$profile->created_at->format('d-m-Y')}}</td>
                <td scope="row"> {{ $profile->name }}</td>
                <td scope="row"> {{ $profile->uid }}</td>
                <td> {{ $profile->email }} </td>

                <td><a href="{{route('admin-profile-show',$profile->id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                <td>{{$profile->is_vip ? 'si':'no'}}</td>
                <td>

                    @if($profile->IsOwned)
                    <a href="{{route('admin-profile-show',$profile->Owner->id)}}"><i class="fa fa-eye" aria-hidden="true"></i>{{$profile->Owner->name}}</a>
                    @else
                    No
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
</div>
