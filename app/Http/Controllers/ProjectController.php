<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::all();
        return view('projects.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('projects.index')->with('succes', 'Project is aangemaakt');        
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
        $categories = Category::all();
        $project = Project::findOrFail($id); // Zoek het project op basis van het ID
        return view('projects.edit', compact('project'), ['categories' => $categories]); // Laad de bewerkingsweergave en geef het project door
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'image' => ['image', 'max:2048'], // Validatieregels voor afbeeldingen bijwerken
            'description' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
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
