<x-admin-layout>
    <div class="container pt-5 px-2">
        <div class="row">
            @if (session('success'))
                <div class="col-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>

            @endif
            <div class="col-12 col-md-10 ">
                <table id="reviews_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ver</th>
                            <th>Mensaje</th>
                            <th>Aprovar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td scope="row">{{ $profile->created_at->format('d-m-Y') }}</td>
                                <td>{{ $profile->name }} </td>
                                <td>{{ $profile->email }} </td>
                                <td>{{ $profile->type_id == 1 ? 'Escort' : 'Agencia' }} </td>
                                <td>
                                        <a href="{{ route('admin-profile-show', $profile->id) }}" target="_blank"
                                            class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                                <td> <button class="btn btn-warning"><i class="fa fa-envelope-open btn-profile-msg" data-id="{{$profile->id}}"  aria-hidden="true"></i></button></td>

                                <td><a href="{{route('approve-profile',$profile->id)}}" class="btn btn-success btn-approve-profile" >
                                        <i class="fa fa-check-circle" aria-hidden="true"></i></button></td>
                                <td><a href="{{route('admin-profile-delete',$profile->id)}}" class="btn btn-danger" >
                                    <i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</x-admin-layout>
