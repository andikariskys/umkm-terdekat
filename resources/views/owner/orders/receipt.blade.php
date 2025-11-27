<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            width: 300px;
            /* Lebar standar printer thermal 80mm */
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }

        .store-name {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .store-info {
            font-size: 10px;
        }

        .transaction-info {
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .item-list {
            width: 100%;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .item-name {
            font-weight: bold;
        }

        .totals {
            text-align: right;
            margin-bottom: 15px;
        }

        .totals div {
            display: flex;
            justify-content: space-between;
        }

        .grand-total {
            font-weight: bold;
            font-size: 14px;
            margin-top: 5px;
            border-top: 1px dashed #000;
            padding-top: 5px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }

        /* Sembunyikan elemen lain saat print jika ada */
        @media print {
            @page {
                margin: 0;
            }

            body {
                padding: 10px;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <div class="store-name">{{ $user->business_name ?? 'UMKM Terdekat' }}</div>
        <div class="store-info">{{ $user->business_address ?? 'Alamat Belum Diatur' }}</div>
        <div class="store-info">{{ $user->business_phone ?? '' }}</div>
    </div>

    <div class="transaction-info">
        <div>No: #{{ $order->id }}</div>
        <div>Tgl: {{ $order->created_at->format('d/m/Y H:i') }}</div>
        <div>Pelanggan: {{ $order->customer_name }}</div>
    </div>

    <div class="item-list">
        @foreach($order->items as $item)
        <div style="margin-bottom: 5px;">
            <div class="item-name">{{ $item->product_name }}</div>
            <div class="item-row">
                <span>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</span>
                <span>{{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="totals">
        {{-- Jika Anda menyimpan subtotal pesanan sebelum pajak, hitung manual atau ambil dari DB --}}
        @php
        $subtotal = $order->total_amount - $order->tax;
        @endphp

        <div>
            <span>Subtotal:</span>
            <span>{{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        @if($order->tax > 0)
        <div>
            <span>Pajak (10%):</span>
            <span>{{ number_format($order->tax, 0, ',', '.') }}</span>
        </div>
        @endif
        <div class="grand-total">
            <span>TOTAL:</span>
            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Terima Kasih telah berbelanja!</p>
        <p>Powered by UMKMTerdekat</p>
    </div>

</body>

</html>