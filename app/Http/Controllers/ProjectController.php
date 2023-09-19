<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects/index')
        ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'image' => ['required', 'image', 'max:2048'], // Voeg validatieregels voor afbeeldingen toe
            'description' => ['required'],
        ]);
        
        // Upload de afbeelding en krijg het pad naar de opgeslagen afbeelding
        $imagePath = $request->file('image')->store('project_images', 'public');
        
        Project::create([
            'title' => $request->input('title'),
            'image' => $imagePath, // Sla het pad naar de afbeelding op in de database
            'description' => $request->input('description'),
        ]);
        
        return redirect()
            ->route('dashboard')
            ->with('success', 'Project created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
