<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{

    public function getTodos()
    {
        $todos = Todo::paginate(5);
        return response()->json($todos);
    }

    public function getTodo(int $todo)
    {
        $todo = Todo::find($todo);

        if(!$todo) {
            return response()->json(['error' => 'not found'], 404);
        }

        return response()->json($todo);
    }

    public  function postTodo(Request $request) {
        $this->validate($request, [
           'title' => 'required|min:3',
            'description' => 'required'
        ]);
        $model = Todo::create($request->all());

        return response()->json($model, 201);
    }

    public function deleteTodo(Request $request, int $todo) {

        $todo = Todo::find($todo);
        if(!$todo){
            return response()->json(['error' => 'not found'], 404);
        }

        $todo->delete();
        return response()->json([], 204);
    }

    public function postTodoStatus(Request $request, int $todo, string $status) {

        if(!$this->validateAvailableStatus($status)){
        return response()->json(['error' => 'available status: done, undone']);
        }

        $todo = Todo::find($todo);
        if(!$todo) {
            return response()->json(['error' => 'not found'], 404);
        }

        $status == 'done' ? $todo->done() : $todo->undone();

        return response()->json($todo);
    }

    private function validateAvailableStatus($status): bool {
        return in_array($status, ['done', 'undone']);
    }
}
