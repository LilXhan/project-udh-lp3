@extends('layouts.app')

@section('content')
<h1 class="text-center">Crear Hábito</h1>
<form action="/habitos/" method="POST">
    @csrf
    <div class="form-row align-items-center">
        <div class="col-auto my-2">
            <label class="mr-sm-2" for="actividades">Actividades: </label>
            <select class="custom-select mr-sm-2" name="actividad_id" id="actividades">
            <option selected>Escoger...</option>
            @foreach($actividades as $actividad) {
            <option value="{{ $actividad->id }}">{{ $actividad->tipo_actividad }}</option>
            }
            @endforeach
            </select>
        </div>

        <div class="col-auto my-2">
            <label class="mr-sm-2" for="alimentos">Alimentos: </label>
            <select class="custom-select mr-sm-2" name="alimento_id" id="alimentos">
            <option selected>Escoger...</option>
            @foreach($alimentos as $alimento) {
            <option value="{{ $alimento->id }}">{{ $alimento->nombre }}</option>
            }
            @endforeach
            </select>
        </div>

        <div class="col-auto my-2">
            <label class="mr-sm-2" for="valor">Valor (1 - 5): </label>
            <input class="form-control" id="valor" name="valor" type="number" max="5" min="0">
        </div>

        <input hidden name="user_id" value="{{ $user->id }}">
        <div class="col-auto my-2">
            <input type="submit" class="btn btn-primary" value="Crear hábito">
        </div>
    </div>
</form>

@endsection
