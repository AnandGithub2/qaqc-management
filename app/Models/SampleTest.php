<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SampleTest extends Model
{


    protected $fillable = [

        'sample_id',

        'test_parameter_id',

        'test_status',

        'result',

        'remarks'

    ];



    public function sample()
    {

        return $this->belongsTo(Sample::class);

    }



    public function testParameter()
    {

        return $this->belongsTo(TestParameter::class);

    }


}