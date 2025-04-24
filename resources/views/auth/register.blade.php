<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="form-register" class="max-w-4xl mx-auto">
        @csrf

        <!-- First and Last Name -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" value="Nombre" />
                <x-text-input id="name" class="block mt-1 w-full placeholder-gray-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="lastName" value="Apellido" />
                <x-text-input id="lastName" class="block mt-1 w-full placeholder-gray-400" type="text" name="lastName" :value="old('lastName')" required autofocus autocomplete="lastName" />
                <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </div>
        </div>

        <!-- Birthdate and Phone -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="birthdate" value="Fecha de Nascimiento" />
                <x-text-input id="birthdate" class="block mt-1 w-full placeholder-gray-400" type="date" name="birthdate" :value="old('birthdate')" required autofocus autocomplete="birthdate" />
                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone" value="Telefono" />
                <x-text-input id="phone" class="block mt-1 w-full placeholder-gray-400" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" placeholder="Ex: +34600111222" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>

        <!-- Address and Billing Address -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="address" value="Direccion de envio" />
                <x-text-input id="address" class="block mt-1 w-full placeholder-gray-400" type="text" name="address" :value="old('address')" required autofocus autocomplete="address"/>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="billing_address" value="Direccion de facturacion" />
                <x-text-input id="billing_address" class="block mt-1 w-full placeholder-gray-400" type="text" name="billing_address" :value="old('billing_address')" required autofocus autocomplete="billing_address"/>
                <x-input-error :messages="$errors->get('billing_address')" class="mt-2" />
                <label for="copiarDireccio" class="inline-flex items-center mt-2">
                    <input id="copiarDireccio" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="copiarDireccio">
                    <span class="ms-2 text-sm text-[#D4C2FC]">Usar la misma direccion que la de envio</span>
                </label>
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full placeholder-gray-400" type="email" name="email" :value="old('email')" required autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password and Confirm Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full placeholder-gray-400" type="password" name="password" required autocomplete="new-password"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full placeholder-gray-400" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Barra de fuerza -->
        <div class="mt-4">
            <div class="h-2 w-full bg-gray-200 rounded overflow-hidden">
                <div id="strengthBar" class="h-2 w-0 bg-red-500 transition-all duration-300 ease-in-out"></div>
            </div>
            <p id="strengthText" class="text-sm mt-1 font-medium text-red-500">Fortalesa: debil</p>
        </div>

        <!-- privacy policies and Cookies -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div class="block">
                <label for="privacyPolicies" class="inline-flex items-center">
                    <input id="privacyPolicies" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="privacy">
                    <span class="ms-2 text-sm text-[#D4C2FC]">Acepto las <a href="">Politicas de Privacidad</a></span>
                </label>
            </div>

            <div class="block">
                <label for="cookies" class="inline-flex items-center">
                    <input id="cookies" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="cookies">
                    <span class="ms-2 text-sm text-[#D4C2FC]">Acepto los <a href="">Cookies</a></span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-[#D4C2FC] hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="submit" class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/registerValidate.js') }}" defer></script>
