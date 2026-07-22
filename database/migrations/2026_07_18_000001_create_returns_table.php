<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returns', function (Blueprint $table) {

            $table->id();

            $table->string('no_retur')->unique();

            // Transaksi penjualan asal yang barangnya diretur
            $table->foreignId('transaction_id')
                ->constrained();

            // Kasir yang memproses retur
            $table->foreignId('user_id')
                ->constrained();

            // Jenis penyelesaian retur:
            // - tukar_barang : barang ditukar dengan produk lain
            // - uang_cash    : uang dikembalikan tunai ke pelanggan
            $table->enum('jenis_retur', ['tukar_barang', 'uang_cash']);

            // Alasan retur, mis: Salah Ukuran, Salah Merek/Warna, Barang Cacat/Rusak, Lainnya
            $table->string('alasan');

            $table->text('catatan')->nullable();

            // Total nilai barang yang dikembalikan oleh pelanggan
            $table->decimal('total_barang_retur', 12, 2)->default(0);

            // Total nilai barang pengganti (hanya terisi jika jenis_retur = tukar_barang)
            $table->decimal('total_barang_pengganti', 12, 2)->default(0);

            // selisih = total_barang_pengganti - total_barang_retur
            // > 0 : pelanggan harus menambah bayar sejumlah selisih
            // < 0 : kasir mengembalikan uang sejumlah |selisih| ke pelanggan
            $table->decimal('selisih', 12, 2)->default(0);

            $table->string('status')->default('selesai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
