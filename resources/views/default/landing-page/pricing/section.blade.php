{!! adsense_pricing_728x90() !!}
<section
    style="background: url('{{asset('public/images/bg/Frame 29.png')}}'); background-repeat: no-repeat; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; background-size: cover;"
    class="site-section relative py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
    id="pricing"
>
    <div class="container relative">
        <div class="relative  p-11 max-lg:px-5">
            <x-section-header
                mb="7"
                title="{!! __($fSectSettings->pricing_title) !!}"
                subtitle="{!! __($fSectSettings->pricing_description) ?? __('Flexible and affording plans tailored to your needs. Save up to %20 for a limited time.') !!}"
            />
            
            <div class="lqd-tabs text-center">
                <div class="lqd-tabs-triggers mx-auto mb-9 inline-flex flex-wrap gap-2 rounded-md border text-[15px] font-medium leading-none" style="border-radius: 53px; padding: 5px;">
                    @if ($plansSubscriptionMonthly->count() > 0)
                        @include('landing-page.pricing.item-trigger', [
                            'target' => '#pricing-monthly',
                            'label' => __('Monthly'),
                            'active' => true,
                        ])
                    @endif
                    @if ($plansSubscriptionAnnual->count() > 0)
                        @include('landing-page.pricing.item-trigger', [
                            'target' => '#pricing-annual',
                            'label' => __('Annual'),
                            'badge' => __($fSectSettings->pricing_save_percent),
                        ])
                    @endif
                    @if ($plansSubscriptionLifetime->count() > 0)
                        @include('landing-page.pricing.item-trigger', [
                            'target' => '#pricing-lifetime',
                            'label' => __('Lifetime'),
                        ])
                    @endif
                    @if ($plansPrepaid->count() > 0)
                        @include('landing-page.pricing.item-trigger', [
                            'target' => '#pricing-prepaid',
                            'label' => __('Pre-Paid'),
                        ])
                    @endif
                    @include('landing-page.pricing.item-trigger', [
                        'target' => '#pricing-custom',
                        'label' => __('Custom'),
                    ])
                </div>
                <div class="lqd-tabs-content-wrap px-10 max-xl:px-0">
                    <div class="lqd-tabs-content">
                        <div id="pricing-monthly">
                            <div class="grid grid-cols-3 gap-2 max-md:grid-cols-1">
                                @foreach ($plansSubscriptionMonthly->take(3) as $plan)
                                    @include('landing-page.pricing.item-content', ['period' => $plan->frequency == 'monthly' ? 'month' : 'year'])
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="hidden"
                            id="pricing-annual"
                        >
                            <div class="grid grid-cols-3 gap-2 max-md:grid-cols-1">
                                @foreach ($plansSubscriptionAnnual as $plan)
                                    @include('landing-page.pricing.item-content', ['period' => $plan->frequency == 'monthly' ? 'month' : 'year'])
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="hidden"
                            id="pricing-prepaid"
                        >
                            <div class="grid grid-cols-3 gap-2 max-md:grid-cols-1">
                                @foreach ($plansPrepaid as $plan)
                                    @include('landing-page.pricing.item-content', ['period' => __('One Time Payment')])
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="hidden"
                            id="pricing-lifetime"
                        >
                            <div class="grid grid-cols-3 gap-2 max-md:grid-cols-1">
                                @foreach ($plansSubscriptionLifetime as $plan)
                                    @include('landing-page.pricing.item-content', ['period' => $plan->frequency == 'lifetime_monthly' ? 'month' : 'year'])
                                @endforeach
                            </div>
                        </div>
                         <div
                            class="hidden"
                            id="pricing-custom"
                        >
                            <div>
                                <div style="width: 33%; margin: 0 auto;" class="px-9 pb-11 rounded-3xl text-center firstPriceBg max-xl:px-6 max-lg:px-4 " style="padding-top: 2.75rem;">
                                	<h6 style="padding-top: 50px" class="p-[0.35rem] mb-6 rounded-md text-[25px] text-opacity-80">from €0.99</h6>
                                	
                                	<ul class="px-3 text-left max-lg:p-0">
                                											<li class="flex items-center mb-4">
                                					<span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-[#684AE2] bg-opacity-10 shrink-0">
                                						<svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                							<path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"></path>
                                						</svg>
                                					</span>
                                					Access to all templates for €50.00+
                                				</li>
                                							<li class="flex items-center mb-4">
                                			<span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-[#684AE2] bg-opacity-10 shrink-0">
                                				<svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                					<path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"></path>
                                				</svg>
                                			</span>
                                						<strong style="margin-right: 5px">100</strong> Tokens<strong style="margin-left: 5px; text-decoration: line-through">€2.99</strong>&nbsp;<strong>€0.99</strong>
                                					</li>
                                	
                                			</ul>
                                	<a href="https://healthly.live/register?plan=4" class="block w-full p-3 mb-6 rounded-lg font-medium  bg-black text-heading-foreground bg-opacity-[0.03] hover:bg-black hover:text-white  transition-colors">Buy custom</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-9 flex justify-center">
                <div class="flex items-center gap-5 text-sm text-[#002A40] text-opacity-60"  style="justify-content: center;">
                    <div style="display: flex; justify-content: space-between;">
                    <p style="font-size: 16px;
    width: 100px;
    position: relative;
    top: 6px;
    margin-right: 20px;">
                       Safe Payment
                                         

                       </p>
                         <img src="{{asset('public/images/mc.png')}}" alt="Master Card"  style="display: inline;
    flex-shrink: 0;
    width: 64px;
    height: 44px;
    position: relative;
    top: -6px;
    margin-right: 20px;">
                                           <img src="{{asset('public/images/visa.png')}}" alt="Visa" style="    width: 100px;
    height: 32px;"></div>
                </div>
            </div>
           
        </div>
    </div>
</section>
