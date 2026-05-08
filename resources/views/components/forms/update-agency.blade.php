<div>
    <div class="row">
        <div class="col-12 col-md-10 mx-auto">

            @if($admin)
                <form action="{{ route('admin-profile-update', $profile->id) }}" method="post"
                    enctype="multipart/form-data" id="agency-form" class="pt-3 mx-auto ">
            @else

                <form action="{{ route('profile.update', $profile->id) }}" method="post"
                    enctype="multipart/form-data" id="agency-form" class="pt-3 mx-auto ">
            @endif

                @csrf
                @method('PUT')
                <!-- LBasic-->
                @if(!$admin)

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
                <div>
                    <div class="row">
                        <div class="col-12 pb-5">
                            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100">
                                {{ __('forms.profile.Basic') }}</h3>
                        </div>
                        <div class="col-12 ">
                            <div class="d-flex flex-wrap flex-md-nowrap">

                                <label for="" class="p-2 d-flex flex-column w-100 ">
                                    <span class="form-label">{{ __('forms.profile.Name') }}</span>
                                    <input required name="name" type="text" class="w-100 form-control"
                                        value="{{ old('name') ?? $profile->name }}" />
                                </label>
                                <label for="" class="p-2 d-flex flex-column w-100">
                                    <span class="form-label">{{ __('forms.profile.Email') }}</span>
                                    <input required type="text" name="email" class="form-control"
                                        value="{{ old('email') ?? $profile->email  }}" />
                                </label>
                            </div>
                            <div class="d-flex flex-wrap flex-md-nowrap">
                                <label for="" class="p-2 d-flex flex-column w-100">
                                    <span class="form-label">{{ __('forms.profile.Phone') }}</span>
                                    <input required type="text" name="phone" class="form-control"
                                        value="{{ old('phone') ?? $profile->phone }}" />
                                </label>

                                    <label for="" class="w-100">
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
                                        value="https://{{ old('web') ?? $profile->web  }}" />
                                        @endif
                                    </label>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">

                            <label for="" class="form-label w-100">
                                <p class="mx-2">{{ __('forms.profile.Description') }}</p>
                                <textarea required required name="description" id=""
                                    class="w-100 rounded  form-control">{{ old('description') ?? $profile->description   }}</textarea>
                            </label>
                        </div>
                        <div class="col-12 py-4 pb-5">
                            @php
                                $photo = $profile->MainPhoto();
                                $logo = $profile->Photos->where('type',1)->first();
                            @endphp
                            <div class="pt-3">
                                <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100  ">Logotipo</h3> @if (!$admin)  <span class="mcolor text-sm mb-3">
                                    <i class="fas fa-question-circle"></i> &nbsp;  {{ __('general.changelogo') }}</span>
                                @endif
                                <p class="py-3"> {{ __('general.updatelogo') }}</p>
                                @if($logo)
                                <img src="{{asset("/storage/agency_photos/$logo->path/$logo->filename")}}" height="100" style="width:100px !important">
                                @endif
                                <p class="pt-3"><input type="file" name="logo" id="logo"  class="w-100" ></p>

                            </div>
                            <div class="mt-5">
                                <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100">Imagen de Portada</h3>
                            <p>{{ __('general.paraimgportada') }}</p>
                                <img src="{{ asset("/storage/agency_photos/$photo->path/$photo->filename") }}"
                                     width="300">
                                <hr>
                                <script>
                                    const main_source = "{{ url("/storage/agency_photos/$photo->path/$photo->filename") }}"
                                </script>

                            <input type="file" name="photo" id="agency_photo" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pb-5">
                            <!--Direccion -->
                            <h3 class="fs-3 fw-bold text-333 border-bottom border-mcolor w-100">
                                {{ __('forms.profile.Address') }}</h3>
                        </div>

                        <div class="col-12 ">
                            <div class="d-flex flex-wrap flex-md-nowrap">
                                <label for="" class="w-100 w-md-25 d-flex flex-column px-2">
                                    <span class="form-label">{{ __('forms.profile.Country') }}</span>
                                    <select required class="js-example-basic-single w-100 " name="country_id"
                                        id="a-country-select">
                                        @php $countries= DB::table('countries')->get() @endphp
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{  (old('country_id') ?? $profile->Address->country_id) == $country->id ? 'selected' : '' }}>
                                                {{ __("geodata.countries.$country->name") }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label for="" class="w-100 w-md-25 d-flex flex-column px-2">
                                    <span class="form-label">{{ __('forms.profile.Region') }}</span>
                                    <select required class="js-example-basic-single w-100" name="region_id"
                                        id="a-region-select">
                                            <option value="{{ $profile->Address->region_id }}" selected>
                                                {{  DB::table('regions')->where('id', $profile->Address->region_id)->first()->name }}
                                            </option>
                                    </select>
                                </label>

                                <label for="" class="w-100 d-flex flex-column px-2">
                                    <span class="form-label">{{ __('forms.profile.City') }}</span>
                                    <select required class="js-example-basic-single w-100" name="city_id"
                                        id="a-cities-select">
                                            <option value="{{ $profile->Address->city_id }}" selected>
                                                {{ DB::table('cities')->where('id', $profile->Address->city_id)->first()->name }}
                                            </option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="latitude" id="latitude" value="{{$profile->Address->latitude }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{$profile->Address->longitude }}">
                        <div class="col-12 ">
                            <div class="w-100 p-2 my-2">
                                <label for="" class="w-100">
                                    <span>{{ __('forms.profile.Address') }} <span
                                            class="text-red-400">*</span></span>
                                    <input required type="text" name="profile_address" id="profile_address" class="w-100"
                                        value="{{ old('address') ?? $profile->Address->address }}" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-4">

                            <div class="p-2 text-center py-4 w-100 d-flex">
                                <input type="submit" name="save"
                                    class="btn rounded w-100 bg-rosa text-white px-4 py-2 mx-auto btn-submit"
                                    value="{{ __('general.Save') }}">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- LBasic-->
        </form>
    </div>
</div>
