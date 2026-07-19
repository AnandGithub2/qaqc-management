<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sample;
use App\Models\SampleTest;
use App\Models\COA;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Main Counts
        $companies = Company::count();
        $products = Product::count();
        $samples = Sample::count();
        $users = User::count();
        $totalCOA = COA::count();

        // Sample Status
        $sampleStatus = [
            'Approved' => Sample::where('qa_status', 'Approved')->count(),
            'Pending'  => Sample::where('qa_status', 'Pending')->count(),
            'Rejected' => Sample::where('qa_status', 'Rejected')->count(),
        ];

        // Test Status
        $testStatus = [
            'Completed' => SampleTest::where('test_status', 'Completed')->count(),
            'Pending'   => SampleTest::where('test_status', 'Pending')->count(),
            'Rejected'  => SampleTest::where('test_status', 'Rejected')->count(),
        ];

        // Dashboard Cards
        $pendingTests = SampleTest::where('test_status', 'Pending')->count();
        $approvedSamples = Sample::where('qa_status', 'Approved')->count();
        $rejectedSamples = Sample::where('qa_status', 'Rejected')->count();

        // Today Analytics
        $todaySamples = Sample::whereDate('created_at', today())->count();

        $todayApproved = Sample::whereDate('updated_at', today())
            ->where('qa_status', 'Approved')
            ->count();

        $approvalRate = $samples > 0
            ? round(($approvedSamples / $samples) * 100)
            : 0;

        // Recent Samples
        $recentSamples = Sample::with([
            'company',
            'product'
        ])
        ->latest()
        ->take(5)
        ->get();

        // Recent COA
        $recentCOA = COA::with('sample')
            ->latest()
            ->take(5)
            ->get();

        // Monthly Sample Trend
        $monthlySamples = Sample::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Company Wise Sample Count
        $companyStats = Company::withCount('samples')
            ->orderByDesc('samples_count')
            ->take(5)
            ->get();

        // Product Wise Sample Count
        $productStats = Product::withCount('samples')
            ->orderByDesc('samples_count')
            ->take(5)
            ->get();

        // Recent Users
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Activity Logs
        $activities = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.index', compact(
            'companies',
            'products',
            'samples',
            'users',
            'totalCOA',

            'sampleStatus',
            'testStatus',

            'pendingTests',
            'approvedSamples',
            'rejectedSamples',

            'todaySamples',
            'todayApproved',
            'approvalRate',

            'recentSamples',
            'recentCOA',

            'monthlySamples',
            'companyStats',
            'productStats',

            'recentUsers',
            'activities'
        ));
    }
}