<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - DATA PRODUK</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        }
    </style>
</head>

<body class="bg-[#0b0f19] text-slate-200 antialiased p-6">

    <div class="space-y-6 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gradient-to-r from-[#1e293b] to-[#111827] border border-slate-800 rounded-2xl p-6 shadow-xl relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 opacity-5 text-white pointer-events-none">
                <i data-lucide="package" class="w-32 h-32"></i>
            </div>
            <div class="relative z-10">
                <h2 class="text-xl font-extrabold text-white tracking-wide mb-1 flex items-center gap-2">
                    <span class="w-1 h-5 bg-amber-500 rounded-full"></span>
                    Manajemen Data Produk
                </h2>
                <p class="text-xs text-slate-400">Kelola informasi produk, stok, dan harga jual sparepart bengkel Anda.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3 relative z-10">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition cursor-pointer">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </a>

                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-semibold rounded-xl text-xs shadow-lg shadow-amber-500/10 hover:shadow-amber-500/30 hover:scale-[1.02] transition duration-200 cursor-pointer">
                    <i data-lucide="plus-circle" class="w-4 h-4 stroke-[2.5]"></i>
                    Tambah Produk
                </a>
            </div>
        </div>

        <div class="bg-[#111827] border border-slate-800 rounded-2xl p-4 shadow-lg">
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari kode atau nama produk..."
                        value="{{ request('search') }}"
                        class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-2.5 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition placeholder:text-slate-500">
                </div>
                <button type="submit" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition cursor-pointer flex items-center justify-center gap-2">
                    Filter Data
                </button>
                @if(request('search'))
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2.5 bg-red-950/20 hover:bg-red-950/40 text-red-400 text-xs font-semibold rounded-xl border border-red-900/30 transition flex items-center justify-center">
                    Reset
                </a>
                @endif
            </form>
        </div>

        <div class="bg-[#111827] border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 bg-[#0f172a]/50 text-white text-[10px] uppercase tracking-wider font-bold">
                            <th class="py-4 px-5 text-center w-16">No</th>
                            <th class="py-4 px-4 w-32">Kode</th>
                            <th class="py-4 px-4">Nama Produk</th>
                            <th class="py-4 px-4">Kategori</th>
                            <th class="py-4 px-4 text-center w-36">Stok</th>
                            <th class="py-4 px-4 text-right w-40">Harga Jual</th>
                            <th class="py-4 px-5 text-center w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/40 text-xs">
                        @forelse($products as $item)
                        <tr class="hover:bg-slate-800/30 transition group">
                            <td class="py-3.5 px-5 text-center font-medium text-white">{{ $loop->iteration }}</td>
                            <td class="py-3.5 px-4 font-mono font-semibold text-white">{{ $item->kode_produk }}</td>
                            <td class="py-3.5 px-4 font-semibold text-white group-hover:text-amber-400 transition">{{ $item->nama_produk }}</td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700/50 text-slate-300 font-medium tracking-wide">
                                    {{ optional($item->category)->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($item->stok <= 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-950/40 text-red-400 border border-red-900/40 font-bold text-[11px]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Habis
                                    </span>
                                    @elseif($item->stok <= 3)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-950/40 text-amber-400 border border-amber-900/40 font-semibold text-[11px]">
                                        {{ $item->stok }} <span class="text-[10px] text-amber-500/80">(Kritis)</span>
                                        </span>
                                        @else
                                        <span class="font-bold text-slate-200 bg-slate-800/40 border border-slate-800 px-2.5 py-1 rounded-lg">{{ $item->stok }}</span>
                                        @endif
                            </td>
                            <td class="py-3.5 px-4 text-right font-mono font-bold text-emerald-400">
                                Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $item->id) }}" class="p-2 bg-slate-800/60 hover:bg-amber-500 hover:text-black border border-slate-700/60 hover:border-amber-400 text-slate-300 rounded-xl transition shadow-sm cursor-pointer" title="Edit Produk">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-800/60 hover:bg-red-500/20 hover:text-red-400 border border-slate-700/60 hover:border-red-500/30 text-slate-400 rounded-xl transition shadow-sm cursor-pointer" title="Hapus Produk">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <div class="p-3 bg-slate-800/40 text-slate-600 rounded-2xl mb-1">
                                        <i data-lucide="package" class="w-6 h-6"></i>
                                    </div>
                                    <p class="text-xs font-medium">Data produk tidak ditemukan atau masih kosong</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>

</html>