<x-guest-layout>
    <x-slot name="title">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Leave Request') }}
        </h2>
    </x-slot>

    <livewire:leave-request-form :leaveRequestId="$leaveRequest->id" />

</x-guest-layout>
