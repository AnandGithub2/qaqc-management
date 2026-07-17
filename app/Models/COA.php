<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class COA extends Model
{

protected $fillable=[

'sample_id',
'coa_number',
'issue_date',
'prepared_by',
'approved_by',
'remarks',
'status'

];


public function sample()
{
    return $this->belongsTo(Sample::class);
}

}