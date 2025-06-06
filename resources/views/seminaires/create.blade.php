@extends('layouts.dashboard')

@section('title', 'Proposer un Séminaire')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Proposer un nouveau séminaire</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('seminaires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titre du séminaire</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="theme" class="form-label">Thème</label>
                <input type="text" class="form-control" id="theme" name="theme" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description détaillée</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            
            
            <div class="mb-3">
                <label for="co_presentateurs" class="form-label">Sélectionner des co-présentateurs (optionnel)</label>
                <select multiple class="form-control" id="co_presentateurs" name="co_presentateurs[]">
                    @foreach($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}">{{ $enseignant->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Maintenez la touche Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs personnes.</small>
            </div>

            

            <button type="submit" class="btn btn-primary">Soumettre la proposition</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')

@endpush