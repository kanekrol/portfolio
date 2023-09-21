<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Project 1',
            'description' => 'Dit is project 1',
            'image' => 'img/project1.jpg',
            'category_id' => 1,
        ]);
        Project::create([
            'title' => 'Project 2',
            'description' => 'Dit is project 2',
            'image' => 'img/project1.jpg',
            'category_id' => 2,
        ]);
        Project::create([
            'title' => 'Project 3',
            'description' => 'Dit is project 3',
            'image' => 'img/project1.jpg',
            'category_id' => 3,
        ]);
    }
}
