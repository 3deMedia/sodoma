<x-app-layout>
    @push('meta')
        <meta name="description" content="{{$seo->seo_description}}" />
        <meta name="keywords" content="{{$seo->seo_keywords}}" />
        <title>{{config('app.name')}} | {{$seo->seo_title}}</title>
    @endpush

    <div class="container py-4 py-sm-8">
        <div class="row">
            <div class="col-11 col-lg-6 mx-auto bg-white">
                @if ($status = session('status'))
                    <div class="alert alert-success alert-dismissible fade show mt-1 mt-md-4 w-100" role="alert">
                        <strong>{{ $status }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-dismissible bg-danger fade show mt-1  w-100" role="alert">
                        <div  class="p-2  text-white rounded">

                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                @endif

                <x-contact-us-form :profile="$profile" />
            </div>
        </div>
</x-app-layout>
