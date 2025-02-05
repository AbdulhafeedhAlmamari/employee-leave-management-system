<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $employee;
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    public function all()
    {
        return $this->employee->all();
    }

    public function find($id)
    {
        return $this->employee->find($id);
    }

    public function create(array $data)
    {
        return $this->employee->create($data);
    }

    public function update($id, array $data)
    {
        $employee = $this->employee->find($id);
        $employee->update($data);
        return $employee;
    }

    public function delete($id)
    {
        $this->employee->destroy($id);
    }
}
