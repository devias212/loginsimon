<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Asegúrate de importar el modelo Task si lo has creado

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all(); // Obtener todas las tareas
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Task::create([
            'name' => $request->name,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
