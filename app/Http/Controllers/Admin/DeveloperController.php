<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return view('admin.developers.index', compact('developers'));
    }

    public function create()
    {
        return view('admin.developers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'mobile' => 'nullable|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        Developer::create($validatedData);

        return redirect()->route('developers.index')->with('success', 'Developer added successfully.');
    }


    public function show(Developer $developer)
    {
        return view('developers.show', compact('developer'));
    }

    public function edit(Developer $developer)
    {
        return view('admin.developers.edit', compact('developer'));
    }

    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'nullable|max:255',
            'mobile' => 'nullable|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $developer->update($request->all());

        return redirect()->route('developers.index')->with('success', 'Developer updated successfully.');
    }

    public function destroy(Developer $developer)
    {
        $developer->delete();

        return redirect()->route('developers.index')->with('success', 'Developer deleted successfully.');
    }
}