<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;
use App\Services\AuditTrailService;

class CompanyController extends Controller
{

   public function index(Request $request)
{
    $search = $request->search;

    $companies = Company::when($search, function ($query) use ($search) {

        $query->where('company_name', 'like', "%{$search}%")
              ->orWhere('company_code', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");

    })
    ->latest()
    ->paginate(10)
    ->withQueryString();

    return view('companies.index', compact('companies', 'search'));
}
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_code' => 'required|unique:companies',
            'company_name' => 'required',
            'email' => 'nullable|email',
        ]);

        $company = Company::create([

            'company_code' => $request->company_code,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gst_number' => $request->gst_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country ?? 'India',
            'pincode' => $request->pincode,
            'status' => $request->status ?? 1,

        ]);

        AuditTrailService::store(
    'Company',
    $company->id,
    'Create',
    null,
    $company->toArray()
);

        // Activity Log
        ActivityLogService::log(
            'Create',
            'Company',
            'Company "' . $company->company_name . '" created.'
        );

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company Added Successfully');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {

        $request->validate([
            'company_code' => 'required',
            'company_name' => 'required',
            'email' => 'nullable|email',
        ]);
$oldData = $company->toArray();
        $company->update([

            'company_code' => $request->company_code,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gst_number' => $request->gst_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country ?? 'India',
            'pincode' => $request->pincode,
            'status' => $request->status ?? 1,

        ]);
        AuditTrailService::store(
    'Company',
    $company->id,
    'Update',
    $oldData,
    $company->fresh()->toArray()
);

        // Activity Log
        ActivityLogService::log(
            'Update',
            'Company',
            'Company "' . $company->company_name . '" updated.'
        );

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company Updated Successfully');
    }

    public function destroy(Company $company)
{
    $name = $company->company_name;

    $oldData = $company->toArray();

    $company->delete();

    ActivityLogService::log(
        'Delete',
        'Company',
        'Company "' . $name . '" deleted.'
    );

    AuditTrailService::store(
        'Company',
        $company->id,
        'Delete',
        $oldData,
        null
    );

    return redirect()
        ->route('companies.index')
        ->with('success', 'Company Deleted Successfully');
}


}