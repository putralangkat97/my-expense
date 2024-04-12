@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'text-gray-800 dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm placeholder:text-gray-300 dark:placeholder:text-gray-500',
]) !!}>
    {{ $slot }}
</select>
