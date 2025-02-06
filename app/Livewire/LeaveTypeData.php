<?php

namespace App\Livewire;

use App\Models\LeaveType;
use Livewire\Component;

class LeaveTypeData extends Component
{
    public $leaveTypes;
    public $selectedLeaveType = null;
    public $leaveTypeDetails = null;

    public function mount()
    {
        $this->leaveTypes = LeaveType::all();
    }

    public function updatedSelectedLeaveType($value)
    {
        $this->leaveTypeDetails = LeaveType::find($value);
    }

    public function render()
    {
        return view('livewire.leave-type-data');
    }
}
