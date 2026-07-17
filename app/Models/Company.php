<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Company extends Model
{
    protected $fillable = [

        'company_code',
        'company_name',
        'email',
        'phone',
        'gst_number',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'status'

    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function samples()
{
    return $this->hasMany(Sample::class);
}
}