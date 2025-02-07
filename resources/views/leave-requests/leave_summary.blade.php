<!DOCTYPE html>
<html>

<head>
    <title>Leave Summary Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background: #f4f4f4;
        }
    </style>
</head>

<body>
    <h1>Leave Summary Report</h1>
    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Number</th>
                <th>Mobile Number</th>
                <th>Total Leave Requests</th>
                <th>Last Leave Request Date</th>
                <th>Type of Last Leave</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveSummaries as $summary)
                <tr>
                    <td>{{ $summary['employee_name'] }}</td>
                    <td>{{ $summary['employee_number'] }}</td>
                    <td>{{ $summary['mobile_number'] }}</td>
                    <td>{{ $summary['total_leave_requests'] }}</td>
                    <td>{{ $summary['last_leave_date'] }}</td>
                    <td>{{ $summary['last_leave_type'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
