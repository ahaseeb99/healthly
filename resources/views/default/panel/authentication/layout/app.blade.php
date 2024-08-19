@extends('panel.layout.app', ['layout_wide' => true, 'wide_layout_px' => 'px-0'])

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap');
        body * {
            font-family: "Sora", sans-serif;
        }
    #login-form {
        color: white;
        background: #052109;
    }
    .sign-text {
        color: white !important;
    }
</style>

@section('content')
    <div class="absolute top-0 left-0 right-0 flex items-center px-8 pt-8 max-lg:px-1">
        <div class="flex-grow">
            <a
                class="navbar-brand"
                href="{{ route('index') }}"
            >
                @if (isset($setting->logo_dashboard))
                    <img
                        class="group-[.navbar-shrinked]/body:hidden dark:hidden"
                        src="/public/images/healthly_admin.svg"
                        alt="{{ $setting->site_name }}"
                    >
                    <img
                        class="hidden group-[.navbar-shrinked]/body:hidden dark:block"
                        src="/public/images/healthly_admin.svg"
                        alt="{{ $setting->site_name }}"
                    >
                @else
                    <img
                        class="group-[.navbar-shrinked]/body:hidden dark:hidden"
                        src="/public/images/healthly_admin.svg"
                        alt="{{ $setting->site_name }}"
                    >
                    <img
                        class="hidden group-[.navbar-shrinked]/body:hidden dark:block"
                        src="/public/images/healthly_admin.svg"
                        alt="{{ $setting->site_name }}"
                    >
                @endif
            </a>
        </div>
        <div class="flex-grow text-end">
            <a
                class="inline-flex items-center gap-1 no-underline text-heading-foreground hover:underline lg:text-white"
                href="{{ route('index') }}"
            >
                <x-tabler-chevron-left class="w-4" />
                {{ __('Back to Home') }}
            </a>
        </div>
    </div>
    <div class="flex min-h-[100vh] w-full flex-wrap items-stretch max-md:pb-20 max-md:pt-32" id="login-form">
        <div class="grow md:flex md:w-1/2 md:flex-col md:items-center md:justify-center md:py-20">
            <div class="w-full px-4 text-center text-2xs lg:w-1/2">
                @yield('form')
            </div>
        </div>

        @if (
            	$setting->auth_view_options != null &&
                $setting->auth_view_options != 'undefined' && 
				json_decode($setting->auth_view_options)?->login_enabled == true &&
                json_decode($setting->auth_view_options)?->login_image != null &&
                json_decode($setting->auth_view_options)?->login_image != '' 
			)
            <div
                class="flex-col justify-center hidden overflow-hidden bg-center bg-cover md:flex md:w-1/2"
                style="background-image: url(/public/images/bg/auth-img.jpg)"
            >
            @else
                <div
                    class="flex-col justify-center hidden overflow-hidden bg-center bg-cover md:flex md:w-1/2"
                    style="background-image: url({{ custom_theme_url('/images/bg/bg-auth.jpg') }})"
                >
                    <img
                        class="translate-x-[27%] rounded-[36px] shadow-[0_24px_88px_rgba(0,0,0,0.55)]"
                        src="{{ custom_theme_url('/images/bg/dash-mockup.jpg') }}"
                        alt="MagicAI Dashboard Mockup"
                    >
                </div>
        @endif
    </div>
@endsection
