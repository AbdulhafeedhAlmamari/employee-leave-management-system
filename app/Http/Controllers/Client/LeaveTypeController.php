<?php

namespace App\Http\Controllers;

use App\Services\LeaveTypeService;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    protected $leaveTypeService;

    public function __construct(LeaveTypeService $leaveTypeService)
    {
        $this->leaveTypeService = $leaveTypeService;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:leave_types,name',
        ]);

        try {
            $this->leaveTypeService->createLeaveType($data);
            return redirect()->route('leave_types.index')->with('success', 'Leave type created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
