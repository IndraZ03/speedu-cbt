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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // e.g., "SKD", "SKB STMKG", "Try Out"
            $table->string('badge_text')->nullable(); // e.g., "#NGEBUTBELAJAR", "Recommended"
            $table->string('badge_color')->default('primary'); // primary, warning, danger, etc.
            $table->decimal('original_price', 12, 2);
            $table->decimal('promo_price', 12, 2);
            $table->string('duration')->nullable(); // e.g., "/15 Sesi", "/10 Sesi"
            $table->text('alert_text')->nullable(); // e.g., "KELAS EKSKLUSIF - HANYA 10 ORANG!"
            $table->string('alert_color')->default('primary');
            $table->json('features')->nullable(); // Array of features
            $table->string('button_text')->default('Daftar Sekarang');
            $table->string('button_color')->default('primary');
            $table->string('whatsapp_message')->nullable(); // Custom WhatsApp message
            $table->string('action_type')->default('whatsapp'); // 'whatsapp' or 'register'
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
