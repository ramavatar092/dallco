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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_mobile')->unique();
            $table->string('name');
            $table->string('city');
            $table->text('address');
            $table->string('state');
            $table->date('register_date');
            $table->string('pincode');
            $table->string('bank_ifsc')->nullable();
            $table->string('account_number')->nullable();
            $table->string('upi_code')->nullable();
            $table->string('mobile_notification_code')->nullable();
            $table->decimal('account_balance', 10, 2)->default(0);
            $table->decimal('total_payout', 10, 2)->default(0);
            $table->decimal('total_earnings', 10, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
