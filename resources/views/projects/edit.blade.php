<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project bewerken') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Voeg de HTTP-PUT-methode toe voor het bijwerken -->

                        <div class="mb-3">
                            <label for="title" class="form-label">Titel</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Afbeelding</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if ($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="Current Image">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Beschrijving</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <select name="category_id" id="1">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <a class="btn btn-primary">
                            <input type="submit" value="Project opslaan">
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
