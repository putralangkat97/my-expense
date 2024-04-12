<div class="fadeinout">
    <x-panel class="w-full sm:w-3/4 md:w-1/2" :href="route('transaction.index')">
        <form wire:submit="export">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-6" wire:loading.class="opacity-50">
                <div>
                    <x-input-label for="selectedMonth" :value="__('Month')" />
                    <x-select-input wire:model="selectedMonth" class="w-full block mt-1">
                        <option value="">{{ __('Select Month') }}</option>
                        @foreach ($this->months as $month)
                            <option value="{{ $month['value'] }}">{{ $month['name'] }}</option>
                        @endforeach
                    </x-select-input>
                    @error('selectedMonth')
                        <x-input-error :messages="$message" class="mt-1" />
                    @enderror
                </div>
                <div>
                    <x-input-label for="selectedYear" :value="__('Year')" />
                    <x-select-input wire:model="selectedYear" class="w-full block mt-1">
                        <option value="">{{ __('Select Year') }}</option>
                        @foreach ($this->years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </x-select-input>
                    @error('selectedYear')
                        <x-input-error :messages="$message" class="mt-1" />
                    @enderror
                </div>
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>
                    {{ __('Export') }}
                </x-primary-button>
                <x-secondary-button type="button" wire:click="clear">
                    {{ __('Clear') }}
                </x-secondary-button>
            </div>
        </form>
    </x-panel>
</div>
