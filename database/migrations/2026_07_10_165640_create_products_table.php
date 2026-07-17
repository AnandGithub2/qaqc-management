<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('products', function (Blueprint $table) {


            $table->id();


            $table->foreignId('company_id')
                  ->constrained()
                  ->cascadeOnDelete();


            $table->string('product_code')
                  ->unique();


            $table->string('product_name');


            $table->text('description')
                  ->nullable();


            $table->string('category')
                  ->nullable();


            $table->boolean('status')
                  ->default(true);


            $table->timestamps();


        });

    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }

};