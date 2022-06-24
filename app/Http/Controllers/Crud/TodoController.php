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
            'todo' => Todo::where(['parent_id' => null])->with('children')->get(),
        ]);
    }


    public function addTodo(Request $request): Response
    {
        $validated = $request->validate([
            'todoValue' => 'required|max:255',
            'parentId' => 'present|nullable|integer|min:1|exists:todos,id',
        ]);

        $todo = new Todo;
        $todo->todoValue = $validated['todoValue'];
        $todo->parentId = $validated['parentId'];
        $todo->save();

        return new Response($todo);
    }
}
