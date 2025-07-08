<?php

namespace App\Http\Controllers;

use App\Models\Actividade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ActividadController extends Controller
{
    public function store(Request $request)
    {
       try {
            $validatedData = $request->validate([
                'tipo_actividad' => 'required|string|max:255|unique:actividades',
                'calorias_quemadas' => 'required|integer|min:0',
                'duracion_minutos' => 'required|integer|min:1'
            ]);
            
            $actividad = new Actividade();
            $actividad->tipo_actividad = $validatedData['tipo_actividad'];
            $actividad->calorias_quemadas = $validatedData['calorias_quemadas'];
            $actividad->duracion_minutos = $validatedData['duracion_minutos'];
            $actividad->save();
            
            return redirect()->route('habitos.create')
                ->with('success', 'Actividad creada exitosamente')
                ->with('nueva_actividad_id', $actividad->id);
                
        } catch (ValidationException $e) {
            return redirect()->route('habitos.create')
                ->withErrors($e->errors())
                ->withInput()
                ->with('modal_actividad', true);
        } catch (Exception $e) {
            return redirect()->route('habitos.create')
                ->with('error', 'Error al crear la actividad: ' . $e->getMessage())
                ->withInput()
                ->with('modal_actividad', true);
        }
    }
}
