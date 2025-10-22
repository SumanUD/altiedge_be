<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    // AdminLTE: list programs
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    // Show create form
    public function create()
    {
        return view('admin.programs.create');
    }

    // Store new program
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'program_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Program::create($validated);

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    // Show edit form
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    // Update program
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'program_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $program->update($validated);

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    // Delete program
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }

    // API for frontend
    public function apiIndex()
    {
        $programs = Program::latest()->get();
        return response()->json($programs);
    }

    public function apiShow($id)
    {
        $program = Program::findOrFail($id);
        return response()->json($program);
    }
}
