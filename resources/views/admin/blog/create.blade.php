<x-admin-layout>
    <x-head.tinymce-config />
    <div class="container pt-5">

        @if (session('success'))
            <div class="bg-green-500 p-3 my-2 w-100 rounded text-white">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-danger p-3 my-2 w-100 rounded text-white">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <h1 class="text-info">@lang('New Post') </h1>
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group w-25">
                            <label for="title" class="block label">@lang('Title')</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        </div>
                        <div class="form-group w-25">
                            <label for="title" class="block">@lang('Meta Description')</label>
                            <input type="text" name="description" value="{{ old('description') }}"
                                class="form-control" >
                        </div>
                        <div class="form-group w-25">
                            <label for="active">
                                <input type="checkbox" name="active" id="active"> Visible
                            </label>
                            <label for="publish_at" class=" mx-4">
                                @lang('publish_at')<br>
                                <input type="date" name="publish_at" id="" class="form-control"
                                    value={{ old('publish_at') }}>
                            </label>
                            <label for="image_file">Imagen portada
                                <input type="file" name="image_file" id="image_file"
                                    class="rounded text-xs md:text-base">
                            </label>

                        </div>



                        @php
                            $content= old('content') ? old('content'):null;
                        @endphp
                    <x-forms.tinymce-editor :content="$content"/>

                    <button type="submit" class="btn btn-primary my-2" >Guardar</button>

                </form>
            </div>

        </div>



    </div>

</x-admin-layout>
