<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Transaksi</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Produk</th>
                    <th>Pelanggan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksiDetails as $transaksiDetail)
                <tr>
                    <td>{{ $transaksiDetail->id }}</td>
                    <td>{{ $transaksiDetail->produk ? $transaksiDetail->produk->nama_produk : 'Produk tidak ditemukan' }}</td>
                    <td>{{ $transaksiDetail->pelanggan ? $transaksiDetail->pelanggan->nama_pelanggan : 'Pelanggan tidak ditemukan' }}</td>
                    <td>{{ $transaksiDetail->jumlah }}</td>
                    <td>{{ $transaksiDetail->harga }}</td>
                    <td>{{ $transaksiDetail->total }}</td>
                </tr>
            @endforeach            
            </tbody>
        </table>
    </div>
</body>
</html>
