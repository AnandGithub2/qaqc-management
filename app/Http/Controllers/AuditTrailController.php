<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;

class AuditTrailController extends Controller
{

    public function index()
    {

        $audits = AuditTrail::with('user')
        ->latest()
        ->get();


        return view(
            'audit.index',
            compact('audits')
        );

    }
    

}