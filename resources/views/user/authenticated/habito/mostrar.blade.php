@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="display-4 fw-bold text-primary">
            Mis Hábitos
        </h1>
        <a href="{{ route('habitos.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
            Nuevo Hábito
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($habitos->isEmpty())
        <div class="alert alert-info p-4 text-center" role="alert">
            <div class="mb-3">
                <i class="fas fa-info-circle fa-3x"></i>
            </div>
            <h4 class="alert-heading">¡No tienes hábitos registrados!</h4>
            <p>Comienza tu seguimiento de hábitos haciendo clic en el botón "Nuevo Hábito".</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($habitos as $habito)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light py-3 border-0 rounded-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 fw-bold text-primary">
                                    {{ $habito->actividad->tipo_actividad }}
                                </h4>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('habitos.edit', $habito->id) }}">
                                                <i class="fas fa-edit me-2 text-warning"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('habitos.destroy', $habito->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este hábito?')">
                                                    <i class="fas fa-trash-alt me-2"></i> Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row align-items-center mb-4">
                                <div class="col-7">
                                    <h5 class="text-muted mb-2">Alimento consumido:</h5>
                                    <h4>{{ $habito->alimento->nombre }}</h4>
                                </div>
                                <div class="col-5">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <h6 class="text-primary mb-1">Total calorías</h6>
                                        <h2 class="mb-0 fw-bold">{{ $habito->valor }}</h2>
                                        <small class="text-muted">kcal</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary px-3 py-2">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $habito->created_at->format('d-m-Y') }}
                                    </span>
                                </div>
                                <div>
                                    <span class="badge bg-secondary px-3 py-2">
                                        <i class="fas fa-clock me-1"></i> {{ $habito->created_at->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                            
                            <hr class="my-3">
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('habitos.edit', $habito->id) }}" class="btn btn-outline-warning flex-grow-1">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>
                                <form action="{{ route('habitos.destroy', $habito->id) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('¿Estás seguro de que deseas eliminar este hábito?')">
                                        <i class="fas fa-trash-alt me-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="d-block d-md-none position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <a href="{{ route('habitos.create') }}" class="btn btn-primary rounded-circle shadow p-3">
        <i class="fas fa-plus fa-lg"></i>
    </a>
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn {
        border-radius: 8px;
    }
    
    .badge {
        font-weight: 500;
    }
</style>
@endsection