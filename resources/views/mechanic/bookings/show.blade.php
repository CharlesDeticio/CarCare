<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Details | Carcare</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #eef2ff;
      --success: #28a745;
      --danger: #e74c3c;
      --warning: #f39c12;
      --info: #17a2b8;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --border-radius: 12px;
      --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light);
      color: var(--dark);
      line-height: 1.6;
    }

    .container {
      max-width: 800px;
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .page-header {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
    }

    .page-header h1 {
      font-weight: 700;
      font-size: 32px;
      color: var(--primary);
      display: inline-flex;
      align-items: center;
      gap: 12px;
    }

    .page-header h1:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--primary);
      border-radius: 2px;
    }

    .card {
      border: none;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      transition: var(--transition);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
      background-color: var(--primary);
      color: white;
      padding: 20px;
      border-bottom: none;
    }

    .card-header h2 {
      font-weight: 600;
      margin: 0;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .card-body {
      padding: 30px;
    }

    .detail-item {
      margin-bottom: 20px;
    }

    .detail-label {
      font-weight: 600;
      color: var(--gray);
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .detail-value {
      font-size: 1.1rem;
      color: var(--dark);
      padding-left: 28px;
    }

    .badge {
      font-size: 0.85rem;
      padding: 0.5em 0.9em;
      border-radius: 50px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .badge-pending {
      background-color: var(--warning);
      color: #1e293b;
    }

    .badge-accepted {
      background-color: var(--success);
      color: white;
    }

    .badge-declined {
      background-color: var(--danger);
      color: white;
    }

    .badge-completed {
      background-color: var(--info);
      color: white;
    }

    .btn {
      border-radius: var(--border-radius);
      padding: 10px 20px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: var(--transition);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn:active {
      transform: translateY(0);
    }

    .btn-outline-secondary {
      color: var(--primary);
      border-color: var(--primary);
    }

    .btn-outline-secondary:hover {
      background-color: var(--primary-light);
    }

    .btn-success {
      background-color: var(--success);
      border: none;
    }

    .btn-danger {
      background-color: var(--danger);
      border: none;
    }

    .btn-primary {
      background-color: var(--info);
      border: none;
    }

    .car-list {
      background-color: #f8f9fa;
      border-radius: var(--border-radius);
      padding: 20px;
      margin-top: 15px;
    }

    .car-item {
      background-color: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      transition: var(--transition);
    }

    .car-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .car-item h6 {
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--primary);
    }

    .no-cars {
      color: var(--gray);
      font-style: italic;
      text-align: center;
      padding: 20px;
    }

    .action-buttons {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      margin-top: 30px;
    }

    /* Reference Number Style */
    .reference-number {
      font-family: 'Courier New', monospace;
      font-weight: bold;
      color: var(--primary);
      letter-spacing: 1px;
      background-color: var(--primary-light);
      padding: 5px 10px;
      border-radius: 4px;
      display: inline-block;
    }

    /* Modal Styles */
    .modal-content {
      border-radius: var(--border-radius);
      border: none;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
      background-color: var(--danger);
      color: white;
      border-top-left-radius: var(--border-radius);
      border-top-right-radius: var(--border-radius);
      border-bottom: none;
      padding: 20px;
    }

    .modal-title {
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .modal-body {
      padding: 25px;
    }

    .modal-footer {
      border-top: 1px solid #f1f5f9;
      padding: 15px 25px;
    }

    /* Animations */
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .pulse {
      animation: pulse 1.5s infinite;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }
      
      .page-header h1 {
        font-size: 24px;
      }
      
      .card-body {
        padding: 20px;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .btn {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="page-header animate__animated animate__fadeIn">
      <h1>
        <i class="bi bi-clipboard2-check"></i>
        Booking Details
      </h1>
    </div>

    <!-- Alerts -->
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Booking Card -->
    <div class="card animate__animated animate__fadeInUp">
      <div class="card-header">
        <h2>
          <i class="bi bi-calendar-event"></i>
          {{ $booking->service->name }}
        </h2>
      </div>
      
      <div class="card-body">
        <!-- Booking Reference -->
        <div class="detail-item">
          <div class="detail-label">
            <i class="bi bi-hash"></i>
            Booking ID
          </div>
          <div class="detail-value">
            @php
              // Generate alphanumeric reference
              $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
              $datePart = $booking->created_at->format('Ymd');
              $randomPart = substr(md5($booking->id), 0, 6);
              $bookingReference = $shopInitials . '-' . $datePart . '-' . $randomPart;
            @endphp
            <span class="reference-number">{{ $bookingReference }}</span>
          </div>
        </div>

        <!-- Booking Details -->
        <div class="detail-item">
          <div class="detail-label">
            <i class="bi bi-person"></i>
            Customer
          </div>
          <div class="detail-value">
            {{ $booking->user->first_name }} {{ $booking->user->last_name }}
          </div>
        </div>
        
        <div class="detail-item">
          <div class="detail-label">
            <i class="bi bi-calendar-date"></i>
            Booking Date
          </div>
          <div class="detail-value">
            {{ $booking->booking_date }} at {{ $booking->booking_time }}
          </div>
        </div>
        
        <div class="detail-item">
          <div class="detail-label">
            <i class="bi bi-chat-square-text"></i>
            Reason
          </div>
          <div class="detail-value">
            {{ $booking->reason ?? 'Not specified' }}
          </div>
        </div>
        
        <div class="detail-item">
          <div class="detail-label">
            <i class="bi bi-info-circle"></i>
            Status
          </div>
          <div class="detail-value">
            <span class="badge 
              @if($booking->status === 'pending') badge-pending pulse
              @elseif($booking->status === 'accepted') badge-accepted
              @elseif($booking->status === 'declined') badge-declined
              @elseif($booking->status === 'completed') badge-completed
              @endif">
              <i class="bi 
                @if($booking->status === 'pending') bi-hourglass-split
                @elseif($booking->status === 'accepted') bi-check-circle
                @elseif($booking->status === 'declined') bi-x-circle
                @elseif($booking->status === 'completed') bi-check2-all
                @endif">
              </i>
              {{ ucfirst($booking->status) }}
            </span>
          </div>
        </div>
        
        <!-- Car Details -->
        <div class="detail-item">
          <div class="detail-label">
            <i class="bi bi-car-front"></i>
            Vehicle Information
          </div>
          <div class="detail-value">
            @if($booking->user->cars->isNotEmpty())
              <div class="car-list">
                @foreach($booking->user->cars as $car)
                  <div class="car-item">
                    <h6>
                      <i class="bi bi-car-front-fill"></i>
                      {{ $car->car_type }}
                    </h6>
                    <div class="row">
                      <div class="col-md-6">
                        <small class="text-muted">Model:</small>
                        <p>{{ $car->car_model }}</p>
                      </div>
                      <!--<div class="col-md-6">-->
                      <!--  <small class="text-muted">Year:</small>-->
                      <!--  <p>{{ $car->car_year ?? 'N/A' }}</p>-->
                      <!--</div>-->
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="no-cars">
                <i class="bi bi-car-front" style="font-size: 2rem;"></i>
                <p>No vehicle information provided</p>
              </div>
            @endif
          </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
          <!--@if($booking->status === 'completed')-->
          <!--  <a href="{{ route('mechanic.bookings.receipt', $booking->id) }}" class="btn btn-primary">-->
          <!--    <i class="bi bi-receipt"></i> Download Receipt-->
          <!--  </a>-->
          <!--@endif-->
          
          <a href="{{ route('mechanic.bookings') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Bookings
          </a>
          
          @if($booking->status === 'pending')
            <form action="{{ route('mechanic.bookings.accept', $booking->id) }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-success" id="acceptBtn">
                <i class="bi bi-check-circle"></i> Accept Booking
              </button>
            </form>
            
            <button type="button" class="btn btn-danger" onclick="openCancelModal({{ $booking->id }})">
              <i class="bi bi-x-circle"></i> Decline Booking
            </button>
          @endif
          
          @if($booking->status === 'accepted')
            <form action="{{ route('mechanic.bookings.complete', $booking->id) }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-primary" id="completeBtn">
                <i class="bi bi-check2-square"></i> Mark as Completed
              </button>
            </form>
            
            <button type="button" class="btn btn-danger" onclick="openCancelModal({{ $booking->id }}, true)">
              <i class="bi bi-person-x"></i> Customer No Show
            </button>
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
              <i class="bi bi-exclamation-triangle"></i>
              Cancel Booking
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <p>Please select a reason for cancellation:</p>
              <select name="reason" id="cancelReason" class="form-select" required>
                <option value="">-- Select Reason --</option>
                @foreach ($cancellationReasons as $reason)
                <option value="{{ $reason }}">{{ $reason }}</option>
                @endforeach
              </select>
            </div>

            <div id="otherReasonContainer" style="display: none;" class="mt-3">
              <label for="other_reason" class="form-label">Specify Other Reason</label>
              <textarea name="other_reason" id="other_reason" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">
              <i class="bi bi-x-circle"></i> Confirm Cancellation
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bi bi-arrow-left"></i> Go Back
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function openCancelModal(bookingId, didNotArrive = false) {
      const cancelForm = document.getElementById('cancelForm');
      const modalTitle = document.querySelector('#cancelModal .modal-title');
      
      if (didNotArrive) {
        cancelForm.action = `/mechanic/bookings/${bookingId}/did-not-arrive`;
        modalTitle.innerHTML = `<i class="bi bi-person-x"></i> Mark as No Show`;
        document.getElementById('cancelReason').value = "Customer No Show";
      } else {
        cancelForm.action = `/mechanic/bookings/${bookingId}/decline`;
        modalTitle.innerHTML = `<i class="bi bi-exclamation-triangle"></i> Decline Booking`;
        document.getElementById('cancelReason').value = "";
      }
      
      // Reset other reason field
      document.getElementById('other_reason').value = "";
      document.getElementById('otherReasonContainer').style.display = 'none';
      
      const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
      cancelModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Handle reason selection
      const reasonSelect = document.getElementById('cancelReason');
      const otherReasonContainer = document.getElementById('otherReasonContainer');
      
      if (reasonSelect) {
        reasonSelect.addEventListener('change', function() {
          otherReasonContainer.style.display = (this.value === 'Other') ? 'block' : 'none';
        });
      }
      
      // Loading states for forms
      const forms = document.querySelectorAll('form');
      forms.forEach(form => {
        form.addEventListener('submit', function() {
          const submitButtons = form.querySelectorAll('button[type="submit"]');
          submitButtons.forEach(btn => {
            btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Processing...`;
            btn.disabled = true;
          });
        });
      });
    });
  </script>
</body>
</html>