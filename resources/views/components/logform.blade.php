<div class="border">

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4 p-2" :errors="$errors" />
        </div>
        <div x-data="{ openTab: 1 }" class=" border border-gray-400 rounded-t " x-cloak>

            <ul class="flex  text-center mcolor ">
                <li @click="openTab = 1" class=" p-4 w-1/2 border-b border-r border-gray-400"
                    :class="openTab == 1 ? 'text-white' : 'mcolor'">
                    <a class="py-2 px-4 hover:text-white  font-semibold" href="#">Login</a>
                </li>
                <li @click="openTab = 2" class=" p-4 w-1/2  border-b border-gray-400"
                    :class="openTab == 2 ? 'text-white' : 'mcolor'">
                    <a class=" py-2 px-4  hover:text-white font-semibold" href="#">Registro</a>
                </li>

            </ul>
            <div class="w-full p-4">
                <div x-show="openTab === 1">

                    <x-slot name="logo">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        </a>
                    </x-slot>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />



                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="text-white">{{ __('Email') }}</label>

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password" class="text-white">{{ __('Password') }}</label>

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="remember">
                                <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-white hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button class="ml-3">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>

                </div>
                <div x-show="openTab === 2">

                    <x-slot name="logo">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        </a>
                    </x-slot>


                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf
                        <!-- Agencia o escort -->
                        <div class="mt-4">
                            <label for="type" class="text-white"> {{ __('Tipo') }}</label><br>
                            <div class="flex justify-around">
                                <label for="type" class="text-white">
                                    <input type="radio" name="type" value="1" checked>
                                    &nbsp; {{ __('general.Escort') }}
                                </label>

                                <label for="type" class="text-white">
                                    <input type="radio" name="type" value="2">
                                    &nbsp;{{ __('general.Agency') }}
                                </label>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="email" class="text-white">{{ __('Email') }}</label>

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password" class="text-white"> {{ __('Password') }}</label>

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label for="password_confirmation" class="text-white">
                                {{ __('Confirm Password') }}</label>

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-white hover:text-gray-400" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button class="ml-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>

                </div>

            </div>
        </div>
        </form>
    </x-auth-card>
</div>
