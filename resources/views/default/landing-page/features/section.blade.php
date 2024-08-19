{!! adsense_features_728x90() !!}
<style>
    .feature-card{
        background: #F5F1FF;
        border-radius: 40px;
        padding: 80px;
        box-shadow: 0px 0px 15px 0px;
    }
    .feature-card.secondBg{
        background: #E9E2FE;
        border-radius: 40px;
        padding: 80px;
        box-shadow: 0px 0px 15px 0px;
    }
</style>
<section
    style="background: url('{{asset('public/images/bg/Frame 022.png')}}'); background-repeat: no-repeat; padding-bottom: 11rem; background-size: cover; padding-top: 14rem;"
    class="site-section pt-32 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
    id="features"
>
    <div class="container">
        <div style="display:flex"><p>Custom Prompts  </p> <img src="{{asset('public/images/bg/tt.png')}}" alt="Forest" style="width: 17px;
    height: 16px;margin-top:5px;margin-left:3px;margin-right:3px"><p>  New every week</p></div>
        <!--<p>Custom Prompts New every week</p>-->
        <header class=" text-left w-2/5 mb-14 max-xl:w-8/12 max-lg:w-10/12 max-md:w-full" style="width: 100% !important">
        	<h2 class="mb-[0.45em]">{!! __($fSectSettings->features_title) !!}</h2>
        	<p class="text-[18px] leading-[1.444em]"></p>
        </header>
        <!--<x-section-header-->
        <!--    title="{!! __($fSectSettings->features_title) !!}"-->
        <!--    subtitle="{!! __($fSectSettings->features_description) ?? __('MagicAI is designed to help you generate high-quality content instantly, without breaking a sweat.') !!}"-->
        <!--/>-->
        <div class="grid grid-cols-3 justify-between gap-x-15 max-lg:grid-cols-2 max-lg:gap-x-10 max-md:grid-cols-1" style="">
            @foreach ($futures as $key => $item)
            <!--@include('landing-page.features.item')-->
                <div class="feature-card @if($key % 2 != 0) secondBg @endif" style="box-shadow: 0px 0px 0 0px;">
                    <h4 style="font-weight: 900;">{!! __($item->title) !!}</h4>
                    <br>
                    <p>{!! __($item->description) !!}</p>
                </div>
            @endforeach
            
        </div>
    </div>
</section>
