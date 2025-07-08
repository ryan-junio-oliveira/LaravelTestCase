<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\TestCase;
use App\Models\TestExecution;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $systems = System::all();
        $testCases = TestCase::with('system')->get();
        $executions = TestExecution::with(['testCase', 'system'])->latest()->get();

        $stats = [
            'totalSystems' => $systems->count(),
            'activeSystems' => $systems->where('status', 'active')->count(),
            'totalTestCases' => $testCases->count(),
            'activeTestCases' => $testCases->where('status', 'active')->count(),
            'totalExecutions' => $executions->count(),
            'passedExecutions' => $executions->where('status', 'passed')->count(),
            'failedExecutions' => $executions->where('status', 'failed')->count(),
            'runningExecutions' => $executions->where('status', 'running')->count(),
        ];

        $passRate = $stats['totalExecutions'] > 0 
            ? round(($stats['passedExecutions'] / $stats['totalExecutions']) * 100) 
            : 0;

        $recentExecutions = $executions->take(5);

        return view('dashboard', compact('stats', 'passRate', 'recentExecutions', 'systems', 'testCases'));
    }
}