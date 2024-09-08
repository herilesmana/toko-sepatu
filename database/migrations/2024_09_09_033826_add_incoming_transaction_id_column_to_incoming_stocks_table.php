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
        Schema::table('incoming_stocks', function (Blueprint $table) {
            $table->foreignId('incoming_transaction_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incoming_stocks', function (Blueprint $table) {
            $table->dropForeign(['incoming_transaction_id']);
            $table->dropColumn('incoming_transaction_id');
        });
    }
};
