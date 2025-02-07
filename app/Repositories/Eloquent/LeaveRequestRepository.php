<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Repositories\Contracts\LeaveRequestRepositoryInterface;

class LeaveRequestRepository implements LeaveRequestRepositoryInterface
{
    protected $leaveRequest;
    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function all()
    {
        return $this->leaveRequest
            ->with(['employee', 'leaveType'])
            ->whereHas('employee', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        return $this->leaveRequest->create($data);
    }

    public function find($id)
    {
        return $this->leaveRequest->find($id);
    }

    public function update($id, array $data)
    {
        $leaveRequest = $this->leaveRequest->find($id);
        $leaveRequest->update($data);
        return $leaveRequest;
    }

    public function delete($id)
    {
        $this->leaveRequest->destroy($id);
    }



    public function getLeaveSummaryReport()
    {
        return $this->leaveRequest
            ->with(['employee', 'leaveType'])
            ->whereHas('employee', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->get()->take(1)
            ->map(function ($leaveRequest) {
                return [
                    'employee_name' => $leaveRequest->employee->employee_name,
                    'employee_number' => $leaveRequest->employee->employee_number,
                    'mobile_number' => $leaveRequest->employee->mobile_number,
                    'total_leave_requests' => $leaveRequest->employee->leaveRequests->count(),
                    'last_leave_date' => $leaveRequest->updated_at->format('Y-m-d'),
                    'last_leave_type' => $leaveRequest->leaveType->name,
                ];
            });
    }
}


// return Employee::with(['leaveRequests' => function ($query) {
//     $query->orderBy('updated_at', 'desc');
// }])
//     ->get()
//     ->map(function ($employee) {
//         $lastLeave = $employee->leaveRequests->first();
//         return [
//             'employee_name' => $employee->employee_name,
//             'employee_number' => $employee->employee_number,
//             'mobile_number' => $employee->mobile_number,
//             'total_leave_requests' => $employee->leaveRequests->count(),
//             'last_leave_date' => $lastLeave ? $lastLeave->updated_at->format('Y-m-d') : 'N/A',
//             'last_leave_type' => $lastLeave ? $lastLeave->leaveType->name : 'N/A',
//         ];
//     });