<article class=" rounded-2xl w-full flex flex-col">
    <div class="p-5 min-h-[180px] flex flex-col font-medium" style="background-color: rgba(233, 226, 254, 1); border-radius: 15px;">
        <div class="flex justify-between space-x-6 mb-3 text-black" style="justify-content: end;">
            <time datetime="{{ $post->updated_at }}"
                class="text-sm" style="color: rgba(18, 13, 30, 1); font-size: 18px; font-weight: 900; opacity: 20%;">{{ date('d.m', strtotime($post->updated_at)) }}</time>
        </div>
        <h2 class="!text-[21px] mb-4 tracking-tight leading-[26px]"><a
                href="{{ url('/blog', $post->slug) }}">{{ $post->title }}</a></h2>
        <a class="flex items-center mt-auto text-[13px] text-black" href="{{ url('/blog', $post->slug) }}" style="color: rgba(18, 13, 30, 1); opacity: 50%; justify-content: center;">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M16.1008 16.496C12.4769 15.8579 8.77192 13.9646 5.70621 10.8988C2.64047 7.83311 0.747152 4.12807 0.109083 0.504198C3.73293 1.14228 7.43794 3.0356 10.5037 6.10131C13.5694 9.16705 15.4627 12.8721 16.1008 16.496Z" fill="#D7C9FF"/>
</svg>
            {{ __('Read More') }}
            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.39873 15.996C4.02258 15.3579 7.72759 13.4646 10.7933 10.3988C13.859 7.33311 15.7524 3.62807 16.3904 0.00419829C12.7666 0.64228 9.06157 2.5356 5.99586 5.60131C2.93012 8.66705 1.0368 12.3721 0.39873 15.996Z" fill="#D7C9FF"/>
</svg>
        </a>
    </div>
    <figure style="margin-top: 10px;">
        <a href="{{ url('/blog', $post->slug) }}">
            <img class="w-full object-cover" src="{{ custom_theme_url($post->feature_image, true) }}"
                alt="{{ $post->title }}" style="height: 17rem; border-radius: 20px;">
        </a>
    </figure>

</article>
