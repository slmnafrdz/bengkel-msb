<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Bengkel MSB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
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
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-semibold rounded-xl text-sm shadow-lg shadow-amber-500/10 transition">
                    <i data-lucide="users" class="w-4 h-4 stroke-[2.5]"></i>
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
                            <i data-lucide="folder-open" class="w-4 h-4 text-slate-500 group-hover:text-amber-500 transition"></i>
                            <span>Laporan</span>
                        </div>
                        <i id="icon-laporan" data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200"></i>
                    </button>
                    <div id="menu-laporan" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-[#0f172a]/40 rounded-xl pl-4 space-y-1">
                        <a href="{{ route('admin.transaksi.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Riwayat Transaksi
                        </a>
                        <a href="{{ route('admin.transaksi.laporan') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400 hover:text-white transition rounded-lg group">
                            <i data-lucide="bar-chart-2" class="w-3.5 h-3.5 text-slate-600 group-hover:text-amber-500"></i>Laporan Transaksi
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
        <div class="max-w-lg mx-auto">

            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('admin.users.index') }}"
                   class="p-2 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-xl text-slate-400 hover:text-white transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <div>
                    <h1 class="text-xl font-extrabold text-white">Tambah User Baru</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Buat akun admin atau kasir baru.</p>
                </div>
            </div>

            @if($errors->any())
            <div class="mb-4 p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl text-xs text-rose-400 space-y-1">
                @foreach($errors->all() as $e)
                <div class="flex items-center gap-2"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $e }}</div>
                @endforeach
            </div>
            @endif

            <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl p-6 space-y-5">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso"
                                   class="w-full bg-slate-800/60 border border-slate-700/60 text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 placeholder-slate-600 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1.5 uppercase tracking-wide">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"
                                   class="w-full bg-slate-800/60 border border-slate-700/60 text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 placeholder-slate-600 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1.5 uppercase tracking-wide">Role</label>
                            <select name="role"
                                    class="w-full bg-slate-800/60 border border-slate-700/60 text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition">
                                <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1.5 uppercase tracking-wide">Password</label>
                            <input type="password" name="password" placeholder="Minimal 6 karakter"
                                   class="w-full bg-slate-800/60 border border-slate-700/60 text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 placeholder-slate-600 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1.5 uppercase tracking-wide">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi password"
                                   class="w-full bg-slate-800/60 border border-slate-700/60 text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 placeholder-slate-600 transition">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                    class="flex-1 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-bold rounded-xl text-sm shadow-lg shadow-amber-500/20 hover:scale-[1.01] transition">
                                Simpan User
                            </button>
                            <a href="{{ route('admin.users.index') }}"
                               class="px-5 py-3 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 font-semibold rounded-xl text-sm transition">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
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
</script>
</body>
</html>