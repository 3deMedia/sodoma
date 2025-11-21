<x-guest-layout>
    <div class="container  pb-5 pt-5 pt-md-1">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-black pb-4">
                        <h2 class="text-xl text-center text-white">RECUPERAR CONTRASEÑA</h2>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                          <!-- Session Status -->
                          @if(session('status'))
                          <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                            <strong>{{session('status')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                          @error('email')
                          <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>{{$message}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror


                        <form role="form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-4 text-sm text-black">
                                ¿Has olvidado tu contraseña? No hay problema escribe tu email y te enviaremos un enlace para recuperarla.
                            </div>
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-100" type="email" name="email" :value="old('email')" required autofocus />

                            </div>
                            <div class="d-flex align-items-center justify-content-end mt-4">
                                <x-button class="btn btn-primary mt-4 btn-submit">
                                    Recuperar Contraseña
                                </x-button>

                            </div>



                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
