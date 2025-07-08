@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-primary text-white py-3 border-0">
                    <h3 class="mb-0 fw-bold text-center">
                        <i class="fas fa-plus-circle me-2"></i> Crear Nuevo Hábito
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('habitos.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="actividades" class="form-label fw-bold mb-0">
                                    <i class="fas fa-running me-1"></i> Actividad
                                </label>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#nuevaActividadModal">
                                    <i class="fas fa-plus me-1"></i> Nueva actividad
                                </button>
                            </div>
                            <select class="form-select @error('actividad_id') is-invalid @enderror" name="actividad_id" id="actividades" required onchange="calcularCalorias()">
                                <option value="" disabled {{ !session('nueva_actividad_id') && !old('actividad_id') ? 'selected' : '' }}>Selecciona una actividad...</option>
                                @foreach($actividades as $actividad)
                                    <option value="{{ $actividad->id }}" data-calorias="{{ $actividad->calorias_quemadas }}" 
                                        {{ (session('nueva_actividad_id') == $actividad->id || old('actividad_id') == $actividad->id) ? 'selected' : '' }}>
                                        {{ $actividad->tipo_actividad }} (quema {{ $actividad->calorias_quemadas }} kcal)
                                    </option>
                                @endforeach
                            </select>
                            @error('actividad_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">
                                Selecciona la actividad física realizada (gasto de calorías)
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="alimentos" class="form-label fw-bold mb-0">
                                    <i class="fas fa-apple-alt me-1"></i> Alimento
                                </label>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#nuevoAlimentoModal">
                                    <i class="fas fa-plus me-1"></i> Nuevo alimento
                                </button>
                            </div>
                            <select class="form-select @error('alimento_id') is-invalid @enderror" name="alimento_id" id="alimentos" required onchange="calcularCalorias()">
                                <option value="" disabled {{ !session('nuevo_alimento_id') && !old('alimento_id') ? 'selected' : '' }}>Selecciona un alimento...</option>
                                @foreach($alimentos as $alimento)
                                    <option value="{{ $alimento->id }}" data-calorias="{{ $alimento->calorias }}" 
                                        {{ (session('nuevo_alimento_id') == $alimento->id || old('alimento_id') == $alimento->id) ? 'selected' : '' }}>
                                        {{ $alimento->nombre }} (aporta {{ $alimento->calorias }} kcal)
                                    </option>
                                @endforeach
                            </select>
                            @error('alimento_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">
                                Selecciona el alimento consumido (ingreso de calorías)
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="valor" class="form-label fw-bold">
                                <i class="fas fa-balance-scale me-1"></i> Balance Calórico
                            </label>
                            <div class="input-group">
                                <input 
                                    type="number" 
                                    class="form-control @error('valor') is-invalid @enderror" 
                                    id="valor" 
                                    name="valor" 
                                    placeholder="Balance calculado automáticamente" 
                                    value="{{ old('valor') }}"
                                    readonly
                                    required
                                >
                                <span class="input-group-text">kcal</span>
                                @error('valor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text text-muted">
                                <i class="fas fa-calculator me-1"></i> Calorías consumidas menos calorías quemadas
                            </div>
                        </div>
                        
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h6 class="card-title">Resumen de calorías</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span id="resumenIngreso"><i class="fas fa-plus-circle text-success me-1"></i> Ingreso: 0 kcal</span>
                                    <span id="resumenGasto"><i class="fas fa-minus-circle text-danger me-1"></i> Gasto: 0 kcal</span>
                                </div>
                                <div class="progress">
                                    <div id="progressBalance" class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="-1000" aria-valuemax="1000"></div>
                                </div>
                                <div class="text-center mt-2">
                                    <span id="resultadoBalance" class="badge bg-secondary">Selecciona actividad y alimento</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info" role="alert">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-lightbulb fa-2x"></i>
                                </div>
                                <div>
                                    <strong>¿Cómo se calcula el balance?</strong>
                                    <p class="mb-0">El balance calórico se obtiene restando las calorías quemadas durante la actividad física de las calorías aportadas por el alimento consumido. Un balance positivo indica que has consumido más calorías de las que has quemado.</p>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('habitos.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Guardar Hábito
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-3 mt-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle me-2"></i> Consejos</h5>
                    <p class="card-text">
                        Un balance calórico negativo favorece la pérdida de peso, mientras que un balance positivo puede contribuir a ganar peso. 
                        Para mantener el peso, busca un equilibrio entre las calorías consumidas y las quemadas.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevaActividadModal" tabindex="-1" aria-labelledby="nuevaActividadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="nuevaActividadModalLabel"><i class="fas fa-running me-2"></i> Nueva Actividad</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('actividades.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tipo_actividad" class="form-label">Tipo de Actividad</label>
                        <input type="text" class="form-control @error('tipo_actividad') is-invalid @enderror" 
                               id="tipo_actividad" name="tipo_actividad" value="{{ old('tipo_actividad') }}" required>
                        @error('tipo_actividad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="calorias_quemadas" class="form-label">Calorías quemadas</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('calorias_quemadas') is-invalid @enderror" 
                                   id="calorias_quemadas" name="calorias_quemadas" value="{{ old('calorias_quemadas') }}" min="0" required>
                            <span class="input-group-text">kcal</span>
                        </div>
                        @error('calorias_quemadas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="duracion_minutos" class="form-label">Duración</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('duracion_minutos') is-invalid @enderror" 
                                   id="duracion_minutos" name="duracion_minutos" value="{{ old('duracion_minutos') }}" min="1" required>
                            <span class="input-group-text">minutos</span>
                        </div>
                        @error('duracion_minutos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Actividad</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevoAlimentoModal" tabindex="-1" aria-labelledby="nuevoAlimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="nuevoAlimentoModalLabel"><i class="fas fa-apple-alt me-2"></i> Nuevo Alimento</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('alimentos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Alimento</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="calorias" class="form-label">Calorías</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('calorias') is-invalid @enderror" 
                                   id="calorias" name="calorias" value="{{ old('calorias') }}" min="0" required>
                            <span class="input-group-text">kcal</span>
                        </div>
                        @error('calorias')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                            <option value="" disabled {{ !old('tipo') ? 'selected' : '' }}>Selecciona un tipo...</option>
                            <option value="Fruta" {{ old('tipo') == 'Fruta' ? 'selected' : '' }}>Fruta</option>
                            <option value="Verdura" {{ old('tipo') == 'Verdura' ? 'selected' : '' }}>Verdura</option>
                            <option value="Proteína" {{ old('tipo') == 'Proteína' ? 'selected' : '' }}>Proteína</option>
                            <option value="Carbohidrato" {{ old('tipo') == 'Carbohidrato' ? 'selected' : '' }}>Carbohidrato</option>
                            <option value="Grasa" {{ old('tipo') == 'Grasa' ? 'selected' : '' }}>Grasa</option>
                            <option value="Bebida" {{ old('tipo') == 'Bebida' ? 'selected' : '' }}>Bebida</option>
                            <option value="Otro" {{ old('tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Alimento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-label {
        margin-bottom: 0.5rem;
    }
    
    .form-select, .form-control {
        padding: 0.75rem 1rem;
        border-radius: 8px;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    
    input[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }
    
    .progress {
        height: 0.75rem;
        border-radius: 1rem;
        background-color: #e9ecef;
    }
    
    .progress-bar.positivo {
        background-color: #198754;
    }
    
    .progress-bar.negativo {
        background-color: #dc3545;
    }
    
    .progress-bar.equilibrado {
        background-color: #0d6efd;
    }
    
    .modal-header {
        border-radius: 0.5rem 0.5rem 0 0;
    }
</style>

<script>
function calcularCalorias() {
    const actividadSelect = document.getElementById('actividades');
    const alimentoSelect = document.getElementById('alimentos');
    const valorInput = document.getElementById('valor');
    
    const resumenIngreso = document.getElementById('resumenIngreso');
    const resumenGasto = document.getElementById('resumenGasto');
    const progressBalance = document.getElementById('progressBalance');
    const resultadoBalance = document.getElementById('resultadoBalance');
    
    const actividadOption = actividadSelect.options[actividadSelect.selectedIndex];
    const alimentoOption = alimentoSelect.options[alimentoSelect.selectedIndex];
    
    if (actividadSelect.selectedIndex > 0 && alimentoSelect.selectedIndex > 0) {
        const caloriasQuemadas = parseInt(actividadOption.getAttribute('data-calorias')) || 0;
        const caloriasConsumidas = parseInt(alimentoOption.getAttribute('data-calorias')) || 0;
        
        const balanceCalorico = caloriasConsumidas - caloriasQuemadas;
        valorInput.value = balanceCalorico;
        
        resumenIngreso.innerHTML = `<i class="fas fa-plus-circle text-success me-1"></i> Ingreso: ${caloriasConsumidas} kcal`;
        resumenGasto.innerHTML = `<i class="fas fa-minus-circle text-danger me-1"></i> Gasto: ${caloriasQuemadas} kcal`;
        
        if (balanceCalorico > 0) {
            progressBalance.className = 'progress-bar positivo';
            progressBalance.style.width = `${Math.min(75 + (balanceCalorico / 20), 100)}%`;
            resultadoBalance.className = 'badge bg-success';
            resultadoBalance.innerText = `Balance positivo: +${balanceCalorico} kcal`;
        } else if (balanceCalorico < 0) {
            progressBalance.className = 'progress-bar negativo';
            progressBalance.style.width = `${Math.max(25 + (balanceCalorico / 20), 0)}%`;
            resultadoBalance.className = 'badge bg-danger';
            resultadoBalance.innerText = `Balance negativo: ${balanceCalorico} kcal`;
        } else {
            progressBalance.className = 'progress-bar equilibrado';
            progressBalance.style.width = '50%';
            resultadoBalance.className = 'badge bg-primary';
            resultadoBalance.innerText = 'Balance neutro: 0 kcal';
        }
    } else {
        valorInput.value = '';
        resumenIngreso.innerHTML = '<i class="fas fa-plus-circle text-success me-1"></i> Ingreso: 0 kcal';
        resumenGasto.innerHTML = '<i class="fas fa-minus-circle text-danger me-1"></i> Gasto: 0 kcal';
        progressBalance.className = 'progress-bar';
        progressBalance.style.width = '50%';
        resultadoBalance.className = 'badge bg-secondary';
        resultadoBalance.innerText = 'Selecciona actividad y alimento';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    calcularCalorias();
    
    @if(session('modal_actividad'))
        const modalActividad = new bootstrap.Modal(document.getElementById('nuevaActividadModal'));
        modalActividad.show();
    @endif
    
    @if(session('modal_alimento'))
        const modalAlimento = new bootstrap.Modal(document.getElementById('nuevoAlimentoModal'));
        modalAlimento.show();
    @endif
});
</script>
@endsection