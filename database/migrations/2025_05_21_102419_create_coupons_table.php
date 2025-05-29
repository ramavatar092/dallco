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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('id');
            $table->string('coupon_code')->unique();
            $table->decimal('coupon_value', 10, 2);
            $table->date('coupon_date')->nullable();
            $table->date('coupon_expiry');
            $table->enum('coupon_status', ['used', 'notused', 'cancelled'])->default('notused');
            $table->string('used_by')->nullable(); 
            $table->date('status_date')->nullable(); 
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
