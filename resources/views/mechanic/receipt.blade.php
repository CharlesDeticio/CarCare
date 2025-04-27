<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - {{ $order->id }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.2;
            color: #000;
            width: 76mm;
            margin: 0 auto;
            padding: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .shop-name {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 2px;
            text-transform: uppercase;
        }
        .shop-address {
            font-size: 10px;
            margin-bottom: 2px;
        }
        .receipt-info {
            text-align: center;
            margin: 5px 0;
        }
        .divider { 
            border-top: 1px dashed #000; 
            margin: 8px 0;
        }
        .divider-thick {
            border-top: 2px solid #000;
            margin: 8px 0;
        }
        .section {
            margin: 6px 0;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }
        .item-name {
            width: 60%;
        }
        .item-value {
            width: 40%;
            text-align: right;
        }
        .signature-area {
            margin: 10px 0;
        }
        .signature-line {
            display: inline-block;
            width: 120px;
            border-top: 1px solid #000;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
        }
        .asterisk-line {
            text-align: center;
            margin: 5px 0;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    @php
        $mechanic = $order->items->first()->product->mechanic ?? auth()->guard('mechanic')->user();
        $subtotal = $order->items->where('product.mechanic_id', auth()->guard('mechanic')->id())->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $taxRate = 0.12;
        $tax = $subtotal * $taxRate;
        $total = $subtotal + $tax;
    @endphp

    <div class="header">
        <div class="shop-name">{{ strtoupper($mechanic->shopname ?? 'AVILA\'S REPAIR SHOP') }}</div>
        <div class="shop-address">{{ $mechanic->Address ?? 'Agustin Tomula Street, Surata Village, Can-Oh, Laptelege, Central Visayas, 4016' }}</div>
        <div class="shop-address">Philippines</div>
        <div>Tel: {{ $mechanic->ContactNo ?? '03975128339' }}</div>
    </div>

    <div class="receipt-info">
        <div>Receipt #: {{ $reference }}</div>
        <div>Date: {{ $date }}</div>
    </div>

    <div class="divider">* * * * * * * * * * * *</div>

    <div class="section">
        <div class="section-title">Customer Information</div>
        <div>Name: {{ $order->user->name }}</div>
        <div>Contact: {{ $order->shipping_phone ?? '09123123223' }}</div>
    </div>

    <div class="divider"></div>

    <div class="section">
        <div class="section-title">Order Items</div>
        @foreach($order->items as $item)
            @if($item->product->mechanic_id == auth()->guard('mechanic')->id())
                <div class="item-row">
                    <div class="item-name">{{ $item->product->ProductName }}</div>
                    <div class="item-value">{{ $item->quantity }} x ₱{{ number_format($item->price, 2) }}</div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="divider"></div>

    <div class="section">
        <div class="section-title">Payment Details</div>
        <div class="item-row">
            <div class="item-name">TOTAL:</div>
            <div class="item-value">₱{{ number_format($subtotal, 2) }}</div>
        </div>
        <!--<div class="item-row">-->
        <!--    <div class="item-name">Tax (12%):</div>-->
        <!--    <div class="item-value">₱{{ number_format($tax, 2) }}</div>-->
        <!--</div>-->
        <!--<div class="item-row" style="margin-top: 5px; font-weight: bold;">-->
        <!--    <div class="item-name">TOTAL:</div>-->
        <!--    <div class="item-value">₱{{ number_format($total, 2) }}</div>-->
        <!--</div>-->
    </div>

    <div class="divider"></div>

    <div style="text-align: center; margin: 8px 0;">
        Thank you for your purchase!
    </div>

    <div class="signature-area">
        <div>Customer Signature: <span class="signature-line"></span></div>
        <!--<div style="margin-top: 8px;">Mechanic Signature: <span class="signature-line"></span></div>-->
    </div>

    <div class="footer">
        <!--<div>Return accepted within 7 days with receipt</div>-->
        <div class="asterisk-line">*******************************</div>
        <div>{{ $mechanic->email ?? 'client@tilepail.com' }}</div>
        <div>© {{ date('Y') }} {{ $mechanic->shopname ?? 'Avila\'s Repair Shop' }}</div>
    </div>
</body>
</html>