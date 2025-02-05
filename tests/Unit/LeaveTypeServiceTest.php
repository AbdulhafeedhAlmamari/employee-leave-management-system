<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\LeaveType;
use App\Repositories\Contracts\LeaveTypeRepositoryInterface;
use App\Repositories\Eloquent\LeaveTypeRepository;
use App\Services\LeaveTypeService;

class LeaveTypeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $leaveTypeService;

    protected function setUp(): void
    {
        parent::setUp();

        $leaveTypeRepository = new LeaveTypeRepository(new LeaveType());
        $this->leaveTypeService = new LeaveTypeService($leaveTypeRepository);
    }

    public function testCreateType()
    {
        $data = LeaveType::factory()->create();

        $this->assertEquals($data->name, LeaveType::first()->name);
    }

    public function testUpdateType()
    {
        $type = LeaveType::factory()->create();

        $data = [
            'name' => 'Updated Name',
        ];

        $result = $this->leaveTypeService->updateLeaveType($type->id, $data);

        $this->assertEquals($data['name'], $result->name);
    }

    public function testGetTypeById()
    {
        $type = LeaveType::factory()->create();

        $result = $this->leaveTypeService->getLeaveTypeById($type->id);

        $this->assertEquals($type->id, $result->id);
    }

    public function testDeleteType()
    {
        $type = LeaveType::factory()->create();

        $this->leaveTypeService->deleteLeaveType($type->id);

        $this->assertNull(LeaveType::find($type->id));
    }
}
