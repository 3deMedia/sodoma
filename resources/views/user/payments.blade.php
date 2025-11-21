<x-app-layout>
      <div class="container pb-5">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold mb-4 text-center pb-4"> {{ __('general.Payments') }}</h2>
            </div>
        <div class="row">
            <div class="col-12 col-md-10 col-xl-8 mx-auto overflow-auto">
                <table class="table" id="users_table">
                    <thead>
                        <tr>
                            <th>{{__('general.Date')}}</th>
                            <th class="text-center">{{__('general.Quantity')}}</th>

                            <th class="text-center">{{__('general.Pay_ticket')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purch)
                        <tr>
                            <td scope="row">{{$purch->created_at->format('d-m-Y')}}</td>
                            <td class="text-center">{{$purch->amount}} €</td>
                            <td class="text-center"><a target="_blank" href="{{route('pdf-payment',$purch->id)}}" class="btn btn-danger"><i class="fa fa-file-pdf" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
