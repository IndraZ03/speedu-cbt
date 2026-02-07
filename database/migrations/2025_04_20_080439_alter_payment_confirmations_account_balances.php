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
        Schema::table('payment_confirmations', function (Blueprint $table) {
            $table->uuid('transaction_id_account_balance')->after('transaction_id')->nullable();

            $table->foreign('transaction_id_account_balance')
                ->references('id')
                ->on('account_balances')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->uuid('transaction_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_confirmations', function (Blueprint $table) {
            $table->dropForeign(['transaction_id_account_balance']);
            $table->dropColumn('transaction_id_account_balance');
            $table->uuid('transaction_id')->nullable(false)->change();
        });
    }
};
