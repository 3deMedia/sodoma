<div>

    @if(!$admin)

        <div class="text-xs ">
            <div><h2 class="fw-bold mb-4 text-center">{{ __('general.PublishyourAd') }}</h2></div>

            <!-- Contador de Visitas en el perfil -->
            {{-- @if ($profile->approved && $profile->active)
                    <div class="alert mcolor border-mcolor">
                         {{$profile->vzt()->period('month')->count()}} {{ __('general.Visits') }} este mes
                    </div>
            @endif --}}
        </div>
    @endif

    @if($agency)
    <form action="{{ route('agency-escort-update', $profile->id) }}" method="post" autocomplete="off"
    enctype="multipart/form-data" id="EscortForm" class="container py-4">

    @elseif($admin)
    <form action="{{ route('admin-profile-update', $profile->id) }}" method="post" autocomplete="off"
        enctype="multipart/form-data" id="Escortform">

    @else
    <form action="{{ route('profile.update',$profile->id) }}" method="post" autocomplete="off"
        enctype="multipart/form-data" id="Escortform">
    @endif
        @csrf
        @method('PUT')

        @if(!$admin)
        <div class="row">
            <p>{{ __('general.filtxt') }}</p>
        </div>
        @else
        <div class="row">
            <h3 class="fs-3 fw-bold text-mgray border-bottom border-mcolor w-75">
                {{ __('forms.profile.Status') }}
            </h3>
            <div class="d-flex">
                <label for="active" class="p-2 m-2">{{ __('general.profile_approved') }}
                    <select name="approved" id="" class="form-control">
                        <option value="1" @if($profile->approved) selected @endif >{{ __('general.Yes') }}</option>
                        <option value="0" @if(!$profile->approved) selected @endif>{{ __('general.No') }}</option>
                    </select>
                </label>
                <label for="active" class="p-2 m-2">{{ __('general.visible') }} /Activo
                    <select name="active" id="" class="form-control">
                        <option value="1" @if($profile->active) selected @endif >{{ __('general.Yes') }}</option>
                        <option value="0" @if(!$profile->active) selected @endif>{{ __('general.No') }}</option>
                    </select>
                </label>
            </div>
        </div>
        @endif
        <!--Basico -->
        <div class="row">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 montserrat my-5">
                {{ __('forms.profile.Basic') }}
            </h3>

            <div class="col-12 py-2 d-flex flex-wrap flex-md-nowrap">
                <div class="d-flex flex-wrap w-100">
                    <label for="name" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span>{{ __('forms.profile.Name') }}
                            <span class="text-danger">*</span></span>
                        <input required  type="text" name="name" class="form-control"
                            value="{{ old('name') ?? $profile->name  }}" />
                    </label>
                    <label for="gender" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span class="">{{ __('forms.profile.Gender') }}
                            <span class="text-danger">*</span> </span>
                        <select required class="myselect" name="gender">
                            <option value="0" {{ (old('gender') ?? $profile->Features->gender ) == 0  ? 'selected' : '' }}>
                                {{ __('forms.profile.Female') }}</option>
                            <option value="1" {{ (old('gender') ?? $profile->Features->gender ) == 1  ? 'selected' : '' }}>
                                {{ __('forms.profile.Male') }}
                            </option>
                            <option value="2" {{ (old('gender') ?? $profile->Features->gender ) == 2  ? 'selected' : '' }}>
                                {{ __('forms.profile.Trans') }}</option>
                        </select>
                    </label>

                </div>
                @if (!$agency)
                <div class="d-flex flex-wrap w-100">

                    <label for="email" class="d-flex flex-column pb-3 px-0 px-md-2 w-100 form-label">
                        <span class="">{{ __('forms.profile.Email') }}</span>
                        <input required  type="text" name="email" class="form-control"
                            value="{{ old('email') ?? $profile->email   }}" />
                    </label>
                    <label for="phone" class="pb-3 px-0 px-md-2 d-flex flex-column w-100 form-label">
                        <span class="">{{ __('forms.profile.Phone') }} <span
                                class="text-danger">*</span></span>
                        <input required  type="text" name="phone" class="form-control"
                            value="{{ old('phone') ?? $profile->phone  }}" />
                    </label>
                </div>
                @endif
            </div>
            <div class="col-12">
                <label for="" class="w-100 pb-3 px-2">
                    <p class="">{{ __('forms.profile.web') }}</p>
                    @php
                    $webs = $profile->web;

                  $cut =  substr($webs, 0, 4);

                  @endphp

                   @if ($cut == 'http')
                    <input  type="text" name="web" class="form-control"
                    value="{{ old('web') ?? $profile->web  }}" />
                    @else
                    <input  type="text" name="web" class="form-control"
                    value="  @if (!empty($profile->web)) https://@endif{{ old('web') ??  $profile->web  }}" />

                   @endif
                </label>

            </div>
            <div class="col-12">
                <label for="description" class="form-label w-100 pb-3 px-2">
                    <p class="mx-2">{{ __('forms.profile.Description') }}
                    </p>
                    <textarea required name="description" id=""
                        class="w-100 rounded  form-control">{{ old('description')  ?? $profile->description }}</textarea>
                </label>
            </div>
            <div class="col-12 mt-5 ">
                <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100 pt-md-4 mt-5">{{
                    __('forms.profile.Gallery') }}
                    <span class="mcolor text-sm"><i class="fas fa-question-circle"></i>
                        @if ($profile->is_vip)
                        {{__('general.max')}}
                        @else
                        {{__('general.basicmax')}}
                        @endif


                        @if ($profile->is_vip)
                        {{maxPhohos(true)}}
                        @else
                        {{maxPhohos()}}
                        @endif

                        {{__('general.photos')}}.


                        @if ($profile->is_vip)

                        @else
                        <a href="{{ route('become-vip') }}" class="">{{__('general.updateper')}}</a>
                        @endif

                        </span>

                </h3>
                <p>{{__('general.photorevtxt')}}</p>

                @if ($profile->Photos->count() > 0)
                <label for="main_photo">{{__('general.main_photo')}}
                    <div class="d-flex flex-wrap flex-lg-nowrap w-100">
                        @foreach ($profile->Photos as $photo)
                        <div class="d-flex flex-column p-2">
                            <img src="{{asset("storage/escort_photos/$photo->path/$photo->filename")}}" data-render="{{$photo->id}}" class="mb-1 profile-image @if($photo->is_main) profile-main-image @endif" @if(!$photo->approved) @if(!$admin) @endif
                            @endif alt="">
                            <div class="d-flex justify-content-center">
                            @if ($admin)
                            <a href="{{route('admin-delete-image',$photo->id)}}" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i></a>
                            @else
                            <a href="{{route('delete-escort-image',$photo->id)}}" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i></a>

                            @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <input  type="hidden" name="main_photo" value=" @if ($profile->MainPhoto()) {{$profile->MainPhoto()->id}}     @endif">

                </label>
                @endif
                <input  type="file" name="photos[]" id="escort_photos"  multiple >
            </div>
            <div class="col-12 form-check">
                <label class="form-check-label">
                    <h6 class="fw-bold border-bottom border-mcolor w-100 pt-md-4 my-2 text-black">{{ __('general.hideface') }}</h6>
                    <p>{{ __('general.hideparrafo') }}</p>
                <p id="radiooptions" class="mt-3">
                    <label><input type="radio" name="hide_face" value="0" {{ ( old('hide_face') ?? $profile->hide_face ) == 0 ? 'checked' : '' }}>
                        <span>{{ __('general.No') }}</span></label>
                    <label><input type="radio" name="hide_face" value="1" {{ ( old('hide_face') ?? $profile->hide_face ) == 1 ? 'checked' : '' }}>
                        <span>{{ __('general.Yes') }}</span></label>
                </p> </label>
              </div>
        </div>

        <!-- Fin Basico -->


        <!--Estetica -->
        <div class="row mt-5">
            <h3 class="fs-2 fw-bold border-bottom border-mcolor w-75 text-333 pt-2 pt-md-4 my-5">
                {{ __('forms.profile.Estetic') }}</h3>

            <div class="col-12 ">
                <div class="-flex flex-wrap flex-md-nowrap w-100">
                    <label for="nationality_id" class="pb-3 px-0 px-md-2 d-flex flex-column form-label sel-nacio">
                        <span class="">{{ __('forms.profile.nationality') }}
                            <span class="text-danger">*</span></span>

                        <select required class="js-example-basic-single" name="nationality_id">
                            @php $nationalities= DB::table('nationalities')->get() @endphp
                            {{-- // cambiar tabla --}}
                            @foreach ($nationalities as $origin)
                            <option value="{{ $origin->id }}" {{ ( old('nationality_id') ?? $profile->Features->nationality_id ) == $origin->id ?
                                'selected' : '' }}>
                                {{ __("geodata.nationalities.$origin->name") }}
                            </option>
                            @endforeach
                        </select>
                    </label>

                </div>
                <div class="d-flex flex-wrap flex-lg-nowrap w-100">
                    <label for="eye_color_id" class="pb-3 px-0 px-md-2 d-flex flex-column form-label sel-dos">
                        <span class="">{{ __('forms.profile.eye_color') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="eye_color_id">
                            @php $eyecolors= DB::table('eye_colors')->get() @endphp
                            @foreach ($eyecolors as $ecolor)
                            <option value="{{ $ecolor->id }}" {{ (old('eye_color_id') ?? $profile->Features->eye_color_id ) == $ecolor->id ? 'selected' : '' }}>
                                {{ __("forms.profile.$ecolor->name") }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label for="hair_color_id" class="pb-3 px-0 px-md-2 ml-0 ml-sm-0 ml-lg-4 d-flex flex-column form-label sel-dos">
                        <span class="">{{ __('forms.profile.Hair_color') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="hair_color_id">
                            @php $hcolors= DB::table('hair_colors')->get() @endphp
                            @foreach ($hcolors as $hcolor)
                            <option value="{{ $hcolor->id }}" {{ (old('hair_color_id') ?? $profile->Features->hair_color_id  ) == $hcolor->id ? 'selected': '' }}>
                                {{ __("forms.profile.$hcolor->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>

        </div>


        {{--  <!-- Fin Estetica --> --}}

        {{--  <!--Medidas --> --}}
        <div class="row mt-5">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 my-5">
                {{ __('forms.profile.Measures') }}</h3>

            <div class="col-12 ">
                <div class="d-flex flex-wrap flex-xl-nowrap w-100">
                    <label for="age" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.age') }} <span
                                class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="age" id="age-sel">
                            @for ($i = 18; $i < 45; $i++) <option value="{{ $i }}" {{ (old('age') ?? $profile->Features->age) == $i ? 'selected' : '' }}>
                                {{ $i }}
                                </option>
                                @endfor
                        </select>
                    </label>
                    <label for="height" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-lg-0 ml-lg-4 sel-dos form-label">
                        <span class="">{{ __('forms.profile.height') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="height">
                            @for ($j = 150; $j < 190; $j++) <option value="{{ $j }}" {{ (old('height') ?? $profile->Features->height ) == $j ? 'selected' : '' }}>
                                {{ $j }} cm</option>
                                @endfor
                        </select>
                    </label>
                    <label for="weight" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-lg-0 ml-xl-4 sel-dos form-label">
                        <span class="">{{ __('forms.profile.weight') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="weight">
                            @for ($k = 50; $k < 75; $k++) <option value="{{ $k }}" {{ (old('weight') ?? $profile->Features->weight ) == $k ? 'selected' : '' }}>
                                {{ $k }} kg</option>
                                @endfor
                        </select>
                    </label>

                </div>
                <div class="w-100 d-flex flex-wrap flex-lg-nowrap">

                    <label for="breast_size" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.breast_size') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="breast_size">
                            @for ($l = 63; $l < 112; $l++) <option value="{{ $l }}" {{ ( old('breast_size') ?? $profile->Features->breast_size ) == $l ? 'selected' : '' }}>
                                {{ $l }} cm</option>
                                @endfor
                        </select>
                    </label>
                    <label for="breast_type" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-lg-4 sel-dos form-label">
                        <span class="">{{ __('forms.profile.breast_type') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single" name="breast_type">
                            <option value="0" {{ (old('breast_type') ?? $profile->Features->breast_type ) == 0 ? 'selected' : '' }}>
                                -
                            </option>
                            <option value="1" {{ (old('breast_type') ?? $profile->Features->breast_type ) == 1 ? 'selected' : '' }}>
                                Natural
                            </option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        {{--
        <!-- Fin Medidas --> --}}
        {{--
        <!--Adicional--> --}}
        <div class="row mt-5">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 my-5">
                {{ __('forms.profile.Additional') }}</h3>
            <div class=" col-12">
                <div class="d-flex flex-wrap flex-md-nowrap w-100">
                    <label for="smoker" class="d-flex flex-column p-0 p-md-2 w-100 form-label">
                        <span class="">{{ __('forms.profile.smoker') }}</span>
                            <p id="radiooptions" class="mt-3">
                                <label><input type="radio" name="smoker" value="0" {{ ( old('smoker') ?? $profile->Features->smoker ) == 0 ? 'checked' : '' }}>
                                    <span>{{ __('general.No') }}</span></label>
                                <label><input type="radio" name="smoker" value="1" {{ ( old('smoker') ?? $profile->Features->smoker ) == 1 ? 'checked' : '' }}>
                                    <span>{{ __('general.Yes') }}</span></label>
                            </p>
                    </label>
                    <label for="private_apartament" class="d-flex flex-column p-0 p-md-2 w-100 form-label">
                        <span class="">{{ __('forms.profile.private_apartment') }}</span>
                        <p id="radiooptions" class="mt-3">
                            <label><input type="radio" name="private_apartament" value="0" {{ ( old('private_apartament') ?? $profile->Features->private_apartament ) == 0 ? 'checked' : '' }}>
                                <span>{{ __('general.No') }}</span></label>
                            <label><input type="radio" name="private_apartament" value="1" {{ ( old('private_apartament') ?? $profile->Features->private_apartament ) == 1 ? 'checked' : '' }}>
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
                            <label><input type="radio" name="whatsapp_acceptance" value="0" {{ ( old('whatsapp_acceptance') ?? $profile->Features->whatsapp_acceptance ) == 0 ? 'checked' : '' }}>
                                <span>{{ __('general.No') }}</span></label>
                            <label><input type="radio" name="whatsapp_acceptance" value="1" {{ ( old('whatsapp_acceptance') ?? $profile->Features->whatsapp_acceptance ) == 1 ? 'checked' : '' }}>
                                <span>{{ __('general.Yes') }}</span></label>
                        </p>
                    </label>
                    <label for="creditcard_acceptance" class="p-0 p-md-2 d-flex flex-column w-100 form-label">
                        <span class="creditcard_acceptance">{{ __('forms.profile.creditcard_acceptance') }}</span>
                        <p id="radiooptions" class="mt-3">
                            <label><input type="radio" name="creditcard_acceptance" value="0" {{ ( old('creditcard_acceptance') ?? $profile->Features->creditcard_acceptance ) == 0 ? 'checked' : '' }}>
                                <span>{{ __('general.No') }}</span></label>
                            <label><input type="radio" name="creditcard_acceptance" value="1" {{ ( old('creditcard_acceptance') ?? $profile->Features->creditcard_acceptance ) == 1 ? 'checked' : '' }}>
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
                                <label><input type="radio" name="is_pornstar" value="0" {{ ( old('is_pornstar') ?? $profile->Features->is_pornstar ) == 0 ? 'checked' : '' }}>
                                    <span>{{ __('general.No') }}</span></label>
                                <label><input type="radio" name="is_pornstar" value="1" {{ ( old('is_pornstar') ?? $profile->Features->is_pornstar ) == 1 ? 'checked' : '' }}>
                                    <span>{{ __('general.Yes') }}</span></label>
                            </p>
                    </label>
            </div>
            </div>


            <div class="col-12 mt-5">
                <div>
                    <label for="languages[]" class="pb-3 px-0 px-md-2 d-flex flex-column sel-idio form-label">
                        <span class="">{{ __('forms.profile.languages') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-multiple w-100" name="languages[]" multiple>
                            @php $ulangs= DB::table('user_languages')->get() @endphp
                            @foreach ($ulangs as $ulang)
                            <option value="{{ $ulang->id }}"{{ in_array($ulang->id,$profile->Features->languages) ? 'selected' : '' }}
                               >
                                {{ __("geodata.langs.$ulang->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-12 mt-4">
                <label for="trave_range_id" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                    <span class="">{{ __('forms.profile.Travel') }} <span
                            class="text-danger">*</span></span>
                    <select required class="js-example-basic-single" name="travel_range_id">
                        @php $tranges= DB::table('travel_ranges')->get() @endphp
                        
                        @foreach ($tranges as $trange)
                        <option value="{{ $trange->id }}" {{ $profile->Address->travel_range_id == $trange->id ? 'selected' : '' }}>
                            {{ __("forms.profile.$trange->name") }}</option>
                        @endforeach
                     
                    </select>
                </label>
            </div>
        </div>


        {{--
        <!-- Fin Adicional --> --}}


        {{-- servicios --}}
        <div class="row mt-5">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 form-label my-5">
                {{ __('forms.profile.services') }} <span class="text-danger">*</span></h3>

            <div class="col-12 ">
                <div class="d-flex flex-wrap pb-3 px-0 px-md-2">

                    @php $db_services= DB::table('services')->get() @endphp

                    @foreach ($db_services as $db_serv)
                    <label for="services" class="d-flex  mx-2 p-0 p-md-2 align-items-center form-label">

                        <input   type="checkbox" value="{{ $db_serv->id }}" name="services[]" class="rounded"
                            style="appearance: auto"
                                @if (old('services')) {{ in_array($db_serv->id,old('services')) ? 'checked': '' }}
                                @elseif($profile->Features->services) {{ in_array($db_serv->id,$profile->Features->services) ? 'checked' : '' }} @endif >

                        <span class="mx-1">{{ __("forms.services.$db_serv->name") }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>


        {{-- FIN servicios --}}

        {{-- Precios --}}
        <div class="row mt-5">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 my-5">
                {{ __('forms.prices.prices') }}</h3>

            <div class="col-12 ">
                <div class="d-flex flex-wrap flex-md-nowrap">
                    <div class="w-100 ">
                        <label for="half_hour" class="w-100 d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">
                                {{ __('forms.prices.half_hour') }}</span>
                            <input type="text" name="half_hour" class="form-control"
                                value="{{ old('half_hour') ?? $profile->Rates->half_hour  }}" />
                        </label>
                        <label for="half_hour_price" class="w-100 d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">
                                {{ __('forms.prices.one_hour') }}
                                <span class="text-danger">*</span></span>
                            <input required  type="text" name="one_hour" class="form-control"
                                value="{{  old('one_hour') ?? $profile->Rates->one_hour  }}" />
                        </label>
                        <label for="" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class=""> {{ __('forms.prices.added_hour') }}</span>
                            <input  type="text" name="added_hour" class="form-control"
                                value="{{ old('added_hour')  ?? $profile->Rates->added_hour }}" />
                        </label>
                    </div>
                    <div class="w-100 ">
                        <label for="weekend_price" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">{{ __('forms.prices.half_day') }}</span>
                            <input  type="text" name="half_day" class="form-control"
                                value="{{ old('half_day') ?? $profile->Rates->half_day }}" />
                        </label>
                        <label for="day_price" class="w-100  d-flex flex-column pb-3 px-0 px-md-2 form-label">
                            <span class="">{{ __('forms.prices.one_day') }}</span>
                            <input  type="text" name="one_day" class="form-control"
                                value="{{ old('one_day') ?? $profile->Rates->one_day  }}" />
                        </label>


                    </div>
                </div>
            </div>
        </div>


        {{-- FIN precios --}}

        <!--Direccion -->
        <div class="row mt-5">
            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-75 my-5">
                {{ __('forms.profile.Address') }}</h3>

            <div class="col-12">
                <div class="d-flex flex-wrap flex-xl-nowrap w-100">
                    <label for="country_id" class="pb-3 px-0 px-md-2 d-flex flex-column sel-dos form-label">
                        <span class="">{{ __('forms.profile.Country') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single w-100 " name="country_id"
                            id="e-country-select">
                            @php $countries= DB::table('countries')->get() @endphp
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ (old('country_id') ?? $profile->Address->country_id ) == $country->id ? 'selected' : '' }}>
                                {{ __("geodata.countries.$country->name") }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label for="region_id" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-lg-4 sel-dos form-label">
                        <span class="mx-2">{{ __('forms.profile.Region') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single w-100 " name="region_id"
                            id="e-region-select">


                            <option value="{{ $profile->Address->region_id }}" selected>
                                {{ DB::table('regions')->where('id', $profile->Address->region_id)->first()->name }}
                            </option>

                        </select>
                    </label>
                    <label for="city_id" class="pb-3 px-0 px-md-2 d-flex flex-column ml-0 ml-sm-0 ml-xl-4 sel-dos form-label">
                        <span class="mx-2">{{ __('forms.profile.City') }}
                            <span class="text-danger">*</span></span>
                        <select required class="js-example-basic-single w-100 " name="city_id" id="e-cities-select">

                            <option value="{{ $profile->Address->city_id }}" selected>
                                {{ DB::table('cities')->where('id', $profile->Address->city_id)->first()->name }}
                            </option>

                        </select>
                    </label>
                </div>
                <input type="hidden" name="latitude" id="latitude" value="{{$profile->Address->latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{$profile->Address->longitude }}">
                <div class="w-100 pb-3 px-0 px-md-2">
                    <label for="address" class="w-100 form-label">
                        <span>{{ __('forms.profile.Address') }} <span class="text-danger">*</span></span>
                        <input required  type="text" name="profile_address" id="profile_address" class="w-100"
                            value="{{ old('address') ?? $profile->Address->address }}" />
                    </label>
                </div>
            </div>
            <div class="col-12">
                {{-- <x-maps-google :centerPoint="['lat' => 52.16, 'long' => 5]"></x-maps-google> --}}
            </div>
        </div>
        <!-- Fin Direccion -->

        <div class="row mt-5">
            <div class="p-0 p-md-2 text-center py-4 col-12 col-md-6 mx-auto d-flex">
                <input type="submit" name="save"
                class="btn rounded w-100 bg-rosa text-white px-4 py-2 mx-auto btn-submit" value="{{ __('general.Save') }}">
            </div>
        </div>



    </form>
</div>
