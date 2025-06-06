@extends('layouts.dashboard')

@section('title', 'Valider les Séminaires')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Demandes de séminaires en attente</h1>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Thème</th>
                    <th>Présentateur Principal</th>
                    <th>Date de la demande</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($seminairesEnAttente as $seminaire)
                <tr>
                    <td>{{ $seminaire->title }}</td>
                    <td>{{ $seminaire->theme }}</td>
                    <td>{{ $seminaire->presentateur->name }}</td>
                    <td>{{ $seminaire->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.seminaires.valider', $seminaire) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="input-group">
                                <input type="date" name="date_de_presentation" class="form-control" required>
                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune demande de séminaire en attente.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection