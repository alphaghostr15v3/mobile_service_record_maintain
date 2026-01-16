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
        Schema::create('shop_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('aadhar_number')->nullable();
            $table->string('mobile_number');
            $table->string('mobile_name');
            $table->string('imei_number')->nullable();
            $table->date('date');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_owners');
    }
};
