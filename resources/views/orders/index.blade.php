{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications - Carcare</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">


  <style>
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
    }

    /* Navigation Tabs */
    .nav-tabs {
      font-size: 14px;
    }

    .nav-tabs .nav-item {
      flex: 1;
      text-align: center;
    }

    .nav-tabs .nav-link {
      padding: 10px;
      border: none;
      color: #333;
      font-weight: 500;
      border-bottom: 3px solid transparent;
      transition: all 0.3s ease-in-out;
    }

    .nav-tabs .nav-link.active {
      border-bottom: 3px solid #070bff;
      font-weight: bold;
      color: #070bff;
    }

    /* Make tabs even smaller on mobile */
    @media (max-width: 576px) {
      .nav-tabs {
        font-size: 12px;
      }
      .nav-tabs .nav-link {
        padding: 4px 8px;
      }
    }

    /* Container */
    .container {
      margin: 20px auto;
      background: #fff;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Orders Grid using CSS Grid */
    .orders-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      justify-items: center;
    }

    /* Order Card Styles */
    .order-card {
      background: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 20px;
      width: 100%;
      max-width: 300px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s, box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .order-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Order Image */
    .order-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    /* Order Details */
    .order-details {
      flex: 1;
    }

    .order-id {
      font-size: 1.1em;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }

    .order-status .badge {
      padding: 6px 10px;
      border-radius: 4px;
      font-size: 0.9em;
      color: #fff;
      display: inline-block;
      margin-bottom: 10px;
    }

    .badge-warning { background: #f39c12; }
    .badge-success { background: #28a745; }
    .badge-danger { background: #dc3545; }
    .badge-info { background: #17a2b8; }
    .badge-primary { background: #007bff; }

    .order-name, .order-amount, .order-quantity {
      font-size: 0.95em;
      color: #555;
      margin-bottom: 8px;
    }

    .order-amount {
      font-weight: bold;
      color: #e74c3c;
    }

    /* Remove default link styling */
    .order-link {
      text-decoration: none;
      color: inherit;
      display: block;
    }
  </style>
</head>
<body>

  <!-- User Sidebar -->
  <x-usersidebar />

  <div class="container" style="margin-top: 100px">
    <h2 class="text-center mt-4 mb-4">My Orders</h2>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs justify-content-left mb-4">
      <li class="nav-item">
        <a class="nav-link active small" href="{{ route('orders.index') }}">All</a>
      </li>
      <li class="nav-item">
        <a class="nav-link small" href="{{ route('cart.index') }}">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link small" href="{{ route('user.pending') }}">To Paid</a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link small" href="{{ route('user.accepted') }}">Accepted</a>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link small" href="{{ route('user.claim') }}">To Claim</a>
      </li>
      <li class="nav-item">
        <a class="nav-link small" href="{{ route('user.completed') }}">Completed</a>
      </li>
      <li class="nav-item">
        <a class="nav-link small" href="{{ route('user.denied') }}">Cancelled</a>
      </li>
    </ul>

    @if($orders->isEmpty())
      <p class="text-center text-muted">You have no orders.</p>
    @else
      <div class="orders-grid">
        @foreach($orders as $order)
          <a href="{{ route('orders.show', $order) }}" class="order-link">
            <div class="order-card">
              @if($order->items->isNotEmpty() && $order->items->first()->product->image)
                <img src="{{ asset('upload/' . $order->items->first()->product->image) }}" alt="Product Image">
              @else
                <img src="{{ asset('assets/img/default-product.jpg') }}" alt="Product Image">
              @endif
              <div class="order-details">
                <div class="order-id">Order #{{ $order->id }}</div>
                <div class="order-status">
                  <span class="badge 
                    @if($order->status === 'pending') badge-warning
                    @elseif($order->status === 'accepted') badge-success
                    @elseif($order->status === 'denied') badge-dangers
                    @elseif($order->status === 'claim') badge-info
                    @elseif($order->status === 'completed') badge-primary
                    @endif">
                    {{ ucfirst($order->status) }}
                  </span>
                </div>
                <div class="order-name">Name: {{ $order->user->last_name }}</div>
                <div class="order-amount">Total: ₱{{ number_format($order->total_amount, 2) }}</div>
                <div class="order-quantity">Quantity: {{ $order->items->sum('quantity') }}</div>
                <div class="order-status-msg">{{ ucfirst($order->status_msg) }}</div> --}} 
                
                <!-- Debugging: Check if mechanic exists -->
                {{-- @if($order->mechanic)
                  <p>Mechanic Found: {{ $order->mechanic->Address }}</p>
                  <p>Mechanic Address: {{ $order->mechanic->Address }}</p>
                @else
                  <p>No Mechanic Found for This Order</p>
                @endif --}}
              
                <!-- Display Mechanic's Address if Status is "claim" -->
                {{-- @if($order->status === 'claim' && $order->mechanic)
                  <div class="mechanic-address" style="margin-top: 10px;">
                    <span class="label">Mechanic's Address:</span>
                    <span class="value">{{ $order->mechanic->Address }}</span>
                  </div>
                @endif
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

</body>
</html> --}}