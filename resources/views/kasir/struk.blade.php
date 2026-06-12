<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #{{ $transaksi->id_transaksi }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }
        .receipt-container {
            width: 58mm; /* Thermal printer width */
            padding: 4mm 2mm;
            box-sizing: border-box;
            margin: 0 auto;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        .header {
            margin-bottom: 8px;
        }
        .header h1 {
            font-size: 14px;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0;
            font-size: 10px;
        }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 4px 0;
        }
        
        .info-section {
            margin-bottom: 6px;
        }
        .info-row {
            display: flex;
            justify-content: flex-start;
        }
        
        .item-section {
            margin: 4px 0;
        }
        .item-name {
            text-transform: uppercase;
            display: block;
            margin-top: 4px;
        }
        .item-detail {
            display: flex;
            justify-content: space-between;
        }
        
        .summary-section {
            margin-top: 6px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
        }
        
        .footer {
            margin-top: 15px;
            font-size: 9px;
        }

        @media print {
            body { width: 58mm; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="receipt-container">
    <!-- Header -->
    <div class="header text-center">
        <h1 class="font-bold">Apotek Maxilla</h1>
        <p>Jalan Sultan Agung No. 30</p>
        <p>Kejambon Tegal</p>
        <p>0283 4532746</p>
    </div>

    <div class="divider"></div>

    <!-- Info -->
    <div class="info-section">
        <div class="info-row">
            <span>Tgl. {{ $transaksi->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span>No. M-{{ str_pad($transaksi->id_transaksi, 10, '0', STR_PAD_LEFT) }} / {{ strtolower(auth()->user()->nama ?? 'admin') }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Items -->
    <div class="item-section">
        <!-- Obat-obatan -->
        @foreach($transaksi->reservasi->rekamMedis->resepObats as $resep)
            <span class="item-name">{{ $resep->obat->nama_obat }}</span>
            <div class="item-detail">
                <span>{{ $resep->jumlah }} PCS x Rp {{ number_format($resep->obat->harga, 0, ',', '.') }}</span>
                <span>Rp {{ number_format($resep->jumlah * $resep->obat->harga, 0, ',', '.') }}</span>
            </div>
        @endforeach

        <!-- Tindakan -->
        @if($transaksi->total_tindakan > 0)
            <span class="item-name">{{ $transaksi->reservasi->rekamMedis->planning ?? 'Tindakan Medis' }}</span>
            <div class="item-detail">
                <span>1 Kali</span>
                <span>Rp {{ number_format($transaksi->total_tindakan, 0, ',', '.') }}</span>
            </div>
        @endif
    </div>

    <div class="divider"></div>

    <!-- Summary -->
    <div class="summary-section">
        <div class="summary-row">
            <span>Total</span>
            <span>: Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span>Tunai</span>
            <span>: Rp {{ $transaksi->metode_pembayaran == 'Cash' ? number_format($transaksi->total_bayar, 0, ',', '.') : '0' }}</span>
        </div>
        <div class="summary-row">
            <span>Kartu Debit</span>
            <span>: Rp {{ $transaksi->metode_pembayaran != 'Cash' ? number_format($transaksi->total_bayar, 0, ',', '.') : '0' }}</span>
        </div>
        <div class="summary-row font-bold" style="margin-top: 4px;">
            <span>Bayar Tunai</span>
            <span>: Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span>Kembali</span>
            <span>: Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <div class="info-section">
        <div class="info-row">
            <span>ID Pasien : #{{ $transaksi->reservasi->id_reservasi }}</span>
        </div>
        <div class="info-row">
            <span>Nama Pasien : {{ $transaksi->reservasi->nama_pasien ?? ($transaksi->reservasi->user->nama ?? '-') }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Footer -->
    <div class="footer text-center">
        <p>Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan</p>
        <p class="font-bold" style="margin-top: 8px;">TERIMA KASIH</p>
    </div>
</div>

<div class="no-print text-center" style="margin-top: 20px; padding: 10px;">
    <button onclick="window.print()" style="padding: 8px 16px; cursor: pointer;">Cetak Lagi</button>
    <button onclick="window.close()" style="padding: 8px 16px; cursor: pointer; margin-left: 10px;">Tutup</button>
</div>

</body>
</html>
