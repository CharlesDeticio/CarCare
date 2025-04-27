<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <title>Booking Receipt #{{ $booking->id }}</title>

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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ $booking->service->mechanic->shopname ?? 'CAR CARE CENTER' }}</div>
            <div class="shop-info">
                {{ $booking->service->mechanic->Address ?? '123 Garage Street' }}<br>
                Tel: {{ $booking->service->mechanic->ContactNo ?? '(123) 456-7890' }}
            </div>
            <div class="receipt-info">
                {{-- Receipt #: {{ $booking->id }}<br> --}}
                Date: {{ now()->format('m/d/Y H:i') }}
            </div>
        </div>

        <!-- Alphanumeric Reference Number -->
        <div class="ref-number">
            Receipt #: {{ strtoupper(substr($booking->service->mechanic->shopname ?? 'CAR', 0, 3)) }}{{ $booking->id }}{{ now()->format('mdY') }}
        </div>

        <div class="divider"></div>
        <div class="section-title">customer information</div>
        
        <div class="detail-row">
            <div>Name:</div>
            <div>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</div>
        </div>
        <div class="detail-row">
            <div>Address:</div>
            <div>{{ $booking->user->address }}</div>
        </div>
        <div class="detail-row">
            <div>Contact:</div>
            <div>{{ $booking->user->phone_number }}</div>
        </div>

        <div class="divider"></div>
        <div class="section-title">service details</div>
        
        <div class="detail-row">
            <div>Service:</div>
            <div>{{ $booking->service->name }}</div>
        </div>
        <div class="detail-row">
            <div>Date/Time:</div>
            <div>{{ $booking->booking_date }} {{ $booking->booking_time }}</div>
        </div>
        @if($booking->reason)
        <div class="detail-row">
            <div>Service Notes:</div>
            <div>{{ $booking->reason }}</div>
        </div>
        @endif

        <div class="divider"></div>
        <div class="section-title">payment details</div>
        
        <div class="price-section">
            <div class="detail-row">
                <div>TOTAL:</div>
                <div>PHP
{{ number_format($booking->service->price, 2) }}</div>
            </div>
<!--            <div class="detail-row">-->
<!--                <div>Tax (10%):</div>-->
<!--                <div>₱-->
<!--{{ number_format($booking->service->price * 0.1, 2) }}</div>-->
<!--            </div>-->
<!--            <div class="detail-row total-row">-->
<!--                <div>TOTAL:</div>-->
<!--                <div>₱-->
<!--{{ number_format($booking->service->price * 1.1, 2) }}</div>-->
<!--            </div>-->
        </div>

        <div class="divider-thick"></div>
        <div class="thank-you">
            Thank you for your business!
        </div>

        <div class="customer-sign">
            {{-- <div>Customer Signature: _________________</div> --}}
            <div style="margin-top: 15px;">Shop Signature: _________________</div>
        </div>

        <div class="footer">
            {{-- <div>Returns accepted within 7 days with receipt</div> --}}
            <div class="divider"></div>
            <div>{{ $booking->service->mechanic->email ?? 'support@carcare.com' }}</div>
            <div>&copy; {{ date('Y') }} {{ $booking->service->mechanic->shopname ?? 'CarCare' }}</div>
        </div>
    </div>
</body>
</html>