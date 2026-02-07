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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode voucher (contoh: DISKON50)
            $table->string('name'); // Nama promo
            $table->text('description')->nullable(); // Deskripsi promo
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage'); // Tipe diskon
            $table->decimal('discount_value', 10, 2); // Nilai diskon (50 untuk 50% atau 50000 untuk Rp50.000)
            $table->decimal('min_purchase', 10, 2)->nullable(); // Minimal pembelian
            $table->decimal('max_discount', 10, 2)->nullable(); // Maksimal potongan (untuk persentase)
            $table->integer('usage_limit')->nullable(); // Batas penggunaan total
            $table->integer('usage_limit_per_user')->default(1); // Batas penggunaan per user
            $table->integer('used_count')->default(0); // Jumlah sudah digunakan
            $table->date('valid_from')->nullable(); // Tanggal mulai berlaku
            $table->date('valid_until')->nullable(); // Tanggal berakhir
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });

        // Tabel untuk tracking penggunaan promo per user
        Schema::create('promo_code_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_code_id')->constrained()->onDelete('cascade');
            $table->char('user_id', 36); // Match the users table id type (UUID)
            $table->string('transaction_code'); // Kode transaksi
            $table->decimal('discount_amount', 10, 2); // Jumlah diskon yang diterapkan
            $table->timestamps();
            
            // Manual foreign key for UUID user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_code_usages');
        Schema::dropIfExists('promo_codes');
    }
};
