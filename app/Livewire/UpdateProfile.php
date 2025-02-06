<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $state = [
        'employee_name' => '',
        'mobile_number' => '',
        'address' => '',
        'notes' => '',
    ];

    public $employeeId; 

    protected $rules = [
        'state.employee_name' => ['required', 'string'],
        'state.mobile_number' => ['required', 'string'],
        'state.address' => ['required', 'string'],
        'state.notes' => ['nullable', 'string'],
    ];

    public function mount($employeeId)
    {
        $this->employeeId = $employeeId; 

        $employee = Employee::find($employeeId);

        if ($employee) {
            $this->state = [
                'employee_name' => $employee->employee_name,
                'mobile_number' => $employee->mobile_number,
                'address' => $employee->address,
                'notes' => $employee->notes,
            ];
        }
    }

    public function save()
    {
        $this->validate();

        $employee = Employee::find($this->employeeId);

        if ($employee) {
            $employee->update([
                'employee_name' => $this->state['employee_name'],
                'mobile_number' => $this->state['mobile_number'],
                'address' => $this->state['address'],
                'notes' => $this->state['notes'],
            ]);

            $this->dispatch('saved');

            $this->dispatch('refresh-navigation-menu');
        }
    }

    public function render()
    {
        return view('livewire.update-profile');
    }
}
