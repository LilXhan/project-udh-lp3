@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-warning text-dark py-3 border-0">
                    <h3 class="mb-0 fw-bold text-center">
                        <i class="fas fa-edit me-2"></i> Editar Hábito
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('habitos.update', $habito->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="actividades" class="form-label fw-bold">
                                <i class="fas fa-running me-1"></i> Actividad
                            </label>
                            <select class="form-select @error('actividad_id') is-invalid @enderror" name="actividad_id" id="actividades" required onchange="calcularCalorias()">
                                <option value="" disabled>Selecciona una actividad...</option>
                                @foreach($actividades as $actividad)
                                    <option value="{{ $actividad->id }}" data-calorias="{{ $actividad->calorias_quemadas }}" {{ (old('actividad_id', $habito->actividad_id) == $actividad->id) ? 'selected' : '' }}>
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
                            <label for="alimentos" class="form-label fw-bold">
                                <i class="fas fa-apple-alt me-1"></i> Alimento
                            </label>
                            <select class="form-select @error('alimento_id') is-invalid @enderror" name="alimento_id" id="alimentos" required onchange="calcularCalorias()">
                                <option value="" disabled>Selecciona un alimento...</option>
                                @foreach($alimentos as $alimento)
                                    <option value="{{ $alimento->id }}" data-calorias="{{ $alimento->calorias }}" {{ (old('alimento_id', $habito->alimento_id) == $alimento->id) ? 'selected' : '' }}>
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
                                    value="{{ old('valor', $habito->valor) }}"
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
                                    <span id="resultadoBalance" class="badge bg-secondary">Calculando balance...</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-secondary">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="fas fa-calendar-alt me-2"></i> 
                                    <strong>Fecha de registro:</strong> {{ $habito->created_at->format('d/m/Y') }}
                                </div>
                                <div>
                                    <i class="fas fa-clock me-2"></i>
                                    <strong>Hora:</strong> {{ $habito->created_at->format('H:i') }}
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
                                    <p class="mb-0">El balance calórico se obtiene restando las calorías quemadas durante la actividad física de las calorías aportadas por el alimento consumido.</p>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="user_id" value="{{ $habito->user_id }}">
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('habitos.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-1"></i> Actualizar Hábito
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
});
</script>
@endsection