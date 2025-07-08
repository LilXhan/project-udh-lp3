<?php 
?><?php

namespace App\Http\Controllers;

use App\Models\Actividade;
use App\Models\Alimento;
use App\Models\Habito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HabitoController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $habitos = Habito::where('user_id', $user->id)->with(['alimento', 'actividad'])->get();
            return view('user.authenticated.habito.mostrar', [
                'habitos' => $habitos,
                'user' => $user
            ]);
        }
        
        return redirect('login');
    }

    public function create()
    {
        $actividades = Actividade::all();
        $user = Auth::user();
        $alimentos = Alimento::all();
        
        if ($user) {
            return view('user.authenticated.habito.crear', [
                'actividades' => $actividades,
                'alimentos' => $alimentos,
                'user' => $user
            ]);
        } 

        return redirect(to: 'login');
    }

    public function store(Request $request)
    {
        $habito = new Habito();
        $habito->user_id = $request->input('user_id');
        $habito->alimento_id = $request->input('alimento_id');
        $habito->actividad_id = $request->input('actividad_id');
        $habito->valor = $request->input('valor');
        $habito->save();
        return redirect('habitos');
    }   

    public function edit(string $id)
    {
        $habito = Habito::findOrFail($id);
        $actividades = Actividade::all();
        $alimentos = Alimento::all();
        $user = Auth::user();

        if ($user) {
            return view('user.authenticated.habito.editar', [
                'habito' => $habito,
                'actividades' => $actividades,
                'alimentos' => $alimentos,
                'user' => $user
            ]);
        }

        return redirect('login');
    }

    public function update(Request $request, string $id)
    {
        $habito = Habito::findOrFail($id);
        $habito->user_id = $request->input('user_id');
        $habito->alimento_id = $request->input('alimento_id');
        $habito->actividad_id = $request->input('actividad_id');
        $habito->valor = $request->input('valor');
        $habito->save();
        return redirect('habitos');
    }

    public function destroy(string $id)
    {
        $habito = Habito::findOrFail($id);
        $habito->delete();
        return redirect('habitos');
    }
}
