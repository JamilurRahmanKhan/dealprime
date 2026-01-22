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
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('order_number');
            $table->integer('customer_id');
            $table->string('shipping_address');
            $table->string('shipping_cost');
            $table->double('advance_payment',15,3)->default(0);
            $table->double('order_total',15,3);
            $table->double('due_amount', 15, 3)->storedAs('order_total - advance_payment'); // Auto-calculated column

            $table->string('payment_method');
            $table->string('order_date');
            $table->string('post_code')->nullable(); //new
            $table->tinyInteger('order_status')->default(2)->comment('0=deleted, 1=order confirmed, 2=processing, 3=delivery complete'); //new
            $table->string('courier')->nullable();
            $table->string('country')->default('bangladesh');
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