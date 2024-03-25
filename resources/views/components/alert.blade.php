@props([
    'type' => 'success',
])

<div class="{{ $type == 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} absolute w-full shadow"
    x-data="{ show: true }" x-transition:enter.duration.200ms x-transition:leave.duration.300ms x-init="setTimeout(() => show = false, 3000)"
    x-show="show">
    <div class="max-w-7xl mx-auto py-9 px-4 sm:px-6 lg:px-8">
        <span class="text-md">
            {{ $slot }}
        </span>
    </div>
</div>
