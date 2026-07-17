<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('c_o_a_s', function (Blueprint $table) {

            $table->id();

            $table->foreignId('sample_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('coa_number')
                ->unique();

            $table->date('issue_date');

            $table->string('prepared_by')
                ->nullable();

            $table->string('approved_by')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('c_o_a_s');
    }

};