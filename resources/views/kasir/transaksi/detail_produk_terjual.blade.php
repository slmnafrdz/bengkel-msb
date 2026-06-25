<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Produk Terjual - Bengkel MSB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-color: #f59e0b;
            --qty-color: #38bdf8;
            --border-color: #334155;
            --table-header-bg: #111827;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1100px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .btn-back {
            background-color: transparent;
            color: var(--accent-color);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            border: 1px solid var(--accent-color);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background-color: var(--accent-color);
            color: #000;
        }

        /* Table Card Styling */
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 15px;
        }

        th {
            background-color: var(--table-header-bg);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .code-badge {
            font-family: monospace;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 4px 8px;
            border-radius: 4px;
            color: var(--text-main);
        }

        .qty-badge {
            color: var(--qty-color);
            font-weight: 700;
            background-color: rgba(56, 189, 248, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
        }

        .price-bold {
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            color: var(--text-muted);
            padding: 40px 0;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <h2>Rincian Item / Produk Terjual Hari Ini</h2>
        <a href="/kasir/dashboard" class="btn-back">← Kembali ke Dashboard</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk / Sparepart</th>
                    <th>Harga Satuan</th>
                    <th style="text-align: center;">Total Qty Keluar</th>
                    <th>Total Pendapatan Produk</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td><span class="code-badge">{{ $item->kode_produk }}</span></td>
                    <td><b>{{ $item->nama_produk }}</b></td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td align="center">
                        <span class="qty-badge">{{ $item->total_qty }} item</span>
                    </td>
                    <td><span class="price-bold">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">Belum ada produk atau sparepart yang terjual hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>