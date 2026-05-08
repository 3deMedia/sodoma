        <div class="mx-2 my-4">
            <div id="demo" class="collapse show" style="min-height: 70px;">
                <div class="d-flex flex-wrap">
                    <a class="nav-enlace my-2 px-2 rounded" href="{{ route('my-account') }}">{{ __('general.My account') }} </a>
                    <a class="nav-enlace my-2 px-2 rounded" href="{{ route('my-profile') }}">
                        @if (auth()->user()->user_type_id == 2)
                            {{ __('general.EditAgency') }}
                        @else
                            {{ __('general.PublishAd') }}
                        @endif
                    </a>
                    @if (auth()->user()->user_type_id == 2)

                        <a class="nav-enlace my-2 px-2 rounded"
                            href="{{ route('my-escorts') }}">{{ __('general.My_escorts') }} </a>
                    @endif
                </div>
            </div>
            <div id="botcambi" class="boti "><a class="botiop" data-toggle="collapse" data-target="#demo"
                    aria-expanded="true"> <i class="cambi ni ni-bold-up text-xl"></i> </a>
            </div>
