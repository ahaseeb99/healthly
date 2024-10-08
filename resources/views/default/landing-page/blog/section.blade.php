<style>
    #blog header{
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
    }
    #blog .row{
        width: 100%;
        display: flex;
    }
</style>
<section
    class="site-section mb-14 py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
    id="blog"
>
    <div class="container">
        <x-section-header
            mb="9"
            width="w-1/2"
            title="{!! __($fSectSettings->blog_title) !!}"
            subtitle=""
        >
            <!-- <h6 class="mb-6 inline-block rounded-md  px-3 py-1 text-[13px] font-medium text-[#60027C]">
                {!! __($fSectSettings->blog_subtitle) !!}</span>
            </h6> -->
            <div style="display:flex"><img src="{{asset('public/images/bg/tt.png')}}" alt="Forest" style="width: 17px;
    height: 16px;margin-top:5px;margin-left:3px;margin-right:3px"><p> {!! __($fSectSettings->blog_subtitle) !!} </p> </div>
        </x-section-header>
        <div class="lg:grid-cols-{{ $fSectSettings->blog_posts_per_page }} mb-10 grid grid-cols-1 gap-10 md:grid-cols-2">
            @foreach ($posts as $key => $post)
                @include('blog.part.card')
            @endforeach
        </div>
        <!--<div class="flex justify-center">-->
        <!--    <a-->
        <!--        class="group flex space-x-2"-->
        <!--        href="/blog"-->
        <!--    >-->
        <!--        <div class="rounded-md bg-green-100 px-2 py-1 text-sm font-semibold text-green-500 transition-colors group-hover:bg-green-200">-->
        <!--            <svg-->
        <!--                xmlns="http://www.w3.org/2000/svg"-->
        <!--                width="16"-->
        <!--                height="16"-->
        <!--                viewBox="0 0 24 24"-->
        <!--                stroke-width="1.5"-->
        <!--                stroke="currentColor"-->
        <!--                fill="none"-->
        <!--                stroke-linecap="round"-->
        <!--                stroke-linejoin="round"-->
        <!--            >-->
        <!--                <path-->
        <!--                    stroke="none"-->
        <!--                    d="M0 0h24v24H0z"-->
        <!--                    fill="none"-->
        <!--                ></path>-->
        <!--                <path d="M12 5l0 14"></path>-->
        <!--                <path d="M5 12l14 0"></path>-->
        <!--            </svg>-->
        <!--        </div>-->
        <!--        <div class="rounded-md bg-green-100 px-2 py-1 text-sm font-semibold text-green-500 transition-colors group-hover:bg-green-200">-->
        <!--            {{ __($fSectSettings->blog_button_text) }}-->
        <!--        </div>-->
        <!--    </a>-->
        <!--</div>-->
    </div>
</section>
