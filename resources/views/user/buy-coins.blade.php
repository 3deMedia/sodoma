<x-app-layout>
    <div class="container pb-5">
        <h2 class="fw-bold mb-4 text-center">{{ __('general.Buy_coins_title') }}</h2>
        <div class="col-12 col-lg-6 mt-2 mt-md-5 bg-white rounded-md block center px-4 py-4 border-black border-1">
            <h5 class="text-center pt-4 pb-4">{{ __('general.actuallyhave') }}<br />{{ auth()->user()->coins }}
                {{ __('general.coins') }} </h5>
            <p class="text-center mb-5"> {!! __('general.Coins_explanation') !!}</p>

            <div class="col-12  mx-auto">
                <div class="w-100 py-4"><button class="rounded border-purple w-100 my-2 text-center bg-black btn-submit text-white" style="height: 75px"
                    data-toggle="modal" data-target="#modelId"> {{ __('general.transfers') }}</button></div>
                <form action="{{ route('stripe-checkout') }}" method="post" id="stripe-form"
                    class="d-flex flex-wrap flex-lg-nowrap w-full justify-content-between">
                    @csrf
                    <div class="d-flex w-100 flex-column text-left py-4">
                        @foreach ($pay_amounts as $paya)
                            <label for="">
                                <input type="radio" name="product" class="mx-2  text-mgray" value="{{ $paya->id }}"
                                    checked>
                                <span class="text-sm fw-bold">{{ $paya->text }}</span>
                            </label>
                        @endforeach
                        </div>
                    <div class="w-100 py-4">
                        <button type="submit" class="rounded border-purple w-100 my-2 text-center bg-white btn-submit"
                            style="height: 45px">
                            <img loading="lazy" src="{{ asset('images/stripe.png') }}" alt=""
                                style="height: 40px"></button>
                        <div class="flex-col">

                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('general.banktransfer') }}<</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('general.transfert1') }}</p>
                    <p><b style="font-weight: 800">{{ __('general.important') }}:</b>  {{ __('general.howconcept') }}</p>
                    <p>Concepto: @if ($profile) {{ $profile->uid }} @else Ejemplo:  sara-1234 @endif</p>
                    <p>{{ __('general.nrc') }}</p>
                    <p>ES53 2100 2879 0213 0039 7237</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('js')
        <script
                src="https://www.paypal.com/sdk/js?client-id=AQ5O4_Ihbyv1civ1x17sbIhmubajuwC6LUXwRm4uRuLyetXVwuUlqMjgNJPVXzvZaAco6v4KfBiFcrd5&currency=EUR&components=buttons,funding-eligibility">
        </script>
        <script src="{{ asset('js/mixin-styles.js') }}"></script>
    @endpush
</x-app-layout>
