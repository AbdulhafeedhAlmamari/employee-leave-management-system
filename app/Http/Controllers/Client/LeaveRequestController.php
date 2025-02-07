<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\LeaveRequestService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaveRequestController extends Controller
{
    protected $leaveRequestService;

    public function __construct(LeaveRequestService $leaveRequestService)
    {
        $this->leaveRequestService = $leaveRequestService;
    }

    public function index()
    {
        $leaveRequests = $this->leaveRequestService->getAllLeaveRequests();
        return view('home', compact('leaveRequests'));
    }

    public function create()
    {
        return view('leave-requests.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date' => 'required|date|before:to_date',
            'to_date' => 'required|date|after:from_date',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        try {
            $this->leaveRequestService->createLeaveRequest($data);
            return redirect()->route('home')->with('success', 'Leave request submitted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->leaveRequestService->deleteLeaveRequest($id);
            return redirect()->route('home')->with('success', 'Leave request deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $leaveRequest = $this->leaveRequestService->getLeaveRequestById($id);
            return view('leave-requests.edit', compact('leaveRequest'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([]);

        try {
            $this->leaveRequestService->updateLeaveRequest($id, $data);
            return redirect()->route('home')->with('success', 'Leave request updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $leaveRequest = $this->leaveRequestService->getLeaveRequestById($id);
            return view('leave_requests.show', compact('leaveRequest'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function generateLeaveReport()
    {
        try {
            return $this->leaveRequestService->generateLeaveSummaryReport();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error generating report: ' . $e->getMessage());
        }
    }
}
