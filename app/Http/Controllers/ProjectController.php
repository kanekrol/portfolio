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
    public function edit($id)
    {
        $project = Project::findOrFail($id); // Zoek het project op basis van het ID
        return view('projects.edit', compact('project')); // Laad de bewerkingsweergave en geef het project door
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'image' => ['image', 'max:2048'], // Validatieregels voor afbeeldingen bijwerken
            'description' => ['required'],
        ]);

        $project = Project::findOrFail($id); // Zoek het project op basis van het ID

        // Bijwerken van de projectgegevens
        $project->title = $request->input('title');
        
        // Controleer of er een nieuwe afbeelding is geüpload en update de afbeelding indien nodig
        if ($request->hasFile('image')) {
            // Verwijder de oude afbeelding (optioneel)
            // Storage::delete('public/' . $project->image);

            // Upload de nieuwe afbeelding en bewaar het pad
            $imagePath = $request->file('image')->store('project_images', 'public');
            $project->image = $imagePath;
        }

        $project->description = $request->input('description');
        $project->save();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Project bijgewerkt');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id); // Zoek het project op basis van het ID

        // Optioneel: Verwijder de bijbehorende afbeelding als die er is
        // Storage::delete('public/' . $project->image);

        $project->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Project verwijderd');
    }
}
