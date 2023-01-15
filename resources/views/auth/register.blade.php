<x-guest-layout>
    <x-auth-card>
    <p class="mx-28 py-2 bg-gray-500 text-sm text-white text-center font-bold mb-8 rounded">プロフィール登録</p>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}"><!--storeメソッドへ-->
             @method('PUT')
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Profile -->
            <div class="mt-4">
                <x-label for="profile" :value="__('Profile')" />
                <textarea id="profile" class="block mt-1 w-full h-28 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="profile" :value="old('profile')" required autofocus></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('ryojo.home') }}">{{ __('スキップしてTOPへ') }}</a>
                <x-button type="submit" class="ml-4">{{ __('Register') }}</x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
