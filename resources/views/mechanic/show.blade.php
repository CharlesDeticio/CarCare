<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Details - Carcare</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #eef2ff;
      --danger: #e74c3c;
      --warning: #f39c12;
      --success: #28a745;
      --info: #17a2b8;
      --dark: #1e293b;
      --light: #f8fafc;
      --gray: #64748b;
      --border-radius: 12px;
      --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light);
      color: var(--dark);
      margin: 0;
      padding: 0;
      line-height: 1.6;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      padding: 0;
    }

    .header {
      background-color: var(--primary);
      color: white;
      padding: 25px 30px;
      position: relative;
    }

    .header h1 {
      font-size: 24px;
      font-weight: 600;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .header .order-id {
      font-weight: 700;
      background: rgba(255,255,255,0.2);
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 16px;
    }

    .order-status-bar {
      display: flex;
      justify-content: space-between;
      padding: 20px 30px;
      background: var(--primary-light);
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 600;
      text-transform: capitalize;
    }

    .status-badge i {
      margin-right: 8px;
      font-size: 16px;
    }

    .badge-warning { background: var(--warning); color: #1e293b; }
    .badge-success { background: var(--success); color: white; }
    .badge-danger { background: var(--danger); color: white; }
    .badge-info { background: var(--info); color: white; }
    .badge-primary { background: var(--primary); color: white; }

    .order-meta {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 25px 30px;
      border-bottom: 1px solid #f1f5f9;
    }

    .meta-item {
      display: flex;
      flex-direction: column;
    }

    .meta-label {
      font-size: 13px;
      color: var(--gray);
      margin-bottom: 5px;
      font-weight: 500;
    }

    .meta-value {
      font-size: 15px;
      font-weight: 500;
      color: var(--dark);
    }

    .meta-value.amount {
      font-size: 18px;
      font-weight: 600;
      color: var(--danger);
    }

    .order-section {
      padding: 25px 30px;
      border-bottom: 1px solid #f1f5f9;
    }

    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    .section-title i {
      margin-right: 10px;
      color: var(--primary);
    }

    .items-table {
      width: 100%;
      border-collapse: collapse;
    }

    .items-table th {
      text-align: left;
      padding: 12px 15px;
      background: #f8fafc;
      font-size: 14px;
      color: var(--gray);
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .items-table td {
      padding: 15px;
      border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }

    .product-cell {
      display: flex;
      align-items: center;
    }

    .product-image {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
      margin-right: 15px;
    }

    .product-name {
      font-weight: 500;
      margin-bottom: 5px;
    }

    .product-sku {
      font-size: 12px;
      color: var(--gray);
    }

    .quantity-cell, .price-cell, .subtotal-cell {
      font-weight: 500;
    }

    .price-cell, .subtotal-cell {
      color: var(--danger);
    }

    .empty-items {
      text-align: center;
      padding: 40px;
      color: var(--gray);
    }

    .empty-items i {
      font-size: 40px;
      margin-bottom: 15px;
      opacity: 0.5;
    }

    .actions {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      padding: 25px 30px;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 12px 24px;
      border-radius: 8px;
      border: none;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: var(--shadow);
      min-width: 180px;
    }

    .btn i {
      margin-right: 8px;
      font-size: 16px;
    }

    .btn-success { 
      background-color: var(--success);
      color: white;
    }
    .btn-success:hover { background-color: #23903c; }

    .btn-danger { 
      background-color: var(--danger);
      color: white;
    }
    .btn-danger:hover { background-color: #c53030; }

    .btn-info { 
      background-color: var(--info);
      color: white;
    }
    .btn-info:hover { background-color: #138496; }

    .btn-primary { 
      background-color: var(--primary);
      color: white;
    }
    .btn-primary:hover { background-color: #3a56d4; }

    .btn-outline {
      background-color: transparent;
      border: 1px solid var(--primary);
      color: var(--primary);
      box-shadow: none;
    }
    .btn-outline:hover {
      background-color: var(--primary-light);
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      color: var(--primary);
      font-weight: 500;
      text-decoration: none;
      margin: 20px 30px;
      transition: var(--transition);
    }

    .back-link i {
      margin-right: 8px;
    }

    .back-link:hover {
      color: #3a56d4;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal.active {
      display: flex;
      opacity: 1;
    }

    .modal-content {
      background-color: #ffffff;
      padding: 30px;
      border-radius: var(--border-radius);
      width: 90%;
      max-width: 500px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      position: relative;
      transform: translateY(20px);
      transition: transform 0.3s ease;
    }

    .modal.active .modal-content {
      transform: translateY(0);
    }

    .close {
      cursor: pointer;
      font-size: 24px;
      color: var(--gray);
      position: absolute;
      top: 15px;
      right: 20px;
      transition: var(--transition);
    }

    .close:hover {
      color: var(--dark);
    }

    .modal-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 20px;
      color: var(--dark);
    }

    .modal-body {
      margin-bottom: 25px;
    }

    .modal-body p {
      margin-bottom: 15px;
      color: var(--gray);
    }

    .modal-body textarea {
      width: 100%;
      height: 120px;
      padding: 12px;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-size: 14px;
      resize: vertical;
      transition: var(--transition);
      font-family: 'Poppins', sans-serif;
    }

    .modal-body textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .container {
        margin: 20px auto;
        border-radius: 0;
      }

      .header {
        padding: 20px;
      }

      .header h1 {
        font-size: 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .order-status-bar {
        flex-direction: column;
        gap: 15px;
        padding: 15px 20px;
      }

      .order-meta {
        grid-template-columns: 1fr;
        padding: 20px;
      }

      .order-section {
        padding: 20px;
      }

      .items-table th {
        display: none;
      }

      .items-table tr {
        display: block;
        margin-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
      }

      .items-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: none;
      }

      .items-table td:before {
        content: attr(data-label);
        font-weight: 500;
        color: var(--gray);
        margin-right: 15px;
        font-size: 13px;
      }

      .product-cell {
        flex-direction: column;
        align-items: flex-start;
      }

      .product-image {
        margin-bottom: 10px;
      }

      .actions {
        flex-direction: column;
        padding: 20px;
      }

      .btn {
        width: 100%;
      }

      .modal-content {
        padding: 20px;
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
      border: 3px solid transparent;
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

  <div class="container">
    <div class="header">
      <h1>
        <span>Order Details</span>
<span class="order-id">
      #{{ strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3)) }}-{{ $order->created_at->format('Ymd') }}-{{ substr(md5($order->id), 0, 6) }}
    </span>      </h1>
    </div>

    <div class="order-status-bar">
      <div>
        <span class="status-badge 
          @if($order->status === 'pending') badge-warning pulse
          @elseif($order->status === 'accepted') badge-success
          @elseif($order->status === 'denied') badge-danger
          @elseif($order->status === 'claim') badge-info
          @elseif($order->status === 'completed') badge-primary
          @endif">
          <i class="fas 
            @if($order->status === 'pending') fa-clock
            @elseif($order->status === 'accepted') fa-check-circle
            @elseif($order->status === 'denied') fa-times-circle
            @elseif($order->status === 'claim') fa-box-open
            @elseif($order->status === 'completed') fa-check-double
            @endif"></i>
          {{ ucfirst($order->status) }}
        </span>
      </div>
      <div style=" font-weight: 500;">
        <i class="far fa-calendar-alt"></i> {{ $order->created_at->format('M d, Y H:i A') }}
      </div>
    </div>

    <div class="order-meta">
      <div class="meta-item">
        <span class="meta-label">Customer</span>
        <span class="meta-value">{{ $order->user->first_name }} {{ $order->user->last_name }}</span>
      </div>
      <div class="meta-item">
        <span class="meta-label">Payment Method</span>
        <span class="meta-value">
          @switch($order->payment_method)
            @case('card') <i class="far fa-credit-card"></i> Credit/Debit Card @break
            @case('paypal') <i class="fab fa-paypal"></i> PayPal @break
            @case('cash') <i class="fas fa-money-bill-wave"></i> Cash on Delivery @break
            @default <i class="fas fa-money-bill"></i> Cash
          @endswitch
        </span>
      </div>
      <div class="meta-item">
        <span class="meta-label">Total Amount</span>
        <span class="meta-value amount">₱{{ number_format($order->total_amount, 2) }}</span>
      </div>
    </div>

    @if($order->status === 'denied' && $order->cancellation_reason)
    <div class="order-section" style="background: #fff8f8; border-left: 4px solid var(--danger);">
      <div class="section-title">
        <i class="fas fa-exclamation-circle"></i>
        <span>Cancellation Details</span>
      </div>
      <p style="color: var(--danger); font-weight: 500;">
        <i class="fas fa-info-circle"></i> {{ $order->cancellation_reason }}
      </p>
    </div>
    @endif

    <div class="order-section">
      <div class="section-title">
        <i class="fas fa-boxes"></i>
        <span>Order Items</span>
      </div>

      @if($filteredItems->isEmpty())
        <div class="empty-items">
          <i class="fas fa-box-open"></i>
          <h4>No Items Assigned</h4>
          <p>There are no items assigned to you in this order.</p>
        </div>
      @else
        <table class="items-table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($filteredItems as $item)
            <tr>
              <td data-label="Product">
                <div class="product-cell">
                  <img src="{{ $item->product->image ? asset('upload/' . $item->product->image) : asset('assets/img/default-product.jpg') }}" 
                       alt="{{ $item->product->ProductName }}" 
                       class="product-image">
                  <div>
                    <div class="product-name">{{ $item->product->ProductName }}</div>
                    <div class="product-sku">SKU: {{ $item->product->id }}</div>
                  </div>
                </div>
              </td>
              <td data-label="Quantity" class="quantity-cell">{{ $item->quantity }}</td>
              <td data-label="Unit Price" class="price-cell">₱{{ number_format($item->price, 2) }}</td>
              <td data-label="Subtotal" class="subtotal-cell">₱{{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

    <div class="actions">
<!--        @if($order->status === 'completed' && $order->items->contains('product.mechanic_id', auth()->guard('mechanic')->id()))-->
<!--    <a href="{{ route('mechanic.orders.receipt', $order) }}" -->
<!--       class="btn btn-primary" -->
<!--       target="_blank">-->
<!--        <i class="fas fa-download"></i> Download Receipt-->
<!--    </a>-->
<!--@endif-->
        
      @if($order->status === 'pending')
        <!-- Mark as To Claim Button -->
<form id="toClaimForm" action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display: inline-block;">
          @csrf
          <input type="hidden" name="status" value="claim">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-check-circle"></i> Mark as Ready for Pickup
          </button>
        </form>

        <!-- Deny Order Button -->
        <button type="button" class="btn btn-danger" onclick="openCancelModal()">
          <i class="fas fa-times-circle"></i> Deny Order
        </button>
      @endif

      @if($order->status === 'claim')
        <!-- Mark as Completed Button -->
        <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display: inline-block;">
          @csrf
          <input type="hidden" name="status" value="completed">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-check-double"></i> Mark as Completed
          </button>
        </form>

        <!-- Did Not Claim Button -->
        <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display: inline-block;">
          @csrf
          <input type="hidden" name="status" value="denied">
          <input type="hidden" name="reason" value="Customer did not show up to claim the order.">
          <button type="submit" class="btn btn-outline">
            <i class="fas fa-user-times"></i> Did Not Claim
          </button>
        </form>
      @endif
    </div>

    <a href="{{ route('mechanic.orders', ['status' => 'pending']) }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to Orders
    </a>
  </div>

  <!-- Cancel Modal -->
  <div id="cancelModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeCancelModal()">&times;</span>
      <h3 class="modal-title">Reason for Cancellation</h3>
      <div class="modal-body">
        <p>Please provide a detailed reason for denying this order:</p>
        <textarea id="cancelReason" placeholder="Example: The requested item is currently out of stock..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="submitCancelForm()">
          <i class="fas fa-paper-plane"></i> Submit
        </button>
        <button type="button" class="btn btn-outline" onclick="closeCancelModal()">
          <i class="fas fa-times"></i> Close
        </button>
      </div>
    </div>
  </div>

  <!-- Inventory Insufficient Modal -->
  <!--<div class="modal" id="inventoryModal">-->
  <!--  <div class="modal-content">-->
  <!--    <span class="close" onclick="closeInventoryModal()">&times;</span>-->
  <!--    <h3 class="modal-title">Inventory Issue</h3>-->
  <!--    <div class="modal-body">-->
  <!--      <p id="inventoryModalMessage"></p>-->
  <!--    </div>-->
  <!--    <div class="modal-footer">-->
  <!--      <button type="button" class="btn btn-info" onclick="closeInventoryModal()">-->
  <!--        <i class="fas fa-check"></i> Understand-->
  <!--      </button>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->

  <!-- REPLACE THE OLD SCRIPT TAG WITH THIS CLEANED-UP VERSION -->
<script>
  // Cancel Order Modal Functions
  const modal = document.getElementById('cancelModal');
  const cancelReasonField = document.getElementById('cancelReason');

  function openCancelModal() {
    modal.classList.add('active');
    cancelReasonField.value = '';
    cancelReasonField.focus();
  }

  function closeCancelModal() {
    modal.classList.remove('active');
  }

  function submitCancelForm() {
    const reason = cancelReasonField.value.trim();
    const submitBtn = document.querySelector('#cancelModal .btn-danger');

    if (!reason) {
      alert('Please provide a reason for cancellation.');
      cancelReasonField.focus();
      return;
    }

    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing';
    submitBtn.disabled = true;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('mechanic.orders.updateStatus', $order) }}";

    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = "{{ csrf_token() }}";

    const statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'status';
    statusInput.value = 'denied';

    const reasonInput = document.createElement('input');
    reasonInput.type = 'hidden';
    reasonInput.name = 'reason';
    reasonInput.value = reason;

    form.appendChild(csrfInput);
    form.appendChild(statusInput);
    form.appendChild(reasonInput);

    document.body.appendChild(form);
    form.submit();
  }

  // Global Event Listeners
  window.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeCancelModal();
    }
  });

  window.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
      closeCancelModal();
    }
  });

  // Disable buttons on form submit
  document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
      form.addEventListener('submit', function(e) {
        const submitButtons = form.querySelectorAll('button[type="submit"]');
        submitButtons.forEach(btn => {
          btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing';
          btn.disabled = true;
        });
      });
    });
  });
</script>

</body>
</html>