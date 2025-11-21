<x-guest-layout>
    @push('meta')
        <meta name="description" content="{{ $seo->seo_description }}" />
        <meta name="keywords" content="{{ $seo->seo_keywords }}" />
        <title>{{ config('app.name') }} | {{ $seo->seo_title }}</title>
    @endpush
    <div class="container py-4">
        <div class="row">
            <div class="col-12 ">
                <div id="" class="faq">
                    @php
                        $faqs = \App\Models\Faqs::all();
                    @endphp
                    @foreach ($faqs as $item)
                        <div class="item">
                            <div class="question pointer">
                                {{ $item->question }} <span class="float-right mcolor"><i
                                        class="fas fa-caret-down"></i></span>
                            </div>
                            <div class="answer">
                                {!! $item->answer !!}
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(".question").click(function() {


                return $(this).next().slideToggle();

            });
        </script>

    @endpush

</x-guest-layout>
