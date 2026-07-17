<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('sample_tests', function (Blueprint $table) {


            $table->id();


            $table->foreignId('sample_id')
            ->constrained()
            ->cascadeOnDelete();



            $table->foreignId('test_parameter_id')
            ->constrained()
            ->cascadeOnDelete();



            $table->enum('test_status',[

                'Pending',
                'Completed',
                'Approved',
                'Rejected'

            ])
            ->default('Pending');



            $table->string('result')
            ->nullable();



            $table->text('remarks')
            ->nullable();



            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists('sample_tests');

    }

};