<?php

namespace App\Services;

use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeService
{
    protected $employeeRepo;

    public function __construct(EmployeeRepositoryInterface $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepo->create($data);
    }

    public function updateEmployee($id, array $data)
    {
        $employee = $this->employeeRepo->find($id);
        if (!$employee) {
            throw new \Exception('Employee not found.');
        }

        return $this->employeeRepo->update($id, $data);
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeRepo->find($id);
        if (!$employee) {
            throw new \Exception('Employee not found.');
        }

        return $this->employeeRepo->delete($id);
    }

    public function getEmployeeById($id)
    {
        $employee = $this->employeeRepo->find($id);
        if (!$employee) {
            throw new \Exception('Employee not found.');
        }
        return $this->employeeRepo->find($id);
    }

    public function getAllEmployees()
    {
        return $this->employeeRepo->all();
    }
}
