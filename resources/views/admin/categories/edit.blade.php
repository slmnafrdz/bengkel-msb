<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - EDIT KATEGORI</title>

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

    <div class="max-w-2xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between bg-gradient-to-r from-[#1e293b] to-[#111827] border border-slate-800 rounded-2xl p-6 shadow-xl relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 opacity-5 text-white pointer-events-none">
                <i data-lucide="tag" class="w-32 h-32"></i>
            </div>
            <div class="relative z-10">
                <h2 class="text-xl font-extrabold text-white tracking-wide mb-1 flex items-center gap-2">
                    <span class="w-1 h-5 bg-amber-500 rounded-full"></span>
                    Edit Kategori
                </h2>
                <p class="text-xs text-slate-400">Perbarui informasi klasifikasi kelompok sparepart untuk kode <span class="text-amber-400 font-mono font-bold">{{ $category->kode_kategori }}</span>.</p>
            </div>

            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition cursor-pointer relative z-10">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Batal
            </a>
        </div>

        <div class="bg-[#111827] border border-slate-800 rounded-2xl shadow-xl p-6 md:p-8">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- ── Error Alert ── --}}
                @if ($errors->any())
                <div class="flex items-start gap-3 p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl text-xs text-rose-400">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5"></i>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-slate-400 tracking-wide block">Kode Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-600">
                            <i data-lucide="binary" class="w-4 h-4"></i>
                        </div>
                        <input type="text" name="kode_kategori" value="{{ old('kode_kategori', $category->kode_kategori) }}" readonly
                            class="w-full text-xs bg-[#0f172a]/50 text-slate-500 pl-9 pr-4 py-3 border border-slate-800 rounded-xl cursor-not-allowed font-mono font-semibold focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-slate-300 tracking-wide block">Nama Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="layers" class="w-4 h-4"></i>
                        </div>
                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $category->nama_kategori) }}" required
                            class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition {{ $errors->has('nama_kategori') ? 'border-rose-500 ring-1 ring-rose-500/30' : '' }}">
                        </div>
                        @error('nama_kategori')<p class="text-[11px] text-rose-400 mt-1 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3 h-3"></i>{{ $message }}</p>@enderror
                        <!-- end -->
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-slate-300 tracking-wide block">Deskripsi Kategori</label>
                    <div class="relative">
                        <div class="absolute left-3 top-3 pointer-events-none text-slate-500">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                        </div>
                        <textarea name="deskripsi" rows="4" class="w-full text-xs bg-[#0f172a] text-slate-200 pl-9 pr-4 py-3 border border-slate-700/60 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition resize-none">{{ old('deskripsi', $category->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-bold rounded-xl text-xs shadow-lg shadow-amber-500/10 hover:shadow-amber-500/30 hover:scale-[1.01] transition duration-200 cursor-pointer">
                        <i data-lucide="refresh-cw" class="w-4 h-4 stroke-[2.5]"></i>
                        Perbarui Kategori
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