<div class="pt-5 pt-md-1 py-4">
    <h1 class="text-xl text-center p-4">@lang('general.ContactUsDep')</h1>
    <p class="px-4">@lang('general.ContactUsText')</p>
    @if(session('success'))
    <div
        class="rounded-lg lg:w-2/6 md:w-1/2 md:ml-auto md:mt-0 px-8 mx-auto my-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-green">
        {!! session('success')!!}
    </div>
    @endif
    @if ($profile)
    <p class="px-4">Tu Perfil es: {{ $profile->name }} de {{ $profile->Address->City->name }}</p>
    @endif


        <form action="{{route('contact-us')}}" method="post" class="p-4">
            @csrf

            <div class="relative p-2 ">
                <input type="name" id="name" name="name2" placeholder=@lang('general.Name')
                    class="form-control">
            </div>
            <div class="relative p-2 ">
                <input type="phone" id="phone" name="phone" placeholder=@lang('general.Phone')
                    class="form-control">
            </div>
            <div class="relative p-2 ">
                <input type="name" id="name" name="email2" placeholder=@lang('general.Email')
                    class="form-control">
            </div>
            <input type="hidden" name="message">
            <div class="relative p-2 ">
                <textarea type="message" id="message" name="message2" class="form-control" placeholder=@lang('general.message')
                    class="form-control"></textarea>
            </div>

            <div class="w-100 text-center py-4">
                <button type="submit" id="btn-submit"
                class="btn saldoleft text-white btn-submit">@lang('general.Send')</button>
            </div>
        </form>
</div>
