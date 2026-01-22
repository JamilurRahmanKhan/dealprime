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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id')->nullable();
            $table->integer('merchant_id');
            $table->integer('combo_product_id')->nullable();
            $table->string('color')->nullable(); //new
            $table->string('size')->nullable(); //new
            $table->string('type'); //new
            $table->integer('qty');
            $table->double('regular_price')->default(0);
            $table->double('selling_price')->default(0);
            $table->string('tax_total')->nullable(); //new
            $table->string('coupon_discount')->nullable();
            $table->string('coupon_discount_amount')->nullable();
            $table->string('product_discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};