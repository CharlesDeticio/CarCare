<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Report PDF</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            color: #333; 
            line-height: 1.5;
        }
        h2 { 
            margin-bottom: 10px; 
            color: #4F46E5;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f0f0f0; 
        }
        .header { 
            margin-bottom: 20px;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #888;
            text-align: center;
        }
        .logo {
            width: 150px;
            margin-bottom: 15px;
        }
        .report-title {
            margin-bottom: 5px;
        }
        .report-date {
            color: #666;
            margin-bottom: 15px;
        }
        .uc-header {
            text-align: center;
            margin-bottom: 15px;
        }
        .uc-logo {
            width: 100px;
            margin-bottom: 5px;
        }
        .uc-name {
            font-size: 14px;
            font-weight: bold;
            color: #002D62;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- UC Header Section -->
    <div class="uc-header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/UC.png'))) }}" class="uc-logo" alt="UC Logo">
        <div class="uc-name">University of Cebu Lapu-Lapu and Mandaue</div>
    </div>

    <div class="header">
        <!-- CarCare Logo -->
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/carcare.png'))) }}" class="logo" alt="CarCare Logo">
        
        <h2 class="report-title">Admin Report Summary</h2>
        <p class="report-date">Generated on: {{ now()->toDayDateTimeString() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Metric</th>
                <th>Total Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Users</td>
                <td>{{ $totalUsers }}</td>
            </tr>
            <tr>
                <td>Total Accepted Mechanics</td>
                <td>{{ $totalMechanics }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ now()->year }} CarCare Reports. All rights reserved.
    </div>

</body>
</html>