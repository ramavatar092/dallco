<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Required for DB::raw

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('payout_date')->useCurrent();
            $table->unsignedBigInteger('user_id'); // foreign key to users table
            $table->decimal('amount', 10, 2);
            $table->timestamps(); // created_at and updated_at

            // Optional: Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
