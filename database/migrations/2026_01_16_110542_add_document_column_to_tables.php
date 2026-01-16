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
        Schema::table('shop_owners', function (Blueprint $table) {
            $table->string('document')->nullable()->after('device_status');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->string('document')->nullable()->after('device_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_owners', function (Blueprint $table) {
            $table->dropColumn('document');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('document');
        });
    }
};
