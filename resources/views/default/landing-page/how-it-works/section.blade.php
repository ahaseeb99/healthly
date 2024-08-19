    {!! adsense_how_it_works_728x90() !!}
    
    <style>
    #how-items .item p {
        text-align: center;
    }
        #how-items .item p::before {
            content: "1";
            display: inline-block;
            font-size: 60px;
            font-weight: bold;
            margin-right: 10px;
        }
        
        #how-items .item:nth-child(2) p::before {
            content: "2";
         
        }
        
        #how-items .item:nth-child(3) p::before {
            content: "3";
         
        }
        
    </style>
    <section
        style="background-image: url('{{asset('public/images/bg/Frame 50.png')}}'); "
        class="site-section transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
        id="how-it-works"
    >
       <div class="container">
            <div
                class=" bg-cover p-10 py-24 text-white text-opacity-60 max-sm:bg-bottom max-sm:px-5"
                style="padding-top: 20%; margin-top: -18%;"
            >
                <div class="mb-14 w-1/2 px-10 max-xl:w-1/2 max-lg:w-8/12 max-md:w-full">
                    <h6 class="mb-3" style="color: #fff; opacity: 50%; font-size: 14px;margin-top: 100px">Healthly Unleash the Power of AI for Your Fitness Journey
                    </h6>
                    <h2 class="text-[64px] leading-none text-[#E5E6E6] max-sm:text-[45px]">{!! __($fSectSettings->how_it_works_title) !!}
                    </h2>
                </div>
                <div class="grid-cols-{{ count($howitWorks) }} mb-20 grid gap-7 max-md:grid-cols-1" id="how-items">
                    @foreach ($howitWorks as $item)
                        @include('landing-page.how-it-works.item')
                    @endforeach
                </div>
                <!--@if ($howitWorksDefaults['option'] == 1)-->
                <!--    <div class="flex justify-center text-[#A2B2C9]">-->
                <!--        {!! $howitWorksDefaults['html'] !!}-->
                <!--    </div>-->
                <!--@endif-->
                <div class="translate-y-3 text-center opacity-0 transition-all delay-[450ms] group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100">
                    @if ($howitWorksDefaults['option'] == 1)
                        <a
                            style="background-color: rgb(255 255 255 / 50%); padding: 1rem 5rem 1rem 5rem;"
                            class="relative inline-flex items-center overflow-hidden rounded-xl border-[2px] border-[#343C57] border-opacity-0 bg-white bg-opacity-10 px-7 py-4 font-semibold transition-all duration-300 hover:scale-105 hover:border-white hover:bg-white hover:bg-opacity-100 hover:text-white hover:shadow-lg"
                            href="{{ !empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#' }}"
                        >
                            <span class="relative z-10 inline-flex items-center">
                                {!! __($fSetting->hero_button) !!}
                                <svg
                                    class="ml-2"
                                    width="11"
                                    height="14"
                                    viewBox="0 0 47 62"
                                    fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M27.95 0L0 38.213H18.633V61.141L46.583 22.928H27.95V0Z"></path>
                                </svg>
                            </span>
                        </a>
                    @endif
                </div>
            </div>
            <!--<div class="w-full text-center max-xl:w-full max-lg:w-full max-md:w-full"-->
            <!--    style="background: linear-gradient(0deg, rgba(14,11,23,1) 0%, rgba(14,11,23,1) 100%);">-->
            <!--            </div>-->
        </div>
    </section>
