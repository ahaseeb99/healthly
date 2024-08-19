<style>
    .bag-img{
        background-image: url("{{asset('public/images/bg/Frame 49.png')}}"); 
        background-size: cover; 
        background-repeat: no-repeat;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
    }
    #banner .banner-divider .fill-background{
        fill: hsl(0deg 0% 100%);
    } 
    
</style>



<section
    style="padding-bottom: 6rem;"
    class="site-section relative flex min-h-screen items-center justify-center overflow-hidden py-52 text-center text-white max-md:pb-16 max-md:pt-48"
    id="banner"
>
    <div class="absolute start-0 top-0 h-full w-full transform-gpu overflow-hidden [backface-visibility:hidden]">
        <div class="absolute left-0 top-0 h-full w-full bag-img"></div>
    </div>
    <div class="container relative">
        <div class="flex w-1/2 flex-col  max-lg:w-2/3 max-md:w-full text-center">
           
            <div class="banner-title-wrap relative">
                <h1 style="font-size:64px;text-align: left;
    font-size: 116px;"
                    class="banner-title mb-7 translate-y-7 font-body font-bold -tracking-wide text-white opacity-0 transition-all ease-out group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100">
                    <img src="{{asset('public/images/bg/lll.svg')}}" alt="Forest" width="100" height="70" style="    display: block;
    margin: 0 auto;
    width: 427px;
    position: absolute;
    right: -90%">
             <!--       <svg-->
             <!--           class="lqd-split-text-words inline transition-all duration-[2850ms]"-->
             <!--           width="47"-->
             <!--           height="62"-->
             <!--           viewBox="0 0 47 62"-->
             <!--           fill="currentColor"-->
             <!--           xmlns="{{asset('public/images/bg/lll.svg')}}">-->
             <!--<path d="M27.95 0L0 38.213H18.633V61.141L46.583 22.928H27.95V0Z" />-->
                       
             <!--       </svg>-->
                    {!! __($fSetting->hero_title) !!}
                    @if ($fSetting->hero_title_text_rotator != null)
                        <span class="lqd-text-rotator inline-grid grid-cols-1 grid-rows-1 transition-[width] duration-200" >
                            @foreach (explode(',', __($fSetting->hero_title_text_rotator)) as $keyword)
                                <span
                                    class="lqd-text-rotator-item {{ $loop->first ? 'lqd-is-active' : '' }} col-start-1 row-start-1 inline-flex translate-x-3 opacity-0 blur-sm transition-all duration-300 [&.lqd-is-active]:translate-x-0 [&.lqd-is-active]:opacity-100 [&.lqd-is-active]:blur-0"
                                >
                                    <span>{!! $keyword !!}</span>
                                </span>
                            @endforeach
                            <span
                                    class="lqd-text-rotator-item col-start-1 row-start-1 inline-flex translate-x-3 opacity-0 blur-sm transition-all duration-300 [&.lqd-is-active]:translate-x-0 [&.lqd-is-active]:opacity-100 [&.lqd-is-active]:blur-0"
                                >
                                    <span>Healthy Recipes</span>
                                </span>
                        </span>
                    @endif
                </h1>
            </div>
            <p
                style="margin: 20px 0 10px 0;    margin: 20px 0 10px 0;
    text-align: left;"
                class="mb-7 w-full text-center text-[20px] leading-[1.25em] text-fuchsia-700 opacity-75 max-sm:w-full [&_.lqd-split-text-words]:translate-y-3 [&_.lqd-split-text-words]:opacity-0 [&_.lqd-split-text-words]:transition-all [&_.lqd-split-text-words]:ease-out group-[.page-loaded]/body:[&_.lqd-split-text-words]:translate-y-0 group-[.page-loaded]/body:[&_.lqd-split-text-words]:text-white group-[.page-loaded]/body:[&_.lqd-split-text-words]:opacity-100 ">
                <x-split-words
                    text="{!! __($fSetting->hero_description) !!}"
                    transitionDelayStart="{{ 0.15 }}"
                    transitionDelayStep="{{ 0.02 }}"
                />
            </p>
        </div>
        <br><br>
        <div class="mx-auto flex w-1/2 flex-col items-center max-lg:w-2/3 max-md:w-full">
            <div class="translate-y-3 opacity-0 transition-all delay-[450ms] group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100">
                @if ($fSetting->hero_button_type == 1)
                    <a
                        style="background-color: rgb(0 0 0 / 50%); padding: 1rem 5rem 1rem 5rem; font-size: 18px; letter-spacing: 1px; font-weight: normal"
                        class="relative inline-flex items-center overflow-hidden rounded-xl border-[2px] border-[#343C57] border-opacity-0 bg-white bg-opacity-10 px-7 py-4 font-semibold transition-all duration-300 hover:scale-105 hover:border-white hover:bg-white hover:bg-opacity-100 hover:text-white hover:shadow-lg"
                        href="{{ !empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#' }}"
                    >
                        <span class="relative z-10 inline-flex items-center">
                            <img src="{{asset('public/images/bg/pik3.png')}}" alt="Forest" style="float:left;margin-right:14px; width: 50px">
                            {!! __($fSetting->hero_button) !!}
                            

                                 <img src="{{asset('public/images/bg/pik.png')}}" alt="Forest" width="12" height="12" style="float:left;margin-left:11px; opacity: 0.8">
                        </span>
                    </a>
                @else
                    <a
                        class="inline-flex w-full items-center justify-center bg-black bg-opacity-10 px-4 py-3 text-lg font-semibold text-white transition-all duration-300 hover:bg-opacity-20"
                        data-fslightbox="video-gallery"
                        style="border-radius: 3rem;"
                        href="{{ !empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#' }}"
                    >
                        <svg
                            class="icon icon-tabler icon-tabler-player-play-filled me-4 bg-white"
                            style="padding: 13px; border-radius: 2rem;"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                stroke="none"
                                d="M0 0h24v24H0z"
                                fill="none"
                            ></path>
                            <path
                                d="M6 4v16a1 1 0 0 0 1.524 .852l13 -8a1 1 0 0 0 0 -1.704l-13 -8a1 1 0 0 0 -1.524 .852z"
                                stroke-width="0"
                                fill="#37393d"
                            ></path>
                        </svg>
                        {!! __($fSetting->hero_button) !!} &nbsp;
                    </a>
                @endif
            </div>
            <br><br><br>
         
        </div>
    </div>
</section>

