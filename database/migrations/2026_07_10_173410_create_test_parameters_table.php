<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('test_parameters', function (Blueprint $table) {


            $table->id();


            $table->string('test_code')
            ->unique();


            $table->string('test_name');


            $table->string('unit')
            ->nullable();


            $table->string('specification')
            ->nullable();


            $table->boolean('status')
            ->default(true);


            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists('test_parameters');

    }

};