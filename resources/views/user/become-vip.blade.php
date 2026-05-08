<x-app-layout>

    <div class="col-12 mx-auto">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">

                    <h3 class="fs-3 fw-bold text-mgray text-center pt-4">
                        {{ __('general.Vip_gifts_title') }}</h3>

                </div>
                <div class="col-12">
                    <div class="row py-6">
                        <div class="col-lg-4">

                            <div class="card card-pricing bg-verd text-center mb-4 border-0">
                                <div class="card-header bg-white">
                                    <h6 class="text-uppercase ls-1 text-pink py-3 mb-0">
                                        {{ __('general.Profile_Vip') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="display-2 text-white">{{ $vip_cost }} €</div>
                                    <span class="text-white">{{ __('general.monthly') }}</span>
                                    <ul class="list-unstyled my-4">
                                        <li class="py-2">
                                            <div class="align-items-center">
                                                <div>
                                                    <div
                                                        class="icon icon-xs icon-shape bg-white shadow rounded-circle text-vip">
                                                        <i class="ni ni-trophy"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <span
                                                        class="pl-2 text-sm text-white">{{ __('general.feature1') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-2">
                                            <div class="align-items-center">
                                                <div>
                                                    <div
                                                        class="icon icon-xs icon-shape bg-white shadow rounded-circle text-vip">
                                                        <i class="ni ni-camera-compact"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <span
                                                        class="pl-2 text-sm text-white">{{ __('general.feature2') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-2">
                                            <div class="align-items-center">
                                                <div>
                                                    <div
                                                        class="icon icon-xs icon-shape bg-white shadow rounded-circle text-vip">
                                                        <i class="ni ni-world-2"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2"><span
                                                        class="pl-2 text-sm text-white">{{ __('general.feature3') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-2">
                                            <div class="align-items-center">
                                                <div>
                                                    <div
                                                        class="icon icon-xs icon-shape bg-white shadow rounded-circle text-vip">
                                                        <i class="ni ni-map-big"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <span
                                                        class="pl-2 text-sm text-white">{{ __('general.feature4') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-2">
                                            <div class="align-items-center">
                                                <div>
                                                    <div
                                                        class="icon icon-xs icon-shape bg-white shadow rounded-circle text-vip">
                                                        <i class="ni ni-button-play"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <span
                                                        class="pl-2 text-sm text-white">{{ __('general.feature5') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    @if ($show_vip_button)
                                        <div class="mx-auto pb-5 pt-3">

                                            <p class="text-white">{{ __('general.updateper') }}</p>
                                            <a class="btn btn-coins btn-sm" href="{{ route('activate-vip') }}">
                                                <span
                                                    class="fw-bold text-white text-center">{{ __('general.Become_vip') }}</span>
                                            </a>

                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('buy-coins') }}" class="btn saldolink border-white">
                                        {{ __('general.Buy_coins_title') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 mx-auto ">
                            <div class="p-2">
                                {!! __('general.Vip_gifts_text') !!}

                                <br><br>
                                <a href="{{ route('buy-coins') }}" class="fw-bold mcolor">
                                    {{ __('general.Buy_coins_title') }}</a>

                            </div>
                            @if ($show_vip_button)
                                <div class="p-2">

                                    <div class="mx-auto pb-5 pt-3">

                                        <p class="">{{ __('general.updateper') }}</p>
                                        <a class="btn  btn-primary alert-before-vip"><span
                                                class="fw-bold text-center">{{ __('general.Become_vip') }}</span>
                                        </a>

                                    </div>

                                </div>
                            @endif

                            @if (!$show_vip_button && !$already_vip && $user_type == 1)
                                <div class="py-4 w-100">
                                    <div class="alert alert-warning" role="alert">

                                        <strong>
                                            <p>{{ __('general.no_vip_requirements') }}</p>
                                        </strong>
                                        @if ($messages)
                                            <ul>
                                                @foreach ($messages as $item)
                                                    <li> {{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @endif

                                    </div>
                                </div>
                            @endif
                            @if ($user_type == 2 && count($escorts) > 0)

                                <div class="container mt-5  py-4">
                                    <div class="row">
                                        <div class="col-12 pl-0 mb-4">
                                            <h6>Tus escorts que pueden activar Vip:</h6>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            @foreach ($escorts as $scrt)
                                                <div class="bg-verd p-2 rounded text-center">
                                                    @php
                                                        $mfoto = $scrt->MainPhoto();
                                                    @endphp
                                                    <img loading="lazy" height="80" style="border-radius:8px" alt=""
                                                        src="{{ asset("storage/escort_photos/$mfoto->path/$mfoto->filename") }}">
                                                    <p class="name mb-0 text-sm text-white"> <b> {{ $scrt->name }}
                                                        </b> </p>
                                                    <button class="btn bg-white my-2 user-wants-vip"
                                                        data-render="{{ $scrt->id }}">
                                                        <i class="fas fa-gem text-orange"></i> Activar Vip
                                                    </button>


                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $('.alert-before-vip').on('click', function() {

                Swal.fire({
                    title: 'Quieres empezar tu subscripcion Vip?',
                    text: " Tiene un coste de {{ $vip_cost }} €",
                    showCancelButton: true,
                    confirmButtonText: 'De acuerdo',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location = "{{ route('activate-vip') }}"
                    } else if (result.isDenied) {
                        Swal.fire('OK')
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>
