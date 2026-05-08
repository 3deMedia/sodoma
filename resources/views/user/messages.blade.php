<x-app-layout>
    <div class="container " style="min-height: 75vh;">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold mb-4 text-center pb-4">{{__('general.Messages')}}</h2>
            </div>
        <div class="row">
            <div class="col-12 col-md-10 mx-auto">
                <div class="">
                    @if ($messages && count($messages) > 0)
                    <table class="table" id="users_table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="w-25">{{__('general.Date')}}</th>
                                <th scope="col" class="w-25">{{__('general.To')}}</th>
                                <th scope="col" class="w-25">{{__('general.from')}}</th>
                                <th scope="col" class="w-25">{{__('general.Message')}}</th>
                                <th scope="col" class="w-25">{{__('general.remove')}}</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            @foreach ($messages as $msg)
                            <tr style="">
                                <td scope="row">{{$msg->created_at->format('d-m-Y')}}</td>
                                <td><p>{{$msg->Profile->name}} </p> </td>
                                <td><p>{{$msg->email}} </p> </td>
                                <td style="white-space: inherit;"><p> {{$msg->message}}</p> </td>
                                <td> <button class="btn btn-danger del-msg" data-render="{{$msg->id}}"> <i class="fa fa-trash" aria-hidden="true"></i></button> </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    @else
                        <p>{{__('general.NoMessages')}}</p>
                    @endif

                </div>

            </div>
        </div>
        @push('js')
        <script defer>
            $('table').DataTable();
        </script>

        @endpush
    </div>
</x-app-layout>
