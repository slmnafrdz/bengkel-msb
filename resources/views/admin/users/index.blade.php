<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Bengkel MSB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
                <h1 class="text-xl font-extrabold text-white">Manajemen User</h1>
                <p class="text-xs text-slate-400 mt-0.5">Kelola akun admin dan kasir bengkel.</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-black font-bold rounded-xl text-xs shadow-lg shadow-amber-500/20 hover:scale-[1.02] transition">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah User
            </a>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
        <div class="mb-4 flex items-center gap-2 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-xs font-semibold">
            <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-4 flex items-center gap-2 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-xs font-semibold">
            <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
        </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-[#0f1629]/60 border border-slate-800/60 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-800 bg-[#090f1e]">
                        <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">#</th>
                        <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                        <th class="text-left px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Dibuat</th>
                        <th class="text-center px-5 py-3.5 text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse($users as $i => $user)
                    <tr class="hover:bg-slate-800/20 transition">
                        <td class="px-5 py-4 text-slate-500 text-xs">{{ $i + 1 }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-500 font-bold text-xs">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-white text-sm">{{ $user->name }}</span>
                                @if($user->id === auth()->id())
                                <span class="text-[10px] bg-amber-500/20 text-amber-400 border border-amber-500/30 px-2 py-0.5 rounded-full font-bold">Anda</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-400 text-xs font-mono">{{ $user->email }}</td>
                        <td class="px-5 py-4">
                            @if($user->role === 'admin')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-[10px] font-bold rounded-lg uppercase tracking-wide">
                                <i data-lucide="shield" class="w-3 h-3"></i> Admin
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold rounded-lg uppercase tracking-wide">
                                <i data-lucide="user" class="w-3 h-3"></i> Kasir
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="p-2 bg-slate-800/60 hover:bg-amber-500 hover:text-black border border-slate-700/60 hover:border-amber-400 text-slate-300 rounded-xl transition shadow-sm"
                                   title="Edit User">
                                    <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="p-2 bg-slate-800/60 hover:bg-rose-500 hover:text-white border border-slate-700/60 hover:border-rose-400 text-slate-300 rounded-xl transition shadow-sm"
                                            title="Hapus User">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-slate-500 text-sm">Belum ada user terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="text-xs text-slate-600 mt-3">Total {{ $users->count() }} user terdaftar.</p>
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