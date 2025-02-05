<?php

namespace App\Repositories\Eloquent;

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
        return $this->leaveRequest->with('employee', 'leaveType')->get();
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
}
