<div class="fadeinout">
    <x-primary-button-link :href="route('transaction.create')" class="mb-4">
        {{ __('Create') }}
    </x-primary-button-link>

    <div class="mb-5">
        <x-text-input type="text" placeholder="Search transaction" wire:model.live.debounce.500ms="search" class="block mt-1 w-full" />
    </div>

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
    {{ $transactions->links() }}
</div>
