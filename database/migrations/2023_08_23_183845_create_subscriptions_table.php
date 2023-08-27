<?php

use App\Models\Customer;
use App\Models\Plan;
use App\Models\PlanType;
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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('expire_at');
            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->foreignIdFor(Plan::class)->nullable()->references('id')->on('plans');
            $table->tinyInteger('plan_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
