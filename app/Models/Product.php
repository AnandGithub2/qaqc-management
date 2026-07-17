<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    protected $fillable = [

        'company_id',

        'product_code',

        'product_name',

        'description',

        'category',

        'status'

    ];



    public function company()
    {

        return $this->belongsTo(Company::class);

    }

    public function samples()
{
    return $this->hasMany(Sample::class);
}

}