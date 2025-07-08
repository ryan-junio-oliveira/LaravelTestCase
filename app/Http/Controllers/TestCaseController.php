<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\TestCase;
use App\Models\TestStep;
use Illuminate\Http\Request;

class TestCaseController extends Controller
{
    public function index()
    {
        $testCases = TestCase::with(['system', 'steps'])->latest()->get();
        $systems = System::all();
        return view('test-cases.index', compact('testCases', 'systems'));
    }

    public function create()
    {
        $systems = System::where('status', 'active')->get();
        return view('test-cases.create', compact('systems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'system_id' => 'required|exists:systems,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expected_result' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
            'status' => 'required|in:draft,active,archived',
            'steps' => 'required|array|min:1',
            'steps.*.action' => 'required|string',
            'steps.*.expected_result' => 'required|string',
        ]);

        $testCase = TestCase::create($request->only([
            'system_id', 'title', 'description', 'expected_result', 'priority', 'status'
        ]));

        foreach ($request->steps as $index => $stepData) {
            TestStep::create([
                'test_case_id' => $testCase->id,
                'step_number' => $index + 1,
                'action' => $stepData['action'],
                'expected_result' => $stepData['expected_result'],
            ]);
        }

        return redirect()->route('test-cases.index')
            ->with('success', 'Caso de teste criado com sucesso!');
    }

    public function edit(TestCase $testCase)
    {
        $systems = System::where('status', 'active')->get();
        $testCase->load('steps');
        return view('test-cases.edit', compact('testCase', 'systems'));
    }

    public function update(Request $request, TestCase $testCase)
    {
        $request->validate([
            'system_id' => 'required|exists:systems,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expected_result' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
            'status' => 'required|in:draft,active,archived',
            'steps' => 'required|array|min:1',
            'steps.*.action' => 'required|string',
            'steps.*.expected_result' => 'required|string',
        ]);

        $testCase->update($request->only([
            'system_id', 'title', 'description', 'expected_result', 'priority', 'status'
        ]));

        // Remove existing steps and create new ones
        $testCase->steps()->delete();
        
        foreach ($request->steps as $index => $stepData) {
            TestStep::create([
                'test_case_id' => $testCase->id,
                'step_number' => $index + 1,
                'action' => $stepData['action'],
                'expected_result' => $stepData['expected_result'],
            ]);
        }

        return redirect()->route('test-cases.index')
            ->with('success', 'Caso de teste atualizado com sucesso!');
    }

    public function destroy(TestCase $testCase)
    {
        $testCase->steps()->delete();
        $testCase->executions()->delete();
        $testCase->delete();

        return redirect()->route('test-cases.index')
            ->with('success', 'Caso de teste excluído com sucesso!');
    }
}