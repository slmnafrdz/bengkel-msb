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
        body { font-family: 'Inter', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            aside { display: none !important; }
            main { padding: 20px !important; }
            body { background: white !important; color: black !important; }
        }
    </style>
</head>
<body class="bg-[#0b0f19] text-slate-200 antialiased min-h-screen">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#0f1629]/80 border-r border-slate-800/60 backdrop-blur-xl flex flex-col justify-between p-4 shrink-0 no-print">
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
                {{-- LAPORAN — aktif di halaman ini --}}
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
                <h1 class="text-xl font-extrabold text-white">Laporan Transaksi</h1>
                <p class="text-xs text-slate-400 mt-0.5">Rekap penjualan sparepart per produk dan per kasir.</p>
            </div>
            <button onclick="window.print()"
                    class="no-print inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-bold rounded-xl text-xs shadow-lg shadow-amber-500/20 hover:scale-[1.02] transition">
                <i data-lucide="printer" class="w-4 h-4"></i>
                Cetak Laporan
            </button>
        </div>

        {{-- FILTER TANGGAL --}}
        <form method="GET" action="{{ route('admin.transaksi.laporan') }}"
              class="no-print flex items-end gap-3 mb-6 p-4 bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl">
            <div>
                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wide mb-1.5">Dari Tanggal</label>
                <input type="date" name="dari" value="{{ $dari }}"
                       class="bg-slate-800/60 border border-slate-700/60 text-white text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-amber-500 transition">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wide mb-1.5">Sampai Tanggal</label>
                <input type="date" name="sampai" value="{{ $sampai }}"
                       class="bg-slate-800/60 border border-slate-700/60 text-white text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-amber-500 transition">
            </div>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded-xl text-xs transition">
                <i data-lucide="filter" class="w-3.5 h-3.5"></i> Terapkan Filter
            </button>
            <a href="{{ route('admin.transaksi.laporan') }}"
               class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-400 font-semibold rounded-xl text-xs transition">
                Reset
            </a>
            <div class="ml-auto text-right">
                <p class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Periode</p>
                <p class="text-xs text-amber-400 font-bold">
                    {{ \Carbon\Carbon::parse($dari)->format('d M Y') }} — {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }}
                </p>
            </div>
        </form>

        {{-- RINGKASAN STATS --}}
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wide mb-1">Total Transaksi</p>
                <p class="text-2xl font-extrabold text-white">{{ $ringkasan->total_trx ?? 0 }}</p>
            </div>
            <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wide mb-1">Total Omset</p>
                <p class="text-2xl font-extrabold text-amber-400">Rp {{ number_format($ringkasan->total_omset ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wide mb-1">Total Item Terjual</p>
                <p class="text-2xl font-extrabold text-white">{{ $laporanProduk->sum('total_qty') }}</p>
            </div>
            <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-4">
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wide mb-1">Jenis Produk Terjual</p>
                <p class="text-2xl font-extrabold text-emerald-400">{{ $laporanProduk->count() }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-5">

            {{-- TABEL REKAP PER PRODUK --}}
            <div class="col-span-2">
                <h2 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                    <i data-lucide="package" class="w-4 h-4 text-amber-500"></i>
                    Rekap Penjualan per Produk
                </h2>
                <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl overflow-hidden">
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="border-b border-slate-800 bg-[#090f1e]">
                                <th class="text-left px-4 py-3 text-slate-500 uppercase tracking-wider font-bold">#</th>
                                <th class="text-left px-4 py-3 text-slate-500 uppercase tracking-wider font-bold">Kode</th>
                                <th class="text-left px-4 py-3 text-slate-500 uppercase tracking-wider font-bold">Nama Produk</th>
                                <th class="text-right px-4 py-3 text-slate-500 uppercase tracking-wider font-bold">Harga Satuan</th>
                                <th class="text-center px-4 py-3 text-slate-500 uppercase tracking-wider font-bold">Qty Keluar</th>
                                <th class="text-right px-4 py-3 text-slate-500 uppercase tracking-wider font-bold">Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50">
                            @forelse($laporanProduk as $i => $item)
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="px-4 py-3 text-slate-500">{{ $i + 1 }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-mono text-amber-400 bg-amber-500/10 border border-amber-500/20 px-2 py-0.5 rounded-lg text-[10px] font-bold">
                                        {{ $item->kode_produk }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-white font-semibold">{{ $item->nama_produk }}</td>
                                <td class="px-4 py-3 text-right text-slate-400">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="bg-blue-500/10 border border-blue-500/20 text-blue-400 font-bold px-2.5 py-1 rounded-lg">
                                        {{ $item->total_qty }} item
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-extrabold text-white">
                                    Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-slate-500">
                                    <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 text-slate-700"></i>
                                    <p>Tidak ada data transaksi pada periode ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($laporanProduk->count() > 0)
                        <tfoot>
                            <tr class="border-t-2 border-slate-700 bg-[#090f1e]">
                                <td colspan="4" class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-wide">Total Keseluruhan</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="bg-blue-500/20 text-blue-300 font-extrabold px-2.5 py-1 rounded-lg">
                                        {{ $laporanProduk->sum('total_qty') }} item
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right text-amber-400 font-extrabold text-sm">
                                    Rp {{ number_format($laporanProduk->sum('total_pendapatan'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            {{-- REKAP PER KASIR --}}
            <div>
                <h2 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4 text-amber-500"></i>
                    Kinerja per Kasir
                </h2>
                <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl overflow-hidden">
                    @forelse($perKasir as $kasir)
                    <div class="px-4 py-4 border-b border-slate-800/50 last:border-0">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-500 font-bold text-xs shrink-0">
                                {{ strtoupper(substr($kasir->nama_kasir, 0, 1)) }}
                            </div>
                            <p class="text-white font-semibold text-xs">{{ $kasir->nama_kasir }}</p>
                        </div>
                        <div class="pl-11 space-y-1">
                            <div class="flex justify-between text-[11px]">
                                <span class="text-slate-500">Transaksi</span>
                                <span class="text-slate-300 font-bold">{{ $kasir->total_trx }}x</span>
                            </div>
                            <div class="flex justify-between text-[11px]">
                                <span class="text-slate-500">Total Omset</span>
                                <span class="text-emerald-400 font-extrabold">Rp {{ number_format($kasir->total_omset, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-4 py-8 text-center text-slate-500 text-xs">Tidak ada data.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>
</div>

<script>
lucide.createIcons();
function toggleDropdown(id, iconId) {
    const el   = document.getElementById(id);
    const icon = document.getElementById(iconId);
    const isOpen = el.style.maxHeight && el.style.maxHeight !== '0px';
    el.style.maxHeight = isOpen ? '0px' : el.scrollHeight + 'px';
    icon.style.transform = isOpen ? '' : 'rotate(180deg)';
}
</script>
</body>
</html>