<div>
    <div class="row">
        <div class="col-12 col-md-10 mx-auto">


            @if ($admin)
            <form action="{{ route('admin-profile-store') }}" method="post" autocomplete="off"
            enctype="multipart/form-data" id="Escortform">
            @else
            <form action="{{ route('profile.store') }}" method="post" autocomplete="off"
            enctype="multipart/form-data" id="NewEscortForm" class="container py-4">
            @endif
                @csrf

                @if ($admin)
                <input type="hidden" name="user_type_id" value="2">

                @endif
                <div>
                     {{-- Informacion Basica --}}
                    <div class="row">
                        <div class="col-12">
                            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100 pb-2">
                                {{ __('forms.profile.Basic') }}</h3>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap flex-md-nowrap">

                                <label for="" class="p-2 d-flex flex-column w-100 ">
                                    <span class="form-label">{{ __('forms.profile.Name') }}</span>
                                    <input required name="name" type="text" class="w-100 form-control"
                                        value="{{  old('name') }}" />
                                </label>
                                <label for="" class="p-2 d-flex flex-column w-100">
                                    <span class="form-label">{{ __('forms.profile.Email') }}</span>
                                    <input required type="text" name="email" class="form-control"
                                        value="{{ old('email') }}" />
                                </label>
                            </div>
                            <div class="d-flex flex-wrap flex-md-nowrap">
                                <label for="" class="p-2 d-flex flex-column w-100">
                                    <span class="form-label">{{ __('forms.profile.Phone') }}</span>
                                    <input required type="text" name="phone" class="form-control"
                                        value="{{ old('phone') }}" />
                                </label>
                                <label for="" class="p-2 d-flex flex-column w-100">
                                    <span class="form-label">{{ __('forms.profile.web') }}</span>
                                    <input type="text" name="web" class="form-control"
                                        value="{{ old('web') }}" />
                                </label>
                            </div>
                        </div>

                        <div class="col-12">

                            <label for="" class="form-label w-100">
                                <p class="mx-2">{{ __('forms.profile.Description') }}</p>
                                <textarea required required  name="description" id=""
                                    class="w-100 rounded  form-control">{{  old('description') }}</textarea>
                            </label>

                        </div>

                    </div>
                    {{-- FIn informacion basica --}}
                     {{-- Foto  --}}
                    <div class="row mt-5">
                        <div class="pb-4">
                            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100 pb-3" for="logo">Logotipo</h3>
                            <input type="file" name="logo" id="logo"  class="w-100">
                        </div>
                        <h3  class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100 mt-5 pb-3">Imagen de portada</h3>
                        <div class="col-12 py-4">
                            <script>
                                const main_source = null
                            </script>
                            <input type="file" name="photo" id="agency_photo"  class="w-100">
                        </div>
                    </div>
                    {{-- Fin Foto --}}

                    {{-- Direccion  --}}
                    <div class="row">
                        <div class="col-12 mt-5">
                            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100 pb-3">
                                {{ __('forms.profile.Address') }}</h3>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-wrap flex-md-nowrap">
                                <label for="" class="w-100 w-md-25 d-flex flex-column px-2">
                                    <span class="form-label">{{ __('forms.profile.Country') }}</span>
                                    <select required  class="js-example-basic-single w-100 " name="country_id"
                                        id="a-country-select">
                                        @php $countries= DB::table('countries')->get() @endphp
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{  old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ __("geodata.countries.$country->name") }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label for="" class="w-100 w-md-25 d-flex flex-column px-2">
                                    <span class="form-label">{{ __('forms.profile.Region') }}</span>
                                    <select required  class="js-example-basic-single w-100" name="region_id"
                                        id="a-region-select">
                                        @if(old('region_id'))
                                        <option value="{{ old('region_id') }}" selected>
                                            {{ DB::table('regions')->where('id', intval(old('region_id')))->first()->name }}
                                        </option>
                                        @endif

                                    </select>
                                </label>

                                <label for="" class="w-100 d-flex flex-column px-2">
                                    <span class="form-label">{{ __('forms.profile.City') }}</span>
                                    <select required class="js-example-basic-single w-100" name="city_id"
                                        id="a-cities-select">
                                        @if(old('city_id'))
                                        <option value="{{ old('city_id') }}" selected>
                                            {{ DB::table('cities')->where('id', intval(old('city_id')))->first()->name}}
                                        </option>
                                        @endif
                                    </select>
                                </label>
                            </div>

                        </div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="col-12  mt-5">
                            <div class="w-100 p-2 mb-2">
                                <label for="" class="w-100">
                                    <span>{{ __('forms.profile.Address') }} <span
                                            class="text-red-400">*</span></span>
                                    <input required  type="text" name="profile_address" id="profile_address" class="w-100"
                                        value="{{  old('address') }}" />
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- Fin Direccion --}}
                    <div class="row">
                        <div class="col-12 my-5">

                            <div class="p-2 text-center py-4 w-100 d-flex">
                                <input type="submit" name="save"
                                class="btn rounded w-100 bg-rosa text-white px-4 py-2 mx-auto btn-submit" value="{{ __('general.Save') }}">

                            </div>
                        </div>
                    </div>

                </div>
        </div>
        <!-- LBasic-->

        </form>
    </div>
</div>
