<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\Eloquent\LeaveRequestRepository;
use App\Repositories\Eloquent\LeaveTypeRepository;
use App\Services\LeaveRequestService;

class LeaveRequestServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $leaveRequestService;


    protected function setUp(): void
    {
        parent::setUp();

        $leaveRequestRepository = new LeaveRequestRepository(new LeaveRequest());
        $employeeRepository = new EmployeeRepository(new Employee());
        $leaveTypeRepository = new LeaveTypeRepository(new LeaveType());

        $this->leaveRequestService = new LeaveRequestService($leaveRequestRepository, $employeeRepository, $leaveTypeRepository);
    }
    public function testCreateLeaveRequest()
    {
        $employee = Employee::factory()->create();
        $leaveType = LeaveType::factory()->create();

        $data = [
            'employee_id' => $employee->id,
            'leave_type_id' => $leaveType->id,
            'from_date' => '2025-02-10',
            'to_date' => '2025-02-15',
            'reason' => 'Personal',
            'notes' => 'This is a test leave request',
        ];

        $result = $this->leaveRequestService->createLeaveRequest($data);
        $this->assertEquals($leaveType->id, $result->leave_type_id);
    }

    public function testGetLeaveRequestById()
    {
        $leaveRequest = LeaveRequest::factory()->create();

        $result = $this->leaveRequestService->getLeaveRequestById($leaveRequest->id);

        $this->assertEquals($leaveRequest->id, $result->id);
    }

    public function testUpdateLeaveRequest()
    {
        $employee = Employee::factory()->create();
        $leaveType = LeaveType::factory()->create();

        $leaveRequest = LeaveRequest::factory()->create();

        $leaveRequest->reason = 'Updated Reason';

        $result = $this->leaveRequestService->updateLeaveRequest($leaveRequest->id, $leaveRequest->toArray());

        $this->assertEquals($leaveRequest->reason, $result->reason);
    }

    public function testDeleteLeaveRequest()
    {
        $leaveRequest = LeaveRequest::factory()->create();

        $result = $this->leaveRequestService->deleteLeaveRequest($leaveRequest->id);

        $this->assertNull(LeaveRequest::find($leaveRequest->id));
    }
}
