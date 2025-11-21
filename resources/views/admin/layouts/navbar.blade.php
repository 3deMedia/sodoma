


<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark bg-black" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <div class="d-flex">
            <img src="{{asset('images/deadmin.png')}}" alt="Panel Administración" width="174" height="51" />

        </div>
        <!-- Form -->

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">

            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">

                            <i class="ni ni-settings-gear-65 text-white"></i>

                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                    <a href="{{route('my-account')}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My Account') }}</span>
                    </a>
                    <a href="{{route('contact-us')}}" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
