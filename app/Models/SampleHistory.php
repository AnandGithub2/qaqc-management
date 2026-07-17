<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleHistory extends Model
{
    protected $fillable = [
        'sample_id',
        'user_id',
        'action',
        'remarks'
    ];

  public function sample()
{
    return $this->belongsTo(Sample::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}