<div class="col-span-6 sm:col-span-4">

    {{-- employee info --}}
    <x-form-section submit="UpdateProfile">
        <x-slot name="title">
            {{ __('Employee Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s employee information.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="employee_name" value="{{ __('Employee Name') }}" />
                <x-input id="employee_name" type="text" class="mt-1 block w-full" wire:model="state.employee_name"
                    required autocomplete="employee_name" />
                <x-input-error for="employee_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="mobile_number" value="{{ __('Mobile Number') }}" />
                <x-input id="mobile_number" type="text" class="mt-1 block w-full" wire:model="state.mobile_number"
                    required autocomplete="mobile_number" />
                <x-input-error for="mobile_number" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" type="text" class="mt-1 block w-full" wire:model="state.address" required
                    autocomplete="address" />
                <x-input-error for="address" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="notes" value="{{ __('Notes') }}" />
                <x-input id="notes" type="text" class="mt-1 block w-full" wire:model="state.notes"
                    autocomplete="notes" />
                <x-input-error for="notes" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <button type="button" wire:click="save" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>
        </x-slot>
    </x-form-section>


</div>
