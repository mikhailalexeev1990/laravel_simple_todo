<?php

namespace App\Http\Controllers\Crud;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class TodoController extends BaseController
{
    public function getTodo(): Response
    {
        return new Response([
            'todo' => Todo::all(),
        ]);
    }


    public function addTodo(Request $request): Response
    {
        $validated = $request->validate([
            'todoValue' => 'required|max:255',
        ]);

        $todo = new Todo;
        $todo->todoValue = $validated['todoValue'];
        $todo->save();

        return new Response([
            'success' => true,
            '$todo' => $todo,
        ]);
    }
}
