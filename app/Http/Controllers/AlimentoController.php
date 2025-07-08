<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AlimentoController extends Controller
{
    public function store(Request $request)
    {
          try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255|unique:alimentos',
                'calorias' => 'required|integer|min:0',
                'tipo' => 'required|string|max:100'
            ]);
            
            $alimento = new Alimento();
            $alimento->nombre = $validatedData['nombre'];
            $alimento->calorias = $validatedData['calorias'];
            $alimento->tipo = $validatedData['tipo'];
            $alimento->save();
            
            return redirect()->route('habitos.create')
                ->with('success', 'Alimento creado exitosamente')
                ->with('nuevo_alimento_id', $alimento->id);
                
        } catch (ValidationException $e) {
            return redirect()->route('habitos.create')
                ->withErrors($e->errors())
                ->withInput()
                ->with('modal_alimento', true);
        } catch (Exception $e) {
            return redirect()->route('habitos.create')
                ->with('error', 'Error al crear el alimento: ' . $e->getMessage())
                ->withInput()
                ->with('modal_alimento', true);
        }
    }
}
