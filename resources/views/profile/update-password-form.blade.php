<x-jet-action-section>
<x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="content">
        <form action="{{route('user-password.update')}}" method="post">
            @method('put')
            @csrf
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="current_password" value="{{ __('Current Password') }}" />
                <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" name="current_password" required/>
                <x-jet-input-error for="current_password" class="mt-2" />
            </div>
        
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="password" value="{{ __('New Password') }}" />
                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" required name="password"/>
                <x-jet-input-error for="password" class="mt-2" />
            </div>
        
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" name="password_confirmation" required />
                <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-button>
                    {{ __('Sauvegarder') }}
                </x-jet-button>
            </div>
        </form>
        
    </x-slot>
</x-jet-action-section>