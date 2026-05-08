<x-admin-layout>
    <div class="container pt-5 px-2 mt-5">
        <div class="row">
            <div class="col-12 col-md-10 py-5">
                <table id="notis_table" class="table table-striped ">

                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>usuario</th>
                            <th>datos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notis as $noti )
                        @php $noti_data=json_encode($noti['data']) @endphp
                        <tr>
                            <td scope="row">{{ $noti['created_at']->format('d-m-Y H:i:s') }}</td>
                            <td> {{ $noti['type'] }} </td>
                            <td>{{ $noti_data }}</td>
                        </tr>
                        @endforeach


                    </tbody>

            </table>
            </div>
        </div>
    </div>
    </x-admin-layout>
