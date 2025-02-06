<div class="flex-1">
    <x-label for="employee_name" value="{{ __('Employee Name') }}" />
    <select id="employee_name" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        wire:model="selectedEmployee" required autocomplete="employee_name">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
        @endforeach
    </select>
</div>
