@props([
    'href' => '#',
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'hover:text-teal-500 transition-all duration-200']) }} wire:navigate>
    {{ $slot }}</a>
