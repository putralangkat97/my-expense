@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-teal-400 text-sm font-medium leading-5 text-teal-500 focus:outline-none focus:border-teal-700 transition duration-150 ease-in-out hover:text-teal-700 hover:border-teal-300'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-teal-700 hover:border-teal-300 focus:outline-none focus:text-teal-700 focus:border-teal-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
    {{ $slot }}
</a>
