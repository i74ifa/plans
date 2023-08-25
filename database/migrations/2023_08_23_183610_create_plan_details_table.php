<?php

use App\Models\Plan;
use App\Models\User;
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
        Schema::create('plan_details', function (Blueprint $table) {
            $table->string('period', 5); // 1m, 3m, 7d, 1y
            $table->timestamp('expire_at');
            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->foreignIdFor(Plan::class)->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_details');
    }
};
