<?php

$classname = 'transition-all ';

switch ($style) {
    case '1':
        $classname .= 'p-7 text-[1.25rem] text-center border rounded-xl font-heading font-medium hover:text-heading-foreground [&.lqd-is-active]:bg-white [&.lqd-is-active]:text-heading-foreground [&.lqd-is-active]:border-white [&.lqd-is-active]:shadow-lg';
        break;
    case '2':
        $classname .= 'px-4 py-2 rounded-lg hover:text-heading-foreground [&.lqd-is-active]:text-heading-foreground [&.lqd-is-active]:bg-white [&.lqd-is-active]:shadow-xl';
        break;
    case '3':
        $classname .= 'px-4 py-3 rounded hover:text-heading-foreground [&.lqd-is-active]:text-heading-foreground [&.lqd-is-active]:bg-customcolor [&.lqd-is-active]:shadow-xs max-sm:w-full max-sm:h-10';
        break;
}

if ($active) {
    $classname .= ' lqd-is-active';
}

?>
<style>
    .\[\&\.lqd-is-active\]\:bg-customcolor.lqd-is-active{
        --tw-bg-opacity: 1;
        background-color:rgba(233, 226, 254, 1);
        color: #120D1E;
        opacity: 40%;
    }
</style>
<button
    style="border-radius: 1.25em;"
    class="{{ $classname }}"
    data-target="{{ $target }}"
>
    {{ ucfirst($label) }}
    @if (!empty($badge))
        <span class="ml-1 inline-block rounded-md bg-[#684AE2] bg-opacity-10 p-[0.375rem] px-2 text-[#684AE2]">{{ $badge }}</span>
    @endif
</button>
