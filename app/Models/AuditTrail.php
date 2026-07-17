<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{

    protected $fillable = [

        'user_id',
        'module',
        'record_id',
        'action',
        'old_data',
        'new_data',
        'ip_address',
        'browser',
        'url'

    ];

    protected $casts = [

        'old_data' => 'array',

        'new_data' => 'array',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}