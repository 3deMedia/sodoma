<div>

    @if ($admin)
    <form action="{{ route('admin-profile-store') }}" method="post" autocomplete="off"
    enctype="multipart/form-data" id="Escortform">
    @elseif($agency)
    <form action="{{ route('agency.store.escort') }}" method="post" autocomplete="off"
    enctype="multipart/form-data" id="NewEscortForm" class="container py-4">
    @else
    <form action="{{ route('profile.store') }}" method="post" autocomplete="off"
    enctype="multipart/form-data" id="NewEscortForm" class="container py-4">
    @endif


    @csrf

    @if ($admin)
        <input type="hidden" name="user_type_id" value="1">
    @endif
    @if ($agency)
        <input type="hidden" name="for_profile" value="{{$agency}}">
    @endif
        {{-- Básico --}}

        <div class="row mt-5">
            <h3 class="fs-3 fs-md-1 fw-bold text-333 border-bottom border-mcolor">{{
                __('forms.profile.Basic') }}
            </h3>
            <div class="col-12 d-flex flex-wrap flex-md-nowrap mt-3">
                <div class="d-flex flex-column w-100">
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span>{{ __('forms.profile.Name') }} <span
                                class="text-danger">*</span></span>
                        <input required  type="text" name="name" class="form-control"
                            value="{{  old('name') }}" />
                    </label>

                    <label for="gender" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label" >
                        <span>{{ __('forms.profile.Gender') }} <span class="text-danger">*</span>
                        </span>
                        <select required class="form-control" name="gender" id="gender">
                            <option value="0" {{ old('gender')==0 ? 'selected' : '' }}>
                                {{ __('forms.profile.Female') }}</option>
                            <option value="1 " {{ old('gender')==1 ? 'selected' : '' }}>
                                {{ __('forms.profile.Male') }}
                            </option>
                            <option value="2" {{ old('gender')==2 ? 'selected' : '' }}>
                                {{ __('forms.profile.Trans') }}</option>
                        </select>
                    </label>

                </div>
                 @if (!$agency) 
                <div class="d-flex flex-wrap w-100">
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span>{{ __('forms.profile.Phone') }} <span
                                class="text-danger">*</span></span>
                        <input required  type="text" name="phone" class="form-control"
                        @if($agency)
                        @php
                            $phone= \App\Models\Profile::find($agency)->phone
                        @endphp
                        value="{{ $phone }}"
                        @else
                        value="{{  old('phone') }}"
                        @endif
                        />
                    </label>
                    <label for="email" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span class="">{{ __('forms.profile.Email') }}</span>
                        <input required  type="text" name="email"
                        @if($agency)
                        @php
                            $email= \App\Models\Profile::find($agency)->email
                        @endphp
                        value="{{ $email }}"
                        @else                    
                            value="{{  old('email') }}"
                        @endif
                            class="form-control" />
                    </label>
                </div>
                 @endif
                <label for="web"  class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                    <span>{{ __('forms.profile.web') }}</span>
                    <input  type="text" name="web" class="form-control"
                    @if($agency)
                        @php
                            $web= \App\Models\Profile::find($agency)->web
                        @endphp
                        value="{{ $web }}"
                        @else
                            value="{{  old('web') }}"
                        @endif
                
                </label>
            </div>

            <div class="col-12">
                <label for="" class="pb-3 px-0 px-md-2 w-100">
                    <p class="">{{ __('forms.profile.Description') }} <span class="text-red">*</span></p>
                    <textarea required name="description"
                        class="w-100 rounded">{{  old('description') }}</textarea>
                </label>
            </div>
        </div>
        {{-- Fin Basico --}}

         {{-- GALERIA IMAGENES --}}
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100">{{ __('forms.profile.Gallery') }}
                    <span class="mcolor text-sm"><i class="fas fa-question-circle"></i>
                     {{__('general.basicmax')}}  2  {{__('general.photos')}}. @if(!$agency) <a href="{{ route('become-vip') }}" class="">{{__('general.updateper')}}</a> @endif
                    </span>
                </h3>
                    <br>
                <script>
                    const gallery_source = null;
                </script>
                <input required  type="file" name="photos[]" id="escort_photos" accept="image/png, image/jpg, image/jpeg" multiple
                class="w-100">
            </div>
            <div class="col-12 form-check">
                <label class="form-check-label">
                    <h6 class="fw-bold border-bottom border-mcolor w-100 pt-md-4 my-2 text-black">{{ __('general.hideface') }}</h6>
                    <p>{{ __('general.hideparrafo') }}</p>
                <p id="radiooptions" class="mt-3">
                    <label><input type="radio" name="hide_face" value="0" >
                        <span>{{ __('general.No') }}</span></label>
                    <label><input type="radio" name="hide_face" value="1" >
                        <span>{{ __('general.Yes') }}</span></label>
                </p> </label>
              </div>
        </div>

        {{--FIN GALERIA IMAGENES --}}

        {{-- Estetica  --}}
        <div class="row mt-5">
            <h3 class="fs-3 fs-md-1 fw-bold text-333 border-bottom border-mcolor">
                {{ __('forms.profile.Estetic') }}</h3>

            <div class="col-12 mt-3">

                <div class=" d-flex flex-wrap flex-md-nowrap">
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span class="">{{ __('forms.profile.nationality') }}</span>
                        {{-- Se quita asterisco --}}
                        <select required class="js-example-basic-single" name="nationality_id">
                            @php $nationalities= DB::table('nationalities')->get() @endphp
                             {{-- Se añade option con valor null --}}
                            <option value="null">Sin definir</option>

                            @foreach ($nationalities as $origin)
                            <option value="{{ $origin->id }}" {{ old('nationality_id')==$origin->id ? 'selected':'' }}>
                                {{ __("geodata.nationalities.$origin->name") }} </option>
                            @endforeach
                        </select>
                    </label>

                </div>

                <div class="d-flex flex-wrap flex-md-nowrap">
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span class="">{{ __('forms.profile.eye_color') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="eye_color_id">
                            @php $eyecolors= DB::table('eye_colors')->get() @endphp
                            @foreach ($eyecolors as $ecolor)
                            <option value="{{ $ecolor->id }}" {{ old('eye_color_id')==$ecolor->id ? 'selected': ''  }}>
                                {{ __("forms.profile.$ecolor->name") }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span class="">{{ __('forms.profile.Hair_color') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="hair_color_id">
                            @php $hcolors= DB::table('hair_colors')->get() @endphp
                            @foreach ($hcolors as $hcolor)
                            <option value="{{ $hcolor->id }}" {{ old('hair_color_id')==$hcolor->id ? 'selected': ''  }}>
                                {{ __("forms.profile.$hcolor->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
        </div>
         {{-- Fin Estetica  --}}

        {{-- Medidas  --}}
        <div class="row mt-5">
            <h3 class="fs-3 fs-md-1 fw-bold text-333 border-bottom border-mcolor col-12">
                {{ __('forms.profile.Measures') }}</h3>
            <div class="col-12 mt-3">
                <div class="d-flex flex-wrap flex-xl-nowrap w-100">
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.age') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="age" id="age-sel">
                            @for ($i = 18; $i < 45; $i++) <option value="{{ $i }}" {{ old('age')==$i
                                ? 'selected' : '' }}>
                                {{ $i }}
                                </option>
                                @endfor
                        </select>
                    </label>
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-lg-4 sel-dos form-label">
                        <span class="">{{ __('forms.profile.height') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="height">
                            @for ($j = 150; $j < 190; $j++) <option value="{{ $j }}" {{ old('height')==$j
                                ? 'selected' : '' }}>
                                {{ $j }} cm</option>
                                @endfor
                        </select>
                    </label>
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-xl-4 sel-dos form-label">
                        <span class="">{{ __('forms.profile.weight') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="weight">
                            @for ($k = 50; $k < 75; $k++) <option value="{{ $k }}" {{ old('weight')==$k
                                ? 'selected' : '' }}>
                                {{ $k }} kg</option>
                                @endfor
                        </select>
                    </label>

                </div>
                <div class="w-100 d-flex flex-wrap flex-lg-nowrap">

                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.breast_size') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="breast_size">
                            @for ($l = 63; $l < 112; $l++) <option value="{{ $l }}" {{old('breast_size')==$l
                                ? 'selected' : '' }}>
                                {{ $l }} cm</option>
                                @endfor
                        </select>
                    </label>
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-lg-4 sel-dos form-label">
                        <span class="">{{ __('forms.profile.breast_type') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="breast_type">
                            <option value="0" {{ old('breast_type')==0 ? 'selected' : '' }}>
                                -
                            </option>
                            <option value="1" {{ old('breast_type')==1 ? 'selected' : '' }}>
                                Natural
                            </option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
         {{--
        <!--Adicional--> --}}
        <div class="row mt-5">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 my-5">
                {{ __('forms.profile.Additional') }}</h3>
            <div class="col-12 mt-3">
                <div class="d-flex flex-wrap flex-md-nowrap w-100">
                    <label for="smoker" class="d-flex flex-column p-0 p-md-2 w-100 form-label">
                        <span class="">{{ __('forms.profile.smoker') }}</span>
                            <p id="radiooptions" class="mt-3">
                                <label><input type="radio" name="smoker" value="0" {{ old('smoker') == 0 ? 'checked' : '' }}>
                                    <span>{{ __('general.No') }}</span></label>
                                <label><input type="radio" name="smoker" value="1" {{ old('smoker') == 1 ? 'checked' : '' }}>
                                    <span>{{ __('general.Yes') }}</span></label>
                            </p>
                    </label>
                    <label for="private_apartament" class="d-flex flex-column p-0 p-md-2 w-100 form-label">
                        <span class="">{{ __('forms.profile.private_apartment') }}</span>
                        <p id="radiooptions" class="mt-3">
                            <label><input type="radio" name="private_apartament" value="0" {{  old('private_apartament')  == 0 ? 'checked' : '' }}>
                                <span>{{ __('general.No') }}</span></label>
                            <label><input type="radio" name="private_apartament" value="1" {{  old('private_apartament')  == 1 ? 'checked' : '' }}>
                                <span>{{ __('general.Yes') }}</span></label>
                        </p>
                    </label>
                </div>
            </div>
            <div class=" col-12">
                <div class="d-flex flex-wrap flex-md-nowrap w-100">
                    <label for="" class="p-0 p-md-2 d-flex flex-column w-100 form-label">
                        <span class="whatsapp_acceptance">{{ __('forms.profile.whatsapp_acceptance') }}</span>
                        <p id="radiooptions" class="mt-3">
                            <label><input type="radio" name="whatsapp_acceptance" value="0" {{ old('whatsapp_acceptance')  == 0 ? 'checked' : '' }}>
                                <span>{{ __('general.No') }}</span></label>
                            <label><input type="radio" name="whatsapp_acceptance" value="1" {{ old('whatsapp_acceptance')  == 1 ? 'checked' : '' }}>
                                <span>{{ __('general.Yes') }}</span></label>
                        </p>
                    </label>
                    <label for="creditcard_acceptance" class="p-0 p-md-2 d-flex flex-column w-100 form-label">
                        <span class="creditcard_acceptance">{{ __('forms.profile.creditcard_acceptance') }}</span>
                        <p id="radiooptions" class="mt-3">
                            <label><input type="radio" name="creditcard_acceptance" value="0" {{  old('creditcard_acceptance') == 0 ? 'checked' : '' }}>
                                <span>{{ __('general.No') }}</span></label>
                            <label><input type="radio" name="creditcard_acceptance" value="1" {{  old('creditcard_acceptance') == 1 ? 'checked' : '' }}>
                                <span>{{ __('general.Yes') }}</span></label>
                        </p>
                    </label>
                </div>
            </div>
            <div class=" col-12">
                <div class="d-flex flex-wrap flex-md-nowrap w-100">
                    <label for="is_pornstar" class="p-0 p-md-2 d-flex flex-column w-100 form-label">
                        <span class="is_pornstar">{{ __('forms.profile.bizum') }}</span>
                            <p id="radiooptions" class="mt-3">
                                <label><input type="radio" name="is_pornstar" value="0" {{  old('is_pornstar') == 0 ? 'checked' : '' }}>
                                    <span>{{ __('general.No') }}</span></label>
                                <label><input type="radio" name="is_pornstar" value="1" {{ old('is_pornstar')  == 1 ? 'checked' : '' }}>
                                    <span>{{ __('general.Yes') }}</span></label>
                            </p>
                    </label>
            </div>
            </div>
            <div class="col-12 mt-5">
                <div>
                    <label for="languages[]" class="pb-3 px-0 px-md-2 d-flex flex-column sel-indio form-label">
                        <span class="">{{ __('forms.profile.languages') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-multiple w-100" name="languages[]" multiple>
                            @php $ulangs= DB::table('user_languages')->get() @endphp
                            @foreach ($ulangs as $ulang)
                            <option value="{{ $ulang->id }}" @if (old('languages')) {{ in_array($ulang->id,old('languages')) ? 'selected': '' }} @endif>
                                {{ __("geodata.langs.$ulang->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div>
                    <label for="travel_ranges" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.Travel') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="travel_range_id">
                            @php $tranges= DB::table('travel_ranges')->get() @endphp

                            @foreach ($tranges as $trange)
                            <option value="{{ $trange->id }}" {{ old('travel_range_id')==$trange->id ? 'selected' : '' }}>
                                {{ __("forms.profile.$trange->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
        </div>


        {{-- Fin Adicional  --}}


        {{-- servicios --}}

        <div class="row  mt-5">
            <h3 class="fs-3 fs-md-1 fw-bold text-333 border-bottom border-mcolor col-12">
                {{ __('forms.profile.services') }} <span class="text-danger">*</span></h3>
            <div class="col-12 mt-3">
                <div class="d-flex flex-wrap p-2">

                    @php $db_services= DB::table('services')->get() @endphp

                    @foreach ($db_services as $db_serv)
                    <label class="d-flex  mx-2 p-2 align-items-center form-label">

                        <input   type="checkbox" value="{{ $db_serv->id }}" name="services[]"
                            @if(old('services')) {{ in_array( $db_serv->id ,old('services')) ? 'checked': ''
                        }}
                        @endif
                        class="rounded"
                        />
                        &nbsp;
                        <span class="mx-1">{{ __("forms.services.$db_serv->name") }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- FIN servicios --}}


        {{-- Precios --}}

        <div class="row  mt-5">
            <h3 class="fs-3 fs-md-1 fw-bold text-333 border-bottom border-mcolor col-12">
                {{ __('forms.prices.prices') }}</h3>
            <div class="col-12 mt-3">
                <div class="d-flex flex-wrap flex-md-nowrap">
                    <div class="w-100 ">
                        <label for="half_hour" class="w-100 d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">{{ __('forms.prices.half_hour') }}</span>
                            <input type="text" name="half_hour" class="form-control"
                                value="{{  old('half_hour') }}" />
                        </label>
                        <label for="one_hour" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class=""> {{ __('forms.prices.one_hour') }}
                                <span class="text-danger">*</span></span>
                            <input required  type="text" name="one_hour" class="form-control"
                                value="{{ old('one_hour') }}" />
                        </label>
                        <label for="added_hour" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class=""> {{ __('forms.prices.added_hour') }}</span>
                            <input type="text" name="added_hour" class="form-control"
                                value="{{ old('added_hour') }}" />
                        </label>
                    </div>
                    <div class="w-100 ">
                        <label for="half_day" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">{{ __('forms.prices.half_day') }}</span>
                            <input type="text" name="half_day" class="form-control"
                                value="{{  old('half_day') }}" />
                        </label>
                        <label for="one_day" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">{{ __('forms.prices.one_day') }}</span>
                            <input type="text" name="one_day" class="form-control"
                                value="{{ old('one_day') }}" />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- FIN precios --}}

        {{-- Direccion  --}}
        <div class="row mt-5">
            <h3 class="fs-3 fs-md-1 fw-bold text-333 border-bottom border-mcolor">{{
                __('forms.profile.Address') }}</h3>
                <div class="d-flex flex-wrap flex-xl-nowrap">

                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.Country') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single w-full " name="country_id"
                            id="e-country-select">
                            @php $countries= DB::table('countries')->get() @endphp
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id')==$country->id ?'selected' : ''}}>
                                {{ __("geodata.countries.$country->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-lg-4 sel-dos form-label">
                        <span class="mx-2">{{ __('forms.profile.Region') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single w-full " name="region_id"
                            id="e-region-select">

                            @if(old('region_id'))
                                <option value="{{ old('region_id') }}" selected>
                                    {{ DB::table('regions')->where('id',intval(old('region_id')))->first()->name }}
                                </option>
                            @endif
                        </select>
                    </label>
                    <label for="" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-xl-4 sel-dos form-label">
                        <span class="mx-2">{{ __('forms.profile.City') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single w-full " name="city_id"
                            id="e-cities-select">
                            @if(old('city_id'))
                                <option value="{{ old('city_id') }}" selected>
                                    {{ DB::table('cities')->where('id', intval(old('city_id')))->first()->name}}
                                </option>
                            @endif
                        </select>
                    </label>
                </div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <div class="w-100 py-2">
                    <label for="" class="flex-column w-100">
                        <span class="form-label">{{ __('forms.profile.Address') }} <span
                                class="text-danger">*</span></span>
                        <input required  type="text" name="profile_address" id="profile_address" class="form-control"
                            value="{{  old('address') }}" />
                    </label>
                </div>

            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <button type="submit"
                class="btn rounded w-100 bg-rosa text-white px-4 py-2 mx-auto btn-submit">{{ __('general.Create') }}</button>
            </div>
        </div>
</form>
</div>
