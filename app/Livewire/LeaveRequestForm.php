<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveRequestForm extends Component
{
    public $employees;
    public $leaveTypes;
    public $employeeId; // Selected employee ID
    public $leaveTypeId;
    public $reason;
    public $fromDate;
    public $toDate;
    public $notes;

    public $leaveRequestId; // ID of the leave request being updated (if any)
    public $isUpdating = false; // Flag to determine if the form is in update mode

    protected $rules = [
        'employeeId' => 'required|exists:employees,id',
        'leaveTypeId' => 'required|exists:leave_types,id',
        'reason' => 'required|string|max:255',
        'fromDate' => 'required|date',
        'toDate' => 'required|date|after_or_equal:fromDate',
        'notes' => 'nullable|string',
    ];

    protected $messages = [
        'employeeId.required' => 'Please select an employee.',
        'leaveTypeId.required' => 'Please select a leave type.',
        'reason.required' => 'The reason field is required.',
        'fromDate.required' => 'The from date field is required.',
        'toDate.required' => 'The to date field is required.',
        'toDate.after_or_equal' => 'The to date must be after or equal to the from date.',
    ];

    public function mount($leaveRequestId = null)
    {
        // Fetch all employees and leave types
        $this->employees = Employee::select('id', 'employee_name')->get();
        $this->leaveTypes = LeaveType::select('id', 'name')->get();

        // Set the default employeeId to the logged-in user's employee ID
        if (Auth::check() && Auth::user()->employee) {
            $this->employeeId = Auth::user()->employee->id;
        }

        // If $leaveRequestId is provided, load the leave request for updating
        if ($leaveRequestId) {
            $this->isUpdating = true;
            $this->leaveRequestId = $leaveRequestId;
            $this->loadLeaveRequest($leaveRequestId);
        }
    }

    public function loadLeaveRequest($leaveRequestId)
    {
        $leaveRequest = LeaveRequest::findOrFail($leaveRequestId);

        // Populate form fields with the leave request data
        $this->employeeId = $leaveRequest->employee_id;
        $this->leaveTypeId = $leaveRequest->leave_type_id;
        $this->reason = $leaveRequest->reason;
        $this->fromDate = $leaveRequest->from_date;
        $this->toDate = $leaveRequest->to_date;
        $this->notes = $leaveRequest->notes;
    }

    public function submit()
    {
        $this->validate();

        // Check for overlapping leave requests (only for new requests)
        if (!$this->isUpdating) {
            $overlappingRequest = LeaveRequest::where('employee_id', $this->employeeId)
                ->where(function ($query) {
                    $query->whereBetween('from_date', [$this->fromDate, $this->toDate])
                        ->orWhereBetween('to_date', [$this->fromDate, $this->toDate])
                        ->orWhere(function ($query) {
                            $query->where('from_date', '<=', $this->fromDate)
                                ->where('to_date', '>=', $this->toDate);
                        });
                })
                ->exists();

            if ($overlappingRequest) {
                $this->addError('fromDate', 'The selected dates overlap with an existing leave request.');
                return;
            }
        }

        // Create or update the leave request
        if ($this->isUpdating) {
            $leaveRequest = LeaveRequest::findOrFail($this->leaveRequestId);
            $leaveRequest->update([
                'employee_id' => $this->employeeId,
                'leave_type_id' => $this->leaveTypeId,
                'reason' => $this->reason,
                'from_date' => $this->fromDate,
                'to_date' => $this->toDate,
                'notes' => $this->notes,
            ]);

            session()->flash('message', 'Leave request updated successfully.');
        } else {
            LeaveRequest::create([
                'employee_id' => $this->employeeId,
                'leave_type_id' => $this->leaveTypeId,
                'reason' => $this->reason,
                'from_date' => $this->fromDate,
                'to_date' => $this->toDate,
                'notes' => $this->notes,
            ]);

            session()->flash('message', 'Leave request submitted successfully.');
        }

        // Reset form fields (except employeeId)
        $this->reset(['leaveTypeId', 'reason', 'fromDate', 'toDate', 'notes']);

        // If updating, reset the update flag
        if ($this->isUpdating) {
            $this->isUpdating = false;
            $this->leaveRequestId = null;
        }
    }

    public function render()
    {
        return view('livewire.leave-request-form');
    }
}