<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - KASIR PREMIUM</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0f172a] text-slate-200 antialiased min-h-screen relative overflow-x-hidden select-none">

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
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-amber-500/10">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
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

            <header class="flex items-center justify-between mb-5 bg-[#111827]/40 border border-slate-800/60 rounded-2xl px-5 py-3 backdrop-blur-md">
                <div></div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 text-xs text-slate-300 bg-[#161f30] border border-slate-700/80 px-3 py-1.5 rounded-xl font-medium">
                        <i data-lucide="calendar" class="w-3.5 h-3.5 text-amber-500"></i>
                        <span>{{ $tanggalSekarang }}</span>
                    </div>
                    <div class="flex items-center gap-2 border-l border-slate-800 pl-3">
                        <div class="w-7 h-7 bg-amber-500 rounded-full flex items-center justify-center text-slate-900 shadow-md shadow-amber-500/10">
                            <i data-lucide="user" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                        </div>
                        <span class="text-xs font-semibold text-white">Kasir Utama</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-500"></i>
                    </div>
                </div>
            </header>

            <div class="bg-gradient-to-br from-[#111827] to-[#1e293b]/50 border border-slate-800/60 rounded-2xl p-5 mb-5 relative flex justify-between items-center overflow-hidden">
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] opacity-20"></div>
                <div class="relative z-10">
                    <h3 class="text-base font-extrabold text-white mb-0.5">Selamat datang kembali, Kasir! ⚡</h3>
                    <p class="text-xs text-slate-400">Sistem kasir siap digunakan. Mari pantau aktivitas dan ringkasan penjualan hari ini.</p>
                </div>
                <button class="absolute top-3 right-3 text-slate-500 hover:text-slate-400 cursor-pointer relative z-10">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-5">

                <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-4 flex flex-col justify-between h-28 backdrop-blur-md">
                    <div class="flex justify-between items-start">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">TRX HARI INI</p>
                        <div class="text-slate-500 bg-slate-800/40 p-1.5 rounded-lg border border-slate-700/40"><i data-lucide="file-text" class="w-4 h-4 stroke-[1.5]"></i></div>
                    </div>
                    <h4 class="text-2xl font-black text-white">{{ $trxHariIni }}</h4>
                    <a href="{{ route('kasir.detail.trx_hari_ini') }}" class="text-[10px] font-bold text-slate-500 flex items-center gap-1 hover:text-amber-500 transition uppercase tracking-wide">Detail <i data-lucide="chevron-right" class="w-3 h-3"></i></a>
                </div>

                <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-4 flex flex-col justify-between h-28 backdrop-blur-md">
                    <div class="flex justify-between items-start">
                        <p class="text-[10px] font-bold text-amber-500 uppercase tracking-wider">OMSET HARI INI</p>
                        <div class="text-amber-500/80 bg-amber-500/5 p-1.5 rounded-lg border border-amber-500/10"><i data-lucide="dollar-sign" class="w-4 h-4 stroke-[1.5]"></i></div>
                    </div>
                    <h4 class="text-2xl font-black text-amber-500">Rp {{ number_format($omsetHariIni, 0, ',', '.') }}</h4>
                    <a href="{{ route('kasir.detail.omset_hari_ini') }}" class="text-[10px] font-bold text-slate-500 flex items-center gap-1 hover:text-amber-500 transition uppercase tracking-wide">Detail <i data-lucide="chevron-right" class="w-3 h-3"></i></a>
                </div>

                <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-4 flex flex-col justify-between h-28 backdrop-blur-md">
                    <div class="flex justify-between items-start">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">PRODUK TERJUAL</p>
                        <div class="text-slate-500 bg-slate-800/40 p-1.5 rounded-lg border border-slate-700/40"><i data-lucide="package" class="w-4 h-4 stroke-[1.5]"></i></div>
                    </div>
                    <h4 class="text-2xl font-black text-white">{{ $produkTerjual }} <span class="text-xs font-normal text-slate-500">Item</span></h4>
                    <a href="{{ route('kasir.detail.produk_terjual') }}" class="text-[10px] font-bold text-slate-500 flex items-center gap-1 hover:text-amber-500 transition uppercase tracking-wide">Detail <i data-lucide="chevron-right" class="w-3 h-3"></i></a>
                </div>

                <div class="bg-gradient-to-br from-[#1e293b]/70 to-[#0f172a]/90 border border-amber-500/20 rounded-2xl p-4 flex flex-col justify-between h-28 shadow-xl shadow-amber-500/[0.02]">
                    <div>
                        <p class="text-[10px] font-bold text-white uppercase tracking-wider">BUAT TRANSAKSI</p>
                        <p class="text-[9px] text-slate-400 mt-0.5">Mulai penjualan produk & sparepart baru.</p>
                    </div>
                    <a href="/transaksi" class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 text-xs font-bold py-2 px-3 rounded-xl flex items-center justify-center gap-2 hover:from-amber-600 hover:to-amber-700 transition shadow-lg shadow-amber-500/10 uppercase tracking-wider">
                        <i data-lucide="shopping-cart" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                        Mulai Kasir
                    </a>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">

                <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-5 flex flex-col min-h-[280px] backdrop-blur-md">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            <h3 class="font-bold text-white text-xs uppercase tracking-wider">Transaksi Terakhir</h3>
                        </div>
                        <a href="/riwayat-transaksi" class="text-[10px] font-bold text-slate-400 border border-slate-800 bg-slate-900/40 rounded-xl px-3 py-1.5 hover:bg-slate-800 transition uppercase tracking-wide">Lihat Semua</a>
                    </div>

                    @if($transaksiTerakhir->count() > 0)
                    <div class="flex-1 space-y-2.5 overflow-y-auto max-h-[200px] pr-1">
                        @foreach($transaksiTerakhir as $trx)
                        <div class="flex justify-between items-center bg-slate-950/40 border border-slate-800/60 p-3 rounded-xl">
                            <div>
                                <p class="text-xs font-bold text-slate-200">{{ $trx->no_nota }}</p>
                                <p class="text-[10px] text-slate-500">{{ date('H:i', strtotime($trx->created_at)) }} WIB</p>
                            </div>
                            <p class="text-xs font-black text-emerald-400">Rp {{ number_format($trx->total, 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex-1 flex flex-col justify-center items-center py-8">
                        <div class="p-4 bg-slate-900/60 border border-slate-800/60 rounded-2xl mb-3 text-slate-600">
                            <i data-lucide="receipt" class="w-6 h-6 stroke-[1.5]"></i>
                        </div>
                        <p class="text-xs text-slate-400 font-medium">Antrean transaksi hari ini masih kosong</p>
                    </div>
                    @endif
                </div>

                <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-5 flex flex-col min-h-[280px] backdrop-blur-md">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <h3 class="font-bold text-white text-xs uppercase tracking-wider">Stok Hampir Habis</h3>
                        </div>
                        <a href="/kasir/spareparts" class="text-[10px] font-bold text-slate-400 border border-slate-800 bg-slate-900/40 rounded-xl px-3 py-1.5 hover:bg-slate-800 transition uppercase tracking-wide">Lihat Semua</a>
                    </div>

                    @if($semuaPeringatanStok->count() > 0)
                    <div class="flex-1 space-y-2.5 overflow-y-auto max-h-[200px] pr-1">
                        @foreach($semuaPeringatanStok as $prod)
                        <div class="flex justify-between items-center bg-slate-950/40 border border-slate-800/60 p-3 rounded-xl">
                            <span class="text-xs font-medium text-slate-300 truncate max-w-[70%]">{{ $prod->nama_produk }}</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $prod->stok == 0 ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                                {{ $prod->stok }} Pcs
                            </span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex-1 flex flex-col justify-center items-center py-8">
                        <div class="p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-2xl mb-3 text-emerald-400/80">
                            <i data-lucide="shield-check" class="w-6 h-6 stroke-[1.5]"></i>
                        </div>
                        <p class="text-xs text-slate-400 font-medium">Semua stok produk aman dan mencukupi</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-5 relative backdrop-blur-md">
                <div class="flex items-center gap-2 mb-4 border-b border-slate-800/60 pb-2.5">
                    <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-500"></i>
                    <h3 class="font-bold text-white text-xs uppercase tracking-wider">Peringatan Batas Stok Kritis</h3>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between bg-[#161f30]/60 border border-slate-800/60 rounded-xl p-3.5">
                        <div class="flex items-center gap-3 text-xs text-slate-300 font-medium">
                            <div class="w-2 h-2 bg-amber-500 rounded-full {{ $stokHampirHabis->count() > 0 ? 'animate-pulse' : '' }}"></div>
                            <span><strong class="text-white">{{ $stokHampirHabis->count() }}</strong> item sparepart dalam kondisi hampir habis.</span>
                        </div>
                        <a href="/kasir/spareparts" class="text-[10px] font-bold text-slate-300 border border-slate-700/60 bg-[#111827]/60 hover:bg-slate-800/80 rounded-xl px-3 py-1.5 uppercase tracking-wide">Cek Stok</a>
                    </div>

                    <div class="flex items-center justify-between bg-[#161f30]/60 border border-slate-800/60 rounded-xl p-3.5">
                        <div class="flex items-center gap-3 text-xs text-slate-400 font-medium">
                            <div class="w-2 h-2 {{ $stokHabisTotal->count() > 0 ? 'bg-rose-500 animate-pulse' : 'bg-slate-600' }} rounded-full"></div>
                            <span><strong class="text-white">{{ $stokHabisTotal->count() }}</strong> item sparepart dalam kondisi habis total.</span>
                        </div>
                        <a href="/kasir/spareparts" class="text-[10px] font-bold text-slate-300 border border-slate-700/60 bg-[#111827]/60 hover:bg-slate-800/80 rounded-xl px-3 py-1.5 uppercase tracking-wide">Cek Stok</a>
                    </div>
                </div>

                <button class="absolute top-5 right-5 text-slate-500 hover:text-slate-400 cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <footer class="mt-10 text-center flex flex-col sm:flex-row items-center justify-between gap-2 text-slate-500 text-[11px] border-t border-slate-800/40 pt-5">
                <p>&copy; 2026 Bengkel MSB. All rights reserved.</p>
                <p class="font-semibold text-slate-600">v2.0.4 Premium</p>
            </footer>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>