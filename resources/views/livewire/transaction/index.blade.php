<div class="fadeinout">
    @session('success')
        @push('alert')
            <x-alert type="success">{{ $value }}</x-alert>
        @endpush
    @endsession

    <x-primary-button-link :href="route('transaction.create')" class="mb-4">
        {{ __('Create') }}
    </x-primary-button-link>

    @forelse ($transactions as $transaction)
        <x-transaction-card class="mb-3" :viewLink="route('transaction.show', $transaction)" :editLink="route('transaction.edit', $transaction)">
            <x-slot:transactionName>{{ $transaction->transaction_name }}</x-slot>
            <x-slot:transactionDate>{{ $transaction->local_datetime_format }}</x-slot>
            <x-slot:transactionValue>{{ $transaction->local_currency }}</x-slot>
        </x-transaction-card>
    @empty
        <div class="bg-white rounded sm:rounded-lg px-4 sm:px-8 py-8 shadow-sm border border-gray-200 text-center">
            <span class="">{{ __('No records') }}</span>
        </div>
    @endforelse
</div>
