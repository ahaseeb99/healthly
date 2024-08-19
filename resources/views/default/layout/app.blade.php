@php
    $google_fonts_string = '';
    $theme_google_fonts = Theme::getSetting('landingPage.googleFonts');

    $i = 0;
    foreach ($theme_google_fonts as $font_name => $weights) {
        $font_string = 'family=' . str_replace(' ', '+', $font_name);
        if (!empty($weights)) {
            $font_string .= ':wght@' . implode(';', $weights);
        }
        $google_fonts_string .= $font_string . ($i === count($theme_google_fonts) - 1 ? '' : '&');
        $i++;
    }
@endphp

<!DOCTYPE html>
<html
    class="max-sm:overflow-x-hidden"
    lang="{{ LaravelLocalization::getCurrentLocale() }}"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
>

<head>
    <meta charset="UTF-8" />
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />
    <meta
        name="description"
        content="{{ getMetaDesc($setting) }}"
    >
    @if (isset($setting->meta_keywords))
        <meta
            name="keywords"
            content="{{ $setting->meta_keywords }}"
        >
    @endif

    <link
        rel="icon"
        href="{{ custom_theme_url($setting->favicon_path ?? 'assets/favicon.ico') }}"
    >
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">
    <title>
        {{ getMetaTitle($setting) }}
    </title>

    @if (filled($google_fonts_string))
        <link
            rel="preconnect"
            href="https://fonts.googleapis.com"
        >
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin
        >
        <!-- <link
            href="https://fonts.googleapis.com/css2?{{ $google_fonts_string }}&display=swap"
            rel="stylesheet"
        > -->
    @endif

    <link
        rel="stylesheet"
        href="{{ custom_theme_url('assets/css/frontend/flickity.min.css') }}"
    >
    <link
        href="{{ custom_theme_url('assets/libs/toastr/toastr.min.css') }}"
        rel="stylesheet"
    />

    @php
        $link = 'resources/views/' . get_theme() . '/scss/landing-page.scss';
    @endphp
    @vite($link)

    @if ($setting->frontend_custom_css != null)
        <link
            rel="stylesheet"
            href="{{ $setting->frontend_custom_css }}"
        />
    @endif

    @if ($setting->frontend_code_before_head != null)
        {!! $setting->frontend_code_before_head !!}
    @endif

    <script>
        window.liquid = {
            isLandingPage: true
        };
    </script>

    <style>
        #toast-container {
            display: none !important;
        }
    </style>

    <!--Google AdSense-->
    {!! adsense_header() !!}
    <!--Google AdSense End-->
    {{-- Rewordfull start --}}
    {{-- <script>(function(w,r){w._rwq=r;w[r]=w[r]||function(){(w[r].q=w[r].q||[]).push(arguments)}})(window,'rewardful');</script> --}}
    {{-- <script async src='https://r.wdfl.co/rw.js' data-rewardful='API_KEY'></script> --}}
    {{-- Rewordfull end --}}

	@if (setting('additional_custom_css') != null)
        {!! setting('additional_custom_css') !!}
    @endif
    <script type="module" src="cookieconsent-config.js"></script>\
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@3.0.1/dist/cookieconsent.css">


<style>
    body, .font-body {
        font-family: "Sora", sans-serif !important;
    }
</style>
</head>

<body class="group/body font-body text-foreground" style="background-color: #000;">
    <div
        class="pointer-events-none invisible fixed left-0 right-0 top-0 z-[99] opacity-0 transition-opacity"
        id="app-loading-indicator"
        x-data
        :class="{ 'opacity-0': !$store.appLoadingIndicator.showing, 'invisible': !$store.appLoadingIndicator.showing }"
    >
        <div class="lqd-progress relative h-[3px] w-full bg-foreground/10">
            <div class="absolute inset-0 lqd-progress-bar lqd-progress-bar-indeterminate lqd-app-loading-indicator-progress-bar bg-primary dark:bg-heading-foreground">
            </div>
        </div>
    </div>

    @include('layout.header')

    @yield('content')

    @include('layout.footer')

    @if ($setting->frontend_custom_js != null)
        <script src="{{ $setting->frontend_custom_js }}"></script>
    @endif

    @if ($setting->frontend_code_before_body != null)
        {!! $setting->frontend_code_before_body !!}
    @endif

    <script src="{{ custom_theme_url('assets/libs/jquery/jquery.min.js') }}"></script>

    @if (in_array($settings_two->chatbot_status, ['frontend', 'both']))
        <script src="{{ custom_theme_url('assets/js/panel/openai_chatbot.js') }}"></script>
    @endif

    <script src="{{ custom_theme_url('assets/libs/vanillajs-scrollspy.min.js') }}"></script>
    <script src="{{ custom_theme_url('assets/libs/flickity.pkgd.min.js') }}"></script>
    <script src="{{ custom_theme_url('assets/js/frontend.js') }}"></script>
    <script src="{{ custom_theme_url('assets/js/frontend/frontend-animations.js') }}"></script>

    @if ($setting->gdpr_status == 1)
        <script src="{{ custom_theme_url('assets/js/gdpr.js') }}"></script>
    @endif

    <script src="{{ custom_theme_url('assets/libs/fslightbox/fslightbox.js') }}"></script>
    <script src="{{ custom_theme_url('assets/libs/toastr/toastr.min.js') }}"></script>

    @if (\Session::has('message'))
        <script>
            toastr.{{ \Session::get('type') }}('{{ \Session::get('message') }}')
        </script>
    @endif

    @if (\Session::has('message'))
        <script>
            toastr.{{ \Session::get('type') }}('{{ \Session::get('message') }}')
        </script>
    @endif
</body>

</html>
