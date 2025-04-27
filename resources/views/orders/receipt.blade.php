<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt #{{ $order->id }}</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        @page { margin: 0; }
        body { 
    font-family: 'Courier New', monospace, Arial, sans-serif;
            line-height: 1.3;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }
        .container { 
            max-width: 76mm; 
            margin: 0 auto;
            margin-top: 40px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 1px dashed #000;
        }
        .logo { 
            font-size: 18px; 
            font-weight: bold; 
            margin-bottom: 2px;
            text-transform: uppercase;
        }
        .shop-info {
            font-size: 10px;
            margin-bottom: 5px;
        }
        .receipt-info {
            font-size: 10px;
            margin-bottom: 10px;
        }
        .section-title {
            text-align: center;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .detail-row { 
            display: flex; 
            justify-content: space-between;
            margin-bottom: 3px;
        }
        .detail-label { 
            font-weight: bold; 
        }
        .divider { 
            border-top: 1px dashed #000; 
            margin: 8px 0;
        }
        .divider-thick {
            border-top: 2px solid #000;
            margin: 8px 0;
        }
        .footer { 
            margin-top: 10px; 
            text-align: center; 
            font-size: 9px; 
        }
        .thank-you { 
            text-align: center; 
            margin: 8px 0; 
            font-style: italic;
            font-size: 11px;
        }
        .price-section {
            margin-top: 10px;
        }
        .total-row {
            font-weight: bold;
            font-size: 14px;
            border-top: 2px dashed #000;
            padding-top: 4px;
            margin-top: 4px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .customer-sign {
            margin-top: 15px;
            padding-top: 5px;
            border-top: 1px dashed #000;
        }
        .ref-number {
            font-weight: bold;
            text-align: center;
            margin: 5px 0;
            padding: 3px;
            border: 1px dotted #000;
            letter-spacing: 2px;
        }
        .barcode {
            text-align: center;
            margin: 10px 0;
            font-family: 'Libre Barcode 39', cursive;
            font-size: 36px;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .item-name {
            flex: 2;
        }
        .item-qty {
            flex: 1;
            text-align: center;
        }
        .item-price {
            flex: 1;
            text-align: right;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ $order->items->first()->product->mechanic->shopname ?? 'CAR CARE CENTER' }}</div>
            <div class="shop-info">
                {{ $order->items->first()->product->mechanic->Address ?? '123 Garage Street' }}<br>
                Tel: {{ $order->items->first()->product->mechanic->ContactNo ?? '(123) 456-7890' }}
            </div>
            <div class="receipt-info">
                Receipt #: {{ strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3)) }}{{ date('Ymd', strtotime($order->created_at)) }}{{ substr(md5($order->id), 0, 6) }}<br>
                Date: {{ $date }}
            </div>
        </div>

        <!-- Barcode -->
        <!--<div class="barcode">*{{ $order->id }}{{ date('Ymd', strtotime($order->created_at)) }}*</div>-->

        <div class="section-title">customer information</div>
        
        <div class="detail-row">
            <div>Name:</div>
            <div>{{ $order->user->first_name }} {{ $order->user->last_name }}</div>
        </div>
        <div class="detail-row">
            <div>Contact:</div>
            <div>{{ $order->user->phone_number }}</div>
        </div>

        <div class="divider"></div>
        <div class="section-title">order items</div>
        
        @foreach($order->items as $item)
        <div class="item-row">
            <div class="item-name">{{ $item->product->ProductName }}</div>
            <div class="item-qty">{{ $item->quantity }} ×</div>
            <div class="item-price">PHP{{ number_format($item->price, 2) }}</div>
        </div>
        @endforeach

        <div class="divider"></div>
        <div class="section-title">payment details</div>
        
        <div class="price-section">
            <div class="detail-row">
                <div>TOTAL:</div>
                <div>PHP{{ number_format($order->total_amount, 2) }}</div>
            </div>
            <!--<div class="detail-row">-->
            <!--    <div>Tax (12%):</div>-->
            <!--    <div>₱{{ number_format($order->total_amount * 0.12, 2) }}</div>-->
            <!--</div>-->
            <!--<div class="detail-row total-row">-->
            <!--    <div>TOTAL:</div>-->
            <!--    <div>₱{{ number_format($order->total_amount * 1.12, 2) }}</div>-->
            <!--</div>-->
        </div>

        <div class="divider-thick"></div>
        <div class="thank-you">
            Thank you for your purchase!
        </div>

        <!--<div class="customer-sign">-->
            <!--<div>Customer Signature: _________________</div>-->
        <!--    <div style="margin-top: 15px;">Shop Signature: _________________</div>-->
        <!--</div>-->

        <div class="footer">
            <!--<div>Returns accepted within 7 days with receipt</div>-->
            <div class="divider"></div>
            <div>{{ $order->items->first()->product->mechanic->email ?? 'support@carcare.com' }}</div>
            <div>&copy; {{ date('Y') }} {{ $order->items->first()->product->mechanic->shopname ?? 'CarCare' }}</div>
        </div>
    </div>
</body>
</html>