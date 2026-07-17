<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\COA;



class Sample extends Model
{
    protected $fillable = [

        'company_id',
        'product_id',
        'sample_number',
        'batch_number',
        'sample_date',
        'quantity',
        'remarks',

        'status',

        'qa_status',
        'approved_by',
        'approval_date',
        'approval_remarks',

    ];

    // Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Sample Tests
    public function sampleTests()
    {
        return $this->hasMany(SampleTest::class);
    }

    public function histories()
{
    return $this->hasMany(SampleHistory::class)
        ->latest();
}

    // Approved User
   public function approvedBy()
{
    return $this->belongsTo(User::class, 'approved_by');
}
public function coa()
{
    return $this->hasOne(COA::class);
}



   
}