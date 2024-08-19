<footer class="py-8 mt-auto lqd-page-footer">
    <div class="container">
        <div class="flex items-center gap-4">
            <div class="grow basis-full md:basis-0 lg:ms-auto">
                <p>GlobalAIVectra s.r.o. - Vovks Mareks - 371 25925475 - Kurta Konráda 2517/1, Libeň, 190 00 Praha 9 | hello@healthly.live</p>
            </div>
            <div class="grow basis-full md:basis-0 md:text-end">
                <p>
                    {{ __('Copyright') }} &copy; <?php echo date('Y'); ?>
                    <a href="{{ route('index') }}">
                        {{ $setting->site_name }}
                    </a>.
                    {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </div>
</footer>
