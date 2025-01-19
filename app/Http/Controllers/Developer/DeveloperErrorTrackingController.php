<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\ErrorTracking;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DeveloperErrorTrackingController extends Controller
{
    public function index()
    {
        $errorTrackings = ErrorTracking::with(['developer', 'project'])->paginate(10); // Paginate the results
        return view('developer.error_trackings.index', compact('errorTrackings'));
    }

    public function create()
    {
        $developers = User::where('role', '!=', 2)->get(); // Exclude users with role = 2
        $projects = Project::all();
        return view('developer.error_trackings.create', compact('developers', 'projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'developer_id' => 'required|exists:users,id', // Change to 'users' table
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'error_type' => 'required|string|max:255',
            'solution_description' => 'required|string',
            'solution_provided_by' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'comments' => 'nullable|string',
        ]);

        // Create the error tracking entry using the validated data
        ErrorTracking::create($validatedData);

        return redirect()->route('developer_error_trackings.index')->with('success', 'Error tracking entry created successfully.');
    }



    public function show($id)
    {
        $errorTracking = ErrorTracking::findOrFail($id); // Find the error tracking by ID
        return view('admin.error_trackings.show', compact('errorTracking'));
    }


    public function edit(ErrorTracking $errorTracking)
    {
        $developers = User::where('role', '!=', 2)->get(); // Exclude users with role = 2
        $projects = Project::all();
        return view('admin.error_trackings.edit', compact('errorTracking', 'developers', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'developer_id' => 'required|exists:users,id', // Change to 'users' table
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'error_type' => 'required|string|max:255',
            'solution_description' => 'required|string',
            'solution_provided_by' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'comments' => 'nullable|string',
        ]);

        // Find the error tracking entry by ID
        $errorTracking = ErrorTracking::findOrFail($id);

        // Update the error tracking entry with validated data
        $errorTracking->update($validatedData);

        return redirect()->route('developer_error_trackings.index')->with('success', 'Error tracking entry updated successfully.');
    }


    public function destroy(ErrorTracking $errorTracking)
    {
        $errorTracking->delete();

        return redirect()->route('developer_error_trackings.index')->with('success', 'Error tracking entry deleted successfully.');
    }

}