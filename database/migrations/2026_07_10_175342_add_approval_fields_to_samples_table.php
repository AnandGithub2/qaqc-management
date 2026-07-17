<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('samples', function (Blueprint $table) {


            $table->enum('qa_status',[

                'Pending',
                'Approved',
                'Rejected'

            ])
            ->default('Pending');


            $table->string('approved_by')
            ->nullable();


            $table->date('approval_date')
            ->nullable();


            $table->text('approval_remarks')
            ->nullable();


        });

    }



    public function down(): void
    {

        Schema::table('samples', function (Blueprint $table) {


            $table->dropColumn([

                'qa_status',

                'approved_by',

                'approval_date',

                'approval_remarks'

            ]);


        });

    }

};