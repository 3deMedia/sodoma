<x-guest-layout>
@push('meta')
<title>{{config('app.name')}} | {{$post->title}}</title>
<meta name="description" content="{{$post->description}}" />
@endpush
<div class="container pt-5 bg-black">
<div class="row">
<div class="col-12 text-center">
<img class="w-100" alt="{{config('app.name')}} | {{$post->title}}" src="{{asset('storage/posts')}}/{{$post->img_file}}"></div>
<div class="col-12 col-md-10 mx-auto my-6">
<h1>{{strtoupper($post->title)}}</h1>
<span class="text-muted p-2">Posted on {{\Carbon\Carbon::parse($post->created_at)->format('d / m / Y')}}</span>
<div class="p-2 mcolor mt-3">{!! $post->content !!}</div>
<div class="my-4"><a href="https://www.escortssecrets.com/blog/"><<< Volver</a></div></div></div></div>
</x-guest-layout>
