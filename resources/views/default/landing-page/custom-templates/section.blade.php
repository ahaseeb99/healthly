{!! adsense_templates_728x90() !!}
<style>
    #templates header{
        margin-left: 20px;
        margin-right: 20px;
        text-align: left;
    }

    #templates .carousel{
        max-width: 100%;
    }
    .uc-content .carousel-cell {
    margin-right: 0 !important;
    margin-left: 0 !important;
    opacity: 1 !important;
    filter: none !important;
    padding: 0px !important;
    border-radius: 32px !important;
    box-shadow: rgba(0, 0, 0, 0.1) -4px 9px 25px -6px;
}
.uc-content .carousel-cell h4{
    line-height: 1.3;
}

#templates .mb-10.inline-flex button {
    font-family: 'satoshi';
    font-size: 16px;
    font-weight: normal;
    
}
#templates .uc-content .group{
    margin: 10px;
    transition: all .3s;
}
#templates .uc-content .group:hover {
   background-color: #F5F1FF;
}
</style>
<section
    style="position: relative; z-index: 1; background: url('{{asset('public/images/bg/Frame 024.png')}}'); background-repeat: no-repeat; background-position: bottom; background-size: cover;"
    class="site-section pb-9 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
    id="templates"
>
    <!--<div class="container">-->
        <div class="p-20 max-sm:px-5">
        <div class="container">
            <x-section-header
                mb="7"
                width="w-3/5"
                title="{!! __($fSectSettings->custom_templates_title) !!}"
                subtitle="{!! $fSectSettings->custom_templates_description ??
                    'Create your own template or use pre-made templates and examples for various content types and industries to help you get started quickly.' !!}"
            >
                <!-- <h6 class="mb-6 inline-block rounded-md  bg-opacity-15 px-3 py-1 text-[13px] font-medium text-[#083D91]">
                    {!! __($fSectSettings->custom_templates_subtitle_one) !!}
                    <img src="{{asset('public/images/bg/pik.png')}}" alt="Forest" width="12" height="12" style="margin-left:2px">
                    <span class="opacity-50">{!! __($fSectSettings->custom_templates_subtitle_two) !!}</span>
                </h6> -->
                <div style="display:flex"><p>Custom Prompts  </p> <img src="{{asset('public/images/bg/tt.png')}}" alt="Forest" style="width: 17px;
    height: 16px;margin-top:5px;margin-left:3px;margin-right:3px"><p>  New every week</p></div>
            </x-section-header>
            <div class="flex flex-col" style="overflow-x: scroll;margin-bottom: 19px;">
                <div style="width: max-content;">
                    <x-tabs-trigger
                        target=".templates-all"
                        style="2"
                        label="{{ __('All') }}"
                        active="true"
                    />
                    @foreach ($filters as $filter)
                        <x-tabs-trigger
                            target=".templates-{{ \Illuminate\Support\Str::slug($filter->name) }}"
                            style="2"
                            label="{{ __($filter->name) }}"
                        />
                    @endforeach
                </div>
            </div>
                </div>
            <div class="relative uc-content" style="display: flex;flex-direction: row;flex-wrap: wrap;">
                  @foreach ($templates as $item)
                                @if ($item->active != 1)
                                    @continue
                                @endif
                                    @include('landing-page.custom-templates.item')
                            @endforeach
                <!-- <div class="max-lg:11/12 mx-auto w-full max-md:w-full"> -->
                    <!--<div class="carousel" data-flickity='{ "pageDots": false }'>-->
                    <!--        @foreach ($templates as $item)-->
                    <!--            @if ($item->active != 1)-->
                    <!--                @continue-->
                    <!--            @endif-->
                    <!--            <div class="carousel-cell">-->
                    <!--                @include('landing-page.custom-templates.item')-->
                    <!--            </div>-->
                    <!--        @endforeach-->
                        
                    <!--</div>-->
                <!-- </div> -->
                <!-- <div class="carousel templates-cards grid max-h-[28rem] grid-cols-3 gap-4 overflow-hidden max-lg:grid-cols-2 max-md:grid-cols-1" data-flickity>
                    
                            @foreach ($templates as $item)
                                @if ($item->active != 1)
                                    @continue
                                @endif
                                <div class="carousel-cell">
                                    @include('landing-page.custom-templates.item')
                                </div>
                            @endforeach
                    
                </div>
                <div class="templates-cards-overlay absolute inset-x-0 bottom-0 z-10 h-[230px] bg-gradient-to-t from-background from-20% to-transparent">
                </div> -->
            </div>
            <!-- <div class="relative z-20 mt-2 text-center">
                <button class="templates-show-more text-[14px] font-semibold text-[#5A4791]">
                    <span class="size-7 mr-1 inline-grid place-content-center rounded-lg bg-[#885EFE] bg-opacity-10">
                        <svg
                            width="12"
                            height="12"
                            viewBox="0 0 12 12"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M5.671 11.796V0.996H7.125V11.796H5.671ZM0.998 7.125V5.671H11.798V7.125H0.998Z" />
                        </svg>
                    </span>
                    <span class="inline-grid h-7 place-content-center rounded-lg bg-[#885EFE] bg-opacity-10 px-2">
                        {{ __('Show more') }}
                    </span>
                </button>
            </div> -->
        </div>
    <!--</div>-->
</section>