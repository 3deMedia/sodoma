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
                            <th>Imagen</th>
                            <th>Tipo de perfil</th>
                            <th>Ver perfil</th>
                            <th>Aprobar Foto</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revs as $rev)
                            <tr>
                                <td scope="row">{{ $rev->created_at->format('d-m-Y') }}</td>
                                <td scope="row">

                                    @php
                                     $photo= $rev->Photo;
                                     $profile_type=$rev->Profile->type_id;
                                     $main_path = $profile_type ==1 ? 'escort_photos':'agency_photos';
                                    @endphp

                                    <img src="{{asset("storage/$main_path/$photo->path/$photo->filename")}}" alt="" height="100" >
                                </td>
                                <td>{{ $profile_type===1 ? 'Escort': 'Agencia' }}</td>
                                 <td>
                                     @if ($profile_type===1)
                                         <a href="{{route('admin-profile-show',$rev->profile_id)}}">{{$rev->Profile->email}}</a>
                                     @else
                                     <a href="{{route('admin-profile-show',$rev->profile_id)}}">{{$rev->Profile->email}}</a>
                                     @endif
                                    </td>

                                <td><a class="btn btn-success" href="{{route('approve-escort-photo',$rev->id)}}">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-admin-layout>
