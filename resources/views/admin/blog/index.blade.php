<x-admin-layout>

    <div class="container pt-5">
        <div class="row">
            <div class="col-8 mx-auto">
                <h1 class="tracking-widest font-bold text-base md:text-3xl border-b-4 border-blue-700 ">
                    @lang('general.Last_Posts')

                </h1>
                <div class="float-right">
                    <a href="{{ route('posts.create') }}" class="btn btn-info"
                        style="position: relative;bottom:5px;">Crear Post</a>
                </div>
            </div>

            <div class="col-8">
                <table id="users_table" class="table table-striped">
                    <thead>
                        <tr class="border-b-2 text-black">
                            <th class=""> Publicación</th>
                            <th> Titulo</th>
                            <th>slug</th>
                            <th>Editar</th>
                            <th> Borrar</th>
                            <th>Visible</th>
                            <th>Ver</th>
                        </tr>
                    </thead>

                    <tbody class="bg-gray-300 text-gray-700">
                        @foreach ($posts as $item)
                            <tr>
                                <td>{{ $item->publish_at->format('d-m-Y') }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->slug }}</td>
                                <td> <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit    "></i></a></td>
                                <td>
                                    <form action="{{ route('posts.destroy', $item->id) }}" method="POST" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>

                                <td>{{ $item->active ? 'visible' : 'oculto' }}</td>
                                <td><a href="{{route('show-post',$item->slug)}}">Ver</a></td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>




</x-admin-layout>
