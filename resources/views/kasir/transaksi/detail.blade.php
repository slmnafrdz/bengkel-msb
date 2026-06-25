<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Nota - {{ $transaction->no_nota }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: black !important; }
        }
    </style>
</head>
<body class="bg-[#0f172a] text-slate-200 antialiased min-h-screen">

    <div class="max-w-2xl mx-auto p-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6 no-print">
            <a href="/riwayat-transaksi"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold rounded-xl transition">
                <i data-lucide="printer" class="w-4 h-4"></i>
                Cetak Nota
            </button>
        </div>

        {{-- NOTA --}}
        <div class="bg-[#111827] border border-slate-800 rounded-2xl p-6">

            {{-- KOP NOTA --}}
            <div class="text-center border-b border-slate-700 pb-4 mb-4">
                <div class="flex items-center justify-center gap-2 mb-1">
                    <i data-lucide="wrench" class="w-5 h-5 text-amber-500"></i>
                    <h1 class="text-lg font-extrabold text-white uppercase tracking-widest">BENGKEL MSB</h1>
                </div>
                <p class="text-xs text-slate-400">Nota Penjualan Sparepart</p>
            </div>

            {{-- INFO TRANSAKSI --}}
            <div class="grid grid-cols-2 gap-2 text-xs mb-4">
                <div>
                    <span class="text-slate-400">No. Nota</span>
                    <p class="text-amber-400 font-bold font-mono">{{ $transaction->no_nota }}</p>
                </div>
                <div class="text-right">
                    <span class="text-slate-400">Tanggal</span>
                    <p class="text-white font-semibold">
                        {{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }} WIB
                    </p>
                </div>
                <div>
                    <span class="text-slate-400">Kasir</span>
                    <p class="text-white font-semibold">{{ $transaction->nama_kasir }}</p>
                </div>
            </div>

            {{-- TABEL ITEM --}}
            <div class="border border-slate-700 rounded-xl overflow-hidden mb-4">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="bg-slate-800 text-slate-400">
                            <th class="text-left p-3">Produk</th>
                            <th class="text-center p-3">Qty</th>
                            <th class="text-right p-3">Harga</th>
                            <th class="text-right p-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                        <tr class="border-t border-slate-800">
                            <td class="p-3">
                                <div class="text-white font-medium">{{ $detail->nama_produk }}</div>
                                <div class="text-slate-500 font-mono text-[10px]">{{ $detail->kode_produk }}</div>
                            </td>
                            <td class="p-3 text-center text-slate-300">{{ $detail->qty }}</td>
                            <td class="p-3 text-right text-slate-300">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td class="p-3 text-right font-semibold text-white">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- RINGKASAN PEMBAYARAN --}}
            <div class="space-y-2 text-xs border-t border-slate-700 pt-4">
                <div class="flex justify-between">
                    <span class="text-slate-400">Total Belanja</span>
                    <span class="text-white font-semibold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Bayar</span>
                    <span class="text-white font-semibold">Rp {{ number_format($transaction->bayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-extrabold border-t border-slate-700 pt-2 mt-2">
                    <span class="text-slate-300">Kembalian</span>
                    <span class="text-emerald-400">Rp {{ number_format($transaction->kembalian, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- FOOTER NOTA --}}
            <div class="text-center mt-6 text-[10px] text-slate-500 border-t border-slate-800 pt-4">
                <p>Terima kasih telah berbelanja di Bengkel MSB</p>
                <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
            </div>

        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>