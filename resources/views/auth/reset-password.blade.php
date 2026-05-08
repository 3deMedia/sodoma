<x-guest-layout>

    <div class="container  pb-5 pt-5 pt-md-1">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-black pb-4">
                        <img src="{{ asset('images/escortssecrets-logo-lujo-21.png') }}" style="height: 59px" alt="Escorts Secrets Publicidad"/>
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
                          @error('password')
                          <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>{{$message}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          @error('password_confirmation')
                          <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>{{$message}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror


                        <form role="form" method="POST" action="{{ route('password.update') }}">
                            @csrf


                              <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-100" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-100"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="d-flex align-items-center justify-content-end mt-4">
                <x-button class="btn-info">
                    {{ __('Reset Password') }}
                </x-button>
            </div>



                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-guest-layout>
