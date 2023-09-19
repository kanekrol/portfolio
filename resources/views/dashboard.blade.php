<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<x-app-layout>
    <x-slot name="header">
        <div class="pull-right mb-2">
            <a class="btn btn-info" href="{{ route('projects.create') }}">Maak project aan</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Titel</th>
                                <th>Beschrijving</th>
                                <th>Afbeelding</th>
                                <th>Categorie</th>
                                <th>Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{$project->id}}</td>
                                <td>{{$project->title}}</td>
                                <td>{{$project->description}}</td>
                                <td><img src="{{ $project->image }}" alt="Project afbeelding" width='300px'></td>
                                <td>Test</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('projects.edit', $project->id) }}">Aanpassen</a>
                                    <a class="btn btn-danger" href="{{ route('projects.destroy', $project->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$project->id}}').submit();">Verwijderen</a>
                                    <form id="delete-form-{{$project->id}}" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
