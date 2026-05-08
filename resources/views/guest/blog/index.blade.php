<x-guest-layout>
    @push('meta')
        <meta name="description" content="{{$seo->seo_description}}" />
        <title>{{config('app.name')}} | {{$seo->seo_title}}</title>
    @endpush
    @if (count($posts) !== 0)
        <div class="container">
            <div class="text-center my-8"><h1>Blog</h1></div>
            <div class="row">

                @foreach ($posts as $post)
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <a href="{{ route('show-post', $post->slug) }}"><img class="w-100"
                                src="{{ asset('storage/posts') }}/{{ $post->img_file }}" alt="content"></a>
                            </div>

                            <div class="card-body">
                                <a href="{{ route('show-post', $post->slug) }}" class="blogtitle">{{ $post->title }}</a>
                                <br /><span>{{\Carbon\Carbon::parse($post->created_at)->format('d / m / Y')}}</span>
                                <p class="mb-4 text-base">
                                    {!! mb_strimwidth($post->content, 0, 400, '...') !!}</p>
                                <a href="{{ route('show-post', $post->slug) }}"
                                    class="btn btn-primary">Leer más</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{-- {{ $posts->links() }} --}}
        </div>
    @else
        <p class="font-bold text-center py-4 text-white">@lang('main.Nothing to show')</p>
    @endif
</x-guest-layout>
