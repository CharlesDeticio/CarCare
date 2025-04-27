<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookings for Your Services | Carcare</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}" />

    <style>
        :root {
            --primary: #6c63ff;
            --primary-light: #e0deff;
            --success: #28c76f;
            --danger: #ea5455;
            --warning: #ff9f43;
            --info: #00cfe8;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-radius: 10px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .content-wrapper {
            margin-left: 280px;
            flex: 1;
            padding: 40px;
            transition: var(--transition);
            margin-top: 70px;
        }

        @media (max-width: 992px) {
            .content-wrapper {
                margin-left: 0;
                padding: 20px;
            }
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            font-size: 32px;
        }

        .card-container {
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 30px;
            transition: var(--transition);
        }

        .card-container:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        /* Filter Section */
        .filter-section {
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            margin-bottom: 30px;
        }

        .filter-label {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 8px;
            display: block;
        }

        /* Tabs */
        .nav-tabs {
            border-bottom: 2px solid var(--light-gray);
            margin-bottom: 25px;
        }

        .nav-tabs .nav-link {
            color: var(--gray);
            font-weight: 600;
            border: none;
            padding: 12px 20px;
            margin-right: 5px;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            transition: var(--transition);
            position: relative;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary);
            background-color: var(--primary-light);
        }

        .nav-tabs .nav-link.active {
            color: var(--primary);
            background-color: #fff;
            border-bottom: 3px solid var(--primary);
            font-weight: 700;
        }

        .nav-tabs .nav-link .badge {
            margin-left: 6px;
            font-size: 0.7rem;
            padding: 4px 8px;
        }

        /* Table Styles */
        .booking-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .booking-table thead th {
            background-color: var(--primary);
            color: #fff;
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .booking-table thead th:first-child {
            border-top-left-radius: var(--border-radius);
        }

        .booking-table thead th:last-child {
            border-top-right-radius: var(--border-radius);
        }

        .booking-table tbody tr {
            transition: var(--transition);
        }

        .booking-table tbody tr:hover {
            background-color: rgba(108, 99, 255, 0.05);
        }

        .booking-table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--light-gray);
        }

        .booking-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .status-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-pending {
            background-color: var(--warning);
            color: #1e293b;
        }

        .badge-accepted {
            background-color: var(--success);
            color: white;
        }

        .badge-completed {
            background-color: var(--info);
            color: white;
        }

        .badge-declined {
            background-color: var(--danger);
            color: white;
        }

        /* Buttons */
        .btn-action {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 50px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-action i {
            font-size: 14px;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-action:active {
            transform: translateY(0);
        }

        .btn-accept {
            background-color: var(--success);
            border: none;
        }

        .btn-decline {
            background-color: var(--danger);
            border: none;
        }

        .btn-complete {
            background-color: var(--primary);
            border: none;
        }

        .btn-details {
            background-color: var(--info);
            border: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .empty-state i {
            font-size: 50px;
            color: var(--gray);
            opacity: 0.5;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: var(--dark-text);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--gray);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: var(--primary);
            color: white;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
            padding: 15px 20px;
            border: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: 1px solid var(--light-gray);
            padding: 15px 25px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-title {
                font-size: 24px;
            }
            
            .content-wrapper {
                padding: 20px 15px;
            }
            
            .nav-tabs .nav-link {
                padding: 10px 15px;
                font-size: 0.85rem;
            }
            
            .booking-table {
                display: block;
                overflow-x: auto;
            }
        }

        /* Animation for status badge */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .status-badge.pulse {
            animation: pulse 1.5s infinite;
        }

        /* Loading state for buttons */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading:after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }

        @keyframes button-loading-spinner {
            from { transform: rotate(0turn); }
            to { transform: rotate(1turn); }
        }
    </style>
</head>

<body>

    <div class="dashboard-wrapper">

        <!-- Sidebar -->
        <div class="sidebar-wrapper" id="sidebar">
            <x-sidebar />
        </div>

        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="page-header">
                <h1 class="page-title">
                    <i class='bx bx-calendar'></i> Service Bookings
                </h1>
                
                <!-- Success Alert -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 0;">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <form method="GET" action="{{ route('mechanic.bookings') }}" class="row g-3">
                    <input type="hidden" name="tab" id="activeTabInput" value="{{ request('tab', 'pending') }}">
                    
                    <div class="col-md-4">
                        <label for="month" class="filter-label">
                            <i class="fas fa-calendar-alt me-2"></i>Filter by Month
                        </label>
                        <select name="month" id="month" class="form-select">
                            <option value="">All Months</option>
                            @foreach($availableMonths as $num => $label)
                                <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="col-md-4">
                        <label for="day" class="filter-label">
                            <i class="fas fa-calendar-day me-2"></i>Filter by Day
                        </label>
                        <select name="day" id="day" class="form-select">
                            <option value="">All Days</option>
                            @foreach($bookingDays as $day)
                                <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>
                                    {{ $day }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i> Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                        type="button" role="tab" aria-controls="pending" aria-selected="true">
                        <i class="fas fa-clock me-2"></i>Pending
                        @if($pendingBookings->count() > 0)
                            <span class="badge bg-white text-warning">{{ $pendingBookings->count() }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted"
                        type="button" role="tab" aria-controls="accepted" aria-selected="false">
                        <i class="fas fa-check-circle me-2"></i>Accepted
                        @if($acceptedBookings->count() > 0)
                            <span class="badge bg-white text-success">{{ $acceptedBookings->count() }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                        type="button" role="tab" aria-controls="completed" aria-selected="false">
                        <i class="fas fa-check-double me-2"></i>Completed
                        @if($completedBookings->count() > 0)
                            <span class="badge bg-white text-info">{{ $completedBookings->count() }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="declined-tab" data-bs-toggle="tab" data-bs-target="#declined"
                        type="button" role="tab" aria-controls="declined" aria-selected="false">
                        <i class="fas fa-times-circle me-2"></i>Cancelled
                        @if($declinedBookings->count() > 0)
                            <span class="badge bg-white text-danger">{{ $declinedBookings->count() }}</span>
                        @endif
                    </button>
                </li>
            </ul>
        
            <!-- Tab Content -->
            <div class="tab-content" id="bookingTabsContent">
                <!-- Pending -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    @if($pendingBookings->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <h4>No Pending Bookings</h4>
                            <p>You don't have any pending service bookings at the moment.</p>
                        </div>
                    @else
                        @include('mechanic.partials.bookings-table', [
                            'bookings' => $pendingBookings,
                            'status' => 'pending',
                            'showActions' => true
                        ])
                    @endif
                </div>
        
                <!-- Accepted -->
                <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                    @if($acceptedBookings->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-calendar-check"></i>
                            <h4>No Accepted Bookings</h4>
                            <p>You don't have any accepted service bookings at the moment.</p>
                        </div>
                    @else
                        @include('mechanic.partials.bookings-table', [
                            'bookings' => $acceptedBookings,
                            'status' => 'accepted',
                            'showActions' => true
                        ])
                    @endif
                </div>
        
                <!-- Completed -->
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    @if($completedBookings->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-calendar-star"></i>
                            <h4>No Completed Bookings</h4>
                            <p>You haven't completed any service bookings yet.</p>
                        </div>
                    @else
                        @include('mechanic.partials.bookings-table', [
                            'bookings' => $completedBookings,
                            'status' => 'completed',
                            'showActions' => false
                        ])
                    @endif
                </div>
        
                <!-- Declined -->
                <div class="tab-pane fade" id="declined" role="tabpanel" aria-labelledby="declined-tab">
                    @if($declinedBookings->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-calendar-minus"></i>
                            <h4>No Cancelled Bookings</h4>
                            <p>You haven't cancelled any service bookings.</p>
                        </div>
                    @else
                        @include('mechanic.partials.bookings-table', [
                            'bookings' => $declinedBookings,
                            'status' => 'declined',
                            'showActions' => false
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="cancelForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Cancel Booking
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <p class="fw-semibold">Please select a reason for cancellation:</p>
                            <select name="reason" id="cancelReason" class="form-select" required>
                                <option value="">-- Select Reason --</option>
                                @foreach ($cancellationReasons as $reason)
                                <option value="{{ $reason }}">{{ $reason }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="otherReasonContainer" style="display: none;" class="mt-3">
                            <label for="other_reason" class="form-label fw-semibold">
                                <i class="fas fa-edit me-2"></i>Specify Other Reason
                            </label>
                            <textarea name="other_reason" id="other_reason" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-action">
                            <i class="fas fa-ban me-1"></i> Confirm Cancellation
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize tab from URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab') || 'pending';
            
            // Set active tab
            const tabButton = document.querySelector(`#${activeTab}-tab`);
            if (tabButton) {
                new bootstrap.Tab(tabButton).show();
                document.getElementById('activeTabInput').value = activeTab;
            }

            // Filter form submission
            const monthSelect = document.getElementById('month');
            const daySelect = document.getElementById('day');

            if (monthSelect) {
                monthSelect.addEventListener('change', function() {
                    document.getElementById('activeTabInput').value = activeTab;
                    this.form.submit();
                });
            }

            if (daySelect) {
                daySelect.addEventListener('change', function() {
                    document.getElementById('activeTabInput').value = activeTab;
                    this.form.submit();
                });
            }

            // Cancel modal setup
            const reasonSelect = document.getElementById('cancelReason');
            const otherReasonContainer = document.getElementById('otherReasonContainer');

            if (reasonSelect) {
                reasonSelect.addEventListener('change', function() {
                    otherReasonContainer.style.display = (this.value === 'Other') ? 'block' : 'none';
                });
            }

            // Row click handling
            const rows = document.querySelectorAll('.clickable-row');
            rows.forEach(row => {
                row.addEventListener('click', function(e) {
                    const isInsidePreventClick = e.target.closest('.prevent-click');
                    if (isInsidePreventClick) return;

                    const href = this.getAttribute('data-href');
                    if (href) window.location.href = href;
                });
            });

            // Form submission loading states
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitButtons = form.querySelectorAll('button[type="submit"]');
                    submitButtons.forEach(btn => {
                        btn.classList.add('btn-loading');
                        btn.innerHTML = '';
                    });
                });
            });
        });

        function openCancelModal(bookingId, didNotArrive = false) {
            const cancelForm = document.getElementById('cancelForm');
            const modalTitle = document.querySelector('#cancelModal .modal-title');
            
            if (didNotArrive) {
                cancelForm.action = `/mechanic/bookings/${bookingId}/cancel`;
                modalTitle.innerHTML = '<i class="fas fa-user-clock me-2"></i>Mark as Did Not Arrive';
            } else {
                cancelForm.action = `/mechanic/bookings/${bookingId}/decline`;
                modalTitle.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Cancel Booking';
            }

            const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
            cancelModal.show();
        }
    </script>

    <!-- Sidebar Toggle Script -->
    <script src="{{ asset('assets/js/script2.js') }}"></script>
</body>
</html>