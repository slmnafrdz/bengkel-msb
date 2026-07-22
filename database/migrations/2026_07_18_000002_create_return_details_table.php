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
        Schema::create('return_details', function (Blueprint $table) {

            $table->id();

            $table->foreignId('retur_id')
                ->constrained('returns')
                ->cascadeOnDelete();

            // dikembalikan : barang lama yang dikembalikan pelanggan (stok bertambah)
            // pengganti    : barang baru yang diberikan ke pelanggan sbg penukar (stok berkurang)
            $table->enum('tipe', ['dikembalikan', 'pengganti']);

            // Hanya terisi untuk tipe "dikembalikan", merujuk ke item transaksi asal
            $table->foreignId('transaction_detail_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_id')
                ->constrained();

            $table->integer('qty');

            $table->decimal('harga', 12, 2);

            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_details');
    }
};
