<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mechanic Dashboard - Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #eef2ff;
      --danger: #e74c3c;
      --warning: #f39c12;
      --success: #28a745;
      --info: #17a2b8;
      --dark: #343a40;
      --light: #f8f9fa;
      --border-radius: 12px;
      --box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f8fafc;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .dashboard-wrapper {
      display: flex;
      min-height: 100vh;
    }

    .sidebar-wrapper {
      width: 280px;
      background-color: #fff;
      transition: width 0.3s ease;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
      position: fixed;
      height: 100%;
      z-index: 100;
    }

    .content-wrapper {
      flex: 1;
      margin-left: 280px;
      padding: 30px;
      transition: margin-left 0.3s ease;
      margin-top: 70px;
    }

    @media (max-width: 992px) {
      .sidebar-wrapper {
        left: -100%;
        position: fixed;
        z-index: 1000;
        transition: all 0.3s ease;
      }

      .sidebar-wrapper.active { left: 0; }

      .content-wrapper {
        margin-left: 0;
        padding: 20px;
      }
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      max-width: 1400px;
      margin: 0 auto;
    }

    .page-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .page-header h1 {
      color: var(--dark);
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 12px;
      position: relative;
      display: inline-block;
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

    .page-header p {
      color: #6c757d;
      font-size: 16px;
      max-width: 600px;
      margin: 0 auto;
    }

    .filter-buttons {
      display: flex;
      justify-content: center;
      gap: 12px;
      flex-wrap: wrap;
      margin-bottom: 35px;
    }

    .filter-buttons a {
      padding: 10px 24px;
      border-radius: 30px;
      background-color: var(--primary-light);
      color: var(--primary);
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: var(--transition);
      border: 1px solid transparent;
      display: inline-flex;
      align-items: center;
    }

    .filter-buttons a i {
      margin-right: 8px;
      font-size: 15px;
    }

    .filter-buttons a:hover,
    .filter-buttons a.active {
      background-color: var(--primary);
      color: #fff;
      box-shadow: 0 8px 15px rgba(67, 97, 238, 0.3);
      transform: translateY(-2px);
    }

    .orders-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 25px;
    }

    .order-card {
      background: #fff;
      border-radius: var(--border-radius);
      overflow: hidden;
      transition: var(--transition);
      border: 1px solid rgba(0, 0, 0, 0.05);
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);
      position: relative;
      text-decoration: none;
      color: inherit;
      display: block;
    }

    .order-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      border-color: rgba(67, 97, 238, 0.2);
    }

    .order-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      z-index: 2;
    }

    .order-badge .badge {
      font-size: 0.75rem;
      font-weight: 700;
      padding: 0.4rem 0.9rem;
      border-radius: 50px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }

    .badge-warning { background: var(--warning); }
    .badge-success { background: var(--success); }
    .badge-danger { background: var(--danger); }
    .badge-info { background: var(--info); }
    .badge-primary { background: var(--primary); }

    .order-image-container {
      height: 200px;
      overflow: hidden;
      position: relative;
    }

    .order-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .order-card:hover .order-image {
      transform: scale(1.08);
    }

    .order-content {
      padding: 1.5rem;
    }

    .order-id {
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 0.75rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .order-date {
      font-size: 0.8rem;
      color: #adb5bd;
      font-weight: 500;
    }

    .customer-name {
      font-size: 1rem;
      color: #495057;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
    }

    .customer-name i {
      margin-right: 10px;
      color: var(--primary);
      font-size: 1.1rem;
    }

    .order-details {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      background: #f8f9fa;
      padding: 12px 15px;
      border-radius: 8px;
    }

    .detail-item {
      text-align: center;
      flex: 1;
    }

    .detail-label {
      font-size: 0.8rem;
      color: #6c757d;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    .detail-value {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark);
    }

    .detail-value.price {
      color: var(--danger);
    }

    .empty-state {
      background: #f8f9fa;
      border-radius: var(--border-radius);
      padding: 4rem;
      text-align: center;
      grid-column: 1 / -1;
      border: 1px dashed #dee2e6;
    }

    .empty-icon {
      font-size: 3.5rem;
      color: #ced4da;
      margin-bottom: 1.5rem;
      opacity: 0.7;
    }

    .empty-state h4 {
      color: #495057;
      margin-bottom: 0.75rem;
      font-size: 1.5rem;
      font-weight: 600;
    }

    .empty-state p {
      color: #6c757d;
      font-size: 1rem;
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }

    .notification-badge {
      display: inline-block;
      min-width: 22px;
      padding: 5px 9px;
      font-size: 12px;
      font-weight: bold;
      color: #fff;
      background-color: var(--danger);
      border-radius: 12px;
      text-align: center;
      vertical-align: middle;
      margin-left: 8px;
      box-shadow: 0 0 10px rgba(231, 76, 60, 0.4);
      transition: transform 0.2s ease;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    .notification-badge.pulse { 
      animation: pulse 1.5s infinite;
    }

    @media (max-width: 768px) {
      .page-header h1 {
        font-size: 1.75rem;
      }
      
      .filter-buttons {
        justify-content: flex-start;
      }
      
      .filter-buttons a {
        padding: 8px 16px;
        font-size: 13px;
      }
      
      .orders-grid {
        grid-template-columns: 1fr;
      }

      .empty-state {
        padding: 2rem;
      }
    }

    /* Remove all underlines from links */
    a, a:hover, a:focus, a:active {
      text-decoration: none !important;
      outline: none !important;
    }

    /* Enhanced focus states for accessibility */
    a:focus-visible, button:focus-visible {
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.5);
      border-radius: 4px;
    }

    /* Smooth scroll behavior */
    html {
      scroll-behavior: smooth;
    }
    /* Style for the Count Bubbles */
  .filter-buttons .count {
    background-color: var(--primary); /* Use primary color for count bubble */
    color: white;
    font-weight: bold;
    font-size: 1rem; /* Increase font size */
    border-radius: 30px; /* Make it oblong with rounded corners */
    padding: 5px 15px; /* Adjust padding to create an oblong shape */
    position: absolute;
    top: -5px; /* Adjust the vertical position */
    right: -5px; /* Adjust the horizontal position */
    transform: translate(25%, -25%);
    display: flex;
    justify-content: center; /* Center text horizontally */
    align-items: center; /* Center text vertically */
    height: 30px; /* Set height to make the count bubble taller */
    min-width: 30px; /* Minimum width */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add shadow to make it pop */
    transition: all 0.3s ease-in-out;
  }

  /* Hover effect for count bubble */
  .filter-buttons a:hover .count,
  .filter-buttons a.active .count {
    background-color: #fff;
    color: var(--primary);
    border: 1px solid var(--primary);
  }

  /* Adjust size for more than 9 items */
  .filter-buttons .count.more-than-9 {
    font-size: 1rem; /* Slightly increase font size */
    padding: 7px 18px; /* Increase padding for larger count */
    height: 35px; /* Make the height bigger */
    min-width: 35px; /* Increase width */
  }
  </style>
</head>

<body>

  <div class="dashboard-wrapper">
    
    <!-- Sidebar -->
    <div class="sidebar-wrapper">
      <x-sidebar />
    </div>

    <!-- Content -->
    <div class="content-wrapper">
      <div class="container">

        <div class="page-header">
          <h1>Order Management</h1>
          <p>Monitor and process all customer orders for your automotive services</p>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
    <a href="{{ route('mechanic.orders') }}" class="{{ request('status') === null ? 'active' : '' }}">
        <i class="fas fa-list"></i> All Orders
        <span class="count">{{ session('pendingCount') + session('claimCount') + session('deniedCount') + session('completedCount') }}</span>
    </a>
    <a href="{{ route('mechanic.orders', ['status' => 'pending']) }}" class="{{ request('status') === 'pending' ? 'active' : '' }}">
        <i class="fas fa-clock"></i> Pending
        <span class="count">{{ session('pendingCount') }}</span>
    </a>
    <a href="{{ route('mechanic.orders', ['status' => 'claim']) }}" class="{{ request('status') === 'claim' ? 'active' : '' }}">
        <i class="fas fa-box-open"></i> Ready for Pickup
        <span class="count">{{ session('claimCount') }}</span>
    </a>
    <a href="{{ route('mechanic.orders', ['status' => 'denied']) }}" class="{{ request('status') === 'denied' ? 'active' : '' }}">
        <i class="fas fa-times-circle"></i> Cancelled
        <span class="count">{{ session('deniedCount') }}</span>
    </a>
    <a href="{{ route('mechanic.orders', ['status' => 'completed']) }}" class="{{ request('status') === 'completed' ? 'active' : '' }}">
        <i class="fas fa-check-circle"></i> Completed
        <span class="count">{{ session('completedCount') }}</span>
    </a>
</div>


        <!-- Orders Grid -->
        @if($orders->isEmpty())
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-box-open"></i>
            </div>
            <h4>No Orders Found</h4>
            <p>When you receive new orders, they will appear here based on your selected filter.</p>
          </div>
        @else
          <div class="orders-grid">
            @foreach($orders as $order)
              @php
                $mechanicId = auth()->guard('mechanic')->id();
                $firstItem = $order->items->where('product.mechanic_id', $mechanicId)->first();
                $productImage = $firstItem && $firstItem->product->image
                  ? asset('upload/' . $firstItem->product->image)
                  : asset('assets/img/default-product.jpg');

                $mechanicTotal = $order->items
                    ->where('product.mechanic_id', $mechanicId)
                    ->sum(function ($item) {
                        return $item->price * $item->quantity;
                    });

                $orderDate = $order->created_at->format('M d, Y');
                
                // Generate alphanumeric reference
                $shopInitials = strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3));
                $datePart = $order->created_at->format('Ymd');
                $randomPart = substr(md5($order->id), 0, 6);
                $orderReference = $shopInitials . '-' . $datePart . '-' . $randomPart;
              @endphp

              <a href="{{ route('mechanic.orders.show', $order) }}" class="order-card">
                <div class="order-badge">
                  <span class="badge 
                    @if($order->status === 'pending') badge-warning
                    @elseif($order->status === 'accepted') badge-success
                    @elseif($order->status === 'denied') badge-danger
                    @elseif($order->status === 'claim') badge-info
                    @elseif($order->status === 'completed') badge-primary
                    @endif">
                    {{ ucfirst($order->status) }}
                  </span>
                </div>

                <div class="order-image-container">
                  <img src="{{ $productImage }}" alt="Product Image" class="order-image">
                </div>

                <div class="order-content">
                  <div class="order-id">
                    <span>{{ $orderReference }}</span>
                    <span class="order-date">{{ $orderDate }}</span>
                  </div>
                  
                  <div class="customer-name">
                    <i class="fas fa-box"></i>
                    {{ $firstItem && $firstItem->product ? $firstItem->product->ProductName : 'Product no longer available' }}
                  </div>
                  
                  <div class="customer-name">
                    <i class="fas fa-user"></i>
                    {{ $order->user->first_name }} {{ $order->user->last_name }}
                  </div>

                  <div class="order-details">
                    <div class="detail-item">
                      <div class="detail-label">Items</div>
                      <div class="detail-value">{{ $firstItem ? $firstItem->quantity : 0 }}</div>
                    </div>
                    
                    <div class="detail-item">
                      <div class="detail-label">Total</div>
                      <div class="detail-value price">₱{{ number_format($mechanicTotal, 2) }}</div>
                    </div>
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        @endif

      </div> <!-- /.container -->
    </div> <!-- /.content-wrapper -->

  </div> <!-- /.dashboard-wrapper -->

  <script src="{{ asset('assets/js/script2.js') }}"></script>

  <script>
    // Add pulse animation to notification badges
    document.addEventListener('DOMContentLoaded', function() {
      const notificationBadges = document.querySelectorAll('.notification-badge');
      notificationBadges.forEach(badge => {
        badge.classList.add('pulse');
      });
    });
  </script>

</body>
</html>