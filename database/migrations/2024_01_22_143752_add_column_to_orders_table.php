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

        Schema::table('orders', function (Blueprint $table) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment', ['accepted', 'rejected', 'active'])->after('user_id');
            $table->enum('status', ['waiting', 'sent', 'canceled'])->nullable()->after('shiping_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('active')->after('user_id');
            $table->dropColumn('payment');
        });
    }
};
