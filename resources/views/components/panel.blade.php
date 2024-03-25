@props([
    'href' => '#',
])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm sm:rounded-lg border']) }}>
    <div class="flex justify-between items-center bg-teal-800/10 p-6">
        <h2 class="font-medium">
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
