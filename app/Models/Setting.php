<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [

        'company_name',
        'company_logo',
        'email',
        'phone',
        'website',
        'gst_number',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'footer_text',
        'license_no',
'iso_number',
'drug_license',
'company_tagline',

    ];

}