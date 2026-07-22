<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - RETUR BARANG</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-[#0f172a] text-slate-200 antialiased min-h-screen relative overflow-x-hidden">

    <div class="flex min-h-screen relative z-10">
        <aside class="w-64 bg-[#111827]/40 border-r border-slate-800/60 backdrop-blur-xl flex flex-col justify-between p-4 shrink-0">
            <div>
                <div class="flex items-center gap-3 px-2 py-3 border-b border-slate-800/60 mb-6">
                    <div class="flex items-center justify-center p-2 bg-amber-500 rounded-xl shadow-lg shadow-amber-500/20">
                        <i data-lucide="wrench" class="w-4 h-4 text-slate-900"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-xs tracking-wider text-white uppercase leading-tight">BENGKEL MSB</h2>
                        <span class="text-[9px] text-amber-500 font-semibold uppercase tracking-widest">Kasir System</span>
                    </div>
                </div>

                <nav class="space-y-1.5">
                    <a href="/kasir/dashboard" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-slate-500"></i>
                        Dashboard
                    </a>

                    <a href="/transaksi" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="arrow-left-right" class="w-4 h-4 text-slate-500"></i>
                        Transaksi
                    </a>

                    <a href="/kasir/spareparts" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="box" class="w-4 h-4 text-slate-500"></i>
                        Stok Sparepart
                    </a>

                    <a href="/riwayat-transaksi" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="history" class="w-4 h-4 text-slate-500"></i>
                        Riwayat Transaksi
                    </a>

                    <a href="/retur" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-amber-500/10">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                        Retur Barang
                    </a>
                </nav>
            </div>
            <div class="border-t border-slate-800/60 pt-4">
                <a href="/logout" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 rounded-xl text-xs uppercase tracking-wider transition font-bold">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 overflow-y-auto">

            <header class="flex items-center justify-between mb-6 bg-[#111827]/40 border border-slate-800/60 rounded-2xl px-5 py-4 backdrop-blur-md">
                <div>
                    <h1 class="text-lg font-extrabold text-white">Retur Barang</h1>
                    <p class="text-xs text-slate-400">Proses tukar barang atau pengembalian uang untuk transaksi yang sudah dibayar.</p>
                </div>
                <a href="{{ route('retur.history') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    Riwayat Retur
                </a>
            </header>

            @if (session('success'))
            <div class="mb-4 p-4 bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-4 p-4 bg-rose-500/20 border border-rose-500/50 text-rose-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
            </div>
            @endif

            {{-- FORM CARI NOTA --}}
            <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6 mb-6">
                <h3 class="text-sm font-bold text-white mb-1">Cari Nota Transaksi</h3>
                <p class="text-xs text-slate-400 mb-4">Masukkan No. Nota yang tertera pada struk pelanggan untuk memulai proses retur.</p>

                <form action="{{ route('retur.cari') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input type="text" name="no_nota" placeholder="Contoh: NOTA-20260718123045"
                        class="flex-1 bg-slate-900 border border-slate-700 rounded-xl p-3 text-white text-sm font-mono focus:outline-none focus:ring-2 focus:ring-amber-500"
                        required autofocus>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold rounded-xl transition uppercase tracking-wider">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Cari Nota
                    </button>
                </form>
            </div>

            {{-- RETUR TERBARU --}}
            <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6">
                <h3 class="text-sm font-bold text-white mb-4">Retur Terbaru</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="border-b border-slate-700 text-slate-400">
                                <th class="text-left p-3">No. Retur</th>
                                <th class="text-left p-3">No. Nota Asal</th>
                                <th class="text-left p-3">Jenis</th>
                                <th class="text-right p-3">Nilai Retur</th>
                                <th class="text-center p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($returTerbaru as $r)
                            <tr class="border-b border-slate-800 hover:bg-slate-800/20 transition">
                                <td class="p-3 font-mono text-amber-500">{{ $r->no_retur }}</td>
                                <td class="p-3 font-mono text-slate-300">{{ $r->transaction->no_nota ?? '-' }}</td>
                                <td class="p-3">
                                    @if($r->jenis_retur === 'tukar_barang')
                                        <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-lg font-semibold">Tukar Barang</span>
                                    @else
                                        <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 rounded-lg font-semibold">Uang Cash</span>
                                    @endif
                                </td>
                                <td class="p-3 text-right text-white font-semibold">Rp {{ number_format($r->total_barang_retur, 0, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('retur.show', $r->no_retur) }}" class="text-amber-500 hover:underline font-semibold">Detail →</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-slate-500 italic py-6">Belum ada data retur.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>lucide.createIcons();</script>
</body>

</html>
