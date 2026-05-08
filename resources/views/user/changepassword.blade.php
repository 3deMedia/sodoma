<x-app-layout>

    <div class="container pb-8">

            <div class="row">
                <div class="col-12 col-md-10 col-lg-8 mx-auto ">
                    <h2 class="fw-bold">{{ __('passwords.Change Password') }}</h2>
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off"
                    class="card p-4 shadow">
                    @csrf
                    @method('put')



                    @if (session('password_status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('password_status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label class="form-control-label"
                                for="input-current-password">{{ __('passwords.Current Password') }}</label>
                            <input type="password" name="old_password" id="input-current-password"
                                class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('passwords.Current Password') }}" value="" required>

                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label class="form-control-label"
                                for="input-password">{{ __('passwords.New Password') }}</label>
                            <input type="password" name="password" id="input-password"
                                class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('passwords.New Password') }}" value="" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"
                                for="input-password-confirmation">{{ __('passwords.Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" id="input-password-confirmation"
                                class="form-control form-control-alternative"
                                placeholder="{{ __('passwords.Confirm New Password') }}" value="" required>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="btn rounded w-100 bg-rosa text-white px-4 py-2 mx-auto btn-submit">{{ __('passwords.Change Password') }}</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
    </div>
</x-app-layout>
