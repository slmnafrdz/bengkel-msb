<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Retur - {{ $retur->no_retur }}</title>
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
            <a href="{{ route('retur.history') }}"
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

        @if (session('success'))
        <div class="mb-4 p-4 bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 rounded-xl text-xs font-bold flex items-center gap-2 no-print">
            <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
        </div>
        @endif

        {{-- NOTA --}}
        <div class="bg-[#111827] border border-slate-800 rounded-2xl p-6">

            {{-- KOP NOTA --}}
            <div class="text-center border-b border-slate-700 pb-4 mb-4">
                <div class="flex items-center justify-center gap-2 mb-1">
                    <i data-lucide="rotate-ccw" class="w-5 h-5 text-amber-500"></i>
                    <h1 class="text-lg font-extrabold text-white uppercase tracking-widest">BENGKEL MSB</h1>
                </div>
                <p class="text-xs text-slate-400">Nota Retur Barang</p>
            </div>

            {{-- INFO RETUR --}}
            <div class="grid grid-cols-2 gap-2 text-xs mb-4">
                <div>
                    <span class="text-slate-400">No. Retur</span>
                    <p class="text-amber-400 font-bold font-mono">{{ $retur->no_retur }}</p>
                </div>
                <div class="text-right">
                    <span class="text-slate-400">Tanggal</span>
                    <p class="text-white font-semibold">
                        {{ \Carbon\Carbon::parse($retur->created_at)->format('d/m/Y H:i') }} WIB
                    </p>
                </div>
                <div>
                    <span class="text-slate-400">No. Nota Asal</span>
                    <p class="text-white font-semibold font-mono">{{ $retur->transaction->no_nota ?? '-' }}</p>
                </div>
                <div class="text-right">
                    <span class="text-slate-400">Kasir</span>
                    <p class="text-white font-semibold">{{ $retur->user->name ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Jenis Retur</span>
                    <p class="text-white font-semibold">
                        {{ $retur->jenis_retur === 'tukar_barang' ? 'Tukar Barang' : 'Kembali Uang (Cash)' }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="text-slate-400">Alasan</span>
                    <p class="text-white font-semibold">{{ $retur->alasan }}</p>
                </div>
            </div>

            @if($retur->catatan)
            <div class="text-xs mb-4 p-3 bg-slate-900/60 rounded-xl border border-slate-800">
                <span class="text-slate-400">Catatan: </span>
                <span class="text-slate-200">{{ $retur->catatan }}</span>
            </div>
            @endif

            {{-- BARANG DIKEMBALIKAN --}}
            <div class="mb-4">
                <p class="text-xs font-bold text-slate-300 mb-2">Barang Dikembalikan Pelanggan</p>
                <div class="border border-slate-700 rounded-xl overflow-hidden">
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
                            @foreach($retur->details->where('tipe', 'dikembalikan') as $d)
                            <tr class="border-t border-slate-800">
                                <td class="p-3 text-white font-medium">{{ $d->product->nama_produk ?? '-' }}</td>
                                <td class="p-3 text-center text-slate-300">{{ $d->qty }}</td>
                                <td class="p-3 text-right text-slate-300">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                                <td class="p-3 text-right font-semibold text-white">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- BARANG PENGGANTI (jika ada) --}}
            @if($retur->jenis_retur === 'tukar_barang')
            <div class="mb-4">
                <p class="text-xs font-bold text-slate-300 mb-2">Barang Pengganti Diberikan</p>
                <div class="border border-slate-700 rounded-xl overflow-hidden">
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
                            @foreach($retur->details->where('tipe', 'pengganti') as $d)
                            <tr class="border-t border-slate-800">
                                <td class="p-3 text-white font-medium">{{ $d->product->nama_produk ?? '-' }}</td>
                                <td class="p-3 text-center text-slate-300">{{ $d->qty }}</td>
                                <td class="p-3 text-right text-slate-300">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                                <td class="p-3 text-right font-semibold text-white">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- RINGKASAN --}}
            <div class="space-y-2 text-xs border-t border-slate-700 pt-4">
                <div class="flex justify-between">
                    <span class="text-slate-400">Nilai Barang Diretur</span>
                    <span class="text-white font-semibold">Rp {{ number_format($retur->total_barang_retur, 0, ',', '.') }}</span>
                </div>
                @if($retur->jenis_retur === 'tukar_barang')
                <div class="flex justify-between">
                    <span class="text-slate-400">Nilai Barang Pengganti</span>
                    <span class="text-white font-semibold">Rp {{ number_format($retur->total_barang_pengganti, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="flex justify-between text-base font-extrabold border-t border-slate-700 pt-2 mt-2">
                    @if($retur->selisih < 0)
                        <span class="text-slate-300">Uang Kembali ke Pelanggan</span>
                        <span class="text-emerald-400">Rp {{ number_format(abs($retur->selisih), 0, ',', '.') }}</span>
                    @elseif($retur->selisih > 0)
                        <span class="text-slate-300">Pelanggan Kurang Bayar</span>
                        <span class="text-amber-400">Rp {{ number_format($retur->selisih, 0, ',', '.') }}</span>
                    @else
                        <span class="text-slate-300">Selisih</span>
                        <span class="text-slate-400">Rp 0 (Impas)</span>
                    @endif
                </div>
            </div>

            {{-- FOOTER NOTA --}}
            <div class="text-center mt-6 text-[10px] text-slate-500 border-t border-slate-800 pt-4">
                <p>Terima kasih atas kepercayaan Anda di Bengkel MSB</p>
                <p>Nota retur ini adalah bukti sah proses pengembalian/penukaran barang</p>
            </div>

        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
