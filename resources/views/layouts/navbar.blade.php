<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark bg-black" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <div class="d-flex">
            <span class="text-white ">Tienes</span>
            <span class="text-yellow  px-2 ">  {{auth()->user()->coins}}</span>
            <span class="text-white ">Coins</span>

        </div>
        <!-- Form -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">

            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">

                            <i class="text-lg ni ni-settings-gear-65"></i>

                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                    <a href="{{route('my-account')}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('general.My account') }}</span>
                    </a>
                    <a href="{{route('my-profile')}}" class="dropdown-item">
                        <i class="ni ni-ruler-pencil"></i>
                        <span>{{ __('general.Edit Profile') }}</span>
                    </a>
                    <div class="dropdown h-100 nav-item">
                        <button class=" dropdown-toggle p-0 h-100 border-0" type="button" style="background: transparent"
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
    </div>
</nav>
