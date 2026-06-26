<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sparepart - Bengkel MSB</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0f172a]">

    <div class="p-6 min-h-screen text-slate-200">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="p-2.5 bg-[#111827] hover:bg-[#1e293b] border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white rounded-xl transition group shadow-md" title="Kembali ke Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform group-hover:-translate-x-0.5 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Data Sparepart</h1>
                    <p class="text-xs text-slate-400 mt-1">Kelola semua daftar stok suku cadang bengkel Anda.</p>
                </div>
            </div>

        </div>

        <form method="GET" class="flex flex-col sm:flex-row items-center gap-3 mb-6 bg-[#111827] border border-slate-800 p-4 rounded-2xl shadow-md">
            <div class="relative flex-1 w-full">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari kode atau nama sparepart..."
                    value="{{ request('search') }}"
                    class="w-full text-xs bg-[#1e293b] border border-slate-700 rounded-xl px-4 py-2.5 text-slate-200 placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
            </div>

            <div class="w-full sm:w-48">
                <select
                    name="status"
                    class="w-full text-xs bg-[#1e293b] border border-slate-700 rounded-xl px-3 py-2.5 text-slate-200 focus:outline-none focus:border-amber-500 cursor-pointer transition">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Hampir Habis</option>
                    <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>

            <button
                type="submit"
                class="w-full sm:w-auto text-xs font-semibold bg-slate-800 border border-slate-700 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl transition">
                Cari
            </button>
        </form>

        <div class="bg-[#111827] border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 bg-[#1f2937]/40 text-white text-xs font-semibold uppercase tracking-wider">
                            <th class="py-4 px-6 text-center w-16">No</th>
                            <th class="py-4 px-4">Kode</th>
                            <th class="py-4 px-6">Nama Produk</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-4 text-center">Stok</th>
                            <th class="py-4 px-6 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @forelse($spareparts as $item)
                        <tr class="hover:bg-[#1f2937]/30 transition group">
                            <td class="py-4 px-6 text-center text-white">{{ $loop->iteration }}</td>

                            <td class="py-4 px-4 font-mono text-amber-500 font-semibold">{{ $item->kode_produk }}</td>

                            <td class="py-4 px-6 font-medium text-white group-hover:text-amber-400 transition">{{ $item->nama_produk }}</td>

                            <td class="py-4 px-6 text-white">{{ $item->category->nama_kategori ?? '-' }}</td>

                            <td class="py-4 px-4 text-center font-semibold {{ $item->stok == 0 ? 'text-rose-500' : ($item->stok <= $item->minimum_stok ? 'text-amber-400' : 'text-slate-200') }}">
                                {{ $item->stok }}
                            </td>

                            <td class="py-4 px-6 text-center">
                                @if($item->stok == 0)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-rose-500/10 text-rose-400 font-medium border border-rose-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Habis
                                </span>
                                @elseif($item->stok <= $item->minimum_stok)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-400 font-medium border border-amber-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        Hampir Habis
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-500/10 text-emerald-400 font-medium border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Tersedia
                                    </span>
                                    @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-500 font-medium tracking-wide">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="text-2xl">📦</span>
                                    <span>Belum ada data sparepart yang cocok.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5 custom-pagination text-xs text-slate-400">
            {{ $spareparts->links() }}
        </div>

    </div>

</body>

</html>