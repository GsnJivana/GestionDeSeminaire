@extends('layouts.dashboard')

@section('title', 'Tableau de bord')

@section('content')
    <div class="alert alert-info">
        <h4 class="alert-heading">Bienvenue, {{ Auth::user()->name }} !</h4>
        <p>Ceci est votre nouvel espace de travail. Le menu sur la gauche s'adapte à votre rôle <strong>({{ Auth::user()->role }})</strong> et la page actuelle est mise en évidence.</p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Raccourci rapide</h5>
                    <p class="card-text">Vous pouvez commencer par gérer les articles si vous avez les permissions.</p>
                    @can('manage-articles')
                        <a href="{{ route('articles.index') }}" class="btn btn-primary">Gérer les articles</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection