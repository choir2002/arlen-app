<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Belanja</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 300px;
            margin: auto;
        }
        h1, h2 {
            text-align: center;
        }
        p, th, td {
            font-size: 12px;
        }
        .center {
            text-align: center;
        }
        .right {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Toko Arlen Grosir</h1>
    <p class="center">Kelurahan Balam Sempurna Kota, 
        Kecamatan Balai Jaya, Kabupaten Rokan Hilir, Provinsi Riau.</p>
    <hr>

    <p>No Transaksi: {{ $data['no_sale'] }}</p>
    <p>Tanggal: {{ $data['date'] }}</p>
    <p>Nama Kasir: {{ $data['name_cashier'] }}</p>
    <hr>

    <h2>Detail Belanja</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th class="center">Jumlah</th>
                <th class="right">Harga</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
            <tr>
                <td>{{ $detail->name_product }}</td>
                <td class="center">{{ $detail->qty }}</td>
                <td class="right">{{ number_format($detail->unit_price, 2, ',', '.') }}</td>
                <td class="right">{{ number_format($detail->total, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>

    <p class="right">Diskon: {{ number_format($data['discount'], 2, ',', '.') }}</p>
    <p class="right">Subtotal: {{ number_format($data['subtotal'], 2, ',', '.') }}</p>
    <p class="right total">Total Bayar: {{ number_format($data['total_payment'], 2, ',', '.') }}</p>
    <p class="right">Tunai: {{ number_format($data['cash'], 2, ',', '.') }}</p>
    <p class="right">Kembalian: {{ number_format($data['return'], 2, ',', '.') }}</p>

    <hr>
    <p class="center">Terima Kasih atas Kunjungan Anda</p>
</body>
</html>
