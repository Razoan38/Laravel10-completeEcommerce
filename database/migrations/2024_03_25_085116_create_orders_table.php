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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country')->nullable();
            $table->text('address_one')->nullable();
            $table->text('address_two')->nullable();
            $table->string('city')->nullable();
            $table->string('state');
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('order_note')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_amount')->default(0)->nullable();
            $table->integer('shipping_id')->nullable();
            $table->string('shipping_amount')->default(0)->nullable();
            $table->string('total_amount')->default(0)->nullable();
            $table->string('payment_method')->nullable();
            $table->tinyInteger('is_payment')->default(0)->nullable();
            $table->text('payment_data')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_delete')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
