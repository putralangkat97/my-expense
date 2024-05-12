<x-app-layout>
    <div class="mx-auto space-y-6">
        <x-panel class="fadeinout">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-panel>

        <x-panel class="fadeinout">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-panel>

        <x-panel class="fadeinout">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </x-panel>
    </div>
</x-app-layout>
