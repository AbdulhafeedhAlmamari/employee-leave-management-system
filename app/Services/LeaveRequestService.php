<?php

namespace App\Services;

use App\Repositories\Contracts\LeaveRequestRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Contracts\LeaveTypeRepositoryInterface;


class LeaveRequestService
{
    protected $leaveRequestRepo;
    protected $employeeRepo;
    protected $leaveTypeRepo;

    public function __construct(
        LeaveRequestRepositoryInterface $leaveRequestRepo,
        EmployeeRepositoryInterface $employeeRepo,
        LeaveTypeRepositoryInterface $leaveTypeRepo
    ) {
        $this->leaveRequestRepo = $leaveRequestRepo;
        $this->employeeRepo = $employeeRepo;
        $this->leaveTypeRepo = $leaveTypeRepo;
    }

    public function createLeaveRequest(array $data)
    {
        $employee = $this->employeeRepo->find($data['employee_id']);
        if (!$employee) {
            throw new \Exception('Employee not found.');
        }

        $leaveType = $this->leaveTypeRepo->find($data['leave_type_id']);
        if (!$leaveType) {
            throw new \Exception('Leave type not found.');
        }

        $overlap = $this->leaveRequestRepo->all()->where('employee_id', $data['employee_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('from_date', [$data['from_date'], $data['to_date']])
                    ->orWhereBetween('to_date', [$data['from_date'], $data['to_date']]);
            })->count();

        if ($overlap) {
            throw new \Exception('Leave request overlaps with existing requests.');
        }

        return $this->leaveRequestRepo->create($data);
    }

    public function updateLeaveRequest($id, array $data)
    {
        $leaveRequest = $this->leaveRequestRepo->find($id);
        if (!$leaveRequest) {
            throw new \Exception('Leave request not found.');
        }

        $overlap = $this->leaveRequestRepo->all()->where('employee_id', $data['employee_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('from_date', [$data['from_date'], $data['to_date']])
                    ->orWhereBetween('to_date', [$data['from_date'], $data['to_date']]);
            })->count();

        if ($overlap) {
            throw new \Exception('Leave request overlaps with existing requests.');
        }

        return $this->leaveRequestRepo->update($id, $data);
    }

    public function deleteLeaveRequest($id)
    {
        $leaveRequest = $this->leaveRequestRepo->find($id);
        if (!$leaveRequest) {
            throw new \Exception('Leave request not found.');
        }

        return $this->leaveRequestRepo->delete($id);
    }

    public function getLeaveRequestById($id)
    {
        $leaveRequest = $this->leaveRequestRepo->find($id);
        if (!$leaveRequest) {
            throw new \Exception('Leave request not found.');
        }
        return $this->leaveRequestRepo->find($id);
    }

    public function getAllLeaveRequests()
    {
        return $this->leaveRequestRepo->all();
    }
    
}
