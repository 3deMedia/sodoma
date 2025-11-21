<x-admin-layout>
    <div class="container pt-5 px-2">
        <div class="row">
            <div class="col-12 col-md-10 ">
                <table id="users_table" class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha creación</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Perfil</th>
                            <th>Coins</th>
                            <td>Borrar</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                        @php
                            $u_type=$user->user_type_id ;
                        @endphp
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->created_at->format('d-m-Y')}}</td>
                            <td scope="row">
                                <a href="{{ route('admin-user-show', $user->id) }}" >{{ $user->email }}</a>
                                </td>
                            <td> {{ $u_type== 1 ? 'escort' :'agency' }} </td>
                            <td>
                                @if($user->Profile())
                                <a href="{{ route('admin-profile-show', $user->Profile()->id) }}"
                                    class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                @else
                                    No tiene
                                @endif

                            </td>
                            <td>{{$user->coins}}</td>
                            <td>
                                <a href="{{ route('admin-user-delete', $user->id) }}"
                                    class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-admin-layout>
