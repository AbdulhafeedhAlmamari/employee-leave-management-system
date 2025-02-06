<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-10 overflow-hidden shadow-xl sm:rounded-lg">

            {{-- add leave request --}}
            <div class="w-full text-right mb-10">
                <a href="{{ route('leave_requests.create') }}">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                        Add Leave Request
                    </button>
                </a>
            </div>

            <table id="tableID" class="" style="width:100%">
                <thead>
                    <tr>
                        <th>Employee Number</th>
                        <th>Employee Name</th>
                        <th>Mobile Number</th>
                        <th>leave type</th>
                        <th>Reason</th>
                        <th>From date</th>
                        <th>To date</th>
                        <th>Notes</th>
                        <th>actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaveRequests as $leaveRequest)
                        <tr>
                            <td>{{ $leaveRequest->employee->employee_number }}</td>
                            <td>{{ $leaveRequest->employee->employee_name }}</td>
                            <td>{{ $leaveRequest->employee->mobile_number }}</td>
                            <td>{{ $leaveRequest->leaveType->name }}</td>
                            <td>{{ $leaveRequest->reason }}</td>
                            <td>{{ $leaveRequest->from_date }}</td>
                            <td>{{ $leaveRequest->to_date }}</td>
                            <td>{{ $leaveRequest->notes }}</td>

                            <td class="flex space-x-4">
                                <form action="{{ route('leave_requests.destroy', $leaveRequest->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                                <a href="{{ route('leave_requests.edit', $leaveRequest->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
