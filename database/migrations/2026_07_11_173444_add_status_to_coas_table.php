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
  Schema::table('c_o_a_s', function (Blueprint $table) {

        $table->string('status')
        ->default('Generated');

    });
}


public function down(): void
{
    Schema::table('c_o_a_s', function (Blueprint $table) {

        $table->dropColumn('status');

    });
}
};
