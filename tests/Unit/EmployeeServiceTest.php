<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Employee;
use App\Models\User;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Services\EmployeeService;

class EmployeeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $employeeService;

    protected function setUp(): void
    {
        parent::setUp();

        $employeeRepository = new EmployeeRepository(new Employee());
        $this->employeeService = new EmployeeService($employeeRepository);
    }

    public function testCreateEmployee()
    {
        $user = User::factory()->create();

        $data = [
            'employee_name' => 'John Doe',
            'employee_number' => 'EMP1234',
            'mobile_number' => '1234567890',
            'address' => '123 Main St',
            'notes' => 'This is a test employee',
            'user_id' => $user->id
        ];

        $result = $this->employeeService->createEmployee($data);

        $this->assertEquals($user->id, $result->user_id);
    }

    public function testUpdateEmployee()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create(['user_id' => $user->id]);

        $data = [
            'employee_name' => 'John Doe',
        ];

        $result = $this->employeeService->updateEmployee($employee->id, $data);

        $this->assertEquals($data['employee_name'], $result->employee_name);
    }

    public function testGetEmployeeById()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create(['user_id' => $user->id]);

        $result = $this->employeeService->getEmployeeById($employee->id);

        $this->assertEquals($employee->id, $result->id);
    }

    public function testDeleteEmployee()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create(['user_id' => $user->id]);

        $this->employeeService->deleteEmployee($employee->id);

        $this->assertNull(Employee::find($employee->id));
    }
}
