@props(['errors'])

@if ($errors->any())
    <div class="alert alert-dismissible bg-danger fade show mt-1 mt-md-4 w-50 mx-auto" role="alert">
        <div {{ $attributes }} class="p-2  text-white rounded">

            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif

