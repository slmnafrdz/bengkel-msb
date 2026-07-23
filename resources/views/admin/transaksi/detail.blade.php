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
        body {
            font-family: 'Inter', sans-serif;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
                color: black !important;
            }
        }
    </style>
</head>

<body class="bg-[#0f172a] text-slate-200 antialiased min-h-screen">

    <div class="max-w-2xl mx-auto p-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6 no-print">
            <a href="{{ route('admin.transaksi.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Riwayat
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
                <p>Barang dapat diretur/ditukar dengan menunjukkan nota ini ke kasir</p>
            </div>

        </div>

        {{-- RIWAYAT RETUR / TUKAR BARANG UNTUK NOTA INI --}}
        @if($returs->count() > 0)
        <div class="mt-6">
            <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                <i data-lucide="rotate-ccw" class="w-4 h-4 text-rose-400"></i>
                Riwayat Retur / Tukar Barang untuk Nota Ini
            </h3>

            @foreach($returs as $retur)
            <div class="bg-[#111827] border border-slate-800 rounded-2xl p-5 mb-4">
                <div class="flex items-center justify-between mb-3 pb-3 border-b border-slate-800">
                    <div>
                        <span class="font-mono text-amber-400 font-bold text-xs">{{ $retur->no_retur }}</span>
                        <p class="text-[11px] text-slate-500 mt-0.5">
                            {{ \Carbon\Carbon::parse($retur->created_at)->format('d/m/Y H:i') }} WIB
                            &bull; Diproses oleh {{ $retur->nama_kasir_retur }}
                        </p>
                    </div>
                    @if($retur->jenis_retur === 'tukar_barang')
                    <span class="px-2.5 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-lg font-bold text-[10px]">Tukar Barang</span>
                    @else
                    <span class="px-2.5 py-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg font-bold text-[10px]">Uang Cash</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-2 text-xs mb-3">
                    <div>
                        <span class="text-slate-400">Alasan</span>
                        <p class="text-white font-semibold">{{ $retur->alasan }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-slate-400">Nilai Barang Diretur</span>
                        <p class="text-white font-semibold">Rp {{ number_format($retur->total_barang_retur, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="border border-slate-700 rounded-xl overflow-hidden mb-2">
                    <table class="w-full text-[11px]">
                        <thead>
                            <tr class="bg-slate-800 text-slate-400">
                                <th class="text-left p-2.5">Produk</th>
                                <th class="text-center p-2.5">Tipe</th>
                                <th class="text-center p-2.5">Qty</th>
                                <th class="text-right p-2.5">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($retur->details as $d)
                            <tr class="border-t border-slate-800">
                                <td class="p-2.5 text-white">{{ $d->nama_produk }}</td>
                                <td class="p-2.5 text-center">
                                    @if($d->tipe === 'dikembalikan')
                                    <span class="text-rose-400">Dikembalikan</span>
                                    @else
                                    <span class="text-blue-400">Pengganti</span>
                                    @endif
                                </td>
                                <td class="p-2.5 text-center text-slate-300">{{ $d->qty }}</td>
                                <td class="p-2.5 text-right text-slate-300">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between text-xs font-bold pt-2 border-t border-slate-800">
                    @if($retur->selisih < 0)
                        <span class="text-slate-300">Uang Kembali ke Pelanggan</span>
                        <span class="text-rose-400">Rp {{ number_format(abs($retur->selisih), 0, ',', '.') }}</span>
                        @elseif($retur->selisih > 0)
                        <span class="text-slate-300">Pelanggan Kurang Bayar</span>
                        <span class="text-blue-400">Rp {{ number_format($retur->selisih, 0, ',', '.') }}</span>
                        @else
                        <span class="text-slate-300">Selisih</span>
                        <span class="text-slate-400">Rp 0 (Impas)</span>
                        @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>