<div>

    <x-panel class="w-full sm:w-1/2" :href="route('transaction.index')">
        <x-slot:head>
            {{ __('Transaction Detail') }}
        </x-slot>
        <x-slot:link>
            {{ __('Back') }}
        </x-slot>

        <div class="grid grid-cols-1 gap-4">
            <div>
                <x-input-label :value="__('Transaction Name')" />
                <span>{{ $transaction->transaction_name }}</span>
            </div>
            <div>
                <x-input-label :value="__('Transaction Date')" />
                <span>{{ $transaction->local_datetime_format }}</span>
            </div>
            <div>
                <x-input-label :value="__('Amount')" />
                <span>{{ $transaction->local_currency }}</span>
            </div>

            <div>
                <x-primary-button-link :href="route('transaction.edit', $transaction)">
                    Edit
                </x-primary-button-link>
            </div>
        </div>
    </x-panel>
</div>
