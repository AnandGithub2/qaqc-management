<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('samples', function (Blueprint $table) {


            $table->id();


            $table->foreignId('company_id')
            ->constrained()
            ->cascadeOnDelete();



            $table->foreignId('product_id')
            ->constrained()
            ->cascadeOnDelete();



            $table->string('sample_number')
            ->unique();



            $table->string('batch_number');



            $table->date('sample_date');



            $table->string('quantity')
            ->nullable();



            $table->text('remarks')
            ->nullable();



            $table->enum('status',[

                'Pending',
                'Testing',
                'Approved',
                'Rejected'

            ])
            ->default('Pending');



            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists('samples');

    }

};