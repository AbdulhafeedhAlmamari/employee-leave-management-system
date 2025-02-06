<div class="flex-1">
    <x-label for="leave_type" value="{{ __('Leave Type') }}" />
    <select id="leave_type" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        wire:model="selectedLeaveType" required autocomplete="leave_type">
        @foreach ($leaveTypes as $leaveType)
            <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
        @endforeach
    </select>
</div>
