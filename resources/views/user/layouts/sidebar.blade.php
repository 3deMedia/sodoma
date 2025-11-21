<nav class="navbar navbar-horizontal navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->

        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('images/escortssecrets-logoblack.png') }}" style="height: 77px" alt="Escorts Secrets Publicidad"/>
        </a>
        <!-- User -->

        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">


                        <i class="ni ni-single-02 text-lg text-black"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Cuenta') }}</h6>
                    </div>
                    <a href="{{ route('my-account') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('general.My account') }}</span>
                    </a>

                    <a href="{{route('contact-us')}}" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('general.Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-button-power"></i>
                        <span>{{ __('general.Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            <img src="{{ asset('images/escortssecrets-logoblack.png') }}" style="height: 63px" alt="Escorts Secrets Publicidad"/>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav align-items-right">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="ni ni-tv-2 text-primary"></i> {{__('general.My_panel')}}
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link  @if(request()->routeIs('my-profile')) fw-bold  text-black @endif" href="{{route('my-profile')}}">
                        <i class="ni ni-circle-08" style="color: #B142A1;"></i> {{__('general.Manage_profile')}}
                    </a>
                </li>

                @if (auth()->user()->user_type_id ==2)

                <li class="nav-item ">
                    <a class="nav-link  @if(request()->routeIs('my-escorts')) fw-bold  text-black @endif" href="{{ route('my-escorts') }}">
                        <i class="fas fa-chess-king text-pink"></i>  {{__('general.My_escorts')}}
                    </a>
                </li>


                @endif


                <li class="nav-item">
                    <a class="nav-link  @if(request()->routeIs('become-vip')) fw-bold  text-black @endif" href="{{ route('become-vip') }}">
                        <i class="fas fa-star text-blue"></i> {{__('general.Become_vip')}}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  @if(request()->routeIs('buy-coins')) fw-bold  text-black @endif" href="{{ route('buy-coins') }}">
                        <i class="fas fa-donate text-orange"></i> {{__('general.Buy_coins')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(request()->routeIs('payments')) fw-bold  text-black @endif" href="{{ route('payments') }}">
                        <i class="far fa-credit-card text-green"></i>
                      <span class="nav-link-text"> {{ __('general.Payments') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(request()->routeIs('my-messages')) fw-bold  text-black @endif" href="{{ route('my-messages') }}">
                        <i class="far fa-envelope text-yellow"></i>
                      <span class="nav-link-text"> {{ __('general.Messages') }}</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-search text-indigo"></i>
                      <span class="nav-link-text"> {{ __('general.Reviews') }}</span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-circle-08" style="color: #B142A1;"></i>
                        <span class="nav-link-text" style="color: #B142A1;">{{ __('Users') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin-users')}}">
                                    {{ __('Con coins') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin-users')}}">
                                    {{ __('Sin coins') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

            </ul>
            <!-- Divider -->

        </div>
    </div>
</nav>
