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
        Schema::create('scan_logs', function (Blueprint $table) {
            $table->id('scan_id');
            $table->string('mobile_number');
            $table->unsignedBigInteger('coupon_id');
            $table->decimal('scan_amount', 10, 2);
            $table->timestamp('scanned_at'); // Renamed for clarity and compatibility
            $table->timestamps();

            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade'); // Adjusted reference
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_logs');
    }
};
