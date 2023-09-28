<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informations du Profil') }}
    </x-slot>

    <x-slot name="description">
        {{ __("Mettez à jour les informations de profil et l'adresse électronique de votre compte.") }}
    </x-slot>

    <x-slot name="form">

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" value="{{ Auth::user()->name }}" disabled class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input id="username" type="text" value="{{ Auth::user()->username }}" disabled class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="username" class="mt-2" />
        </div>

        @admin
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="text" value="{{ Auth::user()->email }}" disabled class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        @endadmin
    </x-slot>
</x-jet-form-section>
