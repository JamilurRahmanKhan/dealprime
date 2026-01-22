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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('merchant_id')->nullable();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('sub_subcategory_id');
            $table->integer('brand_id');
            $table->integer('unit_id');
            $table->string('name');
            $table->string('code');
            $table->string('type');
            $table->text('short_description');
            $table->longText('long_description');
            $table->text('image');
            $table->text('image_one')->nullable();
            $table->text('image_two')->nullable();
            $table->text('image_three')->nullable();
            $table->text('image_four')->nullable();
            $table->double('regular_price',11,2);
            $table->double('selling_price',11,2)->default(0);
            $table->string('discount_type')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->integer('stock_amount')->default(0);
            $table->integer('hit_count')->default(0);
            $table->integer('sales_count')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('flash_sale')->default(0);
            $table->tinyInteger('advance_pay')->default(0);
            $table->double('advance_pay_amount',15,3)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
