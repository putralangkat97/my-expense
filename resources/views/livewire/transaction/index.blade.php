<div>
    @session('success')
        @push('alert')
            <x-alert type="success">{{ $value }}</x-alert>
        @endpush
    @endsession

    <div class="mb-6">
        <x-primary-button-link :href="route('transaction.create')">
            {{ __('Create') }}
        </x-primary-button-link>
    </div>

    <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
        <div class="inline-block min-w-full py-2 aling-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-teal-800/10">
                    <thead class="bg-teal-800/10">
                        <tr>
                            <th scope="col" class="py-3 pl-3 pr-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Transaction Name') }}
                            </th>
                            <th scope="col" class="py-3 pl-3 pr-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Transaction Date') }}
                            </th>
                            <th scope="col" class="py-3 pl-3 pr-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Amount') }}
                            </th>
                            <th scope="col"
                                class="py-3 pl-3 pr-3 text-left sm:text-center text-sm font-semibold text-gray-800">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-800">
                                    <x-link :href="route('transaction.show', $transaction)">
                                        {{ $transaction->transaction_name }}
                                    </x-link>
                                </td>
                                <td class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-800">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->timezone($transaction->timezone)->format('d/m/Y H:i A') }}
                                </td>
                                <td class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-800">
                                    {{ Number::currency($transaction->transaction_value, in: 'IDR') }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left sm:text-center text-sm font-medium sm:pr-6">
                                    <x-link :href="route('transaction.edit', $transaction)">
                                        {{ __('Edit') }}
                                    </x-link>
                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td class="text-center px-3 py-4 text-sm text-gray-800" colspan="4">
                                    {{ __('No data.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
