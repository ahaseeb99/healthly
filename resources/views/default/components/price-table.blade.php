<?php
	$wrapper_classname = 'px-9 pb-11 rounded-3xl text-center firstPriceBg';

	if ( $featured ) {
		$wrapper_classname .= ' border';
	}
?>
<style>
    .firstPriceBg{
        background-color: #fff;
        box-shadow: 0px 0px 6px 0px;
    }
    .secondPriceBg{
        background-image: url("{{asset('public/images/bg/Frame 54.png')}}"); 
        background-size: cover; 
        background-repeat: no-repeat;
    }
</style>
<div class="{{$wrapper_classname}} max-xl:px-6 max-lg:px-4 @if($title == 'Pro' || $title == 'Flex Silver') secondPriceBg @endif" style="padding-top: 2.75rem;">
	<h6 class="p-[0.35rem] mb-6 rounded-md text-[25px] text-opacity-80" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #fff" @endif>{{__($title)}}</h6>
	<p class="text-[45px] font-medium text-heading-foreground leading-none -tracking-wide mb-1" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #fff" @endif>

		@if(currencyShouldDisplayOnRight(currency()->symbol))
		  	{{$price}}{{$currency}}
		@else
			{{$currency}}{{$price}}
		@endif

	</p>
	<p class="mb-4 text-sm" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #fff" @endif>{{ __('per '.$period) }}</p>
	<ul class="px-3 text-left max-lg:p-0">
		@if($trialDays > 0)
		<li class="flex items-center mb-4">
			<span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-[#684AE2] bg-opacity-10 shrink-0" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #000; background-color: white;" @endif>
				<svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"/>
				</svg>
			</span>
			{{ number_format($trialDays)." ".__('Days of free trial.') }}
		</li>
		@endif
		@if ( !empty( $activeFeatures ) )
			@foreach( explode( ',', $activeFeatures ) as $feature )
				<li class="flex items-center mb-4">
					<span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-[#684AE2] bg-opacity-10 shrink-0" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #000; background-color: white;" @endif>
						<svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"/>
						</svg>
					</span>
					{{ trim( __($feature) ) }}
				</li>
			@endforeach
		@endif
		<li class="flex items-center mb-4">
			<span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-[#684AE2] bg-opacity-10 shrink-0" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #000; background-color: white;" @endif>
				<svg width="13" height="10" viewBox="0 0 13 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z"/>
				</svg>
			</span>
			@if((int)$totalWords >= 0)
			<strong>{{number_format($totalWords)}}&nbsp;</strong> {{__(' Word Tokens')}}
			@else
			<strong>{{__('Unlimited ')}}&nbsp;</strong> {{__(' Word Tokens')}}
			@endif
		</li>
		
		@if ( !empty( $inactiveFeatures ) )
			@foreach( explode( ',', $inactiveFeatures ) as $feature )
				<li class="flex items-center mb-4 opacity-25">
					<span class="inline-grid place-content-center w-[22px] h-[22px] mr-3 rounded-xl text-[#684AE2] bg-[#684AE2] bg-opacity-10 shrink-0" @if($title == 'Pro' || $title == 'Flex Silver') style="color: #000; background-color: white;" @endif>
						<svg width="5" height="2" viewBox="0 0 5 2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0.00299835H4.167V1.539H0V0.00299835Z"/>
						</svg>
					</span>
					{{ trim( __($feature) ) }}
				</li>
			@endforeach
		@endif
	</ul>
	<a href="{{$buttonLink}}"  class="block w-full p-3 mb-6 rounded-lg font-medium @if($title == 'Pro' || $title == 'Flex Silver') bg-white text-heading-foreground hover:bg-black hover:text-white @else bg-black text-heading-foreground bg-opacity-[0.03] hover:bg-black hover:text-white @endif transition-colors">{{__($buttonLabel)}}</a>
</div>
