<x-guest-layout>
    <x-auth-card>
    <p class="mx-28 py-2 bg-gray-500 text-sm text-white text-center font-bold mb-8 rounded">新規登録</p>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register.precheck.store') }}">
            @csrf


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button onClick="history.back();" class="ml-4 items-center px-4 py-2 bg-[#b3a7a1] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#ccc1b8] active:bg-[#ccc1b8] focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">
                    戻る
                </button>

                <x-button class="ml-4">
                    {{ __('preRegister') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
