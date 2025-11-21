<x-guest-layout>
    @push('meta')
        <title>{{ $seo->seo_title }}</title>
        <meta name="description" content="{{ $seo->seo_description }}" />
    @endpush
    @if (Route::is('home'))
        @include('guest.layouts.bannerstop')
    @endif
    @include('guest.layouts.filtros')
    <div>
        @if (Route::is('show-escorts'))
            @php
                $category = str_replace('-', '', stristr(request()->path(), '-'));
                $title = str_replace('-', ' ', request()->path());
                $cat_record = App\Models\Categtext::where('name', $category)->first();
                $default_text = App\Models\Categtext::where('name', 'default')->first();
            @endphp
            <div class="row pt-4">
                <div class="col-12 px-0 htext">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-12 px-4 px-lg-2">
                    @if ($cat_record && $cat_record->description_1)
                        <p>{!! nl2br($cat_record->description_1) !!}</p>
                    @else
                        <p>{!! nl2br($default_text->description_1) !!}</p>
                    @endif
                </div>
            </div>
        @endif
        @if (!$escorts_found)
            <h3>No se han encontrado escorts en {{ $category }}</h3>
        @endif
        @foreach ($grouped_escorts as $escort_group)
            <div class="row my-4">
                <div class="col-12 d-flex flex-wrap px-0">
                    @foreach ($escort_group->shuffle() as $scrt)
                        @php $mainPhoto = $scrt->MainPhoto();
                                               
                        @endphp
                        <div class="p-2 rounded text-center profile-view">
                            <div class="bg-white"><a
                                    href="{{ route('show-escorts', [$scrt->Address->City->slug, $scrt->uid]) }}"
                                    class="w-100">
                                    <div style="width: 100%; position: relative;"
                                        @if ($scrt->is_vip) class="corner" @endif>
                                        <div @if ($scrt->verified) class="verified" @endif><img
                                                loading="lazy"
                                                src='{{ asset("storage/escort_photos/$mainPhoto->path/$mainPhoto->filename") }}'
                                                alt="{{ $scrt->name }}" /></div>
                                    </div>
                                </a>
                                <p class="profile-name">{{ $scrt->name }} <br /><span class="profile-under">
                                        @if (!empty($scrt->Features->age))
                                            <i class="fa fa-square-full icosquare"></i> {{ $scrt->Features->age }} años
                                        @endif
                                        @if (!empty($scrt->Features->height))
                                            <i class="fa fa-square-full icosquare mleft"></i>
                                            {{ $scrt->Features->height }} cm
                                        @endif
                                        {{-- @if (!empty($scrt->Rates->one_hour))<i class="fa fa-square-full icosquare mleft"></i> {{ $scrt->Rates->one_hour }} €@endif </span> --}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        @if (Route::is('show-escorts'))
            <div class="row">
                <div class="col-12 px-4 px-lg-2">
                    @if ($cat_record && $cat_record->description_2)
                        <p>{!! nl2br($cat_record->description_2) !!}</p>
                    @else
                        <p>{!! nl2br($default_text->description_1) !!}</p>
                    @endif
                </div>
            </div>
        @endif
        @if (Route::is('home'))
            <div class="mt-6">
                <h2 class="homeh">Conoce las mejores escorts de lujo disponibles en tu ciudad</h2>
                <p>Selecciona tu ciudad, tenemos a las más atractivas escorts de alto standing en las ciudades de
                    Barcelona y Madrid. Mujeres de alto nivel con las que tendrás los momentos más excitantes y
                    eróticos, estas apreciadas modelos se caracterizan por su belleza y su saber estar.</p>
                <p><strong>Selecciona tu ciudad:</strong> </p>
            </div>
            <div class="row justify-content">
                <div class="col-12 col-lg-5 px-0 linkciudad l-filtros"><a href="/escorts-barcelona/" title="escorts bcn"
                        class="lkcity">Escorts BCN</a> (35)</div>
                <div class="col-12 col-lg-5 px-0 linkciudad l-filtros"><a href="/escorts-madrid/" title="escorts madrid"
                        class="lkcity">Escorts Madrid</a> (42)</div>
                <div class="col-12 col-lg-5 px-0 linkciudad l-filtros"><a href="/escorts-ibiza/" title="escorts ibiza"
                        class="lkcity">Escorts Ibiza</a> (4)</div>

                <div class="col-12 col-lg-5 px-0 linkciudad l-filtros"><a href="/escorts-bilbao/" title="escorts bilbao"
                        class="lkcity">Escorts Bilbao</a> (4)</div>
            </div>
            <div class="row mt-6" style="border-bottom: 1px solid #dd2424">
                <div class="col-12 col-md-8 px-0">
                    <h2 class="homeh">Putas de lujo<br />Señoritas de Compañía<br />Escorts Independientes</h2>
                    <p>Si quieres una cita con una de las señoritas de nuestra página Web, tan solo tienes que entrar en
                        su perfil, ver sus fotografías, ver sus datos y tarifas y apretar al botón de llamada. Solo eso,
                        serás atendido gratamente y la cita podrá ser en normalmente de 45 minutos a 1 hora de espera,
                        para que la chica se pueda preparar y tomar un medio de transporte. Todo se realiza por teléfono
                        y whatsapp, y podrás indicarle tus preferencias o prioridades, también donde se realizará el
                        encuentro el lugar, hotel, domicilio o apartamentos por horas.</p>
                    <h3 class="homeh">¿Dónde encontrar<br /> escorts de lujo?</h3>
                    <p>En nuestro directorio nos tratamos de especializar en <strong>escorts de lujo</strong>, chicas
                        bellas que no se dedican a esto en plan profesional, sino que siguen con su trabajo o estudios,
                        y en algunas ocasiones ponen su cuerpo a disposición tuya. Es un trato siempre consentido de dos
                        partes, a mutuo acuerdo, el portal no tiene nada que ver en sus relaciones, tan solo les presta
                        el servicio como portal publicitario para anunciarse. Ante todo, intentamos mejorar nuestros
                        servicios, y por eso tratamos de incorporar información fidedigna y veraz. Les pedimos a las
                        escort, que tengan sus fotografías lo más actualizadas posibles, para que el cliente no se lleve
                        a engaño, y siempre exigimos que las fotografías obviamente sean auténticas, con un proceso de
                        verificación de cada señorita. </p>
                </div>
                <div class="col-12 col-md-4 px-0"><img src="images/escorts-de-lujo.jpg"
                        alt="directorio de escorts de lujo" /></div>
            </div>
            <div class="row">
                <div class="my-6">
                    <h3 class="homeh">El trato con las señoritas de compañía</h3>
                    <p>Siempre que se realice un servicio se ha de tener en cuenta, que las escorts, son personas
                        normales y corrientes que tienen su vida, jóvenes chicas estudiantes, modelos, actrices,
                        masajistas cuando las llamas puede que tengan que hacer algo antes de quedar con usted,
                        recomendamos siempre llamarlas con al menos 1 hora de antelación. Dependerá de cada chica las
                        tarifas que aplique y si se le ha de abonar el transporte hasta tu hotel o lugar de encuentro,
                        normalmente y sobre de noche esto es así. </p>
                </div>
            </div>
            <div class="row">
                <div class="my-6">
                    <h3 class="homeh">Links</h3>
                    <p><a href="https://www.escorts-lujo.com/en/" target="_blank" title="Luxury Escorts Spain"><img src="https://www.escorts-lujo.com/img/escorts-lujo-12060.jpg" alt="Luxury Escort directory" width="120" height="60" /></a></p></p>
                    <p><a href="https://frankfurtbabes.com/en/" rel="nofollow" target="_blank"><img src="https://frankfurtbabes.com/wp-content/uploads/2023/05/banner-exchange.jpg" alt="Escort Frankfurt" width="302" height="39" /></a></p>
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>
