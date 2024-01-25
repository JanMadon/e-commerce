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
        Schema::table('detals_order', function (Blueprint $table) {
            $table->integer('price_item')->unsigned()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detals_order', function (Blueprint $table) {
          //  $table->dropColumnIf('price_item');
        });
    }
};
