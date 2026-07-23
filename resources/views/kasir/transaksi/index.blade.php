<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - TRANSAKSI</title>

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
                    <a href="/kasir/dashboard" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-slate-500"></i>
                        Dashboard
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-amber-500/10">
                        <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
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

                    <a href="/retur" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="rotate-ccw" class="w-4 h-4 text-slate-500"></i>
                        Retur Barang
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
                    <h1 class="text-lg font-extrabold text-white">Transaksi POS</h1>
                    <p class="text-xs text-slate-400">Input data penjualan sparepart bengkel secara instan.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 relative z-10">
                    <a href="/kasir/dashboard" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition cursor-pointer">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                </div>
            </header>

            @if (session('success'))
            <div class="mb-4 p-4 bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-4 p-4 bg-rose-500/20 border border-rose-500/50 text-rose-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
            </div>
            @endif

            @if (session('info'))
            <div class="mb-4 p-4 bg-blue-500/20 border border-blue-500/50 text-blue-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4"></i> {{ session('info') }}
            </div>
            @endif


            {{-- HAPUS form GET luar, tidak diperlukan --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- TABEL DAFTAR SPAREPART --}}
                <div class="lg:col-span-2 bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6">
                    <h3 class="text-sm font-bold text-white mb-4">Daftar Sparepart</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs">
                            <thead>
                                <tr class="border-b border-slate-700 text-slate-400">
                                    <th class="text-left p-3">Kode</th>
                                    <th class="text-left p-3">Produk</th>
                                    <th class="text-right p-3">Harga</th>
                                    <th class="text-center p-3">Stok</th>
                                    <th class="text-center p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="border-b border-slate-800 hover:bg-slate-800/20 transition">
                                    <td class="p-3 font-mono text-amber-500">{{ $product->kode_produk }}</td>
                                    <td class="p-3 font-medium text-white">{{ $product->nama_produk }}</td>
                                    <td class="p-3 text-right">Rp {{ number_format($product->harga_jual,0,',','.') }}</td>
                                    <td class="p-3 text-center">{{ $product->stok }}</td>
                                    <td class="p-3 text-center">
                                        {{-- PERBAIKAN: pakai button + onclick JS, bukan <a href> GET --}}

                                        <button onclick="tambahKeCart({{ $product->id }})"
                                            class="inline-block bg-amber-500 hover:bg-amber-600 text-black px-3 py-1 rounded-lg font-bold transition cursor-pointer">
                                            +
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- KERANJANG BELANJA --}}
                <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6">
                    <h3 class="text-sm font-bold text-white mb-4">Keranjang Belanja</h3>

                    @php $grandTotal = 0; @endphp

                    <div class="max-h-60 overflow-y-auto pr-1">
                        @forelse(session('cart', []) as $item)
                        @php
                        $subtotal = $item['harga'] * $item['qty'];
                        $grandTotal += $subtotal;
                        @endphp
                        <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-3 mb-3 flex justify-between items-center">
                            <div>
                                <div class="text-white font-medium text-xs">{{ $item['nama'] }}</div>
                                <div class="text-slate-400 text-[11px] mt-0.5">Qty: {{ $item['qty'] }}</div>
                            </div>
                            <div class="text-right">
                                <span class="text-slate-200 text-xs font-semibold">Rp {{ number_format($subtotal,0,',','.') }}</span>
                                {{-- PERBAIKAN: pakai button + onclick JS, bukan <a href> GET --}}
                                <button
                                    onclick="hapusDariCart({{ $item['id'] }})"
                                    class="block text-[10px] text-rose-400 hover:underline mt-0.5 bg-transparent border-none cursor-pointer">
                                    Hapus
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-slate-500 text-xs py-6 italic">Keranjang kosong</div>
                        @endforelse
                    </div>

                    <hr class="my-4 border-slate-800">

                    <div class="flex justify-between font-bold text-base">
                        <span>Total</span>
                        <span class="text-amber-400">Rp {{ number_format($grandTotal,0,',','.') }}</span>
                    </div>

                    {{-- FORM CHECKOUT: hanya satu form, tidak nested --}}
                    <form action="{{ route('transaksi.store') }}" method="POST" id="formCheckout">
                        @csrf

                        <div class="mt-4">
                            <label for="bayar" class="block mb-2 text-xs font-semibold text-slate-300">Bayar</label>
                            <input type="number"
                                name="bayar"
                                id="bayar"
                                data-total="{{ $grandTotal }}"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-white font-bold text-lg"
                                placeholder="0"
                                oninput="hitungKembalian()"
                                required>
                        </div>

                        <div class="mt-4 flex justify-between items-center font-bold">
                            <span class="text-xs text-slate-400">Kembalian</span>
                            <span id="kembalian" class="text-emerald-400 text-lg">Rp 0</span>
                        </div>

                        {{-- PERBAIKAN: type="button" agar tidak submit form biasa --}}
                        <button type="button" onclick="prosesSimpanTransaksi()"
                            class="mt-5 w-full bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold py-3.5 rounded-xl transition shadow-lg text-xs uppercase tracking-wider">
                            SIMPAN TRANSAKSI
                        </button>
                    </form>

                </div>
            </div>

        </main>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // 1. HITUNG KEMBALIAN OTOMATIS
        function hitungKembalian() {
            const bayarInput = document.getElementById('bayar');
            const grandTotal = parseInt(bayarInput.getAttribute('data-total')) || 0;
            const bayar = parseInt(bayarInput.value) || 0;
            const kembalian = bayar - grandTotal;
            document.getElementById('kembalian').textContent = 'Rp ' + (kembalian > 0 ? kembalian.toLocaleString('id-ID') : 0);
        }

        // 2. TAMBAH PRODUK KE KERANJANG
        function tambahKeCart(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(() => {
                    window.location.href = "{{ url('/transaksi') }}";
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menambahkan produk.');
                });
        }

        // 3. HAPUS PRODUK DARI KERANJANG
        function hapusDariCart(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(() => {
                    window.location.href = "{{ url('/transaksi') }}";
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus produk.');
                });
        }

        // 4. SIMPAN TRANSAKSI
        function prosesSimpanTransaksi() {
            const bayarInput = document.getElementById('bayar');
            const nominalBayar = parseInt(bayarInput.value) || 0;
            const grandTotal = parseInt(bayarInput.getAttribute('data-total')) || 0;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (nominalBayar <= 0) {
                alert('Masukkan nominal pembayaran terlebih dahulu!');
                return;
            }

            if (nominalBayar < grandTotal) {
                alert('Uang pembayaran kurang!');
                return;
            }

            fetch("{{ route('transaksi.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        bayar: nominalBayar
                    })
                })
                .then(() => {
                    window.location.href = "{{ url('/transaksi') }}";
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memproses transaksi.');
                });
        }
    </script>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>