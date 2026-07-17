<?php

namespace App\Services;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

class AuditTrailService
{
    public static function store(
        $module,
        $recordId,
        $action,
        $oldData,
        $newData
    ) {
        AuditTrail::create([

            'user_id' => Auth::id(),

            'module' => $module,

            'record_id' => $recordId,

            'action' => $action,

           'old_data' => $oldData ? json_encode($oldData) : null,

'new_data' => $newData ? json_encode($newData) : null,

            'ip_address' => request()->ip(),

            'browser' => request()->userAgent(),

            'url' => request()->fullUrl(),

        ]);
    }
}