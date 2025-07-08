<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        $systems = System::latest()->get();
        return view('systems.index', compact('systems'));
    }

    public function create()
    {
        return view('systems.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:50',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        System::create($request->all());

        return redirect()->route('systems.index')
            ->with('success', 'Sistema criado com sucesso!');
    }

    public function edit(System $system)
    {
        return view('systems.edit', compact('system'));
    }

    public function update(Request $request, System $system)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:50',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        $system->update($request->all());

        return redirect()->route('systems.index')
            ->with('success', 'Sistema atualizado com sucesso!');
    }

    public function destroy(System $system)
    {
        $system->testCases()->delete();
        $system->executions()->delete();
        $system->delete();

        return redirect()->route('systems.index')
            ->with('success', 'Sistema excluído com sucesso!');
    }
}