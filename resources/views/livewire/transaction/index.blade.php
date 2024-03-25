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

    <div class="-my-2 sm:-mx-6 lg:-mx-8 overflow-x-auto">
        <div class="inline-block min-w-full py-2 aling-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded md:rounded-lg">
                <table class="min-w-full divide-y divide-teal-800/10">
                    <thead class="bg-teal-800/10">
                        <tr>
                            <th scope="col" class="py-3 sm:px-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Transaction Name') }}
                            </th>
                            <th scope="col"
                                class="hidden md:table-cell py-3 sm:px-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Amount') }}
                            </th>
                            <th scope="col"
                                class="hidden sm:table-cell py-3 sm:px-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Transaction Date') }}
                            </th>
                            <th scope="col"
                                class="py-3 sm:px-3 text-center text-sm font-semibold text-gray-800">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="whitespace-nowrap text-center sm:px-3 py-4 text-sm text-gray-800">
                                    <x-link :href="route('transaction.show', $transaction)">
                                        {{ $transaction->transaction_name }}
                                    </x-link>
                                    <dl class="lg:hidden font-normal">
                                        <dt class="sr-only md:hidden">{{ __('Transaction Amount') }}</dt>
                                        <dd class="md:hidden text-gray-600">
                                            {{ $transaction->local_currency }}
                                        </dd>
                                        <dt class="sr-only sm:hidden">{{ __('Transaction Date') }}</dt>
                                        <dd class="text-gray-400 sm:text-gray-600 sm:hidden">
                                            {{ $transaction->local_datetime_format }}
                                        </dd>
                                    </dl>
                                </td>
                                <td class="hidden md:table-cell whitespace-nowrap text-center sm:px-3 py-4 text-sm text-gray-800">
                                    {{ $transaction->local_currency }}
                                </td>
                                <td class="hidden sm:table-cell whitespace-nowrap text-center sm:px-3 py-4 text-sm text-gray-800">
                                    {{ $transaction->local_datetime_format }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 sm:px-3 text-center text-sm font-medium sm:pr-6">
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
