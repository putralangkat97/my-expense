@props([
    'href' => '#',
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'hover:text-teal-500 text-gray-800 dark:text-white transition-all duration-200']) }} wire:navigate.hover>
    {{ $slot }}</a>
