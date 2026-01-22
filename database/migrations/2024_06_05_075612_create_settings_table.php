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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('company_name');
            // $table->text('slogan');
            $table->string('contact_phone')->nullable();
            $table->string('support_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('support_email')->nullable();
            $table->string('support_hours')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            // $table->text('linkedin_link')->nullable();
            // $table->text('youtube_link')->nullable();
            $table->text('instagram')->nullable();
            $table->text('google_map')->nullable();
            // $table->text('android_app_image')->nullable();
            // $table->text('android_app_url')->nullable();
            // $table->text('ios_app_image')->nullable();
            // $table->text('ios_app_url')->nullable();
            $table->text('company_address')->nullable();
            // $table->text('logo_jpg')->nullable();
            $table->text('logo_png')->nullable();
            $table->text('favicon')->nullable();
            // $table->text('title')->nullable();
            $table->text('payment_method_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};