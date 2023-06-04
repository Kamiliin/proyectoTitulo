<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::all();
        return view('comentario.index', compact('comentarios'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'mejora' => 'required',
        ]);

        $comentario = new Comentario;
        $comentario->nombre = $request->input('nombre');
        $comentario->descripcion = $request->input('descripcion');
        $comentario->mejora = $request->input('mejora');
        $comentario->user_id = Auth::id(); // Asignar el ID del usuario autenticado
        $comentario->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'mejora' => 'required',
        ]);

        $comentario = Comentario::find($id);

        // Verificar si el usuario autenticado es el propietario del comentario
        if ($comentario->user_id == Auth::id()) {
            $comentario->nombre = $request->input('nombre');
            $comentario->descripcion = $request->input('descripcion');
            $comentario->mejora = $request->input('mejora');
            $comentario->update();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $comentario = Comentario::find($id);

        // Verificar si el usuario autenticado es el propietario del comentario
        if ($comentario->user_id == Auth::id()) {
            $comentario->delete();
        }

        return redirect()->back();
    }
}
