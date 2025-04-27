<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop Report History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-hover: #4338CA;
            --secondary-color: #6B7280;
            --secondary-hover: #4B5563;
            --success-color: #10B981;
            --success-hover: #059669;
            --info-color: #3B82F6;
            --info-hover: #2563EB;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #1f2937;
            line-height: 1.6;
        }

        .container {
            margin-top: 40px;
            margin-bottom: 40px;
            max-width: 1200px;
        }

        .main-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .main-card:hover {
            box-shadow: var(--card-hover-shadow);
        }

        h1 {
            font-weight: 600;
            font-size: 28px;
            color: #111827;
            margin-bottom: 0;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 20px;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary-custom {
            background-color: var(--secondary-color);
            color: #fff;
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 20px;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary-custom:hover {
            background-color: var(--secondary-hover);
            transform: translateY(-1px);
        }

        .no-report {
            padding: 40px 20px;
            background-color: #f8fafc;
            text-align: center;
            color: #64748b;
            border-radius: 8px;
            font-size: 16px;
            border: 1px dashed #cbd5e1;
        }

        .no-report i {
            font-size: 24px;
            margin-bottom: 10px;
            color: #94a3b8;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            padding: 15px;
            border: none;
        }

        .table thead th:first-child {
            border-top-left-radius: 10px;
        }

        .table thead th:last-child {
            border-top-right-radius: 10px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        .table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-top: 1px solid #f1f5f9;
        }

        .clickable-row {
            cursor: pointer;
            transition: all 0.2s;
        }

        .clickable-row:hover {
            background-color: #f8fafc;
            transform: translateX(2px);
        }

        .badge {
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .pagination {
            justify-content: center;
            margin-top: 30px;
        }

        .pagination .page-link {
            color: var(--primary-color);
            border-radius: 6px;
            margin: 0 4px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
            min-width: 36px;
            text-align: center;
            transition: all 0.2s;
        }

        .pagination .page-link:hover {
            background-color: #f1f5f9;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8fafc;
            color: #94a3b8;
        }

        .total-sales {
            font-weight: 600;
            color: var(--primary-color);
        }

        .date-cell {
            color: #64748b;
            font-size: 14px;
        }

        .stat-highlight {
            font-weight: 600;
            color: #1e293b;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 22px;
            }
            
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .table {
                font-size: 14px;
            }
            
            .table thead th, 
            .table tbody td {
                padding: 10px 8px;
            }
            
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        @media (max-width: 576px) {
            .table-responsive {
                border: 1px solid #e2e8f0;
                border-radius: 8px;
            }
            
            .table thead {
                display: none;
            }
            
            .table tbody tr {
                display: block;
                margin-bottom: 15px;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }
            
            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
                border-top: 1px solid #f1f5f9;
            }
            
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 500;
                color: #64748b;
                margin-right: 15px;
            }
            
            .table tbody tr:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="main-card">
        <!-- Header -->
        <div class="header-section">
            <div>
                <h1><i class="fas fa-file-alt me-2"></i>Shop Report History</h1>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('mechanic.reports.index') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus-circle"></i> Generate Report
                </a>
            </div>
        </div>

        <!-- Go Back -->
        <div class="mb-4">
            <a href="{{ route('mechanic.overview') }}" class="btn btn-secondary-custom">
                <i class="fas fa-arrow-left me-1"></i> Go Back
            </a>
        </div>

        <!-- Reports -->
        @if($reports->isEmpty())
            <div class="no-report">
                <i class="far fa-file-excel"></i>
                <p>No reports generated yet</p>
                <a href="{{ route('mechanic.reports.index') }}" class="btn btn-primary-custom mt-2">
                    <i class="fas fa-plus-circle"></i> Create Your First Report
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date Generated</th>
                            <th>Completed Bookings</th>
                            <th>Completed Orders</th>
                            <th>Remaining Inventory</th>
                            <th>Total Services</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $index => $report)
                        <tr class="clickable-row" data-href="{{ route('mechanic.reports.view', $report->id) }}">
                            <td class="date-cell" data-label="Date Generated">
                                <i class="far fa-calendar-alt me-2"></i>{{ $report->created_at->format('M d, Y - h:i A') }}
                            </td>
                            <td data-label="Completed Bookings">
                                <span class="stat-highlight">{{ $report->total_users_booked }}</span>
                            </td>
                            <td data-label="Completed Orders">
                                <span class="stat-highlight">{{ $report->total_orders }}</span>
                            </td>
                            <td data-label="Remaining Inventory">
                                <span class="stat-highlight">{{ $report->remaining_inventory }}</span>
                            </td>
                            <td data-label="Total Services">
                                <span class="stat-highlight">{{ $report->total_services }}</span>
                            </td>
                            <td data-label="Total Sales">
                                <span class="total-sales">₱{{ number_format($report->total_revenue, 2) }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($reports->hasPages())
                <div class="mt-4">
                    {{ $reports->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make rows clickable
        const rows = document.querySelectorAll('.clickable-row');
        rows.forEach(row => {
            row.addEventListener('click', function() {
                window.location.href = this.dataset.href;
            });
            
            // Add keyboard accessibility
            row.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    window.location.href = this.dataset.href;
                }
            });
            
            row.setAttribute('tabindex', '0');
        });

        // Responsive table adjustments
        function setupResponsiveTable() {
            const cells = document.querySelectorAll('td');
            const headers = document.querySelectorAll('th');
            
            if (window.innerWidth < 576) {
                headers.forEach((header, index) => {
                    const label = header.textContent;
                    document.querySelectorAll('td:nth-child(' + (index + 1) + ')').forEach(cell => {
                        cell.setAttribute('data-label', label);
                    });
                });
            }
        }
        
        // Run on load and resize
        setupResponsiveTable();
        window.addEventListener('resize', setupResponsiveTable);
    });
</script>

</body>
</html>