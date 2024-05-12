@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-teal-400 text-start text-base font-medium text-teal-500 bg-teal-50 dark:bg-teal-800/30 focus:outline-none focus:text-teal-800 focus:bg-teal-100 focus:border-teal-700 transition duration-150 ease-in-out hover:text-teal-700 hover:bg-teal-50 dark:hover:bg-teal-800/30 hover:border-teal-300'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-500 hover:text-teal-700 hover:bg-teal-50 dark:hover:bg-teal-800/30 hover:border-teal-300 focus:outline-none focus:text-teal-800 focus:bg-teal-50 dark:focus:bg-teal-800/30 focus:border-teal-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate.hover>
    {{ $slot }}
</a>
