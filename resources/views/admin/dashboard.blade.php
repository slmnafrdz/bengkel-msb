<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - ADMIN PREMIUM</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', Arial, sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #f59e0b; }
    </style>
</head>
<body class="bg-[#0b0f19] text-slate-200 antialiased selection:bg-amber-500 selection:text-black">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#111827] border-r border-slate-800 flex flex-col justify-between p-5 shrink-0 shadow-xl">
        <div>
            <div class="flex items-center gap-3 px-2 py-3 border-b border-slate-800 mb-6">
                <div class="p-2 bg-amber-500 rounded-lg text-black shadow-lg shadow-amber-500/20 animate-pulse">
                    <i data-lucide="wrench" class="w-5 h-5 stroke-[2.5]"></i>
                </div>
                <div>
                    <h2 class="font-black text-sm tracking-wider text-white leading-tight">BENGKEL MSB</h2>
                    <span class="text-[10px] text-amber-500 font-bold tracking-widest block mt-0.5">PERFORMANCE ADMIN</span>
                </div>
            </div>
            <nav class="space-y-2">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-semibold rounded-xl text-sm shadow-lg shadow-amber-500/10 transition duration-200">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 stroke-[2.5]"></i>
                    Dashboard
                </a>
                <div class="space-y-1">
                    <button onclick="toggleDropdown('menu-master', 'icon-master')" class="w-full flex items-center justify-between px-3 py-2.5 text-slate-400 hover:bg-slate-800/60 hover:text-white rounded-xl text-sm font-medium transition cursor-pointer group">
                        <div class="flex items-center gap-3">
                            <i data-lucide="database" class="w-4 h-4 text-slate-500 group-hover:text-amber-500 transition"></i>
                            <span>Master Data</span>
                        </div>
                        <i id="icon-master" data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200"></i>
                    </button>
                    <div id="menu-master" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-[#0f172a]/40 rounded-xl pl-4 space-y-1">
                        <a href="/admin/products" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="box" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Produk
                        </a>
                        <a href="/admin/categories" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="tag" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Kategori
                        </a>
                        <a href="/admin/spareparts" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="settings" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Sparepart
                        </a>
                    </div>
                </div>
                <div class="space-y-1">
                    <button onclick="toggleDropdown('menu-laporan', 'icon-laporan')" class="w-full flex items-center justify-between px-3 py-2.5 text-slate-400 hover:bg-slate-800/60 hover:text-white rounded-xl text-sm font-medium transition cursor-pointer group">
                        <div class="flex items-center gap-3">
                            <i data-lucide="folder-open" class="w-4 h-4 text-slate-500 group-hover:text-amber-500 transition"></i>
                            <span>Laporan</span>
                        </div>
                        <i id="icon-laporan" data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200"></i>
                    </button>
                    <div id="menu-laporan" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-[#0f172a]/40 rounded-xl pl-4 space-y-1">
                        <a href="/admin/laporan-transaksi" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Laporan Transaksi
                        </a>
                        <a href="/admin/struk-penjualan" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="printer" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Struk Penjualan
                        </a>
                        <a href="/admin/rekap-pendapatan" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="trending-up" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Rekap Pendapatan
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

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-6 overflow-y-auto bg-[#0b0f19]">

        {{-- HEADER --}}
        <div class="flex justify-between items-center bg-[#111827] border border-slate-800 px-6 py-4 rounded-2xl shadow-md w-full mb-6">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Overview System</span>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-slate-300 font-medium text-xs bg-[#0f172a] border border-slate-800 px-4 py-2 rounded-xl shadow-inner select-none">
                    <i data-lucide="calendar" class="w-4 h-4 text-amber-500"></i>
                    <span id="live-clock" class="tracking-wide">Memuat waktu...</span>
                </div>
                <div class="w-px h-6 bg-slate-800"></div>
                <div class="relative" id="admin-profile-container">
                    <button id="btn-dropdown-admin" class="flex items-center gap-3 text-xs font-semibold text-slate-200 hover:text-white transition cursor-pointer group focus:outline-none select-none">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-black font-bold shadow-md">
                            <i data-lucide="user" class="w-4 h-4 stroke-[2.5]"></i>
                        </div>
                        <span class="hidden sm:inline-block">Admin Bengkel</span>
                        <i data-lucide="chevron-down" id="icon-chevron" class="w-4 h-4 text-slate-500 transition duration-200"></i>
                    </button>
                    <div id="dropdown-admin-menu" class="hidden absolute right-0 mt-3 w-48 bg-[#111827] border border-slate-800 rounded-xl shadow-xl py-2 z-50">
                        <div class="px-4 py-2 border-b border-slate-800/60 mb-1">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Log Masuk Sebagai</p>
                            <p class="text-xs font-semibold text-amber-400 truncate">{{ Auth::user()->email ?? 'admin@bengkel.com' }}</p>
                        </div>
                        <a href="/logout" class="flex items-center gap-2 px-4 py-2.5 text-xs text-rose-400 hover:bg-rose-500/10 transition font-bold">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- WELCOME BANNER --}}
        <div class="bg-gradient-to-r from-[#1e293b] to-[#111827] border border-slate-800 rounded-2xl p-6 mb-6 relative flex justify-between items-center shadow-xl overflow-hidden">
            <div class="absolute -right-10 -bottom-10 opacity-5 text-white pointer-events-none">
                <i data-lucide="wrench" class="w-40 h-40"></i>
            </div>
            <div class="relative z-10">
                <h3 class="text-lg font-bold text-white mb-1">Selamat datang kembali, Chief Mechanic! 🏎️</h3>
                <p class="text-xs text-slate-400">Sistem POS Anda terpantau stabil. Berikut ringkasan aktivitas bengkel hari ini.</p>
            </div>
            <div class="flex items-center gap-2 relative z-10">
                <div class="text-xs font-semibold border border-slate-700 rounded-xl px-3 py-2 bg-[#0f172a] text-amber-500 flex items-center gap-1.5 shadow-inner">
                    <i data-lucide="clock" class="w-3.5 h-3.5 animate-pulse"></i>
                    <span id="live-time-counter">00:00:00</span>
                </div>
            </div>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <div class="bg-[#111827] border border-slate-800 hover:border-slate-700 rounded-2xl p-4 flex justify-between items-start shadow-lg transition group">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Trx Hari Ini</p>
                    <h4 class="text-xl font-extrabold text-white group-hover:text-amber-500 transition">{{ $transaksiHariIni }}</h4>
                </div>
                <div class="text-slate-600 bg-slate-800/40 p-1.5 rounded-lg"><i data-lucide="file-text" class="w-4 h-4 stroke-[2]"></i></div>
            </div>
            <div class="bg-[#111827] border border-slate-800 hover:border-slate-700 rounded-2xl p-4 flex justify-between items-start shadow-lg transition group">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Omset Hari Ini</p>
                    <h4 class="text-lg font-extrabold text-emerald-400">Rp {{ number_format($pendapatanHariIni,0,',','.') }}</h4>
                </div>
                <div class="text-emerald-500/40 bg-emerald-500/5 p-1.5 rounded-lg"><i data-lucide="coins" class="w-4 h-4 stroke-[2]"></i></div>
            </div>
            <div class="bg-[#111827] border border-slate-800 hover:border-slate-700 rounded-2xl p-4 flex justify-between items-start shadow-lg transition group">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Trx Mingguan</p>
                    <h4 class="text-xl font-extrabold text-white group-hover:text-amber-500 transition">{{ $transaksiMingguan }}</h4>
                </div>
                <div class="text-slate-600 bg-slate-800/40 p-1.5 rounded-lg"><i data-lucide="line-chart" class="w-4 h-4 stroke-[2]"></i></div>
            </div>
            <div class="bg-[#111827] border border-slate-800 hover:border-slate-700 rounded-2xl p-4 flex justify-between items-start shadow-lg transition group">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Omset Mingguan</p>
                    <h4 class="text-lg font-extrabold text-white">Rp {{ number_format($pendapatanMingguan,0,',','.') }}</h4>
                </div>
                <div class="text-slate-600 bg-slate-800/40 p-1.5 rounded-lg"><i data-lucide="coins" class="w-4 h-4 stroke-[2]"></i></div>
            </div>
            <div class="bg-[#111827] border border-slate-800 hover:border-slate-700 rounded-2xl p-4 flex justify-between items-start shadow-lg transition group">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Trx Bulanan</p>
                    <h4 class="text-xl font-extrabold text-white group-hover:text-amber-500 transition">{{ $transaksiBulanan }}</h4>
                </div>
                <div class="text-slate-600 bg-slate-800/40 p-1.5 rounded-lg"><i data-lucide="bar-chart-3" class="w-4 h-4 stroke-[2]"></i></div>
            </div>
            <div class="bg-[#111827] border border-slate-800 hover:border-slate-700 rounded-2xl p-4 flex justify-between items-start shadow-lg transition group">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Omset Bulanan</p>
                    <h4 class="text-lg font-extrabold text-amber-400">Rp {{ number_format($pendapatanBulanan,0,',','.') }}</h4>
                </div>
                <div class="text-amber-500/20 bg-amber-500/5 p-1.5 rounded-lg"><i data-lucide="coins" class="w-4 h-4 stroke-[2]"></i></div>
            </div>
        </div>

        {{-- ROW 1: GRAFIK + TRANSAKSI TERAKHIR --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-5">

            {{-- GRAFIK --}}
            <div class="lg:col-span-7 bg-[#111827] border border-slate-800 rounded-2xl p-5 shadow-xl">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-4 bg-amber-500 rounded-full"></span>
                        <h3 class="font-bold text-white text-sm tracking-wide">Statistik Grafik Penjualan</h3>
                    </div>
                    <div class="flex gap-1.5">
                        <button onclick="gantiGrafik('harian')" id="btn-harian" class="grafik-btn text-xs font-bold px-3 py-1.5 rounded-xl border transition">Hari</button>
                        <button onclick="gantiGrafik('mingguan')" id="btn-mingguan" class="grafik-btn text-xs font-bold px-3 py-1.5 rounded-xl border transition">Minggu</button>
                        <button onclick="gantiGrafik('bulanan')" id="btn-bulanan" class="grafik-btn text-xs font-bold px-3 py-1.5 rounded-xl border transition">Bulan</button>
                    </div>
                </div>
                <div id="grafik-container" class="h-48 flex items-end justify-between gap-1 px-2 border-b border-l border-slate-800"></div>
                <div id="grafik-labels" class="flex justify-between gap-1 px-2 mt-2"></div>
            </div>

            {{-- LIVE TRANSAKSI --}}
            <div class="lg:col-span-5 bg-[#111827] border border-slate-800 rounded-2xl p-5 flex flex-col shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-4 bg-amber-500 rounded-full"></span>
                        <h3 class="font-bold text-white text-sm tracking-wide">Live Transaksi Terakhir</h3>
                    </div>
                    <a href="/riwayat-transaksi" class="text-[11px] font-bold text-slate-400 border border-slate-700 hover:bg-slate-800 rounded-xl px-3 py-1.5 uppercase transition">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto flex-1">
                    @if($lastTransactions->count())
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="border-b border-slate-800 text-slate-500 uppercase tracking-wider">
                                <th class="text-left py-2.5 font-bold">Invoice Code</th>
                                <th class="text-right py-2.5 font-bold">Total Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40">
                            @foreach($lastTransactions as $trx)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="py-3 text-slate-300 font-mono font-medium tracking-wide">{{ $trx->no_nota }}</td>
                                <td class="py-3 text-right text-white font-bold">Rp {{ number_format($trx->total,0,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="flex flex-col justify-center items-center py-12">
                        <div class="p-3 bg-slate-800/40 text-slate-600 rounded-2xl mb-3">
                            <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                        </div>
                        <p class="text-xs text-slate-500">Antrean transaksi masih kosong</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ROW 2: STOK + KATEGORI --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-6">

            {{-- STOK MENIPIS --}}
            <div class="lg:col-span-6 bg-[#111827] border border-slate-800 rounded-2xl p-5 flex flex-col shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span>
                        <h3 class="font-bold text-white text-sm tracking-wide">Peringatan Batas Stok Sparepart</h3>
                    </div>
                    <a href="/admin/spareparts" class="text-[11px] font-bold text-slate-400 border border-slate-700 hover:bg-slate-800 rounded-xl px-3 py-1.5 uppercase transition">Lihat Semua</a>
                </div>
                <div class="flex-1">
                    @if($stokMenipis->count())
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="border-b border-slate-800 text-slate-500 uppercase tracking-wider">
                                <th class="text-left py-2 font-bold">Nama Onderdil / Part</th>
                                <th class="text-center py-2 font-bold w-20">Sisa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40">
                            @foreach($stokMenipis as $item)
                            <tr class="hover:bg-slate-800/20 transition">
                                <td class="py-2.5 text-slate-300 font-medium">{{ $item->nama_produk }}</td>
                                <td class="py-2.5 text-center">
                                    <span class="inline-block px-2 py-0.5 bg-red-500/10 text-red-400 border border-red-500/20 font-bold rounded-md">{{ $item->stok }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="flex flex-col justify-center items-center py-12">
                        <div class="p-3 bg-emerald-500/10 text-emerald-400 rounded-2xl mb-2">
                            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                        </div>
                        <p class="text-xs text-slate-400 font-medium">Gudang Aman. Semua item terisi penuh.</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- KATEGORI PALING LARIS --}}
            <div class="lg:col-span-6 bg-[#111827] border border-slate-800 rounded-2xl p-5 flex flex-col shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-4 bg-amber-500 rounded-full"></span>
                        <h3 class="font-bold text-white text-sm tracking-wide">Kategori Paling Laris</h3>
                    </div>
                </div>
                <div class="flex-1 flex flex-col justify-center items-center min-h-[160px]">
                    <div class="p-3 bg-slate-800/50 text-slate-600 rounded-2xl mb-2">
                        <i data-lucide="pie-chart" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs text-slate-500">Data analisis kategori belum tersedia</p>
                </div>
            </div>

        </div>

        {{-- FOOTER --}}
        <footer class="mt-6 text-center text-[11px] text-slate-600 tracking-wider">
            © 2026 BENGKEL MSB PERFORMANCE POS. GLOBAL ADMINISTRATION ENGINE.
        </footer>

    </main>
</div>

{{-- SEMUA SCRIPT DI BAWAH --}}
<script>
    lucide.createIcons();

    function toggleDropdown(menuId, iconId) {
        const menu = document.getElementById(menuId);
        const icon = document.getElementById(iconId);
        if (menu.style.maxHeight === "0px" || !menu.style.maxHeight) {
            menu.style.maxHeight = menu.scrollHeight + "px";
            icon.style.transform = "rotate(180deg)";
        } else {
            menu.style.maxHeight = "0px";
            icon.style.transform = "rotate(0deg)";
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById('menu-master').style.maxHeight = "0px";
        document.getElementById('menu-laporan').style.maxHeight = "0px";

        // JAM HEADER
        function jalankanJam() {
            const now = new Date();
            const tgl = now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            const jam = String(now.getHours()).padStart(2,'0');
            const menit = String(now.getMinutes()).padStart(2,'0');
            const detik = String(now.getSeconds()).padStart(2,'0');
            const el = document.getElementById('live-clock');
            if (el) el.innerText = `${tgl} | ${jam}:${menit}:${detik}`;
        }
        jalankanJam();
        setInterval(jalankanJam, 1000);

        // JAM WELCOME BAR
        function jalankanJamWelcome() {
            const now = new Date();
            const j = String(now.getHours()).padStart(2,'0');
            const m = String(now.getMinutes()).padStart(2,'0');
            const d = String(now.getSeconds()).padStart(2,'0');
            const el = document.getElementById('live-time-counter');
            if (el) el.innerText = `${j}:${m}:${d}`;
        }
        jalankanJamWelcome();
        setInterval(jalankanJamWelcome, 1000);

        // DROPDOWN ADMIN
        const btnDropdown = document.getElementById('btn-dropdown-admin');
        const menuDropdown = document.getElementById('dropdown-admin-menu');
        const iconChevron = document.getElementById('icon-chevron');
        if (btnDropdown && menuDropdown) {
            btnDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                menuDropdown.classList.toggle('hidden');
                iconChevron.classList.toggle('rotate-180');
            });
            window.addEventListener('click', function() {
                menuDropdown.classList.add('hidden');
                iconChevron.classList.remove('rotate-180');
            });
        }

        // GRAFIK
        document.querySelectorAll('.grafik-btn').forEach(btn => {
            btn.classList.add('text-slate-400', 'border-slate-700', 'bg-transparent');
        });
        gantiGrafik('harian');
    });

    // DATA GRAFIK
    const dataGrafik = {
        harian: <?php echo json_encode(array_values($dataGrafikHarian)); ?>,
        mingguan: <?php echo json_encode(array_values($dataGrafikMingguan)); ?>,
        bulanan: <?php echo json_encode(array_values($dataGrafikBulanan)); ?>
    };

    function gantiGrafik(periode) {
        const data = dataGrafik[periode];
        const container = document.getElementById('grafik-container');
        const labels = document.getElementById('grafik-labels');

        document.querySelectorAll('.grafik-btn').forEach(btn => {
            btn.classList.remove('bg-amber-500', 'text-black', 'border-amber-500');
            btn.classList.add('text-slate-400', 'border-slate-700', 'bg-transparent');
        });
        const btnAktif = document.getElementById('btn-' + periode);
        btnAktif.classList.add('bg-amber-500', 'text-black', 'border-amber-500');
        btnAktif.classList.remove('text-slate-400', 'border-slate-700', 'bg-transparent');

        if (!data || data.length === 0) {
            container.innerHTML = `<div class="w-full h-full flex items-center justify-center text-xs text-slate-500">Belum ada data penjualan periode ini.</div>`;
            labels.innerHTML = '';
            return;
        }

        const maxTotal = Math.max(...data.map(d => d.total));
        container.innerHTML = data.map(d => {
            let persen = maxTotal > 0 ? (d.total / maxTotal) * 100 : 0;
            if (d.total > 0 && persen < 5) persen = 5;
            const nominal = 'Rp ' + d.total.toLocaleString('id-ID');
            return `
                <div class="flex-1 flex flex-col items-center group relative h-full justify-end">
                    <div class="absolute bottom-full mb-2 hidden group-hover:flex bg-slate-900 border border-slate-700 text-amber-400 text-[10px] font-bold rounded-lg px-2.5 py-1.5 whitespace-nowrap z-20 shadow-2xl">
                        ${nominal}
                    </div>
                    <div style="height:${persen}%; transition: height 0.5s ease"
                        class="w-full max-w-[28px] bg-gradient-to-t from-amber-600 to-amber-400 hover:from-orange-500 hover:to-amber-300 rounded-t-md cursor-pointer">
                    </div>
                </div>`;
        }).join('');

        labels.innerHTML = data.map(d =>
            `<div class="flex-1 text-center text-[9px] text-slate-500 font-medium truncate">${d.label}</div>`
        ).join('');
    }
</script>

</body>
</html>