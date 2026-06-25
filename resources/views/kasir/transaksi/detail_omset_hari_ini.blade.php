<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Omset Hari Ini - Bengkel MSB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-color: #f59e0b;
            --success-color: #10b981;
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

        /* Omset Highlight Card */
        .omset-summary-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid var(--border-color);
            border-left: 5px solid var(--success-color);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .omset-summary-card p {
            margin: 0 0 8px 0;
            color: var(--text-muted);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .omset-amount {
            font-size: 32px;
            font-weight: 700;
            color: var(--success-color);
            margin: 0;
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

        .nota-code {
            font-family: monospace;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 4px 8px;
            border-radius: 4px;
        }

        .text-success {
            color: var(--success-color);
            font-weight: 600;
        }

        .text-danger {
            color: #ef4444;
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
        <h2>Rincian Omset Pendapatan Hari Ini</h2>
        <a href="/kasir/dashboard" class="btn-back">← Kembali ke Dashboard</a>
    </div>

    <div class="omset-summary-card">
        <p>Total Omset Masuk Bersih</p>
        <div class="omset-amount">Rp {{ number_format($totalOmset, 0, ',', '.') }}</div>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No Nota</th>
                    <th>Kasir</th>
                    <th>Uang Diterima</th>
                    <th>Kembalian</th>
                    <th>Net Omset (Total)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td><span class="nota-code">{{ $trx->no_nota }}</span></td>
                    <td>{{ $trx->nama_kasir }}</td>
                    <td>Rp {{ number_format($trx->bayar, 0, ',', '.') }}</td>
                    <td class="text-danger">Rp {{ number_format($trx->kembalian, 0, ',', '.') }}</td>
                    <td><span class="text-success">Rp {{ number_format($trx->total, 0, ',', '.') }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">Belum ada omset masuk hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>