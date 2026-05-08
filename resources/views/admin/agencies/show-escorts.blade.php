<x-admin-layout>
    <div class="container pt-5 px-2">
        <h1>Escorts de : {{$profile->name}}</h1>
        <div class="row">

            <div class="col-12 col-md-10 ">
                <table id="users_table" class="table table-striped ">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha creacion</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Is Vip</th>
                            <th>Activo</th>
                            <th>Aprobada</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profile->Escorts as $escort )
                        <tr>
                            <td>{{$escort->id}}</td>
                            <td>{{$escort->created_at->format('d-m-Y')}}</td>
                            <td scope="row"> <a href="{{route('admin-profile-show',$escort->id)}}">{{ $escort->name }}</a></td>
                            <td> {{ $escort->email  }} </td>
                            <td>{{$escort->is_vip ? 'si':'no'}}</td>
                            <td>{{$escort->active ? 'si':'no'}}</td>
                            <td>{{$escort->approved ? 'si':'no'}}</td>

                        </tr>
                        @endforeach


                    </tbody>

            </table>
            </div>
        </div>
    </div>
</x-admin-layout>
