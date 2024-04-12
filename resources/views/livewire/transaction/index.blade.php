<div class="fadeinout">
    @session('success')
        @push('alert')
            <x-alert type="success">{{ $value }}</x-alert>
        @endpush
    @endsession

    <x-primary-button-link :href="route('transaction.create')" class="mb-4">
        {{ __('Create') }}
    </x-primary-button-link>

    <div class="mb-5">
        @forelse ($transactions as $index => $transaction)
            <x-transaction-card class="mb-3" :viewLink="route('transaction.show', $transaction['id'])" :editLink="route('transaction.edit', $transaction['id'])">
                <x-slot:transactionName>{{ $transaction['transaction_name'] }}</x-slot>
                <x-slot:transactionDate>{{ \App\Helpers\LocalDateFormat::localDatetimeFormatted($transaction['transaction_date']) }}</x-slot>
                <x-slot:transactionValue>{{ \App\Helpers\LocalDateFormat::getLocalCurrency($transaction['transaction_value']) }}</x-slot>
            </x-transaction-card>
        @empty
            <div
                class="bg-white dark:bg-gray-800 rounded sm:rounded-lg px-4 sm:px-8 py-8 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                <span class="text-gray-800 dark:text-gray-400">{{ __('No records') }}</span>
            </div>
        @endforelse
    </div>

    <div wire:loading wire:target="loadMore" class="h-12 w-full bg-gray-100 dark:bg-gray-800/50 rounded animate-pulse"></div>

    @if ($data_count >= 10 && $count != $data_count)
        <span x-intersect:full="$wire.loadMore()">
            {{ __('Load More') }}
        </span>
    @endif
</div>
