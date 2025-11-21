<x-guest-layout>
    <div class="container  pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 mt-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h4>{{ __('auth.Verify_title') }}</h4>
                        </div>
                        <div class="text-black">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('auth.Verify_email') }} <br><br>
                            <div class="text-center mt-4">

                                <form  method="POST" action="{{route('logout')}}" class="">
                                    @CSRF
                                    <button type="submit" class="btn bg-pink text-white">{{__('auth.exit')}}</button>
                                </form>
                            </div>

                            <p class="mt-4 text-sm">
                                @if (Route::has('verification.send'))
                                {{ __('auth.no_email_received') }}, <a href="{{ route('verification.resend') }}">{{ __('auth.click_here') }}</a>
                            @endif
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
