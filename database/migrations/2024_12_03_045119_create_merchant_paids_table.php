<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('merchant_paids', function (Blueprint $table) {
            $table->id();
            $table->integer('merchant_id')->nullable();
            $table->double('paid_amount',15,3)->default(0);
            $table->double('due_amount',15,3)->default(0);
            $table->string('status')->nullable();
            $table->date('paid_date')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_paids');
    }
};
