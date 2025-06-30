<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>General Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header-table {
            width: 100%;
            border: none;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
            padding: 5px;
        }
        .logo-cell {
            width: 100px;
        }
        .logo {
            max-width: 80px;
            height: auto;
        }
        .content-cell {
            padding-left: 15px;
        }
        .system-title {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }
        .generated-date {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .report-date {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        h1 {
            color: #2563eb;
            margin-bottom: 5px;
        }
        h2 {
            color: #1f2937;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:first-child {
            background-color: #e9e9e9;
        }
        .badge {
            background-color: #2563eb;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
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
                    <div class="report-title">General Report</div>
                    <div class="generated-date">Generated on: {{ now()->format('F d, Y h:i A') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <h2>Most Borrowed Items</h2>
    @if($topItems->isEmpty())
        <p>No borrowing data available for items.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Item Name</th>
                    <th>Borrow Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topItems as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td><span class="badge">{{ $item->BorrowCount }} times</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Most Active Users</h2>
    @if($topUsers->isEmpty())
        <p>No user activity data available.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Borrowed Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topUsers as $index => $userStat)
                    @if($userStat->user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $userStat->user->name }}</td>
                            <td>{{ $userStat->user->dept ?? 'N/A' }}</td>
                            <td><span class="badge">{{ $userStat->total_entries }}</span></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>This is an automatically generated report from the Borrowing Management System.</p>
    </div>
</body>
</html>