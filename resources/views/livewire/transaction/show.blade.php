<div class="fadeinout">
    <x-panel class="w-full sm:w-3/4 md:w-1/2" :href="route('transaction.index')">
        <x-slot:head>
            {{ __('Transaction Detail') }}
        </x-slot>
        <x-slot:link>
            {{ __('Back') }}
        </x-slot>

        <div class="grid grid-cols-1 gap-4">
            <div>
                <x-input-label :value="__('Transaction Name')" />
                <span class="text-gray-800 dark:text-white">{{ $transaction->transaction_name }}</span>
            </div>
            <div>
                <x-input-label :value="__('Transaction Date')" />
                <span class="text-gray-800 dark:text-white">{{ \App\Helpers\LocalDateFormat::localDatetimeFormatted($transaction->transaction_date) }}</span>
            </div>
            <div>
                <x-input-label :value="__('Amount')" />
                <span class="text-gray-800 dark:text-white">{{ \App\Helpers\LocalDateFormat::getLocalCurrency($transaction->transaction_value) }}</span>
            </div>

            <div>
                <x-primary-button-link :href="route('transaction.edit', $transaction)">
                    Edit
                </x-primary-button-link>
            </div>
        </div>
    </x-panel>
</div>
