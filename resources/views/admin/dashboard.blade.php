<x-admin-layout>

    @include('admin.layouts.cards',['data' =>$data])

    <div class="container-fluid mt--7">

        <div class="row my-5">
            <div class="col-12 col-md-6 col-xl-4   mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Crear</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><a href="{{route('admin-profile-create',['type'=>2])}}">Crear usuario tipo agencia</a></p>
                        <p><a href="{{route('admin-profile-create',['type'=>1])}}">Crear usuario tipo escort</a></p>

                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4   mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Configuracion</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.update.config')}}" method="POST">
                            @csrf

                            @foreach (App\Models\Configuration::all() as $item)


                            <div class="form-group">
                                <label for="">{{$item->name}}</label>

                                <input type="text" name="{{$item->name}}" id="" class="form-control" value="{{$item->value}}">

                              </div>
                              @endforeach
                              <button type="submit">Actualizar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
</x-admin-layout>
