<?php

namespace App\Services;

use App\Repositories\Contracts\LeaveTypeRepositoryInterface;
use App\Models\LeaveType;

class LeaveTypeService
{
    protected $leaveTypeRepo;

    public function __construct(LeaveTypeRepositoryInterface $leaveTypeRepo)
    {
        $this->leaveTypeRepo = $leaveTypeRepo;
    }

    public function createLeaveType(array $data)
    {
        return $this->leaveTypeRepo->create($data);
    }

    public function updateLeaveType($id, array $data)
    {
        $leaveType = $this->leaveTypeRepo->find($id);
        if (!$leaveType) {
            throw new \Exception('Leave type not found.');
        }

        return $this->leaveTypeRepo->update($id, $data);
    }

    public function deleteLeaveType($id)
    {
        $leaveType = $this->leaveTypeRepo->find($id);
        if (!$leaveType) {
            throw new \Exception('Leave type not found.');
        }

        return $this->leaveTypeRepo->delete($id);
    }

    public function getLeaveTypeById($id)
    {
        $leaveType = $this->leaveTypeRepo->find($id);
        if (!$leaveType) {
            throw new \Exception('Leave type not found.');
        }
        return $this->leaveTypeRepo->find($id);
    }

    public function getAllLeaveTypes()
    {
        return $this->leaveTypeRepo->all();
    }
}
