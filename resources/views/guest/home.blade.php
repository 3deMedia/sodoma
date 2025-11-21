<x-guest-layout>

    @push('meta')
        <meta name="description" content="{!! $seo->seo_description !!}" />
        <title>{{ $seo->seo_title }}</title>
    @endpush
    <div class="container py-4">
        <div class="row">
            <div class="title py-4 mx-auto col-12 ">
                <h1 class="text-center">{{ __('general.navs.publishads') }}</h1>
                <p class="text-center text-black"><em>{{ __('general.Welcome_text') }}</em></p>
            </div>
            <div class="col-12 col-md-8 col-lg-6 mx-auto my-4">
                <div class="rounded shadow">
                    <ul class="nav nav-tabs text-center" id="accountTab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <a class="nav-link active py-3" id="login-tab" data-toggle="tab" href="#login"
                                role="tab" aria-controls="login"
                                aria-selected="true">{{ __('general.navs.login') }}</a>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <a class="nav-link py-3" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                aria-controls="register" aria-selected="true">{{ __('general.navs.register') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white rounded" id="accountTabContent">
                        <div class="tab-pane fade show active rounded" id="login" role="tabpanel"
                            aria-labelledby="login-tab">

                            <div class="card-body">

                                <form role="form" method="POST" action="{{ route('login') }}" class="">
                                    @csrf

                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                        <label>Usuario:</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Email') }}" type="email" name="email" required
                                                autofocus>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label>Contraseña:</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" placeholder="{{ __('Contraseña') }}" type="password"
                                                required>
                                            <span class="p-viewer">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" name="remember" id="customCheckLogin"
                                            type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customCheckLogin">
                                            <span class="text-muted">Recordarme</span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">Entrar</button>
                                    </div>
                                </form>
                                <div class="mt-3">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <small>¿Has olvidado tu contraseña?</small>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade rounded " id="register" role="tabpanel"
                            aria-labelledby="register-tab">

                            <div class="card-body px-lg-4 py-lg-4">

                                <form role="form" method="POST" action="{{ route('register') }}"
                                    id="register-form">
                                    @csrf
                                    <p>Selecciona tipo de perfil:</p>
                                    <div class="form-user-type mb-4">
                                        @if ($errors->has('fikal'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('fikal') }}</strong>
                                            </span>
                                        @endif
                                        <div class=" d-flex justify-content-around">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="fikal"
                                                    value="1" checked required>
                                                <label class="form-check-label"
                                                    for="exampleCheck1">{{ __('general.Escort') }}</label>
                                            </div>
                                            <div class=" form-check">
                                                <input type="radio" class="form-check-input" name="fikal"
                                                    value="2">
                                                <label class="form-check-label"
                                                    for="">{{ __('general.Agency') }}</label>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('malun') ? ' has-danger' : '' }}">
                                        <label>Introduce tu correo electrónico:</label>
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>

                                            <input type="email" name="email" class="d-none">
                                            <input
                                                class="form-control {{ $errors->has('malun') ? ' is-invalid' : '' }}"
                                                placeholder="correo@ejemplo.com" type="email" name="malun"
                                                required>
                                        </div>
                                        @if ($errors->has('malun'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>El email no es válido</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label>Añade una contraseña:</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="Contraseña" type="password" name="password" required>
                                            <span class="p-viewer">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Confirmar Contraseña"
                                                type="password" name="password_confirmation" required>
                                            <span class="p-viewer">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-12">
                                            <div class="custom-control custom-control-alternative custom-checkbox">
                                                <input class="custom-control-input" id="accept_policy"
                                                    type="checkbox" name="accept_policy" required checked>
                                                <label class="custom-control-label" for="customCheckRegister">
                                                    <span class="text-muted">Estoy de acuerdo con la <a
                                                            href="#!">Política
                                                            de Privacidad</a></span>
                                                </label>
                                            </div>
                                            <span class="invalid-feedback d-none" style="display: block;"
                                                role="alert" id="policy-check">
                                                <strong>{{ __('general.must_accept_policy') }}</strong>
                                            </span>

                                        </div>
                                    </div>
                                    <div class="text-center">                                      
                                        <input type="submit" class="btn btn-primary mt-4 btn-submit" value="Crear Cuenta">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="row">
            <div class="pb-5 pt-5">

                <h2 class="text-xl">{{ __('general.howto_title') }}</h2>
                <p>{{ __('general.howto_text_main') }}</p>
                <p>{{ __('general.howto_text_contact') }}<a href="mailto:info@escortssecrets.com">
                        {{ config('app.contact_email') }}</a></p>
                <p>{{ __('general.howto_text_wassap') }} <a
                        href="https://api.whatsapp.com/send?phone=34684795019&amp;text=Quiero Anunciarme"><i
                            class="icon-whatsapp"></i> {{ config('app.contact_phone') }}</a></p>
            </div>
        </div>

        @push('js')
            <script>
                $('#register-form').on('submit', function(e) {
                    if ($('#accept_policy:checked').length === 0) {
                        $('#policy-check').removeClass('d-none')
                        e.preventDefault();
                    }
                });
                $('.p-viewer').on('click', function() {
                    let nu_type = $(this).siblings()[1].getAttribute('type') == 'text' ? 'password' : 'text';
                    $('.p-viewer').each(function() {
                        $(this).siblings()[1].setAttribute('type', nu_type)
                    });
                })
            </script>
        @endpush
    </div>

</x-guest-layout>
