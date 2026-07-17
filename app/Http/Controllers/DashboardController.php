<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ActivityLog;

use App\Models\Company;
use App\Models\Product;
use App\Models\Sample;
use App\Models\SampleTest;
use App\Models\COA;


class DashboardController extends Controller
{


    public function index()
    {


        $companies = Company::count();


        $products = Product::count();


        $samples = Sample::count();
        $sampleStatus = [

    'Approved' => Sample::where(
        'qa_status',
        'Approved'
    )->count(),


    'Pending' => Sample::where(
        'qa_status',
        'Pending'
    )->count(),


    'Rejected' => Sample::where(
        'qa_status',
        'Rejected'
    )->count(),

];



$testStatus = [

    'Completed' => SampleTest::where(
        'test_status',
        'Completed'
    )->count(),


    'Pending' => SampleTest::where(
        'test_status',
        'Pending'
    )->count(),


    'Rejected' => SampleTest::where(
        'test_status',
        'Rejected'
    )->count(),

];

        $pendingTests = SampleTest::where(
            'test_status',
            'Pending'
        )->count();



        $approvedSamples = Sample::where(
            'qa_status',
            'Approved'
        )->count();



        $rejectedSamples = Sample::where(
            'qa_status',
            'Rejected'
        )->count();



        $recentSamples = Sample::with([
            'company',
            'product'
        ])
        ->latest()
        ->limit(5)
        ->get();

        
$activities = ActivityLog::with('user')
    ->latest()
    ->take(10)
    ->get();

$users = User::count();
          $totalCOA = COA::count();



        return view(
    'dashboard.index',
compact(
    'companies',
    'products',
    'samples',
    'pendingTests',
    'approvedSamples',
    'rejectedSamples',
    'recentSamples',
    'sampleStatus',
    'testStatus',
    'activities',
    'users',
    'totalCOA'
)
);


    }


}