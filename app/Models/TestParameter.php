<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TestParameter extends Model
{


    protected $fillable = [

        'test_code',

        'test_name',

        'unit',

        'specification',

        'status'

    ];

public function sampleTests()
{
    return $this->hasMany(SampleTest::class);
}
}