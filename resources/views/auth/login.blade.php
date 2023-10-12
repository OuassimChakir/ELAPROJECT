<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mt-4">
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" value=""
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" value=""
                    required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Mot de Passe Oublié?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Se Connecter') }}
                </x-jet-button>
            </div>
        </form>
        <div class="flex items-center justify mt-4">
            <x-jet-button id="admin" class="ml-1">
                {{ __('Admin') }}
            </x-jet-button>
            <x-jet-button id="staff" class="ml-4">
                {{ __('Staff') }}
            </x-jet-button>
            <x-jet-button id="student" class="ml-4">
                {{ __('Student') }}
            </x-jet-button>
            <x-jet-button id="teacher" class="ml-4">
                {{ __('Teacher') }}
            </x-jet-button>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#admin').click(function() {
            var username = "admin";
            var password = "t9a3TkTI";
            $('#username').val(username);
            $('#password').val(password);
        });

        $('#staff').click(function() {
            var username = "CA-S1";
            var password = "1FXN8uUK";
            $('#username').val(username);
            $('#password').val(password);
        });

        $('#student').click(function() {
            var username = "CA1-2023";
            var password = "GKRWqpsw";
            $('#username').val(username);
            $('#password').val(password);
        });

        $('#teacher').click(function() {
            var username = "CA-P1";
            var password = "vKQiu9EA";
            $('#username').val(username);
            $('#password').val(password);
        });
    });
</script>
<style>
    #admin {
        background-color: #ff5733;
        color: #fff;
        border: none;
    }

    #staff {
        background-color: #33dbff;
        color: #fff;
        border: none;
    }

    #student {
        background-color: #ff3375;
        color: #fff;
        border: none;
    }

    #teacher {
        background-color: #ffbd33;
        color: #fff;
        border: none;
    }

    #admin:hover,
    #staff:hover,
    #student:hover,
    #teacher:hover {
        background-color: #c2bbae;
        color: black;
    }
</style>
