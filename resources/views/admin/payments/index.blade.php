<x-admin-layout>
    <div class="container pt-5 px-2">
        <div class="row">
            <div class="col-12 col-md-10 ">
                <div class="card">
                    <div class="card-body">
                        <table id="payments_table" class="table table-striped border">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Cantidad</th>
                                    <th>Via</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purch )
                                <tr>
                                    <td> {{ $purch->created_at->format('d-m-Y H:i:s')}} </td>
                                    <td scope="row"> <a href="{{route('admin-user-show',$purch->User->id)}}">{{ $purch->User->email }}</a></td>
                                    <td> {{ $purch->amount}} € </td>
                                    <td> {{ $purch->payment_method}}  </td>
                                    <td class="text-{{$purch->status == 'success' ? 'success' : 'danger'}}">{{$purch->status}} </td>
                                </tr>
                                @endforeach


                            </tbody>

                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </x-admin-layout>
