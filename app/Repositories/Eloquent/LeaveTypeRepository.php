<?php

namespace App\Repositories\Eloquent;


use App\Models\LeaveType;
use App\Repositories\Contracts\LeaveTypeRepositoryInterface;

class LeaveTypeRepository implements LeaveTypeRepositoryInterface
{
    protected $leaveType;
    public function __construct(LeaveType $leaveType)
    {
        $this->leaveType = $leaveType;
    }
    public function all()
    {
        return $this->leaveType->all();
    }

    public function create(array $data)
    {
        return $this->leaveType->create($data);
    }

    public function find($id)
    {
        return $this->leaveType->find($id);
    }

    public function update($id, array $data)
    {
        $leaveType = $this->leaveType->find($id);
        $leaveType->update($data);
        return $leaveType;
    }

    public function delete($id)
    {
        $this->leaveType->destroy($id);
    }
}
