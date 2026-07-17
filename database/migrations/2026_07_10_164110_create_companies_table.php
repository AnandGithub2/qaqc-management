<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {

            $table->id();

            $table->string('company_code')->unique();

            $table->string('company_name');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('gst_number')->nullable();

            $table->text('address')->nullable();

            $table->string('city')->nullable();

            $table->string('state')->nullable();

            $table->string('country')->default('India');

            $table->string('pincode')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};