<?php

namespace App\Http\Controllers;

use App\Models\TestCase;
use App\Models\TestExecution;
use App\Models\TestStepResult;
use Illuminate\Http\Request;

class TestExecutionController extends Controller
{
    public function index()
    {
        $testCases = TestCase::with(['system', 'steps'])
            ->where('status', 'active')
            ->get();
        
        $executions = TestExecution::with(['testCase', 'system', 'results'])
            ->latest()
            ->get();

        return view('executions.index', compact('testCases', 'executions'));
    }

    public function start(Request $request)
    {
        $request->validate([
            'test_case_id' => 'required|exists:test_cases,id',
            'executed_by' => 'required|string|max:255',
        ]);

        $testCase = TestCase::with('steps')->findOrFail($request->test_case_id);

        $execution = TestExecution::create([
            'test_case_id' => $testCase->id,
            'system_id' => $testCase->system_id,
            'executed_by' => $request->executed_by,
            'status' => 'pending',
            'started_at' => now(),
        ]);

        // Create step results
        foreach ($testCase->steps as $step) {
            TestStepResult::create([
                'test_execution_id' => $execution->id,
                'test_step_id' => $step->id,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('executions.show', $execution)
            ->with('success', 'Execução iniciada com sucesso!');
    }

    public function show(TestExecution $execution)
    {
        $execution->load(['testCase.steps', 'system', 'results.step']);
        return view('executions.show', compact('execution'));
    }

    public function updateStep(Request $request, TestExecution $execution)
    {
        $request->validate([
            'step_id' => 'required|exists:test_steps,id',
            'status' => 'required|in:passed,failed,blocked',
            'actual_result' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $stepResult = TestStepResult::where('test_execution_id', $execution->id)
            ->where('test_step_id', $request->step_id)
            ->firstOrFail();

        $stepResult->update([
            'status' => $request->status,
            'actual_result' => $request->actual_result,
            'notes' => $request->notes,
        ]);

        $execution->update(['status' => 'running']);

        return back()->with('success', 'Passo atualizado com sucesso!');
    }

    public function complete(Request $request, TestExecution $execution)
    {
        $request->validate([
            'status' => 'required|in:passed,failed',
            'notes' => 'nullable|string',
        ]);

        $execution->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'completed_at' => now(),
        ]);

        return redirect()->route('executions.index')
            ->with('success', 'Execução finalizada com sucesso!');
    }

    public function reset(TestExecution $execution)
    {
        $execution->update([
            'status' => 'pending',
            'notes' => '',
            'completed_at' => null,
        ]);

        $execution->results()->update([
            'status' => 'pending',
            'actual_result' => null,
            'notes' => null,
        ]);

        return back()->with('success', 'Execução resetada com sucesso!');
    }
}