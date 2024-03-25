<div>
    <x-panel class="w-full sm:w-1/2" :href="route('transaction.index')">
        <x-slot:head>
            {{ __('Transaction Form') }}
        </x-slot>
        <x-slot:link>
            {{ __('Back') }}
        </x-slot>

        <form wire:submit="save">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="transaction_name" :value="__('Transaction Name')" />
                    <x-text-input id="transaction_name" class="block mt-1 w-full" type="text"
                        wire:model="form.transaction_name" required autofocus autocomplete="transaction_name"
                        placeholder="{{ __('Transaction name') }}" />
                    @error('transaction_name')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <x-input-label for="transaction_value" :value="__('Transaction Value')" />
                    <x-text-input id="transaction_value" class="block mt-1 w-full" type="number"
                        wire:model="form.transaction_value" required autofocus autocomplete="off"
                        placeholder="{{ __('0') }}" />
                    @error('transaction_value')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <x-input-label for="transaction_date" :value="__('Transaction Date')" />
                    <x-text-input id="transaction_date" class="block mt-1 w-full" type="datetime-local"
                        wire:model="form.transaction_date" required autofocus autocomplete="off" />
                    @error('transaction_date')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                @if ($transaction)
                    <x-text-input type="hidden" wire:model="form.id" />
                @endif

                <div>
                    <x-primary-button>
                        {{ $transaction ? __('Update') : __('Submit') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-panel>
</div>
