<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Séminaires')</title>
    
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
   
    <style>
        
        body { 
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa; 
        }

        
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            position: fixed; 
            top: 0; 
            left: 0; 
            
            background: linear-gradient(360deg, #6b4f4b, #4a2c2a);
            padding: 1.5rem 0; 
            display: flex;
            flex-direction: column;
        }

        .main-content { 
            margin-left: 260px; 
            padding: 2rem; 
        }

        
        .sidebar-header { 
            padding: 0 1.5rem 1.5rem 1.5rem; 
            text-align: center; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
            margin-bottom: 1rem; 
        }
        .sidebar-header h3 { 
            color: #f9fafb; 
            font-weight: 600; 
        }

        
        .user-profile { 
            padding: 0.75rem 1.5rem;
            margin: 0 1rem 1rem 1rem;
            border-radius: 8px;
            transition: background-color 0.2s ease-in-out;
        }
        .user-profile:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        .user-avatar { 
            width: 45px; height: 45px; 
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5); 
            margin-right: 12px;
            object-fit: cover; 
        }
        .user-profile .d-block {
            color: #e5e7eb;
            font-weight: 500;
        }
        .user-profile .text-muted {
            color: #d1d5db !important; 
            font-size: 0.8rem;
        }

        
        .nav-container {
            flex-grow: 1; 
        }
        .sidebar .nav-link { 
            color: #d1d5db; 
            padding: 0.9rem 1.5rem; 
            margin: 0.2rem 0;
            display: flex; 
            align-items: center; 
            border-left: 4px solid transparent; 
            text-decoration: none; 
            transition: all 0.2s ease-in-out; 
        }
        .sidebar .nav-link:hover { 
            color: #ffffff; 
            background-color: rgba(255, 255, 255, 0.08); 
        }
       
        .sidebar .nav-link.active { 
            color: #f5650b;
            background-color: rgba(245, 158, 11, 0.1); 
            border-left-color: #f59e0b; 
            font-weight: 500;
        }
        .sidebar .nav-link .fa-fw { 
            margin-right: 14px; 
            width: 20px;
            text-align: center;
        }
        
        
        .sidebar-footer { 
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .btn-logout {
            background-color: transparent;
            border: 1px solid #9d6b53;
            color: #d1d5db;
            transition: all 0.2s ease-in-out;
        }
        .btn-logout:hover {
            background-color: #9d6b53;
            color: #ffffff;
            border-color: #9d6b53;
        }

        
        .card { 
            border: none; 
            box-shadow: 0 4px 25px rgba(0,0,0,0.07); 
            border-radius: 10px; 
        }
    </style>
</head>
<body>

    @auth
    <div class="sidebar">
       
        <div class="sidebar-header">
            <h3><i class="fas fa-graduation-cap"></i> Séminaires</h3>
        </div>

        
        <div class="user-profile d-flex align-items-center">
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://i.pravatar.cc/50?u=' . Auth::id() }}" alt="Avatar" class="user-avatar">
            <div>
                <strong class="d-block">{{ Auth::user()->name }}</strong>
                <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
            </div>
        </div>
        
       
        <div class="nav-container">
            <ul class="nav flex-column">
                
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home fa-fw"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('seminaires*') ? 'active' : '' }}" href="{{ route('seminaires.index') }}">
                        <i class="fas fa-calendar-alt fa-fw"></i> Séminaires Programmés
                    </a>
                </li>
                
                
                @if(Auth::user()->role == 'enseignant')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('seminaires/create') ? 'active' : '' }}" href="{{ route('seminaires.create') }}">
                        <i class="fas fa-plus-circle fa-fw"></i> Proposer un séminaire
                    </a>
                </li>
                @endif
                
               
                @if(Auth::user()->role == 'secretaire')
                 <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/seminaires/validation') ? 'active' : '' }}" href="{{ route('admin.seminaires.validation') }}">
                        <i class="fas fa-check-square fa-fw"></i> Valider les demandes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.create') }}">
                        <i class="fas fa-users-cog fa-fw"></i> Gérer les utilisateurs
                    </a>
                </li>
                @endif
            </ul>
        </div>
        
   
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout w-100">
                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                </button>
            </form>
        </div>
    </div>
    @endauth

    <main class="main-content">
        <div class="container-fluid">
            
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        
            @yield('content')

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>