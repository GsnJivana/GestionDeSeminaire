@extends('layouts.dashboard')

@section('title', $seminaire->title)

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title">{{ $seminaire->title }}</h1>
        <hr>
        <p class="text-muted">
            <span class="badge bg-primary fs-6 me-2">{{ $seminaire->theme }}</span>
            <i class="fas fa-calendar-alt me-1"></i> {{ $seminaire->date_de_presentation->format('l d F Y') }}
        </p>

        <h5 class="mt-4">Présentateur Principal</h5>
        <p>{{ $seminaire->presentateur->name }}</p>

        @if($seminaire->copresentateur->isNotEmpty())
            <h5 class="mt-3">Co-présentateurs</h5>
            <ul class="list-inline">
                @foreach($seminaire->copresentateur as $coPres)
                    <li class="list-inline-item"><span class="badge bg-secondary">{{ $coPres->name }}</span></li>
                @endforeach
            </ul>
        @endif

        <h5 class="mt-4">Description</h5>
        <div class="mt-2" style="white-space: pre-wrap;">{{ $seminaire->description }}</div>

        
        @if($seminaire->resume_de_la_presentation_path)
            <hr>
            <a href="{{ Storage::url($seminaire->resume_de_la_presentation_path) }}" class="btn btn-success" target="_blank">
                <i class="fas fa-file-pdf"></i> Télécharger le résumé
            </a>
        @endif
    </div>
</div>
@endsection