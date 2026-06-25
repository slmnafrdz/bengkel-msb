<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $today = now();

        // Hari ini
        $transaksiHariIni = Transaction::whereDate('created_at', $today)->count();
        $pendapatanHariIni = Transaction::whereDate('created_at', $today)->sum('total');

        // Minggu ini
        $transaksiMingguan = Transaction::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        $pendapatanMingguan = Transaction::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->sum('total');

        // Bulan ini
        $transaksiBulanan = Transaction::whereMonth('created_at', now()->month)->count();
        $pendapatanBulanan = Transaction::whereMonth('created_at', now()->month)->sum('total');

        // Stok menipis
        $stokMenipis = Product::whereColumn('stok', '<=', 'minimum_stok')->get();

        // Transaksi terakhir
        $lastTransactions = Transaction::latest()->take(5)->get();

        // Grafik Harian - 7 hari terakhir
        $grafikHarian = DB::table('transactions')
            ->selectRaw('DATE(created_at) as tanggal, SUM(total) as total')
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Grafik Mingguan - 4 minggu terakhir
        $grafikMingguan = DB::table('transactions')
            ->selectRaw('WEEK(created_at) as minggu, YEAR(created_at) as tahun, SUM(total) as total, MIN(DATE(created_at)) as tgl_awal')
            ->whereBetween('created_at', [now()->subWeeks(3)->startOfWeek(), now()->endOfDay()])
            ->groupByRaw('WEEK(created_at), YEAR(created_at)')
            ->orderBy('tahun')
            ->orderBy('minggu')
            ->get();

        // Grafik Bulanan - 6 bulan terakhir
        $grafikBulanan = DB::table('transactions')
            ->selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, SUM(total) as total')
            ->whereBetween('created_at', [now()->subMonths(5)->startOfMonth(), now()->endOfDay()])
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        // Format untuk JavaScript (proses di controller, bukan di blade)
        // Format untuk JavaScript
        $dataGrafikHarian = [];
        foreach ($grafikHarian as $d) {
            $dataGrafikHarian[] = [
                'label' => \Carbon\Carbon::parse($d->tanggal)->format('d/m'),
                'total' => (int) $d->total
            ];
        }

        $dataGrafikMingguan = [];
        foreach ($grafikMingguan as $d) {
            $dataGrafikMingguan[] = [
                'label' => 'Mg ' . \Carbon\Carbon::parse($d->tgl_awal)->format('d/m'),
                'total' => (int) $d->total
            ];
        }

        $dataGrafikBulanan = [];
        foreach ($grafikBulanan as $d) {
            $dataGrafikBulanan[] = [
                'label' => \Carbon\Carbon::createFromDate($d->tahun, $d->bulan, 1)
                    ->locale('id')->isoFormat('MMM'),
                'total' => (int) $d->total
            ];
        }

        return view('admin.dashboard', compact(
            'transaksiHariIni',
            'pendapatanHariIni',
            'transaksiMingguan',
            'pendapatanMingguan',
            'transaksiBulanan',
            'pendapatanBulanan',
            'stokMenipis',
            'lastTransactions',
            'dataGrafikHarian',
            'dataGrafikMingguan',
            'dataGrafikBulanan'
        ));
    }

    public function kasir()
    {
        $today = now()->toDateString();

        $tanggalSekarang = now()->translatedFormat('d F Y');
        $trxHariIni = Transaction::whereDate('created_at', $today)->count();
        $omsetHariIni = Transaction::whereDate('created_at', $today)->sum('total');

        $produkTerjual = DB::table('transaction_details')
            ->whereDate('created_at', $today)
            ->sum('qty');

        $transaksiTerakhir = Transaction::whereDate('created_at', $today)
            ->latest()->take(5)->get();

        $stokHampirHabis = Product::whereColumn('stok', '<=', 'minimum_stok')
            ->where('stok', '>', 0)->orderBy('stok', 'asc')->get();

        $stokHabisTotal = Product::where('stok', '<=', 0)->get();

        $semuaPeringatanStok = Product::whereColumn('stok', '<=', 'minimum_stok')
            ->orderBy('stok', 'asc')->take(5)->get();

        return view('kasir.dashboard', compact(
            'tanggalSekarang',
            'trxHariIni',
            'omsetHariIni',
            'produkTerjual',
            'transaksiTerakhir',
            'stokHampirHabis',
            'stokHabisTotal',
            'semuaPeringatanStok'
        ));
    }
}
