@extends('layouts.dashboard')

@section('title', 'Séminaires Programmés')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Liste des Séminaires Programmés</h1>

@forelse($seminaires as $seminaire)
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title h4">{{ $seminaire->title }}</h2>
            <p class="text-muted">
                <span class="badge bg-primary">{{ $seminaire->theme }}</span> • 
                Prévu le : <strong>{{ $seminaire->date_de_presentation->format('d/m/Y') }}</strong> •
                Présenté par : <strong>{{ $seminaire->presentateur->name }}</strong>
            </p>
            <p class="card-text">{{ Str::limit($seminaire->description, 200) }}</p>
            <a href="{{ route('seminaires.show', $seminaire->slug) }}" class="btn btn-outline-primary">Lire la suite →</a>
        </div>
    </div>
@empty
    <div class="card">
        <div class="card-body text-center">
            <p>Aucun séminaire n'est programmé pour le moment.</p>
        </div>
    </div>
@endforelse

<div class="d-flex justify-content-center">
    {{ $seminaires->links() }}
</div>

@endsection