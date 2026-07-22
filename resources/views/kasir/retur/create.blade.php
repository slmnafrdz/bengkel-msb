<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENGKEL MSB - PROSES RETUR</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
                    <a href="/kasir/spareparts" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="box" class="w-4 h-4 text-slate-500"></i>
                        Stok Sparepart
                    </a>
                    <a href="/riwayat-transaksi" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl text-xs uppercase tracking-wider transition font-semibold">
                        <i data-lucide="history" class="w-4 h-4 text-slate-500"></i>
                        Riwayat Transaksi
                    </a>
                    <a href="/retur" class="flex items-center gap-3 px-3 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-amber-500/10">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
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
                    <h1 class="text-lg font-extrabold text-white">Proses Retur - {{ $transaction->no_nota }}</h1>
                    <p class="text-xs text-slate-400">
                        Tanggal: {{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }} WIB
                        &bull; Kasir: {{ $transaction->user->name ?? '-' }}
                    </p>
                </div>
                <a href="{{ route('retur.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl border border-slate-700/80 transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </a>
            </header>

            @if (session('error'))
            <div class="mb-4 p-4 bg-rose-500/20 border border-rose-500/50 text-rose-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 p-4 bg-rose-500/20 border border-rose-500/50 text-rose-400 rounded-xl text-xs font-bold">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!$adaSisaBisaDiretur)
            <div class="mb-4 p-4 bg-amber-500/20 border border-amber-500/50 text-amber-400 rounded-xl text-xs font-bold flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4"></i>
                Semua barang pada nota ini sudah pernah diretur sepenuhnya.
            </div>
            @endif

            <form action="{{ route('retur.store', $transaction->id) }}" method="POST" id="formRetur">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KOLOM KIRI: PILIH BARANG YANG DIRETUR --}}
                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6">
                            <h3 class="text-sm font-bold text-white mb-1">1. Pilih Barang yang Dikembalikan</h3>
                            <p class="text-xs text-slate-400 mb-4">Isi jumlah barang yang ingin diretur oleh pelanggan (maksimal sesuai sisa yang belum diretur).</p>

                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="border-b border-slate-700 text-slate-400">
                                            <th class="text-left p-3">Produk</th>
                                            <th class="text-right p-3">Harga</th>
                                            <th class="text-center p-3">Dibeli</th>
                                            <th class="text-center p-3">Sisa Bisa Retur</th>
                                            <th class="text-center p-3">Qty Retur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($details as $detail)
                                        <tr class="border-b border-slate-800">
                                            <td class="p-3 text-white font-medium">{{ $detail->product->nama_produk ?? '-' }}</td>
                                            <td class="p-3 text-right text-slate-300">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                            <td class="p-3 text-center text-slate-300">{{ $detail->qty }}</td>
                                            <td class="p-3 text-center text-slate-300">{{ $detail->sisa_bisa_diretur }}</td>
                                            <td class="p-3 text-center">
                                                <input type="number"
                                                    name="retur_items[{{ $detail->id }}]"
                                                    min="0"
                                                    max="{{ $detail->sisa_bisa_diretur }}"
                                                    value="0"
                                                    {{ $detail->sisa_bisa_diretur <= 0 ? 'disabled' : '' }}
                                                    class="w-20 bg-slate-900 border border-slate-700 rounded-lg p-2 text-center text-white qty-retur-input"
                                                    data-harga="{{ $detail->harga }}"
                                                    oninput="hitungRingkasan()">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6">
                            <h3 class="text-sm font-bold text-white mb-1">2. Jenis Penyelesaian Retur</h3>
                            <p class="text-xs text-slate-400 mb-4">Pilih apakah barang ditukar dengan produk lain, atau uang dikembalikan tunai.</p>

                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="jenis_retur" value="tukar_barang" class="hidden peer" onchange="toggleJenisRetur()" checked>
                                    <div class="p-4 rounded-xl border border-slate-700 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 transition">
                                        <i data-lucide="repeat" class="w-5 h-5 text-amber-400 mb-2"></i>
                                        <p class="text-sm font-bold text-white">Tukar Barang</p>
                                        <p class="text-[11px] text-slate-400">Ganti dengan produk lain (ukuran/merek berbeda)</p>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="jenis_retur" value="uang_cash" class="hidden peer" onchange="toggleJenisRetur()">
                                    <div class="p-4 rounded-xl border border-slate-700 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition">
                                        <i data-lucide="banknote" class="w-5 h-5 text-emerald-400 mb-2"></i>
                                        <p class="text-sm font-bold text-white">Kembali Uang (Cash)</p>
                                        <p class="text-[11px] text-slate-400">Uang dikembalikan tunai ke pelanggan</p>
                                    </div>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-xs font-semibold text-slate-300">Alasan Retur</label>
                                    <select name="alasan" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-white text-sm">
                                        <option value="Salah Ukuran">Salah Ukuran</option>
                                        <option value="Salah Merek/Warna">Salah Merek/Warna</option>
                                        <option value="Barang Cacat/Rusak">Barang Cacat/Rusak</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-2 text-xs font-semibold text-slate-300">Catatan (opsional)</label>
                                    <input type="text" name="catatan" placeholder="Keterangan tambahan..."
                                        class="w-full bg-slate-900 border border-slate-700 rounded-xl p-3 text-white text-sm">
                                </div>
                            </div>
                        </div>

                        {{-- SECTION PENGGANTI: hanya untuk tukar_barang --}}
                        <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6" id="sectionPengganti">
                            <h3 class="text-sm font-bold text-white mb-1">3. Pilih Barang Pengganti</h3>
                            <p class="text-xs text-slate-400 mb-4">Tambahkan produk pengganti yang diberikan ke pelanggan.</p>

                            <div class="flex flex-col sm:flex-row gap-3 mb-4">
                                <select id="selectProdukPengganti" class="flex-1 bg-slate-900 border border-slate-700 rounded-xl p-3 text-white text-sm">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-nama="{{ $product->nama_produk }}"
                                            data-harga="{{ $product->harga_jual }}"
                                            data-stok="{{ $product->stok }}">
                                            {{ $product->nama_produk }} (Stok: {{ $product->stok }}) - Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="number" id="qtyProdukPengganti" min="1" value="1"
                                    class="w-full sm:w-24 bg-slate-900 border border-slate-700 rounded-xl p-3 text-white text-sm text-center">
                                <button type="button" onclick="tambahPengganti()"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold rounded-xl transition uppercase tracking-wider">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    Tambah
                                </button>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="border-b border-slate-700 text-slate-400">
                                            <th class="text-left p-3">Produk Pengganti</th>
                                            <th class="text-center p-3">Qty</th>
                                            <th class="text-right p-3">Subtotal</th>
                                            <th class="text-center p-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelPengganti">
                                        <tr id="rowKosongPengganti">
                                            <td colspan="4" class="text-center text-slate-500 italic py-4">Belum ada barang pengganti dipilih</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="hiddenInputsPengganti"></div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: RINGKASAN --}}
                    <div class="bg-[#111827]/40 border border-slate-800/60 rounded-2xl p-6 h-fit sticky top-6">
                        <h3 class="text-sm font-bold text-white mb-4">Ringkasan Retur</h3>

                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Nilai Barang Diretur</span>
                                <span id="ringkasanTotalRetur" class="text-white font-semibold">Rp 0</span>
                            </div>
                            <div class="flex justify-between" id="rowTotalPengganti">
                                <span class="text-slate-400">Nilai Barang Pengganti</span>
                                <span id="ringkasanTotalPengganti" class="text-white font-semibold">Rp 0</span>
                            </div>
                            <hr class="border-slate-800">
                            <div class="flex justify-between text-base font-extrabold">
                                <span id="labelSelisih" class="text-slate-300">Uang Kembali ke Pelanggan</span>
                                <span id="ringkasanSelisih" class="text-emerald-400">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-6 w-full bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold py-3.5 rounded-xl transition shadow-lg text-xs uppercase tracking-wider">
                            PROSES RETUR
                        </button>
                    </div>

                </div>
            </form>

        </main>
    </div>

    <script>
        let daftarPengganti = [];

        function toggleJenisRetur() {
            const jenis = document.querySelector('input[name="jenis_retur"]:checked').value;
            const section = document.getElementById('sectionPengganti');
            const rowTotalPengganti = document.getElementById('rowTotalPengganti');
            const label = document.getElementById('labelSelisih');

            if (jenis === 'tukar_barang') {
                section.style.display = 'block';
                rowTotalPengganti.style.display = 'flex';
            } else {
                section.style.display = 'none';
                rowTotalPengganti.style.display = 'none';
                daftarPengganti = [];
                renderTabelPengganti();
            }
            hitungRingkasan();
        }

        function tambahPengganti() {
            const select = document.getElementById('selectProdukPengganti');
            const opt = select.options[select.selectedIndex];
            const qtyInput = document.getElementById('qtyProdukPengganti');
            const qty = parseInt(qtyInput.value) || 0;
            const stok = parseInt(opt.getAttribute('data-stok')) || 0;

            if (qty <= 0) {
                alert('Qty harus lebih dari 0!');
                return;
            }
            if (qty > stok) {
                alert('Stok produk tidak mencukupi! Sisa stok: ' + stok);
                return;
            }

            daftarPengganti.push({
                id: opt.value,
                nama: opt.getAttribute('data-nama'),
                harga: parseFloat(opt.getAttribute('data-harga')),
                qty: qty
            });

            renderTabelPengganti();
            hitungRingkasan();
        }

        function hapusPengganti(index) {
            daftarPengganti.splice(index, 1);
            renderTabelPengganti();
            hitungRingkasan();
        }

        function renderTabelPengganti() {
            const tbody = document.getElementById('tabelPengganti');
            const hiddenWrap = document.getElementById('hiddenInputsPengganti');

            if (daftarPengganti.length === 0) {
                tbody.innerHTML = '<tr id="rowKosongPengganti"><td colspan="4" class="text-center text-slate-500 italic py-4">Belum ada barang pengganti dipilih</td></tr>';
                hiddenWrap.innerHTML = '';
                return;
            }

            let html = '';
            let hiddenHtml = '';

            daftarPengganti.forEach((item, index) => {
                const subtotal = item.harga * item.qty;
                html += `
                    <tr class="border-b border-slate-800">
                        <td class="p-3 text-white font-medium">${item.nama}</td>
                        <td class="p-3 text-center text-slate-300">${item.qty}</td>
                        <td class="p-3 text-right text-slate-300">Rp ${subtotal.toLocaleString('id-ID')}</td>
                        <td class="p-3 text-center">
                            <button type="button" onclick="hapusPengganti(${index})" class="text-rose-400 hover:underline font-semibold">Hapus</button>
                        </td>
                    </tr>
                `;
                hiddenHtml += `<input type="hidden" name="pengganti_produk[]" value="${item.id}">`;
                hiddenHtml += `<input type="hidden" name="pengganti_qty[]" value="${item.qty}">`;
            });

            tbody.innerHTML = html;
            hiddenWrap.innerHTML = hiddenHtml;
        }

        function hitungRingkasan() {
            let totalRetur = 0;
            document.querySelectorAll('.qty-retur-input').forEach(input => {
                const qty = parseInt(input.value) || 0;
                const harga = parseFloat(input.getAttribute('data-harga')) || 0;
                totalRetur += qty * harga;
            });

            let totalPengganti = 0;
            daftarPengganti.forEach(item => {
                totalPengganti += item.harga * item.qty;
            });

            const jenis = document.querySelector('input[name="jenis_retur"]:checked').value;
            const label = document.getElementById('labelSelisih');
            const selisihEl = document.getElementById('ringkasanSelisih');

            document.getElementById('ringkasanTotalRetur').textContent = 'Rp ' + totalRetur.toLocaleString('id-ID');
            document.getElementById('ringkasanTotalPengganti').textContent = 'Rp ' + totalPengganti.toLocaleString('id-ID');

            let selisih;
            if (jenis === 'uang_cash') {
                selisih = -totalRetur;
            } else {
                selisih = totalPengganti - totalRetur;
            }

            if (selisih < 0) {
                label.textContent = 'Uang Kembali ke Pelanggan';
                selisihEl.textContent = 'Rp ' + Math.abs(selisih).toLocaleString('id-ID');
                selisihEl.className = 'text-emerald-400';
            } else if (selisih > 0) {
                label.textContent = 'Pelanggan Kurang Bayar';
                selisihEl.textContent = 'Rp ' + selisih.toLocaleString('id-ID');
                selisihEl.className = 'text-amber-400';
            } else {
                label.textContent = 'Selisih';
                selisihEl.textContent = 'Rp 0';
                selisihEl.className = 'text-slate-300';
            }
        }

        document.getElementById('formRetur').addEventListener('submit', function (e) {
            let adaQty = false;
            document.querySelectorAll('.qty-retur-input').forEach(input => {
                if ((parseInt(input.value) || 0) > 0) adaQty = true;
            });
            if (!adaQty) {
                e.preventDefault();
                alert('Pilih minimal 1 barang beserta jumlah yang ingin diretur!');
                return;
            }

            const jenis = document.querySelector('input[name="jenis_retur"]:checked').value;
            if (jenis === 'tukar_barang' && daftarPengganti.length === 0) {
                e.preventDefault();
                alert('Pilih minimal 1 barang pengganti untuk proses tukar barang!');
                return;
            }
        });

        toggleJenisRetur();
        lucide.createIcons();
    </script>
</body>

</html>
