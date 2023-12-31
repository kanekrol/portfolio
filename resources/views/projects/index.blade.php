<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<x-app-layout>
    <x-slot name="header">
        <div class="pull-right mb-2">
            <h1>Mijn projecten</h1>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="col-md-6">
                        <form method="get" action="/search">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Search..." value="{{ isset($search) ? $search : ''}}">
                                <button type="submit" class="btn btn-primary">Zoek</button>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Titel</th>
                                <th>Beschrijving</th>
                                <th>Afbeelding</th>
                                <th>Categorie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{$project->id}}</td>
                                <td>{{$project->title}}</td>
                                <td>{{$project->description}}</td>
                                <td><img src="{{ $project->image }}" alt="Project afbeelding" width='300px'></td>
                                <td>{{$project->category->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
