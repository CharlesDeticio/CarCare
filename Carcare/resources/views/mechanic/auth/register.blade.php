<x-guest-layout>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h3 class="text-center mb-3">Mechanic Register Page</h3>
<form action="{{ route('mechanics.store') }}" method="POST" enctype="multipart/form-data">
@csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="ContactNo" :value="__('ContactNo')" />
            <x-text-input id="ContactNo" class="block mt-1 w-full" type="text" name="ContactNo" :value="old('ContactNo')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="Address" :value="__('Address')" />
            <x-text-input id="Address" class="block mt-1 w-full" type="text" name="Address" :value="old('Address')" />
            <x-input-error :messages="$errors->get('Address')" class="mt-2" />
        </div>

        <div class="mt-4">
        <x-input-label for="shopname" :value="__('Shop Name')" />
        <x-text-input id="shopname" class="block mt-1 w-full" type="text" name="shopname" :value="old('shopname')" />
        <x-input-error :messages="$errors->get('shopname')" class="mt-2" />
    </div>

    <!-- Shop Name -->
    <div class="mt-4">
        <x-input-label for="image" :value="__('Shop Image')" />
        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('mechanic.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
