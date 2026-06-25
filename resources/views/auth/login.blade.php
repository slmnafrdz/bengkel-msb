<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel MSB</title>

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

<body class="bg-[#0f172a] min-h-screen flex items-center justify-center p-0 md:p-6 relative overflow-hidden select-none">

    <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-amber-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="w-full max-w-5xl min-h-[100vh] md:min-h-[80vh] bg-[#0b0f19]/60 md:bg-[#111827]/40 md:border md:border-slate-800/60 md:rounded-3xl shadow-2xl flex relative z-10 overflow-hidden backdrop-blur-xl">

        <div class="hidden lg:flex flex-col justify-between w-1/2 p-12 bg-gradient-to-br from-[#111827] to-[#1e293b]/50 border-r border-slate-800/80 relative overflow-hidden">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-30"></div>

            <div class="flex items-center gap-3 relative z-10">
                <div class="flex items-center justify-center p-2.5 bg-amber-500 rounded-xl shadow-lg shadow-amber-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-slate-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A1.5 1.5 0 1019.4 18.85l-5.83-5.83M11.42 15.17a4.993 4.993 0 01-5.54-.38l-2.02-2.02a1 1 0 01.7-.17l2.14.35 1.88-1.88-2.31-2.31a1 1 0 01.17-.7l2.02-2.02a4.993 4.993 0 015.54.38l5.83-5.83a1.5 1.5 0 012.13 2.13l-5.83 5.83zm0 0l.35 2.14 1.88 1.88-2.31-2.31a1 1 0 00-.7-.17z" />
                    </svg>
                </div>
                <span class="text-base font-bold text-white tracking-wider uppercase">Bengkel MSB</span>
            </div>

            <div class="my-auto relative z-10 space-y-3">
                <div class="inline-block px-3 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-[11px] text-amber-400 font-semibold tracking-wider uppercase">
                    Sistem Manajemen Bengkel MSB
                </div>
                <h2 class="text-3xl font-extrabold text-white leading-tight tracking-tight">
                    Pantau Performa & <br>Stok Bengkel dalam <span class="text-amber-500 bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">Satu Sistem </span>
                </h2>
                <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                    Transformasikan Manajemen Bengkel Anda. Kelola inventaris barang dan transaksi pelanggan dengan presisi tinggi untuk performa bengkel yang lebih optimal dan terukur.
                </p>
            </div>

            <div class="bg-slate-900/40 border border-slate-800 p-4 rounded-2xl backdrop-blur-md relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <div class="text-left">
                        <p class="text-white font-semibold text-xs">Sistem Server Stabil</p>
                        <p class="text-[10px] text-slate-400">Terhubung dengan aman ke jaringan</p>
                    </div>
                </div>
                <span class="text-[11px] font-mono text-slate-500">8181/TCP</span>
            </div>
        </div>

        <div class="w-full lg:w-1/2 p-8 sm:p-12 md:p-16 flex flex-col justify-center bg-[#0d1321]/90">

            <div class="text-center lg:text-left mb-8">
                <div class="lg:hidden inline-flex items-center justify-center p-3 bg-amber-500 rounded-xl shadow-lg shadow-amber-500/20 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-slate-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A1.5 1.5 0 1019.4 18.85l-5.83-5.83M11.42 15.17a4.993 4.993 0 01-5.54-.38l-2.02-2.02a1 1 0 01.7-.17l2.14.35 1.88-1.88-2.31-2.31a1 1 0 01.17-.7l2.02-2.02a4.993 4.993 0 015.54.38l5.83-5.83a1.5 1.5 0 012.13 2.13l-5.83 5.83zm0 0l.35 2.14 1.88 1.88-2.31-2.31a1 1 0 00-.7-.17z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white tracking-tight">Selamat Datang</h1>
                <p class="text-xs text-slate-400 mt-1">Silakan masuk menggunakan kredensial akun admin Anda.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5 text-sm">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">Email Address</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="Email@bengkelmsb.com"
                            value="{{ old('email') }}"
                            required
                            class="w-full text-xs bg-[#161f30] border @error('email') border-rose-500 focus:border-rose-500 @else border-slate-700/80 focus:border-amber-500 @enderror rounded-xl px-4 py-3.5 text-slate-200 placeholder-slate-600 focus:outline-none transition-all duration-200">
                    </div>
                    @error('email')
                    <span class="text-[11px] text-rose-400 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-slate-300">Password</label>
                        <a href="#" class="text-[11px] text-amber-500 hover:text-amber-400 transition font-medium">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••"
                            required
                            class="w-full text-xs bg-[#161f30] border @error('password') border-rose-500 focus:border-rose-500 @else border-slate-700/80 focus:border-amber-500 @enderror rounded-xl px-4 py-3.5 text-slate-200 placeholder-slate-600 focus:outline-none transition-all duration-200">
                    </div>
                    @error('password')
                    <span class="text-[11px] text-rose-400 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-[#161f30] border-slate-700 text-amber-500 focus:ring-amber-500/20 focus:ring-offset-0 accent-amber-500">
                        <span class="text-xs text-slate-400">Ingat akun saya</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full text-xs font-bold bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 py-3.5 rounded-xl transition duration-200 shadow-lg shadow-amber-500/10 tracking-wide uppercase font-semibold">
                        Masuk ke Sistem
                    </button>
                </div>
            </form>

            <div class="mt-12 pt-5 border-t border-slate-800/60 text-center lg:text-left flex flex-col sm:flex-row items-center justify-between gap-2 text-slate-500 text-[11px]">
                <p>&copy; 2026 Bengkel MSB. All rights reserved.</p>
                <p class="font-medium text-slate-600">v2.0.4</p>
            </div>

        </div>

    </div>

</body>

</html>