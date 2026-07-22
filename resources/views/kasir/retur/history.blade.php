<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Retur - Bengkel MSB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #0b1329;
            --card-bg: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-color: #f59e0b;
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
            max-width: 1150px;
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
            background-color: rgba(245, 158, 11, 0.1);
            padding: 4px 10px;
            border-radius: 6px;
            color: var(--accent-color);
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-tukar {
            background-color: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
        }

        .badge-cash {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .price-text {
            font-weight: 700;
            color: var(--text-main);
        }

        .btn-detail {
            background-color: rgba(16, 185, 129, 0.1);
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
            <h2>Riwayat Retur Barang</h2>
            <a href="{{ route('retur.index') }}" class="btn-back">← Kembali ke Retur</a>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>No Retur</th>
                        <th>No Nota Asal</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Jenis</th>
                        <th>Nilai Retur</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($returs as $r)
                    <tr>
                        <td><span class="nota-code">{{ $r->no_retur }}</span></td>
                        <td><span class="nota-code">{{ $r->no_nota }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $r->nama_kasir }}</td>
                        <td>
                            @if($r->jenis_retur === 'tukar_barang')
                            <span class="badge badge-tukar">Tukar Barang</span>
                            @else
                            <span class="badge badge-cash">Uang Cash</span>
                            @endif
                        </td>
                        <td><span class="price-text">Rp {{ number_format($r->total_barang_retur, 0, ',', '.') }}</span></td>
                        <td style="text-align: right;">
                            <a href="{{ route('retur.show', $r->no_retur) }}" class="btn-detail">Detail Nota →</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-state">Belum ada data retur.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>