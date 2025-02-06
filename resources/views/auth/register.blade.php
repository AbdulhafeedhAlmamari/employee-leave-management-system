<x-guest-layout>
    <x-slot name="title">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcom to Employee Leave Management System') }}
        </h2>
    </x-slot>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- icon --}}
            <img src="{{ asset('img/logo.png') }}" alt="">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- data in row --}}
            <div class="flex gap-4">
                <div class="flex-1">
                    <x-label for="name" value="{{ __('User Name') }}" />
                    <x-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required
                        autofocus autocomplete="name" />
                </div>

                <div class="flex-1">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="mt-1 w-full" type="email" name="email" :value="old('email')" required
                        autocomplete="username" />
                </div>
            </div>

            {{-- employee name --}}
            <div class="flex gap-4 mt-4">
                <div class="flex-1">
                    <x-label for="employee_name" value="{{ __('Employee Name') }}" />
                    <x-input id="employee_name" class="mt-1 w-full" type="text" name="employee_name"
                        :value="old('employee_name')" required autofocus autocomplete="employee_name" />
                </div>

                {{-- phone number --}}
                <div class="flex-1">
                    <x-label for="mobile_number" value="{{ __('Phone Number') }}" />
                    <x-input id="mobile_number" class="mt-1 w-full" type="text" name="mobile_number"
                        :value="old('mobile_number')" required autofocus autocomplete="mobile_number" />
                </div>
            </div>

            {{-- address --}}
            <div class="mt-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <textarea id="address" class="mt-1 w-full rounded-md" name="address" required autofocus autocomplete="address">{{ old('address') }}</textarea>
            </div>

            <div class="flex gap-4 mt-4">
                <div class="flex-1">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="flex-1">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="mt-1 w-full" type="password" name="password_confirmation"
                        required autocomplete="new-password" />
                </div>
            </div>

            <!-- notes -->
            <div class="mt-4">
                <x-label for="notes" value="{{ __('Notes') }}" />
                <textarea id="notes" class="mt-1 w-full rounded-md" name="notes" autofocus autocomplete="notes">{{ old('notes') }}</textarea>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
