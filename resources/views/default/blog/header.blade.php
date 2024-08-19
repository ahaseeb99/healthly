<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap');
    body * {
        font-family: "Sora", sans-serif;
    }
    .sign-up-decor {
        background: linear-gradient(137deg, #219d12, #eec00f);
        padding: 1px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>
<header @class([
    'site-header group/header absolute inset-x-0 top-0 z-50 transition-[background,shadow] [&.lqd-is-sticky]:bg-white [&.lqd-is-sticky]:text-black [&.lqd-is-sticky]:shadow-[0_4px_20px_rgba(0,0,0,0.03)]',
    'text-black' => !isset($page) || (isset($page) && !$page->titlebar_status),
    'text-white' => isset($page) && $page->titlebar_status,
    'lqd-is-sticky' =>
        !isset($page) || (isset($page) && !$page->titlebar_status),
])>
    <nav 
        id="frontend-local-navbar"
        @class([
            'relative flex items-center justify-between border-b border-opacity-10 px-7 py-4 text-[14px] transition-all duration-500 group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:border-opacity-5 max-sm:px-2',
            'border-black' =>
                !isset($page) || (isset($page) && !$page->titlebar_status),
            'border-white' => isset($page) && $page->titlebar_status,
        ])
        style="background: #052109; color: white;"
    >
        <a
            class="relative site-logo basis-1/3 max-lg:basis-1/3"
            href="{{ route('index') }}"
            style="margin-top: 8px;"
        >
            @if (isset($setting->logo_sticky))
                <img
                    class="peer absolute start-0 top-1/2 -translate-y-1/2 translate-x-3 opacity-0 transition-all group-[.lqd-is-sticky]/header:translate-x-0 group-[.lqd-is-sticky]/header:opacity-100"
                    src="/public/images/healthly_admin.svg"
                    alt="{{ $setting->site_name }} logo"
                >
            @endif
            <img
                class="transition-all group-[.lqd-is-sticky]/header:peer-first:translate-x-2 group-[.lqd-is-sticky]/header:peer-first:opacity-0"
                src="/public/images/healthly_admin.svg"
                alt="{{ $setting->site_name }} logo"
            >
        </a>
        <div
            class="site-nav-container basis-1/3 max-lg:absolute max-lg:right-0 max-lg:top-full max-lg:max-h-0 max-lg:w-full max-lg:overflow-hidden max-lg:bg-[#343C57] max-lg:text-white [&.lqd-is-active]:max-lg:max-h-screen">
            <ul class="flex items-center justify-center text-center gap-14 whitespace-nowrap max-xl:gap-10 max-lg:flex-col max-lg:items-start max-lg:gap-5 max-lg:p-10">
                <li>
                    <a href="https://healthly.live" style="color: white; font-size: 18px;">
                        Home
                    </a>
                </li><li>
                    <a href="https://healthly.live/#how-it-works" style="color: white; font-size: 18px;">
                        How it works
                    </a>
                    </li><li>
                    <a href="https://healthly.live/#features" style="color: white; font-size: 18px;">
                        Features
                    </a>
                    </li><li>
                    <a href="https://healthly.live/#testimonials" style="color: white; font-size: 18px;">
                        Testimonial
                    </a>
                    </li><li>
                    <a href="https://healthly.live/#prices" style="color: white; font-size: 18px;">
                        Prices
                    </a>
                    </li><li>
                    <a href="https://healthly.live/#faq" style="color: white; font-size: 18px;">
                        FAQ
                    </a>
                </li>
            </ul>
            @if (count(explode(',', $settings_two->languages)) > 1)
                <div class="relative block px-10 pt-6 pb-5 -mt-3 border-t group border-white/5 md:hidden">
                    <p class="flex items-center gap-2 mb-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="22"
                            height="22"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M3.6 9h16.8"></path>
                            <path d="M3.6 15h16.8"></path>
                            <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                            <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                        </svg>
                        {{ __('Languages') }}
                    </p>
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if (in_array($localeCode, explode(',', $settings_two->languages)))
                            <a
                                class="block py-3 transition-colors border-b border-black border-opacity-5 last:border-none hover:bg-black hover:bg-opacity-5"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                rel="alternate"
                                hreflang="{{ $localeCode }}"
                            >{{ country2flag(substr($properties['regional'], strrpos($properties['regional'], '_') + 1)) }}
                                {{ $properties['native'] }}</a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
        <div class="flex justify-end gap-2 basis-1/3 max-lg:basis-2/3">
            @if (count(explode(',', $settings_two->languages)) > 1)
                <div class="relative hidden group md:block">
                    <button @class([
                        'inline-flex size-10 items-center justify-center rounded-full border-2 border-solid !border-opacity-20 transition-colors before:absolute before:end-0 before:top-full before:h-4 before:w-full group-hover:!border-opacity-100 group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:group-hover:bg-black group-[.lqd-is-sticky]/header:group-hover:text-white',
                        'border-black group-hover:bg-black group-hover:text-white' =>
                            !isset($page) || (isset($page) && !$page->titlebar_status),
                        'border-white group-hover:bg-white group-hover:text-black' =>
                            isset($page) && $page->titlebar_status,
                    ])>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="22"
                            height="22"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M3.6 9h16.8"></path>
                            <path d="M3.6 15h16.8"></path>
                            <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                            <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                        </svg>
                    </button>
                    <div
                        class="pointer-events-none absolute end-0 top-[calc(100%+1rem)] min-w-[145px] translate-y-2 rounded-md bg-white text-black opacity-0 shadow-lg transition-all group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if (in_array($localeCode, explode(',', $settings_two->languages)))
                                <a
                                    class="block px-3 py-3 transition-colors border-b border-black border-opacity-5 last:border-none hover:bg-black hover:bg-opacity-5"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                    rel="alternate"
                                    hreflang="{{ $localeCode }}"
                                >{{ country2flag(substr($properties['regional'], strrpos($properties['regional'], '_') + 1)) }}
                                    {{ $properties['native'] }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            @auth
                <div class="mx-3">
                    <a
                        @class([
                            'relative inline-flex items-center overflow-hidden rounded-lg border-[2px] !border-opacity-0 px-4 py-2 font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:bg-black/10 group-[.lqd-is-sticky]/header:text-black group-[.lqd-is-sticky]/header:hover:bg-black group-[.lqd-is-sticky]/header:hover:text-white',
                            'bg-white/10 text-white border-white hover:border-white hover:bg-white hover:text-black' =>
                                isset($page) && $page->titlebar_status,
                            'bg-black/10 text-black border-black hover:border-black hover:bg-black hover:text-white' =>
                                !isset($page) || (isset($page) && !$page->titlebar_status),
                        ])
                        href="{{ LaravelLocalization::localizeUrl(route('dashboard.index')) }}"
                        style="color: white; font-size: 18px;"
                    >
                        {!! __('Dashboard') !!}
                    </a>
                </div>
            @else
                <a
                    @class([
                        'relative inline-flex items-center overflow-hidden rounded-lg border-[2px] !border-opacity-10 px-4 py-2 font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg group-[.lqd-is-sticky]/header:border-black group-[.lqd-is-sticky]/header:text-black group-[.lqd-is-sticky]/header:hover:bg-black group-[.lqd-is-sticky]/header:hover:text-white',
                        'text-white border-white hover:border-white hover:bg-white hover:text-black' =>
                            isset($page) && $page->titlebar_status,
                        'text-black border-black hover:border-black hover:bg-black hover:text-white' =>
                            !isset($page) || (isset($page) && !$page->titlebar_status),
                    ])
                    href="{{ LaravelLocalization::localizeUrl(route('login')) }}"
                    style="color: white; font-size: 18px;"
                >
                    {!! __($fSetting->sign_in) !!}
                </a>
                <span class="sign-up-decor">
                    <a
                        @class([
                            'relative inline-flex items-center overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-lg group-[.lqd-is-sticky]/header:border-black/0 group-[.lqd-is-sticky]/header:bg-black/10 group-[.lqd-is-sticky]/header:text-black group-[.lqd-is-sticky]/header:hover:bg-black group-[.lqd-is-sticky]/header:hover:text-white',
                            'bg-white/10 text-white border-white hover:border-white hover:bg-white hover:text-black' =>
                                isset($page) && $page->titlebar_status,
                            'bg-black/10 text-black border-black hover:border-black hover:bg-black hover:text-white' =>
                                !isset($page) || (isset($page) && !$page->titlebar_status),
                        ])
                        href="{{ LaravelLocalization::localizeUrl(route('register')) }}"
                        style="color: white; background: #052109; border-radius: 30px; padding: 10px 14px; font-size: 18px;"
                    >
                        {!! __($fSetting->join_hub) !!}
                    </a>
                </span>
            @endauth

            <button
                class="mobile-nav-trigger size-10 group flex shrink-0 items-center justify-center rounded-full bg-white !bg-opacity-10 group-[.lqd-is-sticky]/header:bg-black lg:hidden"
            >
                <span class="flex flex-col w-4 gap-1">
                    @for ($i = 0; $i <= 1; $i++)
                        <span
                            class="inline-flex h-[2px] w-full bg-white transition-transform first:origin-left last:origin-right group-[.lqd-is-sticky]/header:bg-black group-[&.lqd-is-active]:first:-translate-y-[2px] group-[&.lqd-is-active]:first:translate-x-[3px] group-[&.lqd-is-active]:first:rotate-45 group-[&.lqd-is-active]:last:-translate-x-[2px] group-[&.lqd-is-active]:last:-translate-y-[8px] group-[&.lqd-is-active]:last:-rotate-45"
                        ></span>
                    @endfor
                </span>
            </button>
        </div>
    </nav>
</header>
@if ($app_is_demo)
    <div class="fixed z-50 bottom-8 start-8">
        <a
            class="size-12 inline-flex items-center justify-center rounded-full bg-[#262626] transition-all duration-300 hover:-translate-y-1 hover:scale-110 hover:shadow-md"
            href="https://codecanyon.net/item/magicai-openai-content-text-image-chat-code-generator-as-saas/45408109"
            target="_blank"
            title="{{ __('Buy on Envato') }}"
        >
            <svg
                fill="#0ac994"
                xmlns="http://www.w3.org/2000/svg"
                width="19.824"
                height="22.629"
                viewBox="0 0 19.824 22.629"
            >
                <path
                    d="M17.217,9.263c-.663-.368-2.564-.14-4.848.566-4,2.731-7.369,6.756-7.6,13.218-.043.155-.437-.021-.515-.069a9.2,9.2,0,0,1-.606-7.388c.168-.28-.381-.624-.48-.525A11.283,11.283,0,0,0,1.6,17.091a9.84,9.84,0,0,0,17.2,9.571c3.058-5.481.219-16.4-1.574-17.4Z"
                    transform="translate(-0.32 -9.089)"
                />
            </svg>
        </a>
    </div>
@endif
