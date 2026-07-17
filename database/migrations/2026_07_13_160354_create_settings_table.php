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

        $table->string('company_name');

        $table->string('company_logo')->nullable();

        $table->string('email')->nullable();

        $table->string('phone')->nullable();

        $table->string('website')->nullable();

        $table->string('gst_number')->nullable();

        $table->text('address')->nullable();

        $table->string('city')->nullable();

        $table->string('state')->nullable();

        $table->string('country')->default('India');

        $table->string('pincode')->nullable();

        $table->string('footer_text')->nullable();

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
