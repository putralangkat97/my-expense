@props([
    'href' => '#',
])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 overflow-hidden shadow rounded sm:rounded-lg border dark:border-gray-700']) }}>
    <div class="flex justify-between items-center dark:bg-gray-700/50 p-6">
        <h2 class="font-medium text-gray-800 dark:text-white">
            {{ $head }}
        </h2>

        @isset($link)
            <x-primary-button-link :href="$href">
                {{ $link }}
            </x-primary-button-link>
        @endisset
    </div>

    <div class="p-6 text-gray-900">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="bg-gray-100 p-4">
            <span>{{ $footer }}</span>
        </div>
    @endisset
</div>
