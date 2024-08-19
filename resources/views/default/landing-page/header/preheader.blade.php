<div
    class="absolute inset-x-0 top-0 z-50 flex h-12 items-center justify-center bg-[#343C57] bg-cover px-3 text-center text-sm text-white opacity-0 bg-blend-luminosity transition-all duration-500 group-[.page-loaded]/body:opacity-100"
    style="background-image: url({{ custom_theme_url('assets/img/site/conffetti.png') }}); display: none;"
>
    <p>
        <span class="mr-3 text-[10px] font-semibold uppercase tracking-wide">{{ __($fSetting->header_title) }}</span>
        <span class="opacity-70">{{ __($fSetting->header_text) }}</span>
    </p>
</div>
