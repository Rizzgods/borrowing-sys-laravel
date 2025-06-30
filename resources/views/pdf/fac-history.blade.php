<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Faculty Borrowing History</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px;
            padding: 20px;
            color: #333;
        }
        .header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #4B5563;
        }
        .header-table {
            width: 100%;
            border: none;
        }
        .header-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }
        .logo-cell {
            width: 15%;
            text-align: left;
        }
        .content-cell {
            width: 85%;
            text-align: left;
            padding-left: 20px;
        }
        .logo {
            max-width: 80px;
            max-height: 80px;
        }
        .system-title { 
            font-size: 22px; 
            font-weight: bold; 
            margin-bottom: 8px;
            color: #1F2937;
        }
        .report-title {
            font-size: 18px;
            color: #4B5563;
            margin: 8px 0;
        }
        .user-name {
            font-size: 16px;
            margin: 8px 0;
            color: #4B5563;
        }
        .generated-date {
            font-size: 11px;
            color: #6B7280;
            margin-top: 8px;
        }
        table.data-table { 
            width: 100%; 
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        table.data-table, table.data-table th, table.data-table td { 
            border: 1px solid #E5E7EB; 
        }
        table.data-table th { 
            padding: 10px 8px;
            text-align: left;
            background-color: #F3F4F6;
            font-weight: bold;
            color: #374151;
            text-transform: uppercase;
            font-size: 11px;
        }
        table.data-table td { 
            padding: 10px 8px;
            text-align: left;
            vertical-align: top;
        }
        tbody tr:nth-child(odd) {
            background-color: #F9FAFB;
        }
        .status-returned {
            color: #047857;
            font-weight: bold;
        }
        .status-borrowed {
            color: #0369A1;
            font-weight: bold;
        }
        .status-overdue {
            color: #DC2626;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('storage/images/user/logo.png') }}" alt="Logo" class="logo">
                </td>
                <td class="content-cell">
                    <div class="system-title">PLV BORROWING SYSTEM</div>
                    <div class="report-title">Faculty Borrowing History Report</div>
                    <div class="user-name">Faculty: {{ $faculty->faculty_name }}</div>
                    <div class="user-name">Department: {{ $faculty->dept }}</div>
                    <div class="generated-date">Generated on: {{ now()->format('F d, Y h:i A') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Borrowed By</th>
                <th>Borrowed At</th>
                <th>Return Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($history as $record)
            <tr>
                <td>{{ $record->item->name ?? 'N/A' }}</td>
                <td>{{ $record->user->name ?? 'N/A' }}</td>
                <td>{{ $record->borrowed_at ? date('M d, Y h:i A', strtotime($record->borrowed_at)) : 'N/A' }}</td>
                <td>{{ $record->returnTime ? date('M d, Y h:i A', strtotime($record->returnTime)) : 'N/A' }}</td>
                <td>
                    @if($record->is_returned)
                        <span class="status-returned">Returned</span>
                    @elseif($record->is_borrowed && now() > $record->returnTime)
                        <span class="status-overdue">Overdue</span>
                    @elseif($record->is_borrowed)
                        <span class="status-borrowed">Borrowed</span>
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">No borrowing history found for this faculty.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        PLV Borrowing System &copy; {{ date('Y') }} - All Rights Reserved
    </div>
</body>
</html>