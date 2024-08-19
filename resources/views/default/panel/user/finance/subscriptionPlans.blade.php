@extends('panel.layout.app', ['disable_tblr' => true])
@section('title', __('Plans'))
@section('titlebar_actions', '')
@section('titlebar_actions_before')
    <div class="flex w-full mt-4">
        <x-remaining-credit
            class="text-2xs lg:ms-auto"
            legend-size="sm"
            style="inline"
            progress-height="sm"
        />
    </div>
@endsection





@inject('paymentControls', 'App\Http\Controllers\Finance\PaymentProcessController')
@inject('gatewayControls', 'App\Http\Controllers\Finance\GatewayController')

@section('content')
<style>
    body.theme-dark .modal-content {
        background-color: #000 !important;
    }
</style>
    <div class="py-10">
        <div class="flex flex-col gap-10">
            <div class="w-full">
                @include('panel.user.finance.subscriptionStatus')
            </div>
            <div class="w-full">
                @if ($plans->count() > 0)
                    <h2 class="mb-5">
                        {{ __('Subscription Plans') }}:
                    </h2>
                @endif
                <div class="grid grid-cols-3 gap-3 max-lg:grid-cols-2 max-md:grid-cols-1">
                    @foreach ($plans as $plan)
                        <div @class([
                            'w-full rounded-3xl border',
                            'shadow-[0_7px_20px_rgba(0,0,0,0.04)]' => $plan->is_featured,
                        ]) style="background-color: #f1f1f1;">
                            <div class="flex flex-col h-full p-7">
                                <div class="mb-2 flex items-start text-[50px] font-bold leading-none text-heading-foreground">
                                    @if (currencyShouldDisplayOnRight(currency()->symbol))
                                        {{ $plan->price }} <small class='inline-flex text-[0.35em] font-normal'>
                                            {{ currency()->symbol }}
                                        </small>
                                    @else
                                        <small class='inline-flex text-[0.35em] font-normal'>
                                            {{ currency()->symbol }}
                                        </small>
                                        {{ $plan->price }}
                                    @endif
                                    <div class="ms-2 mt-2 inline-flex flex-col items-start gap-2 text-[0.3em]">
                                        {{ __(formatCamelCase($plan->frequency)) }}
                                        @if ($plan->is_featured == 1)
                                            <div class="inline-flex rounded-full bg-gradient-to-r from-[#ece7f7] via-[#e7c5e6] to-[#e7ebf9] px-3 py-1 text-3xs text-black">
                                                {{ __('Popular plan') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <p class="text-sm font-medium leading-none opacity-50">
                                    {{ __($plan->name) }}
                                </p>

                                <ul class="my-6 text-sm text-heading-foreground">
                                    @if ($plan->trial_days != 0)
                                        <li class="mb-3">
                                            <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>
                                            {{ number_format($plan->trial_days) . ' ' . __('Days of free trial.') }}
                                        </li>
                                    @endif
                                    <li class="mb-3">
                                        <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>

                                        {{ __('Access') }}
                                        <strong>{{ __($plan->checkOpenAiItemCount()) }}</strong> {{ __('Templates') }}
                                        <div class="group relative inline-block before:absolute before:-inset-2.5">
                                            <span class="peer relative -mt-6 inline-flex !h-6 !w-6 cursor-pointer items-center justify-center">
                                                <x-tabler-info-circle-filled class="size-4 opacity-20" />
                                            </span>
                                            <div
                                                class="min-w-60 pointer-events-none invisible absolute start-full top-1/2 z-10 ms-2 max-h-96 -translate-y-1/2 translate-x-2 scale-105 overflow-y-auto rounded-lg border bg-background p-5 opacity-0 shadow-xl transition-all before:absolute before:-start-2 before:top-0 before:h-full before:w-2 group-hover:pointer-events-auto group-hover:visible group-hover:translate-x-0 group-hover:opacity-100 [&.anchor-end]:end-2 [&.anchor-end]:start-auto [&.anchor-end]:me-2 [&.anchor-end]:ms-0"
                                                data-set-anchor="true"
                                            >
                                                <ul>
                                                    @foreach ($openAiList->groupBy('filters') as $key => $openAi)
                                                        <li class="mt-5 mb-3 first:mt-0">
                                                            <h5 class="text-base">
                                                                {{ ucfirst($key) }}
                                                            </h5>
                                                        </li>
                                                        @php($openAi = \App\Helpers\Classes\Helper::sortingOpenAiSelected($openAi, $plan->open_ai_items))

                                                        @foreach ($openAi as $itemOpenAi)
                                                            <li class="mb-1.5 flex items-center gap-1.5 text-heading-foreground">
                                                                <span @class([
                                                                    'bg-primary/10 text-primary' => $plan->checkOpenAiItem($itemOpenAi->slug),
                                                                    'bg-foreground/10 text-foreground' => !$plan->checkOpenAiItem(
                                                                        $itemOpenAi->slug),
                                                                    'size-4 inline-flex items-center justify-center rounded-xl align-middle',
                                                                ])>
                                                                    @if ($plan->checkOpenAiItem($itemOpenAi->slug))
                                                                        <x-tabler-check class="size-3" />
                                                                    @else
                                                                        <x-tabler-minus class="size-3" />
                                                                    @endif
                                                                </span>
                                                                <small @class(['opacity-60' => !$plan->checkOpenAiItem($itemOpenAi->slug)])>
                                                                    {{ $itemOpenAi->title }}
                                                                </small>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    @foreach (explode(',', $plan->features) as $item)
                                        <li class="mb-3">
                                            <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                    @if ($plan->is_team_plan)
                                        <li class="mb-3">
                                            <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>
                                            <strong>
                                                {{ number_format($plan->plan_allow_seat) }}
                                            </strong>
                                            {{ __('Team allow seats') }}
                                        </li>
                                    @endif
                                    @if ($plan->display_word_count)
                                        <li class="mb-3">
                                            <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>
                                            @if ((int) $plan->total_words >= 0)
                                                <strong>
                                                    {{ number_format($plan->total_words) }}
                                                </strong>
                                                {{ __('Word Tokens') }}
                                            @else
                                                <strong>{{ __('Unlimited') }}</strong> {{ __('Word Tokens') }}
                                            @endif
                                        </li>
                                    @endif
                                  

                                </ul>

                                @if ($activesubid == $plan->id)
                                    <div class="mt-auto text-center">
                                        <div class="flex flex-col gap-2">
                                            <span class="text-green-500">
                                                <b>{{ __('Already Subscribed') }}</b>
                                            </span>
                                            <a
                                                class="text-foreground/60"
                                                onclick="return confirm('Are you sure to cancel your plan? You will lose your remaining usage.');"
                                                href="{{ LaravelLocalization::localizeUrl(route('dashboard.user.payment.cancelActiveSubscription')) }}"
                                            >
                                                {{ __('Cancel Subscription') }}
                                            </a>
                                        </div>
                                    </div>
                                @elseif($activesubid != null)
                                    <div class="mt-auto text-center">
                                        <div class="flex flex-col gap-2">
                                            <span class="text-foreground/60">
                                                <b>{{ __('You have an active subscription.') }}</b>
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-auto text-center">
                                        @if ($is_active_gateway == 1)
                                            @php($planid = $plan->id)
                                            @if ($plan->price == 0)
                                                <x-button
                                                    class="w-full"
                                                    href="{{ $app_is_demo ? '#' : LaravelLocalization::localizeUrl(route('dashboard.user.payment.startSubscriptionProcess', ['planId' => $planid, 'gatewayCode' => 'freeservice'])) }}"
                                                    onclick="{{ $app_is_demo ? 'return toastr.info(\'This feature is disabled in Demo version.\')' : '' }}"
                                                    variant="ghost-shadow"
                                                >
                                                    {{ __('Choose plan') }}
                                                </x-button>
                                            @else
                                                <button class="choose-plan-btn w-full lqd-btn inline-flex items-center justify-center gap-1.5 text-xs font-medium rounded-full transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/5 disabled:opacity-50 disabled:pointer-events-none lqd-btn-ghost-shadow bg-background text-foreground shadow-xs hover:bg-primary hover:text-primary-foreground dark:hover:bg-foreground dark:hover:text-background focus-visible:bg-primary focus-visible:text-primary-foreground dark:bg-foreground/[3%] dark:focus-visible:bg-foreground dark:focus-visible:text-background lqd-btn-md py-2 px-4 lqd-btn-hover-none w-full" data-price="{{ $plan->price }}" data-plan-id="{{ $planid }}">Choose Plan</button>
                                            
                                            @endif
                                        @else
                                            <p>{{ __('Please enable a payment gateway') }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-full">
                @if ($prepaidplans->count() > 0)
                    <h2 class="mb-5">
                        {{ __('Token Packs') }}:
                    </h2>
                @endif
                <div class="grid grid-cols-3 gap-3 max-lg:grid-cols-2 max-md:grid-cols-1">
                    @foreach ($prepaidplans as $plan)
                        <div @class([
                            'w-full rounded-3xl border',
                            'shadow-[0_7px_20px_rgba(0,0,0,0.04)]' => $plan->is_featured,
                        ]) style="background-color: #f1f1f1;">
                            <div class="flex flex-col h-full p-7">
                                <div class="mb-2 flex items-start text-[50px] font-bold leading-none text-heading-foreground">
                                    @if (currencyShouldDisplayOnRight(currency()->symbol))
                                        {{ $plan->price }}
                                        <small class='inline-flex text-[0.35em] font-normal'>
                                            {{ currency()->symbol }}
                                        </small>
                                    @else
                                        <small class='inline-flex text-[0.35em] font-normal'>
                                            {{ currency()->symbol }}
                                        </small>
                                        {{ $plan->price }}
                                    @endif
                                    <div class="ms-2 mt-2 inline-flex flex-col items-start gap-2 text-[0.3em]">
                                        {{ __('One time') }}
                                        @if ($plan->is_featured == 1)
                                            <div
                                                class="inline-flex rounded-full bg-gradient-to-r from-[#ece7f7] via-[#e7c5e6] to-[#e7ebf9] px-[0.75rem] py-[0.25rem] text-3xs text-black">
                                                {{ __('Popular pack') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm font-medium leading-none opacity-60">
                                    {{ __($plan->name) }}
                                </p>
                                <ul class="p-0 my-6 text-sm list-none text-heading-foreground">
                                    <li class="mb-3">
                                        <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>

                                        {{ __('Access') }}
                                        <strong>
                                            {{ __($plan->checkOpenAiItemCount()) }}
                                        </strong>
                                        {{ __('Templates') }}
                                        <div class="group relative inline-block before:absolute before:-inset-2.5">
                                            <span class="peer relative -mt-6 inline-flex !h-6 !w-6 cursor-pointer items-center justify-center">
                                                <x-tabler-info-circle-filled class="size-4 opacity-20" />
                                            </span>
                                            <div
                                                class="min-w-60 pointer-events-none invisible absolute start-full top-1/2 z-10 ms-2 max-h-96 -translate-y-1/2 translate-x-2 scale-105 overflow-y-auto rounded-lg border bg-background p-5 opacity-0 shadow-xl transition-all before:absolute before:-start-2 before:top-0 before:h-full before:w-2 group-hover:pointer-events-auto group-hover:visible group-hover:translate-x-0 group-hover:opacity-100 [&.anchor-end]:end-2 [&.anchor-end]:start-auto [&.anchor-end]:me-2 [&.anchor-end]:ms-0"
                                                data-set-anchor="true"
                                            >
                                                <ul>
                                                    @foreach ($openAiList->groupBy('filters') as $key => $openAi)
                                                        <li class="mt-5 mb-3 first:mt-0">
                                                            <h5 class="text-base">{{ ucfirst($key) }}</h5>
                                                        </li>
                                                        @php($openAi = \App\Helpers\Classes\Helper::sortingOpenAiSelected($openAi, $plan->open_ai_items))
                                                        @foreach ($openAi as $itemOpenAi)
                                                            <li class="mb-1.5 flex items-center gap-1.5 text-heading-foreground">
                                                                <span @class([
                                                                    'bg-primary/10 text-primary' => $plan->checkOpenAiItem($itemOpenAi->slug),
                                                                    'bg-foreground/10 text-foreground' => !$plan->checkOpenAiItem(
                                                                        $itemOpenAi->slug),
                                                                    'size-4 inline-flex items-center justify-center rounded-xl align-middle',
                                                                ])>
                                                                    @if ($plan->checkOpenAiItem($itemOpenAi->slug))
                                                                        <x-tabler-check class="size-3" />
                                                                    @else
                                                                        <x-tabler-minus class="size-3" />
                                                                    @endif
                                                                </span>
                                                                <small @class(['opacity-60' => !$plan->checkOpenAiItem($itemOpenAi->slug)])>
                                                                    {{ $itemOpenAi->title }}
                                                                </small>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    @foreach (explode(',', $plan->features) as $item)
                                        <li class="mb-3">
                                            <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                    @if ($plan->display_word_count)
                                        <li class="mb-3">
                                            <span class="inline-flex items-center justify-center align-middle size-5 me-1 rounded-xl text-primary custom-bullet">
                                                <x-tabler-check class="size-3.5" />
                                            </span>
                                            @if ((int) $plan->total_words >= 0)
                                                <strong>
                                                    {{ number_format($plan->total_words) }}</strong>
                                                {{ __('Word Tokens') }}
                                            @else
                                                <strong>
                                                    {{ __('Unlimited') }}
                                                </strong>
                                                {{ __('Word Tokens') }}
                                            @endif
                                        </li>
                                    @endif
                                   
                                </ul>
                                <div class="mt-auto text-center">
                                    @if ($is_active_gateway == 1)
                                        @php($planid = $plan->id)
                                        @if ($plan->price == 0)
                                            <x-button
                                                class="w-full"
                                                href="{{ $app_is_demo ? '#' : LaravelLocalization::localizeUrl(route('dashboard.user.payment.startPrepaidPaymentProcess', ['planId' => $planid, 'gatewayCode' => 'freeservice'])) }}"
                                                onclick="{{ $app_is_demo ? 'return toastr.info(\'This feature is disabled in Demo version.\')' : '' }}"
                                                variant="ghost-shadow"
                                            >
                                                {{ __('Choose pack') }}
                                            </x-button>
                                        @else
                                            <button class="choose-plan-btn w-full lqd-btn inline-flex items-center justify-center gap-1.5 text-xs font-medium rounded-full transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/5 disabled:opacity-50 disabled:pointer-events-none lqd-btn-ghost-shadow bg-background text-foreground shadow-xs hover:bg-primary hover:text-primary-foreground dark:hover:bg-foreground dark:hover:text-background focus-visible:bg-primary focus-visible:text-primary-foreground dark:bg-foreground/[3%] dark:focus-visible:bg-foreground dark:focus-visible:text-background lqd-btn-md py-2 px-4 lqd-btn-hover-none w-full" data-price="{{ $plan->price }}" data-plan-id="{{ $planid }}">Choose Pack</button>
                                            
                                  
                                        @endif
                                    @else
                                        <p>
                                            {{ __('Please enable a payment gateway') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
     
                    <div class="w-full">
          <h2 class="mb-5"> Custom: </h2>
          <div class="grid grid-cols-3 gap-3 max-lg:grid-cols-2 max-md:grid-cols-1">
            <div class="w-full border rounded-3xl" style="background-color: #f1f1f1;">
              <div class="flex flex-col h-full p-7">
                <div class="mb-2 flex items-start text-[50px] font-bold leading-none text-heading-foreground" style="
    font-size: 30px;
">
                  <small class="inline-flex text-[0.35em] font-normal"> € </small> from 0.99
                </div>
                <ul class="p-0 my-6 text-sm list-none text-heading-foreground">
                  <li class="flex items-center mb-4">
                    <span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-opacity-10 shrink-0 custom-bullet">
                                            <svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"></path>
                                            </svg>
                                          </span> Access to all templates for €50.00+
                  </li>
                  <li class="flex items-center mb-4">
                    <span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-opacity-10 shrink-0 custom-bullet">
                                            <svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"></path>
                                            </svg>
                                          </span>
                    <strong style="margin-right: 5px">100</strong> Tokens <strong style="margin-left: 5px; text-decoration: line-through">€2.99</strong>&nbsp; <strong>€0.99</strong>
                  </li>
                </ul>
                <div class="mt-auto text-center">
                    <input type="range" min="100" max="100000" value="100" class="slider" id="wordCountSlider" style="margin-bottom: 10px; ">
                    <p id="wordCountDisplay">100 words</p>
                    <button data-plan-id="custom" class="choose-plan-btn lqd-btn inline-flex items-center justify-center gap-1.5 text-xs font-medium rounded-full transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/5 disabled:opacity-50 disabled:pointer-events-none lqd-btn-ghost-shadow bg-background text-foreground shadow-xs hover:bg-primary hover:text-primary-foreground dark:hover:bg-foreground dark:hover:text-background focus-visible:bg-primary focus-visible:text-primary-foreground dark:bg-foreground/[3%] dark:focus-visible:bg-foreground dark:focus-visible:text-background lqd-btn-md py-2 px-4 lqd-btn-hover-none w-full" id="choosePlanButton">
                        Choose custom pack for €0.99
                    </button>
                    
                </div>
                
               
                
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $('[data-click="tooltip"]').on('click', function() {

            let id = $(this).data('id');

            if ($('#' + id).hasClass('d-none')) {
                $('#' + id).removeClass('d-none');
            } else {
                $('#' + id).addClass('d-none');
            }

        })

        $(document).ready(function() {
            let plan = '{{ request('plan') }}';

            if (plan) {
                $('#gatewayModal_' + plan).modal('show');
            }
        });
    </script>
@endpush
<div id="addressModal" class="modal" tabindex="-1" role="dialog" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.4); z-index: 9999;">
  <div class="modal-dialog" role="document" style="position: relative; margin: auto; top: 50%; transform: translateY(-50%); max-width: 800px;">
    <div class="modal-content" style="background-color: #fff; padding: 20px; border-radius: 5px;">
      <div class="modal-header">
        <h5 class="modal-title">Address Details</h5>
        <p style="margin-bottom: 24px">Just one last thing, we need to take you address details before we can proceed to the payment</p>
        <button type="button" id="close-pay-modal" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 24px; cursor: pointer;top: 10px; right: 10px;position: absolute;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <form id="addressForm" style="grid-column: 1 / -1;">
            <div style="display: flex;">
                <div style="
    flex-grow: 1;margin-right: 20px;
">
                     <div class="relative mb-4 lqd-input-container">
            <label class="flex items-center gap-2 mb-3 font-medium leading-none cursor-pointer lqd-input-label text-2xs text-label" for="address1">
              <span class="lqd-input-label-txt">Address</span>
            </label>
            <input id="address1" class="block w-full px-4 py-2 text-base transition-colors border lqd-input peer border-input-border bg-input-background text-input-foreground ring-offset-0 focus:border-secondary focus:outline-0 focus:ring focus:ring-secondary dark:focus:ring-foreground/10 sm:text-2xs lqd-input-lg h-11 rounded-xl" name="address1" type="text" placeholder="123 Main St" required>
          </div>

          <div class="relative mb-4 lqd-input-container">
            <label class="flex items-center gap-2 mb-3 font-medium leading-none cursor-pointer lqd-input-label text-2xs text-label" for="city">
              <span class="lqd-input-label-txt">City</span>
            </label>
            <input id="city" class="block w-full px-4 py-2 text-base transition-colors border lqd-input peer border-input-border bg-input-background text-input-foreground ring-offset-0 focus:border-secondary focus:outline-0 focus:ring focus:ring-secondary dark:focus:ring-foreground/10 sm:text-2xs lqd-input-lg h-11 rounded-xl" name="city" type="text" placeholder="London" required>
          </div>

          <div class="relative mb-4 lqd-input-container">
            <label class="flex items-center gap-2 mb-3 font-medium leading-none cursor-pointer lqd-input-label text-2xs text-label" for="state">
              <span class="lqd-input-label-txt">County</span>
            </label>
            <input id="state" class="block w-full px-4 py-2 text-base transition-colors border lqd-input peer border-input-border bg-input-background text-input-foreground ring-offset-0 focus:border-secondary focus:outline-0 focus:ring focus:ring-secondary dark:focus:ring-foreground/10 sm:text-2xs lqd-input-lg h-11 rounded-xl" name="state" type="text" placeholder="Greater London" required>
          </div>
                </div>


<div style="
    flex-grow: 1;
">
          <div class="relative mb-4 lqd-input-container">
            <label class="flex items-center gap-2 mb-3 font-medium leading-none cursor-pointer lqd-input-label text-2xs text-label" for="zipCode">
              <span class="lqd-input-label-txt">Postcode</span>
            </label>
            <input id="zipCode" class="block w-full px-4 py-2 text-base transition-colors border lqd-input peer border-input-border bg-input-background text-input-foreground ring-offset-0 focus:border-secondary focus:outline-0 focus:ring focus:ring-secondary dark:focus:ring-foreground/10 sm:text-2xs lqd-input-lg h-11 rounded-xl" name="zipCode" type="text" placeholder="SW1A 1AA" required>
          </div>

          <div class="relative mb-4 lqd-input-container">
                   <label class="flex items-center gap-2 mb-3 font-medium leading-none cursor-pointer lqd-input-label text-2xs text-label" for="country_register">{{ __('Country') }}</label>
<select
    id="country"
    name="country"
    class="form-control"
    style="border: 1px solid #efefef; border-radius: 10px;width: 100%"
    required
>
    <option value="">Select a country...</option>

    <option value="AD">Andorra</option>
    <option value="AG">Antigua and Barbuda</option>
    <option value="AR">Argentina</option>
    <option value="AM">Armenia</option>
    <option value="AU">Australia</option>
    <option value="AT">Austria</option>
    <option value="AZ">Azerbaijan</option>
    <option value="BS">Bahamas</option>
    <option value="BH">Bahrain</option>

    <option value="BE">Belgium</option>
    <option value="BZ">Belize</option>
    <option value="BJ">Benin</option>
    <option value="BT">Bhutan</option>

    <option value="BW">Botswana</option>
    <option value="BR">Brazil</option>
    <option value="BN">Brunei</option>
    <option value="CV">Cabo Verde</option>
    <option value="KH">Cambodia</option>
    <option value="CA">Canada</option>
    <option value="CL">Chile</option>
    <option value="CO">Colombia</option>
    <option value="KM">Comoros</option>

    <option value="CR">Costa Rica</option>
    <option value="CY">Cyprus</option>
    <option value="CZ">Czech Republic</option>
    <option value="DK">Denmark</option>
    <option value="DJ">Djibouti</option>
    <option value="DM">Dominica</option>
    <option value="DO">Dominican Republic</option>
    <option value="TL">East Timor (Timor-Leste)</option>
    <option value="EC">Ecuador</option>
    <option value="SV">El Salvador</option>
    <option value="GQ">Equatorial Guinea</option>
    <option value="ER">Eritrea</option>
    <option value="EE">Estonia</option>
    <option value="SZ">Eswatini</option>
    <option value="FJ">Fiji</option>
    <option value="FI">Finland</option>
    <option value="FR">France</option>
    <option value="GM">Gambia</option>
    <option value="GE">Georgia</option>
    <option value="DE">Germany</option>
    <option value="GH">Ghana</option>
    <option value="GR">Greece</option>
    <option value="GD">Grenada</option>
    <option value="GT">Guatemala</option>

    <option value="GY">Guyana</option>
    <option value="HN">Honduras</option>
    <option value="HU">Hungary</option>
    <option value="IS">Iceland</option>
    <option value="IN">India</option>
    <option value="ID">Indonesia</option>

    <option value="IE">Ireland</option>
    <option value="IL">Israel</option>
    <option value="IT">Italy</option>
    <option value="CI">Ivory Coast</option>
    <option value="JP">Japan</option>
    <option value="JO">Jordan</option>
    <option value="KZ">Kazakhstan</option>
    <option value="KE">Kenya</option>
    <option value="KI">Kiribati</option>
    <option value="KW">Kuwait</option>
    <option value="KG">Kyrgyzstan</option>
    <option value="LV">Latvia</option>
    <option value="LS">Lesotho</option>

    <option value="LI">Liechtenstein</option>
    <option value="LT">Lithuania</option>
    <option value="LU">Luxembourg</option>
    <option value="MW">Malawi</option>
    <option value="MY">Malaysia</option>
    <option value="MV">Maldives</option>
    <option value="MT">Malta</option>
    <option value="MH">Marshall Islands</option>
    <option value="MR">Mauritania</option>
    <option value="MU">Mauritius</option>
    <option value="MX">Mexico</option>
    <option value="FM">Micronesia</option>
    <option value="MC">Monaco</option>
    <option value="MN">Mongolia</option>

    <option value="NA">Namibia</option>
    <option value="NR">Nauru</option>
    <option value="NL">Netherlands</option>
    <option value="NZ">New Zealand</option>

    <option value="NO">Norway</option>
    <option value="OM">Oman</option>
    <option value="PK">Pakistan</option>
    <option value="PW">Palau</option>
    <option value="PS">Palestine</option>
    <option value="PA">Panama</option>
    <option value="PG">Papua New Guinea</option>
    <option value="PY">Paraguay</option>
    <option value="PE">Peru</option>
    <option value="PL">Poland</option>
    <option value="PT">Portugal</option>
    <option value="RO">Romania</option>
    <option value="RW">Rwanda</option>
    <option value="KN">Saint Kitts and Nevis</option>
    <option value="LC">Saint Lucia</option>
    <option value="VC">Saint Vincent and the Grenadines</option>
    <option value="WS">Samoa</option>
    <option value="SM">San Marino</option>
    <option value="ST">Sao Tome and Principe</option>

    <option value="SC">Seychelles</option>
    <option value="SG">Singapore</option>
    <option value="SK">Slovakia</option>
    <option value="SB">Solomon Islands</option>
    <option value="KR">South Korea</option>
    <option value="ES">Spain</option>

    <option value="SE">Sweden</option>
    <option value="CH">Switzerland</option>
    <option value="TW">Taiwan</option>
    <option value="TJ">Tajikistan</option>
    <option value="TH">Thailand</option>
    <option value="TG">Togo</option>
    <option value="TO">Tonga</option>
    <option value="TT">Trinidad and Tobago</option>

    <option value="TM">Turkmenistan</option>
    <option value="TV">Tuvalu</option>
    <option value="UA">Ukraine</option>

    <option value="UY">Uruguay</option>
    <option value="UZ">Uzbekistan</option>
    <option value="VU">Vanuatu</option>
    <option value="VA">Vatican City</option>

    <option value="ZM">Zambia</option>
</select>
          </div>

       </div>
         </div>
        </form>
      </div>
     
      <div class="modal-footer"  style="display: flex;align-items: center;flex-flow: revert;justify-content: space-between;padding-top: 20px;border-top: 1px solid #efefef; margin-top: 20px">
          <label>
            <input type="checkbox" id="tacCheckbox" required>
            I confirm that I have read and agree to the <a href="https://healthly.live/terms" target="_blank" style="text-decoration: underline;">Terms and Conditions</a> and <a href="https://healthly.live/page/custom-privacy-notice" target="_blank" style="text-decoration: underline;">Privacy Notice</a>.
          </label>
 <button class="lqd-btn inline-flex items-center justify-center gap-1.5 font-medium rounded-full transition-all hover:-translate-y-0.5 hover:shadow-xl disabled:opacity-50 disabled:pointer-events-none lqd-btn-primary bg-primary text-primary-foreground hover:bg-primary/90 hover:shadow-primary/10 focus-visible:bg-primary/90 focus-visible:shadow-primary/10 lqd-btn-md py-2 px-4 lqd-btn-hover-none text-sm" id="submitAddress" type="submit" disabled="disabled">Proceed to payment</button>      </div>
      <script>
  document.getElementById('tacCheckbox').addEventListener('change', function() {
    document.getElementById('submitAddress').disabled = !this.checked;
  });
</script>
    </div>
  </div>
</div>
        

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addressModal = document.getElementById('addressModal');
        const addressForm = document.getElementById('addressForm');
        document.getElementById('close-pay-modal').addEventListener('click', function() {
                            addressModal.style.display = 'none';

            
        })
        document.querySelectorAll('.choose-plan-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userEmail = document.body.getAttribute('data-email');
                const userName = document.body.getAttribute('data-name');
                window.price = this.getAttribute('data-price');
                window.planId = this.getAttribute('data-plan-id');
                window.wordsCount = this.getAttribute('data-words-count');

                // Show the address modal
                addressModal.style.display = 'block';

                // Handle form submission
               
            });
        });
        document.getElementById('submitAddress').addEventListener('click', function() {
              const userEmail = document.body.getAttribute('data-email');
                const userName = document.body.getAttribute('data-name');
                    const formData = new FormData(addressForm);
                    const addressData = {
                        first_name: userName,
                        last_name: userName,
                        address1: formData.get('address1'),
                        city: formData.get('city'),
                        state: formData.get('state'),
                        zip_code: formData.get('zipCode'),
                        country: formData.get('country'),
                        phone: "12345678",
                        cell_phone: "12345678",
                        email: userEmail,
                        amount: window.price,
                        plan_id: window.planId,
                        words_count: window.wordsCount || ''
                    };

                    fetch('https://healthly-api.vercel.app/api/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(addressData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.redirectUrl) {
                            window.location.href = data.redirectUrl;
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
        document.getElementById('wordCountSlider').addEventListener('input', function() {
            const wordCount = parseInt(this.value);
            const price = calculatePrice(wordCount);
            window.price = price;
            document.getElementById('choosePlanButton').textContent = `Choose pack for €${price.toFixed(2)}`;
            document.getElementById('choosePlanButton').setAttribute('data-price', price.toFixed(2));
            document.getElementById('choosePlanButton').setAttribute('data-words-count', wordCount);
            document.getElementById('wordCountDisplay').textContent = `${wordCount.toLocaleString()} words`;
        });

        function calculatePrice(words) {
            // Adjust the formula according to your pricing logic
            // This is a placeholder formula; adjust as necessary to scale up to 1000 euros
            const maxPrice = 1000;
            const minPrice = 0.99;
            const pricePerWord = (maxPrice - minPrice) / (100000 - 100);
            return minPrice + (words - 100) * pricePerWord;
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successModal = document.getElementById('successModal');

        // Check if the URL contains the success fragment
        if (window.location.hash === '#success') {
            successModal.style.display = 'block';
        }

        // Close the success modal when the close button is clicked
        successModal.querySelector('.close').addEventListener('click', function() {
            successModal.style.display = 'none';
        });

        // Close the success modal when the "Close" button is clicked
        successModal.querySelector('.lqd-btn').addEventListener('click', function() {
            successModal.style.display = 'none';
        });
    });
</script>
<!-- Success Modal -->
    <div id="successModal" class="modal" tabindex="-1" role="dialog" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.4); z-index: 9999;">
        <div class="modal-dialog" role="document" style="position: relative; margin: auto; top: 50%; transform: translateY(-50%); max-width: 500px;">
            <div class="modal-content" style="background-color: #fff; padding: 20px; border-radius: 5px;">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 24px; cursor: pointer; position: absolute; top: 10px; right: 10px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Congratulations! You have successfully paid for the plan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lqd-btn inline-flex items-center justify-center gap-1.5 font-medium rounded-full transition-all hover:-translate-y-0.5 hover:shadow-xl disabled:opacity-50 disabled:pointer-events-none lqd-btn-primary bg-primary text-primary-foreground hover:bg-primary/90 hover:shadow-primary/10 focus-visible:bg-primary/90 focus-visible:shadow-primary/10 lqd-btn-md py-2 px-4 lqd-btn-hover-none text-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

