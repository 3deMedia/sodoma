<x-app-layout>
    <div class="container pb-5">

        @if ($message = session('paysuccess'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Enhorabuena!</strong> {{ $message }}
            </div>
        @endif
        @if ($message = session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong> {{ $message }}</strong>
            </div>
        @endif
        @if ($profile)
            <div class="row">
                <div class="col-12">
                    <h2 class="fw-bold mb-4 text-center">{{ __('general.Hello') }} {{ $profile->name }}</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-6 mt-2 mt-md-5 bg-white rounded-md mx-auto p-4">
                    <div style="float: right;margin-left:20px;"><span
                            class="coinsleft">{{ $coins }}</span><br /><a href="{{ route('buy-coins') }}"
                            style="text-decoration: none;"><span
                                class="saldoleft">{{ __('general.balance') }}</span></a></div>
                    <p>
                        <strong>{{ __('general.status') }} </strong>

                        @if (!$profile->approved)
                            <i class="fa fa-circle text-red"></i> &nbsp;{{ __('general.notaprove') }}

                        @else
                            <i class="fa fa-circle text-green"></i> &nbsp; {{ __('general.Aproved') }}
                        @endif


                        @if($profile->monthly_agency_period && $profile->type_id == 2)
                         y  activo
                        @elseif(!$profile->monthly_agency_period && $profile->type_id == 2)
                        <b>pero sin activar</b>
                        @endif
                    </p>
                    <p>

                        @if ($profile->Vip())
                            <strong>{{ __('general.viprenewal') }}</strong>
                            {{ $profile->Vip()->ends_at->format('d/m/Y') }}
                        @elseif($profile->approved)
                            @if (!$is_agency )
                                {{ __('general.susbscriptions.no_subscriptions') }}<br />
                                <a href="{{ route('become-vip') }}"
                                    class="sus">{{ __('general.becomevip') }}</a>
                            @else
                                @if ($coins)
                                    {{ __('general.forpublish') }}
                                @else
                                    {{ __('general.buyforpublish') }}
                                @endif

                            @endif
                        @else
                            <p>{{ __('general.tobecomevip') }}</p>
                        @endif
                    </p>
                </div>
            </div>
        @else
            <div class="row b2">
                <div class="col-12">
                    <h2 class="mb-4 text-center">{{ __('general.Welcome') }}</h2>
                </div>
                <div class="col-12 col-md-6 mx-auto">
                    <p>{{ __('general.Welcome_text') }}</p>

                    @if ($is_agency)
                        @if (!$profile)
                            <p class="h5 pb-4">{{ __('general.completedata') }}
                                {{ __('general.agencyafter') }} <strong>{{ $agency_cost }}
                                    Euros</strong>.</p>

                            <a href="{{ route('my-profile') }}" class="btns-account mx-auto butbuycoins"><i
                                    class="fa fa-award text-xl pr-3"></i>{{ __('general.agencydata') }} </a>
                        @else
                            <p class="text-center">Crea tu primer anuncio</p>
                            <a href="{{ route('my-escorts') }}" class="btns-account  butbuycoins"><i
                                    class="fa fa-image text-xl pr-3"></i> {{ __('general.My_escorts') }} </a>
                        @endif
                    @else
                        @if (!$profile)
                            <p class="text-center">Crea tu primer anuncio</p>
                            <a href="{{ route('my-profile') }}" class="mx-auto btns-account butbuycoins"><i
                                    class="fas fa-user text-xl pr-3"></i> {{ __('general.CreateAd') }}</a>
                        @else
                            <a href="{{ route('my-profile') }}" class="mx-auto btns-account butbuycoins"><i
                                    class="fas fa-user  text-xl pr-3"></i>{{ __('general.PublishAd') }}</a>
                        @endif
                        </a>
                    @endif

                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-md-6 mt-2 mt-md-3 bg-white rounded-md mx-auto text-center pt-4 pb-md-4 ">
                <h5 class="text-center p-2">{{ __('general.actuallyhave') }} {{ $coins }}
                    {{ __('general.coins') }}</h5>
                <p class="text-center mb-5">
                    @if ($coins > 19)
                        {{ __('general.topublishadok') }}
                    @else
                        {{ __('general.topublishad') }}
                    @endif


                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center">


                            @if ($is_agency)
                                <a href="{{ route('my-profile') }}" class="btns-account  butbuycoins"><i
                                        class="fa fa-award text-xl pr-3"></i> {{ __('general.agencydata') }} </a>
                                @if ($profile)
                                    <a href="{{ route('my-escorts') }}" class="btns-account  butbuycoins"><i
                                            class="fa fa-image text-xl pr-3"></i> {{ __('general.My_escorts') }} </a>
                                    @if ($profile->approved && !$profile->monthly_agency_period)
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btns-account  butbuycoins " data-toggle="modal"
                                            data-target="#modelId">
                                            <i
                                                class="fas fa-user-check text-xl pr-3"></i>{{ __('general.activate_agency_account') }}

                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog"
                                            aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center">  {{ __('general.activate_agency_account') }}</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left p-4">
                                                     <p>    {!! __('general.activate_agency_account_explanation',['cost'=>$agency_cost]) !!}</p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <a href="{{ route('activate-account') }}"
                                                            class="btn bg-verd text-white">
                                                            {{ __('general.activate_agency_account') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('my-profile') }}" class=" btns-account butbuycoins"><i
                                        class="fas fa-user  text-xl pr-3"></i>
                                    @if (!$profile)
                                        {{ __('general.CreateAd') }}
                                    @else
                                        {{ __('general.PublishAd') }}
                                    @endif
                                </a>
                            @endif
                            <a href="{{ route('buy-coins') }}" class=" btns-account butbuycoins"><i
                                    class="fa fa-coins text-xl pr-3"></i> {{ __('general.Buy_coins_title') }}</a>
                            <a href="{{ route('become-vip') }}" class=" btns-account butbuycoins"><i
                                    class="fas fa-gem text-xl pr-3"></i> {{ __('general.Become_vip') }}</a>

                            <a href="{{ route('payments') }}" class="btns-account butbuycoins"><i
                                    class="fa fa-receipt text-xl pr-3"></i> {{ __('general.Payments') }}</a>
                            <a href="{{ route('my-messages') }}" class=" btns-account butbuycoins"><i
                                    class="fas fa-envelope text-xl pr-3"></i> {{ __('general.Messages') }}</a>

                            <a href="{{ route('changepassword') }}" class="btns-account butchangepass"><i
                                    class="fa fa-lock text-xl pr-3"></i> {{ __('general.Change Password') }}</a>
                            <a href="{{ route('logout') }}" class="btns-account butclose"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="fa fa-power-off text-xl pr-3"></i> {{ __('general.Logout') }}</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
