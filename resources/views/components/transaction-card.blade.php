@props([
    'viewLink' => '#',
    'editLink' => '#',
])

<div
    {{ $attributes->merge(['class' => 'bg-white rounded sm:rounded-lg px-4 sm:px-8 py-4 shadow-sm border border-gray-200']) }}>
    <div class="flex justify-between items-center">
        <div class="flex flex-col justify-start">
            <x-link :href="$viewLink" class="font-medium text-sm sm:text-lg">{{ $transactionName }}</x-link>
            <div class="text-gray-500 text-sm sm:text-lg">{{ $transactionDate }}</div>
        </div>
        <div class="flex justify-between space-x-2 items-center">
            <div class="text-sm sm:text-lg">{{ $transactionValue }}</div>
            <x-link :href="$editLink">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-teal-600 icon icon-tabler icon-tabler-edit w-5 h-5"
                    width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                </svg>
            </x-link>
        </div>
    </div>
</div>
