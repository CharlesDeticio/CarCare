<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Details - Carcare</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f0f4f8;
      color: #333;
      margin: 0;
    }
    .container {
      max-width: 900px;
      margin: 100px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    .order-header {
      background: #4361ee;
      color: #fff;
      padding: 25px 30px;
      font-size: 1.6rem;
      font-weight: 600;
      position: relative;
    }
    .order-header .back-link {
      position: absolute;
      top: 50%;
      right: 30px;
      transform: translateY(-50%);
      background-color: #ffffff;
      color: #252323;
      padding: 8px 15px;
      border-radius: 6px;
      font-size: 0.9rem;
      text-decoration: none;
      font-weight: 500;
    }
    .order-header .back-link:hover {
      background-color: #176be2;
      text-decoration: none;
    }
    .order-status {
      background: #f8f9ff;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #e0e0e0;
    }
    .order-status .status-text {
      font-size: 1rem;
      color: #495057;
    }
    .order-status .status-badge {
      background-color: #4361ee;
      color: #fff;
      padding: 6px 14px;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 600;
      text-transform: capitalize;
    }
    .order-summary, .order-items, .total-summary {
      padding: 25px 30px;
    }
    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
      font-size: 1rem;
    }
    .summary-row .label {
      color: #6c757d;
    }
    .summary-row .value {
      font-weight: 500;
      color: #343a40;
    }
    .cancellation-reason {
      background: #ffe5e5;
      color: #d32f2f;
      padding: 15px;
      border-radius: 8px;
      font-weight: 500;
    }
    .order-item {
      display: flex;
      align-items: center;
      padding: 15px 0;
      border-bottom: 1px solid #e0e0e0;
    }
    .order-item img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 6px;
      margin-right: 20px;
      border: 1px solid #ddd;
    }
    .item-details .name {
      font-weight: 600;
      color: #343a40;
      margin-bottom: 5px;
    }
    .item-details .shop {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 4px;
    }
    .item-details .price-info {
      font-size: 0.9rem;
      color: #6c757d;
    }
    .item-price {
      font-weight: 600;
      color: #4361ee;
      min-width: 100px;
      text-align: right;
    }
    .total-summary {
      text-align: right;
      border-top: 1px solid #e9ecef;
    }
    .total-summary .label {
      font-size: 1.1rem;
      color: #6c757d;
      margin-right: 10px;
    }
    .total-summary .value {
      font-size: 1.5rem;
      color: #4361ee;
      font-weight: 700;
    }
    .btn-primary {
      border-radius: 8px;
      font-weight: 600;
      /*padding: 12px 20px;*/
      /*margin: 20px 20px;*/
      margin-top: 10px;
      margin-bottom: 25px;
      
    }
    .modal-header {
      background-color: #4361ee;
      color: #fff;
    }
    .star-rating {
      display: flex;
      justify-content: center;
      gap: 10px;
      font-size: 2rem;
      color: #ccc;
      cursor: pointer;
    }
    .star-rating .fa-star.selected {
      color: #facc15;
    }
    footer {
      text-align: center;
      font-size: 13px;
      color: #94a3b8;
      margin-top: 40px;
    }
    .ref-number {
      background: #f8f9fa;
      padding: 8px 15px;
      border-radius: 4px;
      font-weight: 600;
      text-align: center;
      margin: 15px 30px;
      border: 1px dashed #4361ee;
      color: #4361ee;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="order-header">
    Order Details
    <a href="{{ route('user.pending') }}" class="back-link"><i class="fas fa-arrow-left mr-1"></i></a>
  </div>
  @if(session('success'))<div class="alert alert-success text-center">{{ session('success') }}</div>@endif
  @if(session('error'))<div class="alert alert-danger text-center">{{ session('error') }}</div>@endif
  
  <!-- Alphanumeric Reference Number -->
  <div class="ref-number">
    Order ID: {{ strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3)) }}{{ date('Ymd', strtotime($order->created_at)) }}{{ substr(md5($order->id), 0, 6) }}
  </div>

  <div class="order-status">
    <div class="status-text">
      @switch($order->status)
        @case('pending') Your order is pending approval. @break
        @case('accepted') Your order has been accepted. @break
        @case('claim') Your order is ready for claiming. @break
        @case('completed') Your order has been completed. @break
        @case('denied') Order Canceled. @break
        @case('did_not_claim') Customer did not claim today. @break
        @case('canceled') You canceled this order. @break
        @default Status unknown.
      @endswitch
    </div>
    <div class="status-badge">{{ ucfirst($order->status) }}</div>
  </div>

  <div class="order-summary">
    <div class="summary-row">
      <span class="label">Order Date:</span>
      <span class="value">{{ $order->created_at->format('M d, Y h:i A') }}</span>
    </div>
    <div class="summary-row">
      <span class="label">Payment Method:</span>
    <span class="value">{{ ucfirst($order->payment_method ?? 'Cash') }}</span>
    </div>
    @if($order->status === 'claim' && $order->mechanic)
    <div class="summary-row">
      <span class="label">Mechanic's Address:</span>
      <span class="value">{{ $order->mechanic->Address }}</span>
    </div>
    @endif
    @if($order->status === 'denied' && $order->cancellation_reason)
    <div class="cancellation-reason">
      Cancellation Reason: {{ $order->cancellation_reason }}
    </div>
    @endif
  </div>

  <div class="order-items">
    @foreach($order->items as $item)
      <div class="order-item">
        <img src="{{ $item->product->image ? asset('upload/' . $item->product->image) : 'https://via.placeholder.com/80' }}" alt="{{ $item->product->ProductName }}">
        <div class="item-details">
          <div class="name">{{ $item->product->ProductName }}</div>
          <div class="shop"><i class="fas fa-store mr-1"></i>{{ $item->product->mechanic->shopname ?? 'Unknown Shop' }}</div>
          <div class="price-info">Qty: {{ $item->quantity }} × ₱{{ $item->price }}</div>
        </div>
        <div class="item-price">₱{{ number_format($item->quantity * $item->price, 2) }}</div>
      </div>
    @endforeach
  </div>

  <div class="total-summary">
    <span class="label">Total Amount:</span>
    <span class="value">₱{{ number_format($order->total_amount, 2) }}</span>
  </div>
  @if($order->status === 'completed')
    <a href="{{ route('user.orders.receipt', $order->id) }}" class="btn btn-primary">
        <i class="fas fa-receipt"></i> Download Receipt
    </a>
@endif

  @if($order->status === 'completed' && !$existingRating)
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#rateModal" data-order-id="{{ $order->id }}" data-order-name="{{ $order->items->first()->product->ProductName ?? 'Product' }}">
      <i class="fas fa-star"></i> Rate Order
    </button>
  @endif
</div>

<!-- Rating Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{ route('user.rate') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" id="modalOrderId">
        <div class="modal-header">
          <h5 class="modal-title" id="rateModalLabel">Rate Order</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group text-center mb-4">
            <label class="font-weight-bold d-block mb-2">Your Rating</label>
            <div class="star-rating">
              <input type="hidden" name="rating" id="rating" required>
              <span class="fa fa-star" data-value="1"></span>
              <span class="fa fa-star" data-value="2"></span>
              <span class="fa fa-star" data-value="3"></span>
              <span class="fa fa-star" data-value="4"></span>
              <span class="fa fa-star" data-value="5"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="comment" class="font-weight-bold">Comment (optional)</label>
            <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write your feedback..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Submit Review</button>
          <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $('#rateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var orderId = button.data('order-id');
    var productName = button.data('order-name');
    $('#modalOrderId').val(orderId);
    $('.modal-title').text('Rate ' + productName);
  });
  $(document).ready(function () {
    let selectedRating = 0;
    $('.star-rating .fa-star').on('mouseover', function () {
      highlightStars($(this).data('value'));
    });
    $('.star-rating .fa-star').on('mouseout', function () {
      highlightStars(selectedRating);
    });
    $('.star-rating .fa-star').on('click', function () {
      selectedRating = $(this).data('value');
      $('#rating').val(selectedRating);
      highlightStars(selectedRating);
    });
    function highlightStars(rating) {
      $('.star-rating .fa-star').each(function () {
        if ($(this).data('value') <= rating) {
          $(this).addClass('selected');
        } else {
          $(this).removeClass('selected');
        }
      });
    }
  });
</script>
</body>
</html>