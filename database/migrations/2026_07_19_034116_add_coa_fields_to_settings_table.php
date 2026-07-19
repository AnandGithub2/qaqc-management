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
    Schema::table('settings', function (Blueprint $table) {

        $table->string('license_no')->nullable();

        $table->string('iso_number')->nullable();

        $table->string('drug_license')->nullable();

        $table->string('company_tagline')->nullable();

    });
}

public function down(): void
{
    Schema::table('settings', function (Blueprint $table) {

        $table->dropColumn([

            'license_no',
            'iso_number',
            'drug_license',
            'company_tagline'

        ]);

    });
}
};
