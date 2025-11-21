
<nav class="navbar navbar-expand-xl navbar-light">
    <div class="container">
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('images/escortssecrets-logoblack.png') }}" style="height: 63px" alt="Escorts Secrets Publicidad"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('images/escortssecrets-logoblack.png') }}" style="height: 63px" alt="Escorts Secrets Publicidad"/>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{route('my-account')}}" title="{{__('general.My account')}}">
                        <i class="fas fa-home  text-xl pr-2"></i>
                        <span class="nav-link-inner--text d-xl-none"> {{__('general.My account')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{route('my-profile')}}" title="{{__('general.Manage_profile')}}">
                        <i class="fas fa-user text-xl pr-2"></i>
                        <span class="nav-link-inner--text d-xl-none"> {{__('general.Manage_profile')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{route('buy-coins')}}" title="{{__('general.Buy_coins_title')}}">
                        <i class="fas fa-coins text-xl pr-2"></i>
                        <span class="nav-link-inner--text d-xl-none"> {{__('general.Buy_coins_title')}}</span>
                    </a>
                </li>
                @if (request()->user()->user_type_id ==2)
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('my-escorts') }}" title="{{ __('general.My_escorts') }}">
                        <i class="fa fa-users text-xl pr-2 "></i>
                        <span class="nav-link-inner--text d-xl-none">{{ __('general.My_escorts') }}</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                <a class="nav-link nav-link-icon" href="{{ route('become-vip') }}">
                    <i class="fas fa-gem text-xl pr-2"></i> <span class="nav-link-inner--text d-xl-none">{{__('general.Become_vip')}}</span>
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('my-messages') }}" title="{{ __('general.Messages') }}">
                        <i class="fas fa-envelope  text-xl pr-2"></i>
                        <span class="nav-link-inner--text d-xl-none">{{ __('general.Messages') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('contact-us') }}" title="{{ __('general.Support') }}">
                        <i class="ni ni-support-16 text-xl pr-2"></i>
                        <span class="nav-link-inner--text d-xl-none">{{ __('general.Support') }}</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <div class="dropdown h-100 nav-link nav-link-item">
                        <button class="p-0 h-100 border-0" type="button" style="background: transparent"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ni ni-world-2 text-xl"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('lang', 'es') }}"> <img loading="lazy"
                                    src="{{ asset('images') }}/spa.png" height="20" /> ESP</a>
                            <a class="dropdown-item" href="{{ route('lang', 'en') }}"><img loading="lazy"
                                    src="{{ asset('images') }}/eng.jpg" height="20" /> ENG</a>
                        </div>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link nav-link-icon" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" title="{{ __('general.Logout') }}">
                        <i class="fas fa-power-off text-xl pr-2"></i>
                        <span class="nav-link-inner--text d-xl-none">{{ __('general.Logout') }}</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
