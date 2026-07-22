<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Bengkel MSB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0b0f19] text-slate-200 antialiased min-h-screen">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-[#0f1629]/80 border-r border-slate-800/60 backdrop-blur-xl flex flex-col justify-between p-4 shrink-0">
            <div>
                <div class="flex items-center gap-3 px-2 py-3 border-b border-slate-800/60 mb-5">
                    <div class="flex items-center justify-center p-2 bg-amber-500 rounded-xl shadow-lg shadow-amber-500/20">
                        <i data-lucide="wrench" class="w-4 h-4 text-slate-900"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-sm tracking-wider text-white leading-tight">BENGKEL MSB</h2>
                        <span class="text-[10px] text-amber-500 font-bold tracking-widest block mt-0.5">PERFORMANCE ADMIN</span>
                    </div>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/60 hover:text-white rounded-xl text-sm font-medium transition group">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-slate-500 group-hover:text-amber-500 transition"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/60 hover:text-white rounded-xl text-sm font-medium transition group">
                        <i data-lucide="users" class="w-4 h-4 text-slate-500 group-hover:text-amber-500 transition"></i>
                        Manajemen User
                    </a>
                    <div class="space-y-1">
                        <button onclick="toggleDropdown('menu-master','icon-master')" class="w-full flex items-center justify-between px-3 py-2.5 text-slate-400 hover:bg-slate-800/60 hover:text-white rounded-xl text-sm font-medium transition cursor-pointer group">
                            <div class="flex items-center gap-3">
                                <i data-lucide="database" class="w-4 h-4 text-slate-500 group-hover:text-amber-500 transition"></i>
                                <span>Master Data</span>
                            </div>
                            <i id="icon-master" data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200"></i>
                        </button>
                        <div id="menu-master" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-[#0f172a]/40 rounded-xl pl-4 space-y-1">
                            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                                <i data-lucide="box" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Produk
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                                <i data-lucide="tag" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Kategori
                            </a>
                            <a href="{{ route('admin.spareparts.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                                <i data-lucide="settings" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Sparepart
                            </a>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <button onclick="toggleDropdown('menu-laporan','icon-laporan')" class="w-full flex items-center justify-between px-3 py-2.5 text-slate-400 hover:bg-slate-800/60 hover:text-white rounded-xl text-sm font-medium transition cursor-pointer group">
                            <div class="flex items-center gap-3">
                                <i data-lucide="folder-open" class="w-4 h-4 text-amber-500 transition"></i>
                                <span class="text-white font-semibold">Laporan</span>
                            </div>
                            <i id="icon-laporan" data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200" style="transform:rotate(180deg);"></i>
                        </button>
                        <div id="menu-laporan" class="overflow-hidden transition-all duration-300 ease-in-out bg-[#0f172a]/40 rounded-xl pl-4 space-y-1" style="max-height:200px;">
                            <a href="{{ route('admin.transaksi.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                                <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Riwayat Transaksi
                            </a>
                            <a href="{{ route('admin.transaksi.laporan') }}" class="flex items-center gap-2 px-3 py-2 text-xs bg-amber-500/10 text-amber-400 border-l-2 border-amber-500 font-semibold transition rounded-lg">
                                <i data-lucide="bar-chart-2" class="w-3.5 h-3.5"></i>Laporan Transaksi
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="border-t border-slate-800 pt-4">
                <a href="/logout" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-red-950/40 hover:text-red-400 rounded-xl text-sm transition font-medium group">
                    <i data-lucide="log-out" class="w-4 h-4 text-slate-500 group-hover:text-red-400 transition"></i>
                    Logout
                </a>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="flex-1 p-6 overflow-y-auto bg-[#0b0f19]">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-white">Riwayat Transaksi</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Seluruh riwayat penjualan sparepart Bengkel MSB.</p>
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-500 bg-slate-800/50 border border-slate-700/50 rounded-xl px-3 py-2">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-amber-500"></i>
                    {{ now()->format('d M Y') }}
                </div>
            </div>

            {{-- ALERT --}}
            @if(session('error'))
            <div class="mb-4 flex items-center gap-2 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-xs font-semibold">
                <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
            </div>
            @endif
            @if(session('success'))
            <div class="mb-4 flex items-center gap-2 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-xs font-semibold">
                <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
            </div>
            @endif

            {{-- STATS CARDS --}}
            @php
            $totalTrx = $transactions->count();
            $totalOmset = $transactions->sum('total');
            $totalHariIni = $transactions->filter(fn($t) => \Carbon\Carbon::parse($t->created_at)->isToday())->count();
            $omsetHariIni = $transactions->filter(fn($t) => \Carbon\Carbon::parse($t->created_at)->isToday())->sum('total');
            @endphp
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                    <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Total Transaksi</p>
                    <p class="text-2xl font-extrabold text-white">{{ $totalTrx }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">Semua waktu</p>
                </div>
                <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                    <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Total Omset</p>
                    <p class="text-2xl font-extrabold text-amber-400">Rp {{ number_format($totalOmset, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">Semua waktu</p>
                </div>
                <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                    <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Transaksi Hari Ini</p>
                    <p class="text-2xl font-extrabold text-white">{{ $totalHariIni }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">{{ now()->format('d M Y') }}</p>
                </div>
                <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                    <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Omset Hari Ini</p>
                    <p class="text-2xl font-extrabold text-emerald-400">Rp {{ number_format($omsetHariIni, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">{{ now()->format('d M Y') }}</p>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="flex items-center gap-3 mb-4">
                <div class="relative flex-1 max-w-xs">
                    <i data-lucide="search" class="w-3.5 h-3.5 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="text" id="searchInput" placeholder="Cari no nota atau kasir..."
                        class="w-full bg-slate-800/60 border border-slate-700/60 text-white text-xs rounded-xl pl-9 pr-4 py-2.5 focus:outline-none focus:border-amber-500 placeholder-slate-600 transition">
                </div>
                <select id="filterKasir"
                    class="bg-slate-800/60 border border-slate-700/60 text-white text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-amber-500 transition">
                    <option value="">Semua Kasir</option>
                    @foreach($transactions->pluck('nama_kasir')->unique() as $kasir)
                    <option value="{{ $kasir }}">{{ $kasir }}</option>
                    @endforeach
                </select>
                <div class="text-xs text-slate-500" id="jumlahHasil">{{ $totalTrx }} transaksi</div>
            </div>

            {{-- TABLE --}}
            <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl overflow-hidden">
                <table class="w-full text-sm" id="tabelTransaksi">
                    <thead>
                        <tr class="border-b border-slate-800 bg-[#090f1e]">
                            <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">#</th>
                            <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">No Nota</th>
                            <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal & Jam</th>
                            <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Kasir</th>
                            <th class="text-right px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Total</th>
                            <th class="text-center px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50" id="tbody">
                        @forelse($transactions as $i => $trx)
                        <tr class="hover:bg-slate-800/20 transition row-data"
                            data-nota="{{ strtolower($trx->no_nota) }}"
                            data-kasir="{{ $trx->nama_kasir }}">
                            <td class="px-5 py-4 text-slate-500 text-xs">{{ $i + 1 }}</td>
                            <td class="px-5 py-4">
                                <span class="font-bold font-mono text-xs bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2.5 py-1 rounded-lg">
                                    {{ $trx->no_nota }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-400 text-xs">
                                <div class="font-semibold text-slate-300">{{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}</div>
                                <div class="text-slate-500">{{ \Carbon\Carbon::parse($trx->created_at)->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-300">
                                        {{ strtoupper(substr($trx->nama_kasir, 0, 1)) }}
                                    </div>
                                    <span class="text-slate-300 text-xs font-medium">{{ $trx->nama_kasir }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <span class="font-bold text-white text-sm">Rp {{ number_format($trx->total, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <a href="{{ route('admin.transaksi.show', $trx->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-500/10 hover:bg-emerald-500 border border-emerald-500/30 hover:border-emerald-400 text-emerald-400 hover:text-white text-xs font-bold rounded-lg transition">
                                    <i data-lucide="eye" class="w-3 h-3"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center text-slate-500 text-sm">
                                <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 text-slate-700"></i>
                                <p>Belum ada transaksi yang tercatat.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-3">
                <p class="text-xs text-slate-600">Menampilkan <span id="countShown">{{ $totalTrx }}</span> dari {{ $totalTrx }} transaksi.</p>
            </div>

        </main>
    </div>

    <script>
        lucide.createIcons();

        function toggleDropdown(id, iconId) {
            const el = document.getElementById(id);
            const icon = document.getElementById(iconId);
            const isOpen = el.style.maxHeight && el.style.maxHeight !== '0px';
            el.style.maxHeight = isOpen ? '0px' : el.scrollHeight + 'px';
            icon.style.transform = isOpen ? '' : 'rotate(180deg)';
        }

        // Filter & Search
        const searchInput = document.getElementById('searchInput');
        const filterKasir = document.getElementById('filterKasir');
        const rows = document.querySelectorAll('.row-data');
        const countShown = document.getElementById('countShown');
        const jumlahHasil = document.getElementById('jumlahHasil');

        function applyFilter() {
            const q = searchInput.value.toLowerCase();
            const kasir = filterKasir.value.toLowerCase();
            let visible = 0;
            rows.forEach(row => {
                const nota = row.dataset.nota;
                const ksr = row.dataset.kasir.toLowerCase();
                const match = (!q || nota.includes(q) || ksr.includes(q)) &&
                    (!kasir || ksr === kasir);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            countShown.textContent = visible;
            jumlahHasil.textContent = visible + ' transaksi';
        }

        searchInput.addEventListener('input', applyFilter);
        filterKasir.addEventListener('change', applyFilter);
    </script>
</body>

</html>