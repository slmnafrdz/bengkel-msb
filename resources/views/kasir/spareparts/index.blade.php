<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - STOK SPAREPART</title>

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

                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-amber-500/10">
                        <i data-lucide="box" class="w-4 h-4"></i>
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

            <header class="flex items-center justify-between mb-6 bg-[#111827]/40 border border-slate-800/60 rounded-2xl px-5 py-4 backdrop-blur-md">
                <div>
                    <h1 class="text-lg font-extrabold text-white">Stok Sparepart</h1>
                    <p class="text-xs text-slate-400">Data real-time ketersediaan sparepart di bengkel.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 relative z-10">
                    <a href="/kasir/dashboard" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition cursor-pointer">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                </div>
            </header>

            <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl overflow-hidden backdrop-blur-md shadow-xl">
                
                <div class="p-4 border-b border-slate-800/60 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-slate-900/20">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-500">Daftar Produk & Sparepart</span>
                    
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        </span>
                        <input type="text" 
                               id="search-sparepart" 
                               class="w-full bg-slate-900 border border-slate-700/80 rounded-xl py-1.5 pl-9 pr-4 text-white text-xs focus:outline-none focus:border-amber-500 placeholder-slate-500 transition" 
                               placeholder="Cari kode, nama, atau kategori...">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-800 bg-[#0f172a]/50 text-white text-[10px] uppercase tracking-wider font-bold">
                                <th class="py-4 px-5 text-center w-16">No</th>
                                <th class="py-4 px-4 w-32">Kode</th>
                                <th class="py-4 px-4">Nama Produk</th>
                                <th class="py-4 px-4">Kategori</th>
                                <th class="py-4 px-4 text-center w-36">Stok</th>
                                <th class="py-4 px-5 text-center w-40">Status</th>
                            </tr>
                        </thead>
                        <tbody id="table-sparepart" class="divide-y divide-slate-800/50 text-slate-300 text-xs">
                            @forelse($spareparts as $index => $item)
                            <tr class="sparepart-row hover:bg-slate-800/30 transition">
                                <td class="py-4 px-5 text-center font-medium text-slate-500">
                                    {{ $spareparts->firstItem() + $index }}
                                </td>
                                <td class="py-4 px-4 font-mono font-semibold text-amber-500">
                                    {{ $item->kode_produk }}
                                </td>
                                <td class="py-4 px-4 font-bold text-white">
                                    {{ $item->nama_produk }}
                                </td>
                                <td class="py-4 px-4 text-slate-400">
                                    {{ $item->category->nama_kategori ?? $item->category->name ?? 'Tanpa Kategori' }}
                                </td>
                                <td class="py-4 px-4 text-center font-bold text-white">
                                    {{ $item->stok }}
                                </td>
                                <td class="py-4 px-5 text-center">
                                    @if($item->stok == 0)
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase bg-rose-600/20 text-rose-400 border border-rose-500/20">Habis</span>
                                    @elseif($item->stok <= $item->minimum_stok)
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase bg-amber-500/10 text-amber-400 border border-amber-500/20">Menipis</span>
                                    @else
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr id="empty-row">
                                <td colspan="6" class="py-8 text-center text-slate-500 font-medium">Belum ada data sparepart yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($spareparts->hasPages())
                <div id="pagination-container" class="p-4 border-t border-slate-800/60 bg-slate-900/10">
                    {{ $spareparts->links() }}
                </div>
                @endif
            </div>

            <footer class="mt-10 text-center flex flex-col sm:flex-row items-center justify-between gap-2 text-slate-500 text-[11px] border-t border-slate-800/40 pt-5">
                <p>&copy; 2026 Bengkel MSB. All rights reserved.</p>
                <p class="font-semibold text-slate-600">v2.0.4 Premium</p>
            </footer>
        </main>
    </div>

    <script>
        // Memastikan ikon dirender otomatis
        lucide.createIcons();

        // LOGIKA PENYARINGAN LIVE SEARCH (CLIENT-SIDE)
        document.getElementById('search-sparepart').addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.sparepart-row');
            const pagination = document.getElementById('pagination-container');
            let foundAny = false;

            rows.forEach(row => {
                // Mengambil nilai text dari kolom Kode, Nama, dan Kategori
                const kode = row.cells[1].textContent.toLowerCase();
                const nama = row.cells[2].textContent.toLowerCase();
                const kategori = row.cells[3].textContent.toLowerCase();

                if (kode.includes(keyword) || nama.includes(keyword) || kategori.includes(keyword)) {
                    row.style.display = "";
                    foundAny = true;
                } else {
                    row.style.display = "none";
                }
            });

            // Menyembunyikan link pagination jika user sedang mengetik pencarian agar tidak membingungkan
            if (pagination) {
                pagination.style.display = keyword === "" ? "" : "none";
            }

            // Atur baris "Data tidak ditemukan" secara dinamis jika tidak ada yang cocok
            let noResultRow = document.getElementById('no-search-result');
            if (!foundAny && keyword !== "") {
                if (!noResultRow) {
                    const tbody = document.getElementById('table-sparepart');
                    noResultRow = document.createElement('tr');
                    noResultRow.id = 'no-search-result';
                    noResultRow.innerHTML = `<td colspan="6" class="py-8 text-center text-slate-500 font-medium">🔍 Sparepart dengan kata kunci "${this.value}" tidak ditemukan.</td>`;
                    tbody.appendChild(noResultRow);
                }
            } else if (noResultRow) {
                noResultRow.remove();
            }
        });
    </script>
</body>

</html>