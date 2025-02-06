<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;

class EmployeeData extends Component
{
    public $employees;
    public $selectedEmployee = null;
    public $employeeDetails = null;

    public function mount()
    {
        $this->employees = Employee::all();
    }

    public function updatedSelectedEmployee($value)
    {
        $this->employeeDetails = Employee::find($value);
    }

    public function render()
    {
        return view('livewire.employee-data');
    }
}
