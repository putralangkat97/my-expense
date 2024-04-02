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
            <x-input-label :value="$transaction[0]->local_date_format" class="mb-1 text-lg md:text-xl" />
            <x-transaction-card class="mb-3" :viewLink="route('transaction.show', $transaction[0])" :editLink="route('transaction.edit', $transaction[0])">
                <x-slot:transactionName>{{ $transaction[0]->transaction_name }}</x-slot>
                <x-slot:transactionDate>{{ $transaction[0]->local_time_format }}</x-slot>
                <x-slot:transactionValue>{{ $transaction[0]->local_currency }}</x-slot>
            </x-transaction-card>
        @empty
            <div
                class="bg-white dark:bg-gray-800 rounded sm:rounded-lg px-4 sm:px-8 py-8 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                <span class="text-gray-800 dark:text-gray-400">{{ __('No records') }}</span>
            </div>
        @endforelse
    </div>

    <div class="">
        {{ $transactions->links(data: ['scrollTo' => false]) }}
    </div>
</div>
