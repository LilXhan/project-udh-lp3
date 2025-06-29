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
            $habitos = Habito::where('user_id', '=', $user['id'])->first();
            return view('user.authenticated.habito.mostrar', [
                'habitos' => $habitos
            ]);
        }

        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
