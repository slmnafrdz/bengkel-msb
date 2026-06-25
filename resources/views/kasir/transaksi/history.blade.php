<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi Hari Ini - Bengkel MSB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0b1329; /* Disamakan dengan latar utama POS Bengkel MSB */
            --card-bg: #0f172a; /* Disamakan dengan kontainer sidebar/tabel POS */
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-color: #f59e0b; /* Warna Amber khas aksen bengkel */
            --accent-hover: #d97706;
            --border-color: #1e293b;
            --table-header-bg: #090f1e;
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
            color: var(--text-main);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background-color: #1e293b;
            border-color: #475569;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
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
            font-size: 11px;
            letter-spacing: 0.05em;
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid rgba(30, 41, 59, 0.5);
            color: var(--text-main);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.01);
        }

        .nota-code {
            font-family: monospace;
            font-size: 13px;
            font-weight: 700;
            background-color: rgba(245, 158, 11, 0.1); /* Latar belakang amber transparan */
            padding: 4px 10px;
            border-radius: 6px;
            color: var(--accent-color); /* Warna font kode nota kuning khas bengkel */
        }

        .badge-time {
            color: var(--text-muted);
            font-size: 14px;
        }

        .price-text {
            font-weight: 700;
            color: var(--text-main);
        }

        .btn-detail {
            background-color: rgba(16, 185, 129, 0.1); /* Emerald semitransparan */
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: inline-block;
        }

        .btn-detail:hover {
            background-color: #10b981;
            color: #052e16;
        }

        .empty-state {
            text-align: center;
            color: var(--text-muted);
            padding: 60px 0;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <h2>Daftar Transaksi Hari Ini</h2>
        <a href="/kasir/dashboard" class="btn-back">← Kembali ke Dashboard</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No Nota</th>
                    <th>Jam Transaksi</th>
                    <th>Kasir</th>
                    <th>Total Belanja</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td><span class="nota-code">{{ $trx->no_nota }}</span></td>
                    <td><span class="badge-time">{{ date('H:i:s', strtotime($trx->created_at)) }} WIB</span></td>
                    <td>{{ $trx->nama_kasir }}</td>
                    <td><span class="price-text">Rp {{ number_format($trx->total, 0, ',', '.') }}</span></td>
                    <td style="text-align: right;">
                        <a href="{{ route('transaksi.show', $trx->id) }}" class="btn-detail">Detail Nota →</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">Belum ada transaksi masuk pada hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>