<div class="max-w-screen-md mx-auto py-10 sm:px-6 lg:px-8 bg-white mt-10">
    @if (session()->has('message'))
        <div x-data="{ showMessage: true }" x-init="setTimeout(() => showMessage = false, 3000)" x-show="showMessage"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <!-- Employee Name Dropdown -->
        <div class="flex-1 mb-4">
            <x-label for="employeeId" value="{{ __('Employee Name') }}" />
            <select id="employeeId"
                class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                wire:model="employeeId" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ $employee->id == $employeeId ? 'selected' : 'disabled' }}>
                        {{ $employee->employee_name }}
                    </option>
                @endforeach
            </select>
            @error('employeeId')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Leave Type Dropdown -->
        <div class="flex-1 mb-4">
            <x-label for="leaveTypeId" value="{{ __('Leave Type') }}" />
            <select id="leaveTypeId"
                class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                wire:model="leaveTypeId" required>
                <option value="" selected disabled>Select Leave Type</option>
                @foreach ($leaveTypes as $leaveType)
                    <option value="{{ $leaveType->id }}" {{ $leaveType->id == $leaveTypeId ? 'selected' : '' }}>
                        {{ $leaveType->name }}
                    </option>
                @endforeach
            </select>
            @error('leaveTypeId')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Reason -->
        <div class="flex-1 mb-4">
            <x-label for="reason" value="{{ __('Reason') }}" />
            <x-input id="reason" class="mt-1 w-full" type="text" wire:model="reason" required />
            @error('reason')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- From Date and To Date -->
        <div class="flex gap-4 mb-4">
            <div class="flex-1">
                <x-label for="fromDate" value="{{ __('From Date') }}" />
                <x-input id="fromDate" class="mt-1 w-full" type="date" wire:model="fromDate" required />
                @error('fromDate')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-1">
                <x-label for="toDate" value="{{ __('To Date') }}" />
                <x-input id="toDate" class="mt-1 w-full" type="date" wire:model="toDate" required />
                @error('toDate')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Notes -->
        <div class="flex-1 mb-4">
            <x-label for="notes" value="{{ __('Notes') }}" />
            <textarea id="notes"
                class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                wire:model="notes"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <x-button type="submit">
                {{ $isUpdating ? 'Update Leave Request' : 'Submit Leave Request' }}
            </x-button>
        </div>
    </form>
</div>