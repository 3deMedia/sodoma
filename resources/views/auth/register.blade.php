<x-guest-layout>

    @push('meta')
        {{-- <meta name="description" content="{!! $seo->seo_description !!}" />
        <meta name="keywords" content="{{ $seo->seo_keywords }}" />
        <title>{{ config('app.name') }} | {{ $seo->seo_title }}</title> --}}
    @endpush



<div class="container">
    <div class="title text-center pt-6">
        <h1>Publica tu anuncio</h1>
    </div>
    <p class="text-center text-black"><em>Si quieres calidad y garantía, puedes publicar tus <strong>anuncios eróticos</strong> en nuestro listado exclusivo para mujeres con clase.</em></p>

   <div class="pb-6 pt-6">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card bg-secondary">
                <div class="card-header pb-2">
                  <h2 class="text-xl text-center text-black">Ya soy cliente</h2>
                </div>
                <div class="card-body px-lg-4 py-lg-4">

                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña') }}" type="password"  required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheckLogin">
                                <span class="text-muted">Recordarme</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-light">
                            <small>¿Has olvidado tu contraseña?</small>
                        </a>
                    @endif
                </div>

            </div>
        </div>

    <div class="col-lg-6 col-md-6 mt-8 mt-md-0">
        <div class="card bg-secondary">
            <div class="card-header pb-2">
                <h2 class="text-xl text-center text-black">Quiero Registrarme</h2>
            </div>
            <div class="card-body px-lg-4 py-lg-4">

                <form role="form" method="POST" action="{{ route('register') }}" id="register-form">
                    @csrf
                    <div>
                        @if ($errors->has('user_type_id'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('user_type_id') }}</strong>
                            </span>
                        @endif
                        <div class="form-group d-flex justify-content-around">
                            <div class="form-group form-check">
                                <input type="radio" class="form-check-input" id="" name="user_type_id" value="1"
                                    checked required>
                                <label class="form-check-label"
                                    for="exampleCheck1">{{ __('general.Escort') }}</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="radio" class="form-check-input" id="" name="user_type_id"
                                    value="2">
                                <label class="form-check-label" for="">{{ __('general.Agency') }}</label>
                            </div>

                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <label>Introduce tu correo electrónico:</label>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Email') }}" type="email" name="email"
                                value="{{ old('email') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="Contraseña" type="password" name="password" required>
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
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="Confirmar Contraseña"
                                type="password" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-12">
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id="accept_policy" type="checkbox"
                                    name="accept_policy" required>
                                <label class="custom-control-label" for="customCheckRegister">
                                    <span class="text-muted">Estoy de acuerdo con la <a
                                            href="#!">Política de Privacidad</a></span>
                                </label>
                            </div>
                            <span class="invalid-feedback d-none" style="display: block;" role="alert"
                                id="policy-check">
                                <strong>{{ __('general.must_accept_policy') }}</strong>
                            </span>

                        </div>
                    </div>
                    <div class="text-center">
                    <button class="g-recaptcha btn btn-primary mt-4 btn-submit" data-sitekey="6Le3P9oqAAAAAMCrR7p9bRF96qABlXVbziiHXSFU"
                    data-callback='onSubmit' data-action='submit'>Crear cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
</script>
@endpush
</div>
<div>
    <div class="container pb-5 pt-5">

<h3>¿Cómo publicar tu anuncio?</h3>
<p class="text-black">Para publicar un anuncio es necesario registrarse. Es muy sencillo, luego solo tienes que rellenar los datos de tu ficha y adjuntar las fotografías. Si hay algún problema te ayudaremos en todo momento. No dudes en consultarnos.</p>
<p class="text-black">Puedes comunicarte con nosotros por email: <a href="mailto:info@escortssecrets.com">info@escortssecrets.com</a></p>
<p class="text-black">También podemos atenderte todo por Whatsapp en nuestro número <a href="https://api.whatsapp.com/send?phone=0034684795019&amp;text=Quiero Anunciarme"><i class="icon-whatsapp"></i> 684 795 019</a></p>
</div>
</div>


</x-guest-layout>
