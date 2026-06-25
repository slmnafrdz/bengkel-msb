<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - EDIT PRODUK</title>

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

    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between bg-gradient-to-r from-[#1e293b] to-[#111827] border border-slate-800 rounded-2xl p-6 shadow-xl relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 opacity-5 text-white pointer-events-none">
                <i data-lucide="edit" class="w-32 h-32"></i>
            </div>
            <div class="relative z-10">
                <h2 class="text-xl font-extrabold text-white tracking-wide mb-1 flex items-center gap-2">
                    <span class="w-1 h-5 bg-amber-500 rounded-full"></span>
                    Edit Data Produk
                </h2>
                <p class="text-xs text-slate-400">Perbarui informasi spesifikasi stok atau harga untuk kode <span class="text-amber-400 font-mono font-bold">{{ $product->kode_produk }}</span>.</p>
            </div>

            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition cursor-pointer relative z-10">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Batal
            </a>
        </div>

        <div class="bg-[#111827] border border-slate-800 rounded-2xl shadow-xl p-6 md:p-8">
            <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="space-y-2 md:col-span-1">
                        <label class="text-xs font-semibold text-slate-400 tracking-wide block">Kode Produk</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-600">
                                <i data-lucide="binary" class="w-4 h-4"></i>
                            </div>
                            <input type="text" name="kode_produk" value="{{ old('kode_produk', $product->kode_produk) }}" readonly
                                class="w-full text-xs bg-[#0f172a]/50 text-slate-500 pl-9 pr-4 py-3 border border-slate-800 rounded-xl cursor-not-allowed font-mono font-semibold focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-semibold text-slate-300 tracking-wide block">Nama Produk</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required
                                class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-slate-300 tracking-wide block">Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="tag" class="w-4 h-4"></i>
                        </div>
                        <select name="category_id" required
                            class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition appearance-none cursor-pointer">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" class="bg-[#111827] text-slate-200" 
                                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-800/60 my-2">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-slate-300 tracking-wide block">Jumlah Stok</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <i data-lucide="boxes" class="w-4 h-4"></i>
                            </div>
                            <input type="number" name="stok" value="{{ old('stok', $product->stok) }}" min="0" required
                                class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-slate-300 tracking-wide block">Minimum Stok</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                            </div>
                            <input type="number" name="minimum_stok" value="{{ old('minimum_stok', $product->minimum_stok) }}" min="0" required
                                class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition">
                        </div>
                    </div>
                </div>

                <hr class="border-slate-800/60 my-2">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-slate-300 tracking-wide block">Harga Beli</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 font-mono font-bold text-xs">
                                Rp
                            </div>
                            <input type="number" name="harga_beli" value="{{ old('harga_beli', (int)$product->harga_beli) }}" min="0" required
                                class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition font-mono">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-slate-300 tracking-wide block">Harga Jual</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-400 font-mono font-bold text-xs">
                                Rp
                            </div>
                            <input type="number" name="harga_jual" value="{{ old('harga_jual', (int)$product->harga_jual) }}" min="0" required
                                class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition font-mono font-bold text-emerald-400">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-bold rounded-xl text-xs shadow-lg shadow-amber-500/10 hover:shadow-amber-500/30 hover:scale-[1.01] transition duration-200 cursor-pointer">
                        <i data-lucide="refresh-cw" class="w-4 h-4 stroke-[2.5]"></i>
                        Perbarui Data Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>

</html>