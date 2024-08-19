{!! adsense_faq_728x90() !!}
<style>
    #faq header{
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
    }
    .lqd-accordion-content > p{
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #000 !important;
    }
    .tracking-wide > span{
        font-size: 16px !important;
        font-weight: 900 !important;
    }
</style>
<section
    class="site-section py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
    id="faq"
>
    <div class="container">
        <div class="relative p-11 pb-16 max-sm:px-5">
            <x-section-header
                mb="9"
                width="w-1/2"
                title="{!! __($fSectSettings->faq_title) !!}"
                subtitle="{!! __($fSectSettings->faq_subtitle) !!}"
            >
                <!-- <h6 class="mb-6 inline-block px-3 py-1 text-[13px] font-medium text-[#60027C]">
                    {!! __($fSectSettings->faq_text_one) !!}
                    <span class="dot"></span>
                    <span class="opacity-50">{!! __($fSectSettings->faq_text_two) !!}</span>
                </h6> -->
                <div style="display:flex"><p>{!! __($fSectSettings->faq_text_one) !!} </p> <img src="{{asset('public/images/bg/tt.png')}}" alt="Forest" style="width: 17px;
    height: 16px;margin-top:5px;margin-left:3px;margin-right:3px"><p> {!! __($fSectSettings->faq_text_two) !!}</p></div>
            </x-section-header>
            <div class="lqd-accordion mx-auto w-5/6 max-lg:w-full" style="border-radius: 25px;">
                @foreach ($faq as $key => $item)
                    @include('landing-page.faq.item')
                @endforeach
            </div>
        </div>
    </div>
</section>
